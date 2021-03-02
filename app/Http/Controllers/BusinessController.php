<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Model\Business;
use App\Model\BusinessCategory;
use App\Model\Product;
use App\Model\Service;
use Illuminate\Support\Facades\Auth;


class BusinessController extends Controller
{
    /**
    * Go to Add Businesses.
    *
    * @return view
    */
    public function BusinessProfiles(){
        $businessData= BusinessCategory::all();
        $producData= Product::all();
        $servicData= Service::all();

      
        return view('/portal.business_profiles',compact('businessData', 'producData', 'servicData'));
    }


    public function addProduct(Request $request) {
        $response = [];
        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = array('error' => 'Error occured in Ajax Call.');
            return response()->json($response, $statusCode);
        }
        try {
            $image = $request->get('image');  
           if($image==''){
            $fileName = 'image'.time().'.'.$request->image->extension(); 
            $request->image->move(public_path('uploads'), $fileName);
            $image ='uploads/'.$fileName;
           }

            $name = $request->get('name');
            $details = $request->get('details');           
            $price = $request->get('price');
            $businessId = $request->get('businessId');                  
           
            $Product = new Product();
            $Product->businessId = $businessId;         
            $Product->name = $name;
            $Product->image = $image;
            $Product->details = $details;           
            $Product->price = $price;
          
        //    echo json_encode($Product);die;
         
            $Product->save();
            $response = array(
                'status' => 1,
                'message' => 'Product Details Are Inserted Successfully'
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
    * Go to Add Products.
    *
    * @return view
    */
    public function Products(){
        $businessData= BusinessCategory::all();
      
        return view('/portal.products',compact('businessData'));
    }

    /**
    * Go to Add Services.
    *
    * @return view
    */
    public function Services(){
        $servicesData= BusinessCategory::all();
      
        return view('/portal.services',compact('servicesData'));
    }

    public function addServices(Request $request) {
        $response = [];
        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = array('error' => 'Error occured in Ajax Call.');
            return response()->json($response, $statusCode);
        }
        try {
            $image = $request->get('image');  
           if($image==''){
            $fileName = 'image'.time().'.'.$request->image->extension(); 
            $request->image->move(public_path('uploads'), $fileName);
            $image ='uploads/'.$fileName;
           }

            $name = $request->get('name');
            $details = $request->get('details');           
            $price = $request->get('price');
            $business_categoryId = $request->get('business_categoryId');                  
           
            $Service = new Service();
            $Service->businessId = $business_categoryId;         
            $Service->name = $name;
            $Service->image = $image;
            $Service->details = $details;           
            $Service->price = $price;
          
           
         
            $Service->save();
            $response = array(
                'status' => 1,
                'message' => 'Service Details Are Inserted Successfully'
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

    public function addBusiness(Request $request) {
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
           if($image==''){
            $fileName = 'image'.time().'.'.$request->image->extension(); 
            $request->image->move(public_path('uploads'), $fileName);
            $image ='uploads/'.$fileName;
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

    public function ajaxProductDetails(Request $request) {
        $response = [];
        $perm = null;
        $statusCode = 200;
        $users = array(); //Should be changed #4
        $search_val = array();
        try {
            $draw = $request->draw;
            $offset = $request->start;
            $length = $request->length;
            $search = $request->search ["value"];
            $order = $request->order;
            //print_r($order);die;

            $users = Product::all();
            
            
            $filtered = Product::where(function($q) use ($search) {
                $q->orwhere('businessId', 'like', '%' . $search . '%');
                $q->orwhere('name', 'like', '%' . $search . '%');
                $q->orwhere('details', 'like', '%' . $search . '%');
                $q->orwhere('price', 'like', '%' . $search . '%');
                $q->orwhere('image', 'like', '%' . $search . '%');
               
            });
            $ordered = $filtered;
            $filtered_count = $filtered->count();
            //echo count ( $order );die;
            for ($i = 0; $i < count($order); $i ++) {
                $ordered = $ordered->orderBy($request->columns [$order [$i] ['column']] ['data'], strtoupper($order [$i] ['dir']));
            }
            $page_displayed = $ordered->offset($offset)->limit($length)->get();
            $data = array();
            if (!empty($page_displayed)) {
                foreach ($page_displayed as $user) {
                    $nestedData['id'] = $user->id;
                    $nestedData['businessId'] = $user->businesscategory->name;
                    $nestedData['name'] = $user->name;
                    $nestedData['details'] = $user->details;
                    $nestedData['price'] = $user->price;
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
                'product_details' => $data //Should be changed #8
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

    public function editProduct(Request $request) {      
        $lead_edit_id = $request->lead_edit_id;
        $businessData= BusinessCategory::all();
        $edit_data = Product::where('id', $lead_edit_id)->first();
        return view('portal.products',compact('businessData'))->with('data', $edit_data);
        
    }

    public function updateProduct(Request $request) {
        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = array('error' => 'Error occured in Ajax Call.');
            return response()->json($response, $statusCode);
        }
        $this->validate($request, [
            'name' => 'required',
            'businessId' => 'required',
            'details' => 'required',
            'price' => 'required', 
            'image' => 'required'     
                ], [
            'name.required' => 'Name is required',
            'businessId.required' => 'Business Type is required',
            'details.required' => 'Details Value is required',
            'price.required' => 'Price Value is required',
            'image.required' => 'Image Value is required'           
                ]
        );
        try {
            $name = $request->get('name');
            $businessId = $request->get('businessId');
            $details = $request->get('details');
            $price = $request->get('price');
            $image = $request->get('image');  
            if($image==''){
             $fileName = 'image'.time().'.'.$request->image->extension(); 
             $request->image->move(public_path('uploads'), $fileName);
             $image ='uploads/'.$fileName;
            }
            $hid_id = $request->get('hid_id');
            $update_product_data = Product::where('id', $hid_id)->update(['name' => $name, 'businessId' => $businessId, 'details' => $details, 'price' => $price, 'image' => $image]);
            $response = array(
                'status' => 1,
                'message' => 'Product Details Are Updated Successfully'
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

    public function deleteProductsDetails(Request $request) {
        $lead_edit_id = $request->lead_call_id;
        $edit_data = Product::where('id', $lead_edit_id)->delete();
        $response = array(
            'status' => 1,
            'message' => 'Product Details Are Deleted Successfully'
        );
        return response()->json($response);
    }
}
