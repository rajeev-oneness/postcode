<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\AboutUs;

class AboutUsController extends Controller
{
    //about us front page
    public function index() {
        $data = AboutUs::find(1);
        return view('front.home.aboutus', compact('data'));
    }

    //admin manage about us
    public function manageAbout() {
        $data = AboutUs::find(1);
        return view('portal.about-us.aboutus', compact('data'));
    }
    public function updateAbout(Request $req) {
        $about = AboutUs::find(decrypt($req->about_id));
        $about->short_description = $req->short_description;
        $about->description = $req->description;
        $about->save();
        return back();
    }
}
