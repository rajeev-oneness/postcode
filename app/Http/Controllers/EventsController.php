<?php

namespace App\Http\Controllers;

use App\Model\EventCategory;
use App\Model\BusinessCategory;
use App\Model\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    /**
    * Go to Add Events.
    *
    * @return view
    */
    public function Services(){
        $busCateData= BusinessCategory::all();
        $eventCatData= EventCategory::all();
      
        return view('/portal.events.events',compact('eventCatData', 'busCateData'));
    }

    
    /**
    * Go to Save Events.
    *
    * @return view
    */
    public function addEvents(Request $request) {
        $request->validate([
            'name' => 'required|min:5|string',
           
        ]);
        $fileName = time().'.'.$request->image->extension(); 
            $request->image->move(public_path('uploads/'), $fileName);
            $eventsdesc ='uploads/'.$fileName;

        $Event = new Event();
        $Event->business_id = $request->business_categoryId;         
        $Event->name = $request->name;
        $Event->image = $eventsdesc;
        $Event->details = $request->details;           
        $Event->price = $request->price; 
        $Event->event_category_id = $request->event_category_id;         
        $Event->address = $request->address;

        
        
        // $now1 = date('Y-m-d'); //Fomat Date and time //you are overwriting this variable below
        // $now1 = $request->end;
        
        $dob = $request->start;
        $timestamp = strtotime($dob);
        $new_date = date("Y-m-d", $timestamp);

        $dob1 = $request->end;
        $timestamp = strtotime($dob1);
        $new_date1 = date("Y-m-d", $timestamp);

        $Event->start = $new_date;
        $Event->end = $new_date1;           
        $Event->frequency = $request->frequency;  
        $Event->age_group = $request->age_group;         
        $Event->booking_details = $request->booking_details;
        $Event->contact_details = $request->contact_details;           
         
     
        $Event->save();
           
            return redirect()->route('admin.dashboard');
    }

     /**
     * Go to manage events view.
     *
     * @param  Request $request
     * @return view
     */
    public function manageEventsView(Request $request){
        $userId = Auth::user()->id;

        // $sevents_manage=Event::with('eventcattype')->get();
        // $businescat_manage=BusinessCategory::with('eventbusiesstype')->get();

        // $categories = Event::with('eventcattype','eventbusiesstype')->get();
        $categories1 = Event::with(['eventcattype','eventbusiesstype' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->get();
        // echo json_encode($categories1);die;
        return view('/portal.events.manage_events',compact('categories1'));
    }

    public function editEvent(Request $request) {      
        $lead_events_id = $request->app_id;
        $businesserData= BusinessCategory::all();
        $eventerData= EventCategory::all();
        $editedevents_data = Event::where('id', $lead_events_id)->first();
        // echo json_encode($businessSerData);die;
        return view('portal.events.edit_event', compact('editedevents_data', 'eventerData', 'businesserData'));
        
    }

     /**
    * Go to Update Events Profiles.
    *
    * @return view
    */
    public function updateEvent(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);
        $fileName = time().'.'.$request->image->extension(); 
            $request->image->move(public_path('uploads/'), $fileName);
            $imgevent ='uploads/'.$fileName;
            
    //   echo json_encode($image);
    //   die;
        $hid_id = $request->hid_id;
        // echo json_encode('$hid_id');
        // die;
      
        $update_event_data = Event::where('id', $hid_id)->update(['name' => $request->name, 'business_id' => $request->business_categoryId, 'details' => $request->details, 'image' => $imgevent, 'price' => $request->price, 'event_category_id' => $request->event_category_id, 'address' => $request->address, 'start' => $request->start, 'end' => $request->end, 'frequency' => $request->frequency, 'age_group' => $request->age_group, 'booking_details' => $request->booking_details, 'contact_details' => $request->contact_details]);   
            return redirect()->route('admin.manage_events');
    }

    public function deleteEvents(Request $request) {
        $lead_delete_id = $request->appdel_id;
        $delete_event = Event::where('id', $lead_delete_id)->delete();
        return redirect()->route('admin.manage_events');
    }

}
