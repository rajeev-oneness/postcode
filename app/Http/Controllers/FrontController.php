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
use App\Model\UserPurchase;
use App\Model\Community;
use App\Model\CommunityGroup;
use App\Model\ProductCart;
use Auth;
use Validator;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{

    public function homepage() {
        $businesses = Business::all();
        $threebusinesses = Business::limit(3)->get();
        $postcodes = Postcode::all();
        $offers = offer::limit(5)->get();
        $categories = BusinessCategory::all();
        $communities = Community::all();
        return view('front.home.index', compact('threebusinesses','businesses','postcodes','categories','offers','communities'));
    }
    public function postcodeDeatils(Request $req) {
        // businesses
        $businesses = Business::select('*');
        if ($req->postcode != '' && $req->category != '') {
            $businesses = $businesses->where('pin_code', $req->postcode)->where('business_categoryId', $req->category);
        } elseif ($req->postcode == '' && $req->category != '') {
            $request = new Request([
                'postcode' => '',
                'category' => $req->category,
            ]);
            return $this->directory($request);
        } elseif ($req->postcode != '' && $req->category == '') {
            $businesses = $businesses->where('pin_code', $req->postcode);
        }
        $businesses = $businesses->get();
        
        //ratings
        $pluck = $businesses->pluck('id');
        $ratingsDetails = Rating::whereIn('business_id',$pluck)->get();
        
        //postcode details
        $postcode = Postcode::where('postcode', $req->postcode)->first();
        
        //offers
        $offers = Offer::where('postcode', $req->postcode)->where('expire_date', '>=', date("Y-m-d"))->limit(5)->get();
        
        //events
        $events = Event::where('postcode', $req->postcode)->where('end', '>=', date("Y-m-d"))->limit(3)->get();
        
        //communities
        $communities = CommunityGroup::where('postcode', $req->postcode)->get();
        //category
        $category = $req->category;
        return view('front.home.postcode-details', compact('businesses','postcode','offers','events','communities','category', 'ratingsDetails'));
    }
    public function getLatLng(Request $req) {
        // businesses
        $businesses = Business::select('*');
        if ($req->postcode != '' && $req->category != '') {
            $businesses = $businesses->where('pin_code', $req->postcode)->where('business_categoryId', $req->category);
        } elseif ($req->postcode == '' && $req->category != '') {
            $businesses = $businesses->where('business_categoryId', $req->category);
        } elseif ($req->postcode != '' && $req->category == '') {
            $businesses = $businesses->where('pin_code', $req->postcode);
        }
        $businesses = $businesses->get();
        
        return response()->json(['error' => false, 'data' => $businesses]);
    }
    
    public function directory(Request $request) {
        $request = $request->except('_token');
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
            $offset = $request->page * 10;
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
            $count = $business->count();
            $business = $business->with('ratings')->limit(10)->offset($offset)->get();
            return response()->json(['error' => false, 'message' => 'Business Data', 'data' => $business, 'total' => $count]);
        }
        return response()->json(['error'=>true,'message'=>$validate->errors()->first()]);
    }

    public function event(Request $request) {
        $request = $request->except('_token');
        // $request = $request->all();
        $event = Event::all();
        // dd($event);
        return view('front.home.event', compact('request', 'event'));
    }
    public function deal(Request $request) {
        $request = $request->except('_token');
        // $request = $request->all();
        return view('front.home.deal', compact('request'));
    }
    public function marketplace(Request $request) {
        $request = $request->except('_token');
        // $request = $request->all();
        return view('front.home.marketplace', compact('request'));
    }
    public function getmarketplace (Request $request) {
        $offset = $request->page * 10;
        if($request->search == '') {
            $datas = Product::with('category', 'subcategory')->orderBy('created_at', 'DESC')->limit(10)->offset($offset)->get();
        } else {
            $datas = Product::where('name','like','%'.$request->search.'%')->with('category', 'subcategory')->orderBy('created_at', 'DESC')->limit(10)->offset($offset)->get();
        }
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
            $offset = $request->page * 10;
            if($request->search != '') {
                $search = $request->search;
                if($request->menu == 'events') {
                    $datas = Event::select('*')
                    ->where('end', '>=', date("Y-m-d"))
                    ->where(function($datas) use ($search) {
                        $datas->where('name', 'like', '%' . $search . '%')
                        ->orWhere('postcode','like','%'.$search.'%');
                    })
                    ->with('eventcattype','ratings');         
                } else if ($request->menu == 'deals') {
                    $datas = Offer::select('*')
                    ->where('expire_date', '>=', date("Y-m-d"))
                    ->where(function($datas) use ($search) {
                        // $datas->where('title','like','%'.$search.'%');
                        $datas->whereBetween('postcode', [$search-5, $search+5]);
                    });
                }
            } else {
                if($request->menu == 'events') {
                    $datas = Event::select('*')->where('end', '>=', date("Y-m-d"))->with('eventcattype','ratings');         
                } else if ($request->menu == 'deals') {
                    $datas = Offer::select('*')->where('expire_date', '>=', date("Y-m-d"));
                }
            }
            if(auth()->check()) {
                $datas = $datas->where('postcode', auth()->user()->postcode);
            }
            $count = $datas->count();
            $datas = $datas->with('business')->orderBy('created_at', 'DESC')->limit(10)->offset($offset)->get();

            //dd($datas);
            return response()->json(['error'=>false,'message'=>'Data','data'=>$datas, 'total' => $count]);
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

            $data = Event::where('id', $request->id)->with('business','agegroup')->first();
            return view('front.home.event-details', compact('data'));
        
        } else if($request->name == 'deal') {

            $data = Offer::where('id', $request->id)->with('business')->first();
            return view('front.home.deal-details', compact('data'));
        
        } else if($request->name == 'marketplace') {

            $data = Product::where('id', $request->id)->get();
            return view('front.home.product-details', compact('data'));
        
        }  else if($request->name == 'community') {

            $data = Community::where('id', $request->id)->first();
            return view('front.home.community-details', compact('data'));
        
        } 
    }

    public function addToCart(Request $req)
    {
        $product_cart = new ProductCart;
        $product_cart->user_id = auth()->id();
        $product_cart->product_id = $req->product_id;
        $product_cart->amount = 1;
        $product_cart->price = $req->price;
        $product_cart->save();
        
        return response()->json(['data' => $product_cart]);
    }

    public function myCart()
    {
        $cart = ProductCart::where('user_id', auth()->id())->get();
        return view('front.home.marketplace-cart', compact('cart'));
    }

    public function buyNow(Request $request,$product_ids)
    {
        $product_id_array = decrypt($product_ids);
        $total_price = 0;
        foreach ($product_id_array as $product_id) {
            $product = Product::findorFail($product_id);
            $total_price = $total_price+$product->price;
        }
        $data = [
            'redirectUrl' => route('item.product.payment',$product_ids),
            'price' => $total_price,
        ];
        return view('stripe.index',compact('data'));
    }

    public function successfullPayment(Request $request,$product_ids){
        $product_id_array = decrypt($product_ids);
        foreach ($product_id_array as $product_id) {
            $userPurchase = new UserPurchase;
            $userPurchase->user_id = auth()->user()->id;
            $userPurchase->product_id = $product_id;
            $userPurchase->stripeTransactionId = $request->stripeTransactionId;
            $userPurchase->save();
        }
        return redirect(route('payment.successfull.thankyou',$request->stripeTransactionId));
    }

}
