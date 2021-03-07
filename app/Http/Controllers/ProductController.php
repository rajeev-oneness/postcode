<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Model\Business;
use App\Model\BusinessCategory;
use App\Model\Product;
use App\Model\Service;
Use App\Model\EventCategory;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function editProduct(Request $request) {      
        $lead_edit_id = $request->lead_edit_id;
        $businessData= BusinessCategory::all();
        $edit_data = Product::where('id', $lead_edit_id)->first();
        return view('portal.product.products',compact('businessData'))->with('data', $edit_data);
        
    }
    /**
    * Go to Products View.
    *
    * @return view
    */
    public function Products(){
        $businessData= BusinessCategory::all();
      
        return view('portal.product.products',compact('businessData'));
    }

      /**
    * Go to Products List View.
    *
    * @return view
    */
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
            $filtered = Product::with('businesscategory')->where(function($q) use ($search) {
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

      /**
    * Go to Add Products.
    *
    * @return jsonArray
    */
    public function addProduct(Request $request) {
        $response = [];
        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = array('error' => 'Error occured in Ajax Call.');
            return response()->json($response, $statusCode);
        }
        $this->validate($request, [
            'image' => 'required',
            'name' => 'required',
            'details' => 'required',
            'price' => 'required',
            'businessId' => 'required' 
                ], [
            'image.required' => 'Image is required',
            'name.required' => 'Duration is required',
            'details.required' => 'Details required',
            'price.required' => 'Value is required',
            'businessId.required' => 'BusinessID is required'
                ]
        );
        try {
            $fileName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/'), $fileName);
        $produimg = 'uploads/' . $fileName;        
           
            $Product = new Product();
            $Product->businessId = $request->businessId;         
            $Product->name = $request->name;
            $Product->image = $produimg;
            $Product->details = $request->details;           
            $Product->price = $request->price;
          
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
    * Go to Update Products View.
    *
    * @return view
    */
    public function updateProduct(Request $request) {
        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = array('error' => 'Error occured in Ajax Call.');
            return response()->json($response, $statusCode);
        }
        $this->validate($request, [
            'name' => 'required|max:255',
            'businessId' => 'required|numeric|min:1',
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

      /**
    * Go to Delete Products.
    *
    * @return view
    */
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
