<?php

namespace App\Http\Controllers;

use App\Model\EventCategory;
use App\Model\BusinessCategory;
use App\Model\Event;
use Illuminate\Http\Request;

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
}
