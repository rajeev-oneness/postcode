<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\BusinessCategory;
use App\Model\Offer;

class OfferController extends Controller
{
    /**
    * Go to Add Offers.
    *
    * @return view
    */
    public function OfferView(){
        $busCategData= BusinessCategory::all();
        $offerCatData= Offer::all();
      
        return view('/portal.offer.offer',compact('offerCatData', 'busCategData'));
    }

     /**
    * Go to Add Offers.
    *
    * @return view
    */
    public function addOffers(Request $request) {
       
        $fileName = time().'.'.$request->image->extension(); 
            $request->image->move(public_path('uploads/'), $fileName);
            $offerimg ='uploads/'.$fileName;

            $dob = $request->expire_date;
            $timestamp = strtotime($dob);
            $new_date = date("Y-m-d", $timestamp);

        $Offer = new Offer();
        $Offer->businessId = $request->business_categoryId;         
        $Offer->title = $request->title;
        $Offer->image = $offerimg;
        $Offer->price = $request->price;           
        $Offer->short_description = $request->short_description; 
        $Offer->description = $request->description;         
        $Offer->promo_code = $request->promo_code;
        $Offer->howcanredeem = $request->content;
        $Offer->expire_date = $new_date;
        $Offer->save();
           
            return redirect()->route('admin.dashboard');
    }
}
