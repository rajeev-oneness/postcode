<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\BusinessCategory;
use App\Model\Offer;
use Validator,Redirect,Response;


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

        $validator = Validator::make($request->all(), [
            'business_categoryId' => 'required|min:1|max:20',
            'title' => 'required',
            'short_description' => 'required|min:4|max:255',
            'description' => 'required|min:4|max:255',
            'price' => 'required|numeric',
            'promo_code' => 'required',
            'content' => 'required',
            'expire_date' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',         
        ]);
       $validator->validate();
       
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

      /**
     * Go to manage events view.
     *
     * @param  Request $request
     * @return view
     */
    public function manageOffers(Request $request){
        $categories = Offer::with(['offercattype' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->get();
        // echo json_encode($categories1);die;
        return view('/portal.offer.manage_offers',compact('categories'));
    }

     /**
     * Go to Edit Offers view.
     *
     * @param  Request $request
     * @return view
     */
    public function editOffer(Request $request) {      
        $lead_events_id = $request->app_id;
        $businesofferData= BusinessCategory::all();
        $editedoffers_data = Offer::where('id', $lead_events_id)->first();
        // echo json_encode($businessSerData);die;
        return view('portal.offer.edit_offers', compact('editedoffers_data', 'businesofferData'));
        
    }

    /**
    * Go to Update Offers.
    *
    * @return view
    */
    public function updateOffers(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);
        $fileName = time().'.'.$request->image->extension(); 
            $request->image->move(public_path('uploads/'), $fileName);
            $imgupdate ='uploads/'.$fileName;

        $hid_id = $request->hid_id;
        $update_offer_data = Offer::where('id', $hid_id)->update(['title' => $request->title, 'businessId' => $request->business_categoryId, 'description' => $request->description, 'image' => $imgupdate, 'price' => $request->price, 'short_description' => $request->short_description, 'promo_code' => $request->promo_code, 'expire_date' => $request->expire_date, 'howcanredeem' => $request->howcanredeem]);   
            return redirect()->route('admin.manage_offers');
    }

     /**
     * Go to Delete Offers.
     *
     * @param  Request $request
     * @return view
     */
    public function deleteOffers(Request $request) {
        $lead_delete_id = $request->appdel_id;
        $delete_event = Offer::where('id', $lead_delete_id)->delete();
        return redirect()->route('admin.manage_offers');
    }
}
