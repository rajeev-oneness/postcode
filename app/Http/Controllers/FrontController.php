<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Business;
use App\Model\BusinessCategory;
use App\Model\Event;
use App\Model\Offer;
use App\Model\Rating;
use App\Model\Product;
use App\Model\Country;
use App\Model\State;
use App\Model\Postcode;
use Auth;
use Validator;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{

    public function homepage() {
        $businesses = Business::all();
        $postcodes = Postcode::all();
        $categories = BusinessCategory::all();
        return view('front.home.index', compact('businesses','postcodes','categories'));
    }
    
    public function directory(Request $request) {
        $request = $request->all();
        return view('front.home.directory-search',compact('request'));
    }

    public function getBusinessByState(Request $request)
    {
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
            if(!empty($request->id)){
                $business = $business->where('id', $request->id)->get();
                return response()->json(['error'=>false,'message'=>'Business Details','data'=>$business, 'details' => 1]);
            }
            $business = $business->with('ratings')->limit(1)->offset($offset)->get();
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
    public function marketplace(Request $request) {
        $request = $request->all();
        return view('front.home.marketplace', compact('request'));
    }
    public function getmarketplace (Request $request) {
        $offset = $request->page * 1;
        $datas = Product::with('category', 'subcategory')->orderBy('created_at', 'DESC')->limit(1)->offset($offset)->get();
        return response()->json(['error'=>false,'message'=>'Product Data','data'=>$datas]);
    }
    public function eventDealAjax(Request $request) {
        // dd($request->all());
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
    
    //details of each sections
    public function details(Request $request) {
        if($request->name == 'business') {

            $data = Business::where('id', $request->id)->with('businesstype','services','products','events','offers','ratings')->get()->toArray();
            $ratings = Rating::with('user')->where('business_id' ,$request->id)->get();
            return view('front.home.business-details', compact('data', 'ratings'));
        
        } else if($request->name == 'event') {

            $data = Event::where('id', $request->id)->with('business','agegroup')->get();
            return view('front.home.event-details', compact('data'));
        
        } else if($request->name == 'deal') {

            $data = Offer::where('id', $request->id)->with('business')->get();
            return view('front.home.deal-details', compact('data'));
        
        }  
    }

}
