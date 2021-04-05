<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Model\EventCategory;
use Illuminate\Support\Facades\Auth;
use Validator,Redirect,Response;

class EventcategoryController extends Controller
{
    /**
    * Go to Event Categories View.
    *
    * @return view
    */
    public function eventsCategories(){
        if(auth()->user()->userType == 3) {
            return view('business-portal.eventcategory.events_categories');
        }
        return view('/portal.eventcategory.events_categories');
    }
      /**
    * Go to Add Event Categories.
    *
    * @return view
    */
    public function addEventCategories(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4|max:255',        
        ]);
       $validator->validate();
        $EventCategory = new EventCategory();
            $EventCategory->name = $request->name;  
            $EventCategory->created_by = auth()->user()->id;             
            $EventCategory->save();
            $category = $EventCategory->id;
            if(auth()->user()->userType == 3) {
                return redirect()->route('business-admin.manage_eventcategories');
            }
            return redirect()->route('admin.manage_eventcategories');
    }

    /**
    * Go to Edit Event Categories.
    *
    * @return view
    */
    public function editEventCategories(Request $request) {      
        $lead_edit_id = $request->lead_edit_id;
        $edit_data = EventCategory::where('id', $lead_edit_id)->first();
        if(auth()->user()->userType == 3) {
            return view('business-portal.eventcategory.edit_eventcategories',compact('edit_data'));
        }
        return view('portal.eventcategory.edit_eventcategories',compact('edit_data'));
        
    }

     /**
    * Go to Update Event Categories.
    *
    * @return view
    */
    public function updateEventCategories(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|string',
           
        ]);

        $hid_id = $request->get('hid_id');
        $name = $request->get('name');
        $update_product_data = EventCategory::where('id', $hid_id)->update(['name' => $name]);
        if(auth()->user()->userType == 3) {
            return redirect()->route('business-admin.manage_eventcategories');
        }   
        return redirect()->route('admin.manage_eventcategories');
    }

    
     /**
    * Go to Delete Event Categories.
    *
    * @return view
    */
    public function deleteEventCategories(Request $request) {
        $lead_delete_id = $request->lead_delete_id;
        $edit_data = EventCategory::where('id', $lead_delete_id)->delete();
        if(auth()->user()->userType == 3) {
            return redirect()->route('business-admin.manage_eventcategories');
        }
        return redirect()->route('admin.manage_eventcategories');
    }
    
    
     /**
    * Go to Event Categories.
    *
    * @return view
    */
    public function eventCategoryDetails(Request $request) {
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

            $users = EventCategory::all();
            
            
            $filtered = EventCategory::where(function($q) use ($search) {
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
                'eventcategory_details' => $data //Should be changed #8
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
     * Go to manage events view.
     *
     * @param  Request $request
     * @return view
     */
    public function manageEventCategories(Request $request){
        if(auth()->user()->userType == 3) {
            $categories = EventCategory::where('created_by', auth()->user()->id)->get();
            // echo json_encode($categories1);die;
            return view('business-portal.eventcategory.manage_eventcategories',compact('categories'));
        }
        $categories = EventCategory::all();
        // echo json_encode($categories1);die;
        return view('/portal.eventcategory.manage_eventcategories',compact('categories'));
    }

}
