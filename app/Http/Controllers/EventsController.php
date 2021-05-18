<?php

namespace App\Http\Controllers;

use App\Model\EventCategory;
use App\Model\BusinessCategory;
use App\Model\Business;
use App\Model\Event;
use App\Model\AgeGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator,Redirect,Response;

class EventsController extends Controller
{
    /**
    * Go to Add Events.
    *
    * @return view
    */
    public function Events(){
        $busCateData= Business::all();
        $eventCatData= EventCategory::all();
        $ageGroups= AgeGroup::all();
        if(auth()->user()->userType == 3) {
            return view('business-portal.events.events',compact('eventCatData', 'busCateData','ageGroups'));
        }
        return view('/portal.events.events',compact('eventCatData', 'busCateData','ageGroups'));
    }

    
    /**
    * Go to Save Events.
    *
    * @return view
    */
    public function addEvents(Request $request) {
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
        ]);
        $validator->validate();
        try {
            $fileName = time().'.'.$request->image->extension(); 
            $request->image->move(public_path('uploads/'), $fileName);
            $eventsdesc ='uploads/'.$fileName;

            $event = new Event();
            $event->business_id = $request->business_categoryId;         
            $event->name = $request->name;
            $event->image = $eventsdesc;
            $event->short_description = $request->short_description;           
            $event->description = $request->description;           
            $event->price = $request->price; 
            $event->event_category_id = $request->event_category_id;         
            $event->address = $request->address;
            $event->country_id = auth()->user()->countryId;
            $event->state_id = auth()->user()->stateId;
            $event->postcode = auth()->user()->postcode;
            $dob = $request->start;
            $timestamp = strtotime($dob);
            $new_date = date("Y-m-d", $timestamp);
            $dob1 = $request->end;
            $timestamp = strtotime($dob1);
            $new_date1 = date("Y-m-d", $timestamp);
            $event->start = $new_date;
            $event->end = $new_date1;           
            $event->frequency = $request->frequency;  
            $event->age_group = $request->age_group;         
            $event->booking_details = $request->booking_details;
            $event->contact_details = $request->contact_details;
            $event->created_by = auth()->user()->id;
            $event->save();
            if(auth()->user()->userType == 3) {
                return redirect()->route('business-admin.manage_events');
            }
            return redirect()->route('admin.manage_events');
        }catch (\Exception $e) {
            report($e);
    
            return false;
        }
    }

     /**
     * Go to manage events view.
     *
     * @param  Request $request
     * @return view
     */
    public function manageEventsView(Request $request){
        if(auth()->user()->userType == 3) {
            $categories1 = Event::where('created_by', auth()->user()->id)->with(['eventcattype','eventbusiesstype' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }])->paginate(3);
            // dd($categories1);
            return view('business-portal.events.manage_events',compact('categories1'));
        }
        $categories1 = Event::with(['eventcattype','eventbusiesstype' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->get();
        // echo json_encode($categories1);die;
        return view('/portal.events.manage_events',compact('categories1'));
    }

     /**
     * Go to rdit events view.
     *
     * @param  Request $request
     * @return view
     */
    // public function editEvent(Request $request) {      
    //     $lead_events_id = $request->app_id;
    //     $businesserData= BusinessCategory::all();
    //     $eventerData= EventCategory::all();
    //     $editedevents_data = Event::where('id', $lead_events_id)->first();
    //     // echo json_encode($businessSerData);die;
    //     return view('portal.events.edit_event', compact('editedevents_data', 'eventerData', 'businesserData'));
        
    // }

    public function editEvent($id) {      
     
       
        $businesserData= Business::all();
        $eventerData= EventCategory::all();
        $ageGroups= AgeGroup::all();
        $editedevents_data = Event::findOrFail(decrypt($id));
        // dd($ageGroups);
        // echo json_encode($edited_data);die;
        if(auth()->user()->userType == 3) {
            return view('business-portal.events.edit_event', compact('editedevents_data', 'eventerData', 'businesserData', 'ageGroups'));
        }
        return view('portal.events.edit_event', compact('editedevents_data', 'eventerData', 'businesserData', 'ageGroups'));
        
    }

     /**
    * Go to Update Events.
    *
    * @return view
    */
    public function updateEvent(Request $request)
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
            $imgevent ='uploads/'.$fileName;
            $update_event_data = Event::where('id', $hid_id)->update([
                'image' => $imgevent, 
            ]);
          }
        
        $update_event_data = Event::where('id', $hid_id)->update([
            'name' => $request->name, 
            'business_id' => $request->business_categoryId, 
            'short_description' => $request->short_description,
            'description' => $request->description, 
            'price' => $request->price, 
            'event_category_id' => $request->event_category_id, 
            'address' => $request->address, 
            'start' => $request->start, 
            'end' => $request->end, 
            'frequency' => $request->frequency, 
            'age_group' => $request->age_group, 
            'booking_details' => $request->booking_details, 
            'contact_details' => $request->contact_details
        ]);
            if(auth()->user()->userType == 3) {
                return redirect()->route('business-admin.manage_events');
            }  
            return redirect()->route('admin.manage_events');
        }catch (\Exception $e) {
            report($e);
    
            return false;
        }
       
    }

     /**
     * Go to Delete events.
     *
     * @param  Request $request
     * @return view
     */
    public function deleteEvents(Request $request) {
        $lead_delete_id = $request->appdel_id;
        $delete_event = Event::where('id', $lead_delete_id)->delete();
        if(auth()->user()->userType == 3) {
            return redirect()->route('business-admin.manage_events');
        }
        return redirect()->route('admin.manage_events');
    }

}
