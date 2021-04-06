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
            if(!empty($request->search)){
                $business = $business->where('name','like','%'.$request->search.'%')
                                    ->orWhere('address','like','%'.$request->search.'%')
                                    ->orWhere('pin_code','like','%'.$request->search.'%');
            }
            $business = $business->limit(1)->offset($offset)->get();
            return response()->json(['error'=>false,'message'=>'Business Data','data'=>$business]);
        }
        return response()->json(['error'=>true,'message'=>$validate->errors()->first()]);
    }

    public function event(Request $request) {
        $request = $request->all();
        return view('front.home.event', compact('request'));
    }
    public function deal(Request $request) {
        $request = $request->all();
        return view('front.home.deal', compact('request'));
    }

    public function eventDealAjax(Request $request) {
        $rules = [
            '_token' => 'required',
            'page'=> 'required|min:0|numeric',
            'menu' => 'required'
        ];
        $validate = Validator::make($request->all(),$rules);
        if(!$validate->fails()){
            $offset = $request->page * 1;
            if($request->search != '') {
                if($request->menu == 'events') {
                    $datas = Event::select('*')->where('name','like','%'.$request->search.'%')->orWhere('postcode','like','%'.$request->search.'%')->orWhere('address','like','%'.$request->search.'%');         
                } else if ($request->menu == 'deals') {
                    $datas = Offer::select('*')->orWhere('postcode','like','%'.$request->search.'%')->orWhere('address','like','%'.$request->search.'%');
                }
            } else {
                if($request->menu == 'events') {
                    $datas = Event::select('*');         
                } else if ($request->menu == 'deals') {
                    $datas = Offer::select('*');
                }
            }
            if(auth()->check()) {
                $datas = $datas->where('postcode', auth()->user()->postcode);
            }
            $datas = $datas->with('business')->orderBy('created_at', 'DESC')->limit(1)->offset($offset)->get();
            return response()->json(['error'=>false,'message'=>'Event Data','data'=>$datas]);
        }
        return response()->json(['error'=>true,'message'=>$validate->errors()->first()]);
    }
    
}
