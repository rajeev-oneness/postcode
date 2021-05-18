<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Business;
use App\Model\BusinessCategory;
use App\Model\Product;
use App\Model\Service;
use App\Model\Event;
use App\Model\State;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator,Redirect,Response;


class BusinessController extends Controller
{
    public function index() {
        $businessCategories = BusinessCategory::all();
        $producData = Product::all();
        $servicData = Service::all();
        $stateData = State::all();
        return view('front.business.add', compact('businessCategories', 'producData', 'servicData', 'stateData'));
    }
    public function manage() {
        $businessDatas = Business::all();
        return view('front.business.manage', compact('businessDatas'));
    }
    public function edit($businessId) {
        $businessCatData = BusinessCategory::all();
        $productsData = Product::all();
        $servicessData = Service::all();
         $stateData = State::all();
        $businessprofile_data = Business::where('id', $businessId)->first();
        return view('front.business.edit', compact('businessprofile_data', 'businessCatData', 'productsData', 'servicessData', 'stateData'));
    }
    public function delete(request $request) {
        // dd($request->id);
        $businessData = Business::find($request->id);
        $businessData->delete();
    }
    /**
     * Go to  Business Profile.
     *
     * @return view
     */
    public function BusinessProfiles()
    {
        $businessData = BusinessCategory::all();
        $producData = Product::all();
        $servicData = Service::all();
        $stateData = State::all();

        return view('/portal.businessprofile.business_profiles', compact('businessData', 'producData', 'servicData', 'stateData'));
    }

    /**
     * Go to Add Business.
     *
     * @return json
     */
    public function addBusinessProfile(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'unique:businesses',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);
        $validator->validate();
        try {

            $fileName = time().'.'.$request->image->extension(); 
            $request->image->move(public_path('uploads/'), $fileName);
            $busiprofimg ='uploads/'.$fileName;

            $password = \Hash::make($request->password);

            $Business = new Business();        
            $Business->email = $request->email;
            $Business->abn = $request->abn;
            $Business->password = $password;
            $Business->company_website = $request->company_website;
            $Business->image = $busiprofimg;
            $Business->name = $request->name;
            $Business->address = $request->address;
            $Business->mobile = $request->mobile;  
            $Business->open_hour = $request->open_hour;  
            $Business->closing_hour = $request->closing_hour;  
            $Business->services = $request->services; 
            $Business->products = $request->products; 
            $Business->state_id = $request->state_id;  
            $Business->business_categoryId = $request->business_categoryId;  
            $Business->pin_code = $request->pin_code;  
            $Business->description = $request->description;  
            $Business->facebook_link = $request->facebook_link;  
            $Business->instagram_link = $request->instagram_link;  
            $Business->twitter_link = $request->twitter_link; 
            $Business->youtube_link = $request->youtube_link; 
            $Business->linkedin_link = $request->linkedin_link;     
            
            // echo json_encode($Business);die;

            $Business->save();
        
            return redirect()->route('admin.manage_businessprofiles')->with('Success','Business Added Successfully');
        }catch (\Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * Go to Manage Business Profile View.
     *
     * @return view
     */
    public function businessProfileDetails(Request $request)
    {
        $businesses = Business::all();
        return view('/portal.businessprofile.manage_businessprofiles', compact('businesses'));
    }

    /**
     * Go to Delete Business Profiles.
     *
     * @return view
     */
    public function deleteBusinessProfiles($lead_delete_id)
    {
        $delete_data = Business::where('id', decrypt($lead_delete_id))->delete();
        return redirect()->route('admin.manage_businessprofiles')->with('Success','Business Deleted Successfully');
    }

    /**
     * Go to Edit Business Profiles.
     *
     * @return view
     */
    public function editBusinessProfiles($lead_edit_id)
    {
        $businessCatData = BusinessCategory::all();
        $productsData = Product::all();
        $servicessData = Service::all();
        $stateData = State::all();
        $businessprofile_data = Business::where('id', decrypt($lead_edit_id))->first();
        return view('portal.businessprofile.edit_businessprofile', compact('businessprofile_data', 'businessCatData', 'productsData', 'servicessData', 'stateData'));
    }

    /**
     * Go to Update Business Profiles.
     *
     * @return view
     */
    public function updateBusinessProfiles(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $validator->validate();
        try {
            if($request->hasFile('image')) {
                $fileName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/'), $fileName);
                $qdesc = 'uploads/' . $fileName;
                $update_businesscategory_data = Business::where('id', $hid_id)->update([
                    'image' => $qdesc,
                ]);
            }
            $hid_id = $request->hid_id;
            $update_businesscategory_data = Business::where('id', $hid_id)->update([
                'name' => $request->name, 
                'business_categoryId' => $request->business_categoryId, 
                'address' => $request->address,
                'pin_code' => $request->pin_code,
                'state_id' => $request->state_id, 
                'mobile' => $request->mobile, 
                'open_hour' => $request->open_hour, 
                'closing_hour' => $request->closing_hour, 
                'services' => $request->services, 
                'products' => $request->products, 
                'description' => $request->description, 
                'facebook_link' => $request->facebook_link, 
                'instagram_link' => $request->instagram_link, 
                'twitter_link' => $request->twitter_link, 
                'youtube_link' => $request->youtube_link, 
                'linkedin_link' => $request->linkedin_link
            ]);
            $userId = Business::where('id', $request->hid_id)->first();
            $user = User::find($userId->user_id);
            $user->name = $request->name;
            $user->address = $request->address;
            $user->postcode = $request->pin_code;
            $user->stateId = $request->state_id;
            $user->save();
            return redirect()->route('admin.manage_businessprofiles')->with('Success','Business Updated Successfully');
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }
    public function dashboardView(Request $request)
    {
        $product=Product::where('created_by', auth()->user()->id);
        $BusinessCategory=BusinessCategory::where('created_by', auth()->user()->id);
        $event=Event::where('created_by', auth()->user()->id);
       return view('business-portal.dashboard',compact('product','BusinessCategory','event'));
    }

    public function businessProfile()
    {
        $business = User::with('business')->where('id', auth()->id())->get();
        return view('business-portal.profile.index',compact('business'));
    }

    public function editMyBusinessProfile()
    {
        $businessCatData = BusinessCategory::all();
        $productsData = Product::where('created_by', auth()->id())->get();
        $servicessData = Service::where('created_by', auth()->id())->get();
        $stateData = State::all();
        $businessprofile_data = Business::where('user_id', auth()->id())->first();
        return view('business-portal.profile.edit',compact('businessprofile_data', 'businessCatData', 'productsData', 'servicessData', 'stateData'));
    }

    public function updateMyBusinessProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $validator->validate();
        try {
            if($request->hasFile('image')) {
                $fileName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/'), $fileName);
                $qdesc = 'uploads/' . $fileName;
                $update_businesscategory_data = Business::where('id', $hid_id)->update([
                    'image' => $qdesc,
                ]);
            }
            $update_businesscategory_data = Business::where('user_id', auth()->id())->update([
                'name' => $request->name, 
                'business_categoryId' => $request->business_categoryId, 
                'address' => $request->address,
                'pin_code' => $request->pin_code,
                'state_id' => $request->state_id, 
                'mobile' => $request->mobile, 
                'open_hour' => $request->open_hour, 
                'closing_hour' => $request->closing_hour, 
                'services' => $request->services, 
                'products' => $request->products, 
                'description' => $request->description, 
                'facebook_link' => $request->facebook_link, 
                'instagram_link' => $request->instagram_link, 
                'twitter_link' => $request->twitter_link, 
                'youtube_link' => $request->youtube_link, 
                'linkedin_link' => $request->linkedin_link
            ]);
            $user = User::find(auth()->id());
            $user->name = $request->name;
            $user->address = $request->address;
            $user->postcode = $request->pin_code;
            $user->stateId = $request->state_id;
            $user->save();


            return redirect()->route('my.business.profile');
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }

}
