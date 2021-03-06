<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Business;
use App\Model\BusinessCategory;
use App\Model\Product;
use App\Model\Service;
use Illuminate\Support\Facades\Auth;


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

        return view('/portal.businessprofile.business_profiles', compact('businessData', 'producData', 'servicData'));
    }

    /**
     * Go to Add Business.
     *
     * @return json
     */
    public function addBusiness(Request $request)
    {
        $response = [];
        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = array('error' => 'Error occured in Ajax Call.');
            return response()->json($response, $statusCode);
        }
        try {
            $userId = Auth::user()->id;

            $image = $request->get('image');
            if ($image == '') {
                $fileName = 'image' . time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads'), $fileName);
                $image = 'uploads/' . $fileName;
            }

            $name = $request->get('name');
            $address = $request->get('address');
            $mobile = $request->get('mobile');
            $business_categoryId = $request->get('business_categoryId');
            $open_hour = $request->get('open_hour');
            $closing_hour = $request->get('closing_hour');
            $services = $request->get('services');
            $products = $request->get('products');
            $description = $request->get('description');
            $facebook_link = $request->get('facebook_link');
            $instagram_link = $request->get('instagram_link');
            $twitter_link = $request->get('twitter_link');
            $youtube_link = $request->get('youtube_link');
            $linkedin_link = $request->get('linkedin_link');



            $Business = new Business();
            $Business->business_categoryId = $business_categoryId;
            $Business->userId = $userId;
            $Business->image = $image;
            $Business->name = $name;
            $Business->address = $address;
            $Business->mobile = $mobile;
            $Business->open_hour = $open_hour;
            $Business->closing_hour = $closing_hour;
            $Business->services = $services;
            $Business->products = $products;
            $Business->description = $description;
            $Business->facebook_link = $facebook_link;
            $Business->facebook_link = $facebook_link;
            $Business->instagram_link = $instagram_link;
            $Business->twitter_link = $twitter_link;
            $Business->youtube_link = $youtube_link;
            $Business->linkedin_link = $linkedin_link;

            $Business->save();
            $response = array(
                'status' => 1,
                'message' => 'Business Details Are Inserted Successfully'
            );
        } catch (\Exception $e) {
            $response = array(
                'exception' => true,
                'exception_message' => $e->getMessage(),
            );
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
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
        $lead_edit_id = $request->lead_edit_id;
        $businessprofile_data = Business::where('id', $lead_edit_id)->first();
        return view('portal.businessprofile.edit_businessprofile', compact('businessprofile_data', 'businessCatData', 'productsData', 'servicessData'));
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
