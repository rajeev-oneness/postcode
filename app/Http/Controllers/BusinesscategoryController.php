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

            $users = BusinessCategory::all();
            
            
            $filtered = BusinessCategory::where(function($q) use ($search) {
                $q->orwhere('name', 'like', '%' . $search . '%');
               
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
                    $nestedData['name'] = $user->name;
                    $view = $edit_button = $user->id;
                    $nestedData['action'] = array('e' => $edit_button);
                    $data[] = $nestedData;
                }
            }
            $response = array(
                "draw" => $draw,
                "recordsTotal" => $users->count(), //Should be changed #7
                "recordsFiltered" => $filtered_count,
                'businesscategory_details' => $data //Should be changed #8
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
           
            return redirect()->route('admin.businesscategory.manage_businesscategories', compact('busi_category_id'));
    }

    public function editBusinessCategories(Request $request) {      
        $lead_edit_id = $request->lead_edit_id;
        $edited_data = BusinessCategory::where('id', $lead_edit_id)->first();
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
    
    public function deleteBusinessCategories(Request $request) {
        $lead_delete_id = $request->lead_delete_id;
        $delete_data = BusinessCategory::where('id', $lead_delete_id)->delete();
        return redirect()->route('admin.manage_businesscategories');
    }
}
