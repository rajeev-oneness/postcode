<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Business;
use App\Model\BusinessCategory;
use App\Model\Product;
use App\Model\Service;
use App\Model\State;
use Illuminate\Support\Facades\Auth;
use Validator,Redirect,Response;


class BusinessController extends Controller
{
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
            'business_categoryId' => 'required|min:1|max:20',
            'name' => 'required',
            'email' => 'required|unique:businesses',
            'description' => 'required|min:4|max:255',
            'address' => 'required|min:4|max:255',
            'pin_code' => 'required|max:6',
            'mobile' => 'required',
            'facebook_link' => 'required',
            'instagram_link' => 'required',
            'twitter_link' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            
        ]);
       $validator->validate();
          

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
       
        return redirect()->route('admin.manage_businessprofiles');
}

    /**
     * Go to Manage Business Profile View.
     *
     * @return view
     */
    public function businessProfileDetails(Request $request)
    {
        $response = [];
        $perm = null;
        $statusCode = 200;
        $users = array(); //Should be changed #4
        $search_val = array();
        try {
            $draw = $request->draw;
            $offset = $request->start;
            $length = $request->length;
            $search = $request->search["value"];
            $order = $request->order;
            //print_r($order);die;

            $users = Business::all();


            $filtered = Business::with('businesstype')->where(function ($q) use ($search) {
                $q->orwhere('name', 'like', '%' . $search . '%');
                $q->orwhere('address', 'like', '%' . $search . '%');
                $q->orwhere('image', 'like', '%' . $search . '%');
            });
            $ordered = $filtered;
            $filtered_count = $filtered->count();
            //echo count ( $order );die;
            for ($i = 0; $i < count($order); $i++) {
                $ordered = $ordered->orderBy($request->columns[$order[$i]['column']]['data'], strtoupper($order[$i]['dir']));
            }
            $page_displayed = $ordered->offset($offset)->limit($length)->get();
            $data = array();
            if (!empty($page_displayed)) {
                foreach ($page_displayed as $user) {
                    
                    $nestedData['id'] = $user->id;
                    $nestedData['businessId'] = $user->businesstype->name;
                    $nestedData['address'] = $user->address;
                    $nestedData['name'] = $user->name;
                    $nestedData['image'] = $user->image;
                    $view = $edit_button = $user->id;
                    $nestedData['action'] = array('e' => $edit_button);
                    $data[] = $nestedData;
                }
            }
            $response = array(
                "draw" => $draw,
                "recordsTotal" => $users->count(), //Should be changed #7
                "recordsFiltered" => $filtered_count,
                'businessprofile_details' => $data //Should be changed #8
            );
        } catch (\Exception $e) {
            $response = array(
                'exception' => true,
                'exception_message' => $e->getMessage()
            );
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    /**
     * Go to Delete Business Profiles.
     *
     * @return view
     */
    public function deleteBusinessProfiles(Request $request)
    {
        $lead_delete_id = $request->lead_delete_id;
        $delete_data = Business::where('id', $lead_delete_id)->delete();
        return redirect()->route('admin.manage_businessprofiles');
    }

    /**
     * Go to Edit Business Profiles.
     *
     * @return view
     */
    public function editBusinessProfiles(Request $request)
    {
        $businessCatData = BusinessCategory::all();
        $productsData = Product::all();
        $servicessData = Service::all();
         $stateData = State::all();
        $lead_edit_id = $request->lead_edit_id;
        $businessprofile_data = Business::where('id', $lead_edit_id)->first();
        return view('portal.businessprofile.edit_businessprofile', compact('businessprofile_data', 'businessCatData', 'productsData', 'servicessData', 'stateData'));
    }

    /**
     * Go to Update Business Profiles.
     *
     * @return view
     */
    public function updateBusinessProfiles(Request $request)
    {
        $fileName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/'), $fileName);
        $qdesc = 'uploads/' . $fileName;
        $hid_id = $request->hid_id;

        $update_businesscategory_data = Business::where('id', $hid_id)->update(['name' => $request->name, 'business_categoryId' => $request->business_categoryId, 'address' => $request->address, 'image' => $qdesc, 'mobile' => $request->mobile, 'open_hour' => $request->open_hour, 'closing_hour' => $request->closing_hour, 'services' => $request->services, 'products' => $request->products, 'description' => $request->description, 'facebook_link' => $request->facebook_link, 'instagram_link' => $request->instagram_link, 'twitter_link' => $request->twitter_link, 'youtube_link' => $request->youtube_link, 'linkedin_link' => $request->linkedin_link]);
        return redirect()->route('admin.manage_businessprofiles');
    }
}
