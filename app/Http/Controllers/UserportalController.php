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
use App\Model\Offer;
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
        // dd($ratings[0]['business'][0]['name']);
        return view('user-portal.rating', compact('ratings'));
    }

    public function deal() {
        $user = User::where('id', auth()->id())->where('userType', 2)->with('usercountry','userstate')->get()->toArray();
        $allOffers = Offer::where('postcode', $user[0]['postcode'])->whereDate('expire_date', '>=', Carbon::now())->with('business')->get()->toArray();

        return view('user-portal.deal', compact('allOffers'));
    }
}
