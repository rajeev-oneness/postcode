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
            $business_categoryId = $request->get('business_categoryId');                  
           
            $Product = new Product();
            $Product->businessId = $business_categoryId;         
            $Product->name = $name;
            $Product->image = $image;
            $Product->details = $details;           
            $Product->price = $price;
          
           
         
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
}
