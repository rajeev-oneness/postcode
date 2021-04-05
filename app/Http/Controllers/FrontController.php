<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Business;
use App\Model\BusinessCategory;
use App\Model\Event;
use App\Model\Offer;
use App\Model\Rating;
use App\Model\Country;
use App\Model\State;
use App\Model\Postcode;
use Auth;
use Validator;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    // public function directory() {
    //     $ratings = Rating::all();
    //     $businesses = Business::orderBy('created_at', 'DESC')->get();
    //     return view('front.directory', compact('businesses','ratings'));
    // }
    
    public function homepage() {
        $businesses = Business::all();
        $postcodes = Postcode::all();
        $categories = BusinessCategory::all();
        return view('front.home.index', compact('businesses','postcodes','categories'));
    }

    // public function search(Request $req) {
    //     // dd($req->all());
    //     $keyword = $req->keyword;
    //     $postcode = $req->postcode;
    //     $category = $req->category;
    //     $businesses = Business::where([
    //         ['name', 'LIKE', '%' . $keyword . '%'],
    //         ['pin_code', 'LIKE', '%' . $postcode . '%'],
    //         ['business_categoryId', 'LIKE', '%' . $category . '%'],
    //     ])->get();
    //     if(count($businesses) == 0){
    //         $req->session()->flash('noData', 'Sorry! no data found');
    //         return back();
    //     }
    //     // dd($businesses);
    //     return view('front.home.directory-search', compact('businesses'));
    // }

    // public function statePostcode(Request $request) 
    // {
        
    // }
    
    public function directory(Request $request) {
        // $business = Business::select('*');
        // if(auth()->check()){
        //     $business = $business->where('pin_code', auth()->user()->postcode);
        // }
        // $business = $business->get();
        //$businesses = [];
        $request = $request->all();
        // dd($request);
        return view('front.home.directory-search',compact('request'));
    }

    public function getBusinessByState(Request $request)
    {
        // dd($request->all());
        $rules = [
            'stateId' => '',
            'page'=> 'required|min:0|numeric',
            'keyword '=>'',
            'postcode'=>'',
            'category' => '',
        ];
        $validate = Validator::make($request->all(),$rules);
        if(!$validate->fails()){
            $offset = $request->page * 1;
            $business = Business::select('*');
            if(!empty($request->stateId)){
                $business = $business->where('state_id','like','%'.$request->stateId.'%');
            }
            if(!empty($request->keyword)){
                $business = $business->where('name','like','%'.$request->keyword.'%');
            }
            if(!empty($request->postcode)){
                $business = $business->where('pin_code','like','%'.$request->postcode.'%');
            }
            if(!empty($request->category)){
                $business = $business->where('business_categoryId','like','%'.$request->category.'%');
            }
            $business = $business->limit(1)->offset($offset)->get();
            return response()->json(['error'=>false,'message'=>'Business Data','data'=>$business]);
        }
        return response()->json(['error'=>true,'message'=>$validate->errors()->first()]);
    }

    public function event() {
        $events = Event::with('business')->get();
        if(auth()->check()) {
            $events = Event::where('state_id', auth()->user()->stateId)->with('business')->get();
        }
        return view('front.home.event', compact('events'));
    }

    public function deal() {
        $deals = Offer::with('business')->get();
        return view('front.home.deal', compact('deals'));
    }
}
