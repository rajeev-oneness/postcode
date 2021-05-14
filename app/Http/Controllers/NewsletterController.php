<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Newsletter;

class NewsletterController extends Controller
{
    public function subscribeNewsletter(request $request) {
        $request->validate([
            'email' =>['required','regex:/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/','unique:newsletters'],
        ]);
        $newsletter = new Newsletter;
        $newsletter->email = $request->email;
        $newsletter->save();
        $request->session()->flash('newsletter', 'Subscribed successfully!');
        return back();
    }

    public function manage()
    {
        $newsletters = Newsletter::all();
        return view('portal.newsletter.index', compact('newsletters'));
    }
}
