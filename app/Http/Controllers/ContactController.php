<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ContactUs;


class ContactController extends Controller
{
    //contact us front page
    public function index() {
        $address = ContactUs::find(1);
        return view('front.home.contact', compact('address'));
    }
    //store the contact us from visitors
    public function store(Request $req)
    {
        $address = new ContactUs;
        $address->type = 2;
        $address->name = $req->name;
        $address->email = $req->email;
        $address->mobile = $req->mobile;
        $address->subject = $req->subject;
        $address->message = $req->message;
        $address->save();
        return response()->json(['error' => false, 'message' => 'message sent!']);
    }

    //admin address section
    public function manageAddress() {
        $address = ContactUs::find(1)->get();
        return view('portal.address.address', compact('address'));
    }
    public function updateAddress(Request $req) {
        $address = ContactUs::find(decrypt($req->contact_id));
        $address->name = $req->name;
        $address->email = $req->email;
        $address->mobile = $req->mobile;
        $address->address = $req->address;
        $address->save();
        return back();
    }
}
