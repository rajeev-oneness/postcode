<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\BusinessCategory;


class BusinesscategoryController extends Controller
{
    /**
     * Go to manage businessCategory view.
     *
     * @param  Request $request
     * @return view
     */
    public function businessCategoryDetails(Request $request) {
        $businessCategories = BusinessCategory::all();
        return view('/portal.businesscategory.manage_businesscategories', compact('businessCategories'));
    }
    /**
    * Go to Business Categories View.
    *
    * @return view
    */
    public function businessCategories(){
        return view('/portal.businesscategory.business_categories');
    }
     /**
    * Go to Add Business Categories.
    *
    * @return view
    */
    public function addBusinessCategories(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|string',
           
        ]);
        $BusinessCategory = new BusinessCategory();
            $BusinessCategory->name = $request->name;               
            $BusinessCategory->save();
            $busi_category_id = $BusinessCategory->id;
           
            return redirect()->route('admin.manage_businesscategories');
    }

     /**
    * Go to Edit Business Categories.
    *
    * @return view
    */
    public function editBusinessCategories($lead_edit_id) {
        $edited_data = BusinessCategory::where('id', decrypt($lead_edit_id))->first();
        return view('portal.businesscategory.edit_businesscategories', compact('edited_data'));
        
    }

    
     /**
    * Go to udate Businesses categories.
    *
    * @return view
    */
    public function updateBusinessCategories(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|string',
           
        ]);

        $hid_id = $request->get('hid_id');
        $name = $request->get('name');
        $update_businesscategory_data = BusinessCategory::where('id', $hid_id)->update(['name' => $name]);   
            return redirect()->route('admin.manage_businesscategories');
    }
    
    
     /**
    * Go to Delete Businesses categories.
    *
    * @return view
    */
    public function deleteBusinessCategories($lead_delete_id) {
        $delete_data = BusinessCategory::where('id', decrypt($lead_delete_id))->delete();
        return redirect()->route('admin.manage_businesscategories');
    }
}
