<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostalController extends Controller
{
    /**
     * Go to  Postal Code.
     *
     * @return view
     */
    public function postcodeView()
    {
        $businessData = BusinessCategory::all();
        $producData = Product::all();
        $servicData = Service::all();

        return view('/portal.businessprofile.business_profiles', compact('businessData', 'producData', 'servicData'));
    }
}
