<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\BusinessCategory;
use App\Model\Business;
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
        $busCategData= Business::all();
        $offerCatData= Offer::all();
        if(auth()->user()->userType == 3){
            $offerCatData= Offer::where('created_by', auth()->user()->id)->get();
            return view('business-portal.offer.offer',compact('offerCatData', 'busCategData'));
        }
        return view('/portal.offer.offer',compact('offerCatData', 'busCategData'));
    }

     /**
    * Go to Add Offers.
    *
    * @return view
    */
    public function addOffers(Request $request) {

        $validator = Validator::make($request->all(), [
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',         
        ]);
       $validator->validate();
       try {
        $fileName = time().'.'.$request->image->extension(); 
        $request->image->move(public_path('uploads/'), $fileName);
        $offerimg ='uploads/'.$fileName;

        $dob = $request->expire_date;
        $timestamp = strtotime($dob);
        $new_date = date("Y-m-d", $timestamp);

        $business = Business::where('user_id', auth()->user()->id)->first();

        $Offer = new Offer();
        if(auth()->user()->userType != 3){
            $Offer->businessId = $request->business_categoryId;         
        } else {
            $Offer->businessId = $business->id;
        }
        $Offer->title = $request->title;
        $Offer->image = $offerimg;
        $Offer->price = $request->price;           
        $Offer->short_description = $request->short_description; 
        $Offer->description = $request->description;         
        $Offer->promo_code = $request->promo_code;
        $Offer->howcanredeem = $request->content;
        $Offer->expire_date = $new_date;
        $Offer->created_by = auth()->user()->id;
        $Offer->address = auth()->user()->address;
        $Offer->postcode = auth()->user()->postcode;
        $Offer->save();
            if(auth()->user()->userType == 3){
                return redirect()->route('business-admin.manage_offers');
            }
            return redirect()->route('admin.manage_offers');
        }catch (\Exception $e) {
            report($e);
    
            return false;
        }
    }

      /**
     * Go to manage events view.
     *
     * @param  Request $request
     * @return view
     */
    public function manageOffers(Request $request){
        if(auth()->user()->userType == 3){
            $categories = Offer::where('created_by', auth()->user()->id)->with(['offercattype' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }])->paginate(3);
            // echo json_encode($categories);die;
            return view('business-portal.offer.manage_offers',compact('categories'));
        }
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
    // public function editOffer(Request $request) {      
    //     $lead_events_id = $request->app_id;
    //     $businesofferData= BusinessCategory::all();
    //     $editedoffers_data = Offer::where('id', $lead_events_id)->first();
    //     // echo json_encode($businessSerData);die;
    //     return view('portal.offer.edit_offers', compact('editedoffers_data', 'businesofferData'));
        
    // }

    public function editOffer($id) {      
     
        $businesofferData= Business::all();
        $editedoffers_data = Offer::findOrFail(decrypt($id));
        // echo json_encode($edited_data);die;
        if(auth()->user()->userType == 3){
            return view('business-portal.offer.edit_offers', compact('editedoffers_data', 'businesofferData'));
        }
        return view('portal.offer.edit_offers', compact('editedoffers_data', 'businesofferData'));
        
    }

    /**
    * Go to Update Offers.
    *
    * @return view
    */
    public function updateOffers(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',         
        ]);
       $validator->validate();
       try {
            $business = Business::where('user_id', auth()->user()->id)->first();
            if(auth()->user()->userType != 3){
                $businessId = $request->business_categoryId;         
            } else {
                $businessId = $business->id;
            }
            $hid_id = $request->hid_id;
            if($request->hasFile('image')) {
                $fileName = time().'.'.$request->image->extension(); 
                $request->image->move(public_path('uploads/'), $fileName);
                $imgupdate ='uploads/'.$fileName;
                $update_offer_data = Offer::where('id', $hid_id)->update([
                    'image' => $imgupdate
                ]);
            }
            
            $update_offer_data = Offer::where('id', $hid_id)->update([
                'title' => $request->title, 
                'businessId' => $businessId, 
                'description' => $request->description,  
                'price' => $request->price, 
                'short_description' => $request->short_description, 
                'promo_code' => $request->promo_code, 
                'expire_date' => date("Y-m-d", strtotime($request->expire_date)), 
                'howcanredeem' => $request->howcanredeem
            ]);   
            if(auth()->user()->userType == 3){
                return redirect()->route('business-admin.manage_offers');
            }
            return redirect()->route('admin.manage_offers');
        }catch (\Exception $e) {
            report($e);
    
            return false;
        }
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
        if(auth()->user()->userType == 3){
            return redirect()->route('business-admin.manage_offers');
        }
        return redirect()->route('admin.manage_offers');
    }
}
