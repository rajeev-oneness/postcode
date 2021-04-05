<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Model\Business;
use App\Model\BusinessCategory;
use App\Model\Product;
use App\Model\Service;
Use App\Model\EventCategory;
use Validator,Redirect,Response;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
     /**
     * Go to manage events view.
     *
     * @param  Request $request
     * @return view
     */
    public function manageProducts(Request $request){
        if(auth()->user()->userType == 3) {
            $categories = Product::where('created_by', auth()->user()->id)->with(['businesscategory' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }])->get();
            return view('business-portal.product.manage_products',compact('categories'));
        }
        $categories = Product::with(['businesscategory' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->get();
        // echo json_encode($categories1);die;
        return view('portal.product.manage_products',compact('categories'));
        
    }

    /**
    * Go to Products View.
    *
    * @return view
    */
    public function Products(){
        $businessData= BusinessCategory::all();
        if(auth()->user()->userType == 3) {
            return view('business-portal.product.product',compact('businessData'));
        }
        return view('portal.product.product',compact('businessData'));
    }

     /**
    * Go to Add Offers.
    *
    * @return view
    */
    public function addProducts(Request $request) {
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
   		$validator->validate();
        try {
            $fileName = time().'.'.$request->image->extension(); 
            $request->image->move(public_path('uploads/'), $fileName);
            $productimg ='uploads/'.$fileName;

            $Product = new Product();
            $Product->businessId = $request->businessId;         
            $Product->name = $request->name;
            $Product->image = $productimg;
            $Product->details = $request->details;
            $Product->price = $request->price;           
            $Product->created_by = auth()->user()->id;

            $Product->save();
            if(auth()->user()->userType == 3) {
                return redirect()->route('business-admin.manage_products');
            }
            return redirect()->route('admin.manage_products');
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }

     /**
     * Go to Edit Product view.
     *
     * @param  Request $request
     * @return view
     */
    public function editProduct($id) {      
     
        $businessData= BusinessCategory::all();
        $edited_data = Product::findOrFail(decrypt($id));
        // echo json_encode($edited_data);die;
        if(auth()->user()->userType == 3) {
            return view('business-portal.product.edit_product',compact('businessData', 'edited_data'));
        }
        return view('portal.product.edit_product',compact('businessData', 'edited_data')); 
    }

    /**
    * Go to Update Products.
    *
    * @return view
    */
    public function updateProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',    
        ]);
        $validator->validate();
        try {
            $hid_id = $request->hid_id;
            if($request->hasFile('image')) {
                $fileName = time().'.'.$request->image->extension(); 
                $request->image->move(public_path('uploads/'), $fileName);
                $imgupdatepro ='uploads/'.$fileName;
                Product::where('id', $hid_id)->update([
                    'image' => $imgupdatepro, 
                ]);
            };
            $update_prouduct_data = Product::where('id', $hid_id)->update([
                'name' => $request->name, 
                'businessId' => $request->businessId, 
                'details' => $request->details,
                'price' => $request->price
            ]);
            if(auth()->user()->userType == 3) {
                return redirect()->route('business-admin.manage_products');
            }   
            return redirect()->route('admin.manage_products');
        } catch (\Exception $e) {
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
    public function deleteProductsDetails($id) {
        $lead_delete_id = decrypt($id);
        $delete_product = Product::where('id', $lead_delete_id)->delete();
        if(auth()->user()->userType == 3) {
            return redirect()->route('business-admin.manage_products');
        }
        return redirect()->route('admin.manage_products');
    }
}
