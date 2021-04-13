<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Model\Event;
Use App\Model\Booking;
use App\User;

class BookingController extends Controller
{
    public function index($eventId) {
        $event = Event::find(decrypt($eventId));
        return view('front.home.event-book', compact('event'));
    }

    public function bookingComplete(Request $req) {
        $booking = new Booking;
        $booking->user_id = decrypt($req->user_id);
        $booking->event_id = decrypt($req->event_id);
        $booking->payment = 1;
        
        $booking->save();
        return redirect()->route('user.newsfeed');
    }
}
