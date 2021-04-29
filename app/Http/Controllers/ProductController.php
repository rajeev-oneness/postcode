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
use App\Model\ProductCategory;
use App\Model\ProductSubcategory;

class ProductController extends Controller
{
     /**
     * Go to manage events view.
     *
     * @param  Request $request
     * @return view
     */
    public function manageProducts(Request $request){
        if(auth()->user()->userType == 2) {
            $products = Product::where('created_by', auth()->user()->id)->with('category','subcategory')->orderBy('created_at', 'desc')->get();
            // dd($products);
            return view('user-portal.product.manage_products',compact('products'));
        }
        $products = Product::with('category','subcategory')->orderBy('created_at', 'desc')->get();
        // dd($products);
        return view('portal.product.manage_products',compact('products'));
        
    }

    /**
    * Go to Products View.
    *
    * @return view
    */
    public function Products(){
        $businessData= BusinessCategory::all();
        $productCategory = ProductCategory::all();
        if(auth()->user()->userType == 2) {
            return view('user-portal.product.product',compact('businessData', 'productCategory'));
        }
        return view('portal.product.product',compact('businessData', 'productCategory'));
    }

    public function fetchSubcategory(Request $req) {
        $req->validate([
            '_token' => 'required',
            'cat_id' => 'required',
        ]);
        $productSubcategory = ProductSubcategory::where('category_id', $req->cat_id)->get();
        return response()->json(['message' => 'success', 'data' => $productSubcategory]);
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
            // dd($request->all());
            $fileName = time().'.'.$request->image->extension(); 
            $request->image->move(public_path('uploads/'), $fileName);
            $productimg ='uploads/'.$fileName;

            $Product = new Product();
            $Product->category_id = $request->category_id;
            $Product->subcategory_id = $request->subcategory_id;       
            $Product->name = $request->name;
            $Product->image = $productimg;
            $Product->details = $request->details;
            $Product->price = $request->price;           
            $Product->created_by = auth()->user()->id;

            $Product->save();
            if(auth()->user()->userType == 2) {
                return redirect()->route('user.marketplace.manage_products');
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
        $edited_data = Product::findOrFail(decrypt($id));
        $productCategory = ProductCategory::all();
        $productSubcategory = ProductSubcategory::where('category_id',$edited_data->category_id)->get();
        if(auth()->user()->userType == 2) {
            return view('user-portal.product.edit_product',compact('productCategory', 'edited_data','productSubcategory'));
        }
        return view('portal.product.edit_product',compact('productCategory', 'edited_data','productSubcategory')); 
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
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id, 
                'details' => $request->details,
                'price' => $request->price,
                'updated_by' => auth()->user()->id
            ]);
            if(auth()->user()->userType == 2) {
                return redirect()->route('user.marketplace.manage_products');
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
        if(auth()->user()->userType == 2) {
            return redirect()->route('user.marketplace.manage_products');
        }
        return redirect()->route('admin.manage_products');
    }
}
