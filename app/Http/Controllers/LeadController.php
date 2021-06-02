<?php

namespace App\Http\Controllers;

use App\Model\Lead;
use Illuminate\Http\Request;
use App\Model\Business;
use App\Model\Postcode;
use App\Model\BusinessCategory;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    public function search(){
        $businesses = Business::all();
        $postcodes = Postcode::with('state')->get();
        $categories = BusinessCategory::all();
        return view('front.home.search-leads', compact('businesses','postcodes', 'categories'));
    }
    public function leads(Request $request){
        $postcode = Postcode::where('postcode', $request->postcode)->first();
        $request = $request->except('_token');
        return view('front.home.lead-lists',compact('request', 'postcode'));
    }

    public function getQuotes(Request $request){
        $postcode =  Postcode::where('id', $request->postcodeId)->first();
        $businesses = explode(",", $request->businessId);
        $name = $request->name;
        $email = $request->email;
        $mobile = $request->mobile;
        $postcode_id = $request->postcodeId;
        foreach($businesses as $business) {
            $lead = new Lead();
            $lead->name = $name;
            $lead->email = $email;
            $lead->mobile = $mobile;
            $lead->postcodesId = $postcode_id;
            $lead->businessId = $business;
            $lead->save();
            $business_owner = Business::where('id', $business)->first()->businessuserid;
            Mail::send('emails.lead-owner',
                array('name' => $name, 'email' => $email, 'mobile' => $mobile, 'postcode' => $postcode->postcode),
                function ($message) use ($name, $email, $business_owner) {
                $message->from($email, $name);
                $message->subject("Leads From Post Code");
                $message->to($business_owner->email, $business_owner->name);
            });
        }
        Mail::send('emails.lead-user',
                array('name' => $name, 'email' => $email, 'mobile' => $mobile, 'postcode' => $postcode->postcode),
                function ($message) use ($name, $email) {
                $message->from('sagaranimesh3317@gmail.com', 'Post Code');
                $message->subject("Leads From Post Code");
                $message->to($email, $name);
            });
    }

}
