<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Postcode;
use App\Model\BusinessCategory;
use App\Model\Business;
use App\Model\Lead;
use Validator;
use Illuminate\Support\Facades\DB;
use Mail;

class LeadController extends Controller
{
    public function index()
    {
        $postcodes = Postcode::all();
        $businessCategories = BusinessCategory::all();
        return view('front.home.leads.local-leads', compact('postcodes', 'businessCategories'));
    }
    public function search(Request $request)
    {
        $request = $request->all();
        return view('front.home.leads.local-leads-search', compact('request'));
    }
    public function getLeads(Request $request)
    {
        $rules = [
            'page'=> 'required|min:0|numeric',
            'postcode'=>'required|numeric',
            'category' => 'required|numeric',
        ];
        $validate = Validator::make($request->all(),$rules);
        if(!$validate->fails()){
            $offset = $request->page * 10;
            $business = Business::select('*');
            $business = $business->where('pin_code', $request->postcode)->where('business_categoryId', $request->category);
            $count = $business->count();
            $business = $business->with('ratings')->limit(10)->offset($offset)->get();
            return response()->json(['error' => false, 'message' => 'Business Data', 'data' => $business, 'total' => $count]);
        }
        return response()->json(['error'=>true,'message'=>$validate->errors()->first()]);
    }
    public function submitQuoteRequest(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'quote_id' => 'required',
            'name' => 'required', 
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'importance' => 'required|numeric|min:1'
        ]);
        
        DB::beginTransaction();
        try {
            if(count($req->quote_id) > 0)
            {
                $businessNames = [];
                foreach ($req->quote_id as $business_id	) {
                    $lead = new Lead();
                    $lead->business_id	 = $business_id;
                    $userName = $req->name;
                    $userEmail = $req->email;
                    $userPhn = $req->phone;
                    $importance = $req->importance;
                    $lead->name = $userName;
                    $lead->email = $userEmail;
                    $lead->phone = $userPhn;
                    $lead->importance = $importance;
                    $lead->save();
                    
                    //business details
                    $business = Business::find($business_id);
                    $businessEmail = $business->email;
                    $businessName = $business->name;
                    array_push($businessNames, $businessName);

                    // dd('first mail');
                    \Mail::send('emails/business-lead', 
                    array('userName' => $userName, 'userEmail' => $userEmail, 'userPhn' => $userPhn, 'businessEmail' => $businessEmail, 'businessName' => $businessName, 'importance' => $importance), function ($message) use ($userName, $userEmail, $userPhn, $businessEmail, $businessName) {
                        $message->to($businessEmail, $businessName);
                        $message->subject('Quotation Request From Our Postcode');
                        $message->from($userEmail, $userName);
                    });
                }
                $userName = $req->name;
                $userEmail = $req->email;
                $business = implode(', ', $businessNames);
                // dd($business);
                \Mail::send('emails/user-lead', 
                array('userName' => $userName, 'userEmail' => $userEmail, 'business' => $business), 
                function ($message) use ($userName, $userEmail, $business) {
                    $message->to($userEmail, $userName);
                    $message->subject('Quotation Request To Our Postcode');
                    $message->from('ourpostcode@test.com', 'Our Postcode');
                });
            }
            DB::commit();
            return redirect()->route('local.leads')->with('Success','Request submitted successfully!');
        }catch (\Exception $e) {
            DB::rollback();
            report($e);
            return false;
        }
    }
}
