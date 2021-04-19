<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Rating;
use App\Model\Contact;
use App\Model\Business;
use App\Model\BusinessCategory;
use App\Model\Testimonial;
use App\Model\Newsletter;
use App\Model\State;
use App\Model\Postcode;
use App\Model\Event;
use App\Model\Booking;
use App\Model\Offer;
use App\Model\Message;
use App\User;
use Mail;
use Validator, Redirect, Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class UserportalController extends Controller
{
    public function newsfeed() {
        $user = User::where('id', auth()->id())->where('userType', 2)->with('usercountry','userstate')->get()->toArray();
        
        $stateEvents = Event::where('state_id', $user[0]['userstate']['id'])->whereDate('created_at', '>', Carbon::now()->subDays(7))->whereDate('created_at', '<=', Carbon::now())->with('eventcattype', 'business', 'agegroup')->get()->toArray();
        $postcodeEvents = Event::where('postcode', $user[0]['postcode'])->whereDate('created_at', '>', Carbon::now()->subDays(7))->whereDate('created_at', '<=', Carbon::now())->with('eventcattype', 'business', 'agegroup')->get()->toArray();
        
        $postcodeOffers = Offer::where('postcode', $user[0]['postcode'])->whereDate('created_at', '>', Carbon::now()->subDays(7))->with('business')->whereDate('created_at', '<=', Carbon::now())->get()->toArray();

        $allEvents = Event::where('postcode', $user[0]['postcode'])->whereDate('end', '>=', Carbon::now())->with('eventcattype', 'business', 'agegroup')->get()->toArray();
        $allOffers = Offer::where('postcode', $user[0]['postcode'])->whereDate('expire_date', '>=', Carbon::now())->with('business')->get()->toArray();

        return view('user-portal.newsfeed', compact('stateEvents', 'postcodeEvents', 'postcodeOffers', 'allEvents', 'allOffers'));
    }

    public function rating() {
        $ratings = Rating::where('userId', auth()->id())->with('response','business')->get()->toArray();
        // dd($ratings);
        return view('user-portal.rating', compact('ratings'));
    }

    public function deal() {
        $user = User::where('id', auth()->id())->where('userType', 2)->with('usercountry','userstate')->get()->toArray();
        $allOffers = Offer::where('postcode', $user[0]['postcode'])->whereDate('expire_date', '>=', Carbon::now())->with('business')->get()->toArray();
        return view('user-portal.deal', compact('allOffers'));
    }

    public function settings() {
        $user = User::find(auth()->id());
        return view('user-portal.settings', compact('user'));
    }

    public function updatePrivacy(Request $req) {
        $user = User::find(auth()->id());
        $user->is_private = $req->is_private;
        $user->save();
        return redirect()->route('user.settings');
    }

    public function editProfile() {
        $user = User::find(auth()->id());
        return view('user-portal.edit-profile', compact('user'));
    }

    public function updateProfile(Request $req) {
        $user = User::find(auth()->id());
        $user->name = $req->name;
        $user->address = $req->address;
        $user->postcode = $req->postcode;
        $user->save();
        return redirect()->route('user.settings');
    }

    public function myCalender() {
        $events = Booking::with('event')->where('user_id', auth()->id())->get()->toArray();
        // dd($events);
        if(count($events) > 0) {
            return view('user-portal.my-calendar', compact('events'));
        } else {
            return back();
        }
    }

    public function getBusiness(Request $req) {
        $businesses = Business::all();
        return response()->json(['error' => false, 'message' => 'Business Data', 'data' => $businesses]);
    }

    public function sendMessage(Request $req) {
        // dd($req->all());
        $message = new Message;
        $message->user_id = $req->user_id;
        $message->business_id = $req->business_id;
        $message->subject = $req->subject;
        $message->message = $req->message;
        $message->save();
        return back();
    }

    public function messagePortal() {
        $messages = Message::with('business')->where('user_id', auth()->id())->get()->toArray();
        // dd($messages);
        return view('user-portal.messaging-portal', compact('messages'));
    }
}
