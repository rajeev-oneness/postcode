<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Rating;
use App\Model\Contact;

class UserController extends Controller
{
  /**
     * Customer Ratings Save
     *    
     * Request $request 
     * @return jsonArray
     */
    public function userRatings(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|string',
            'rating' => 'required|min:1|max:5',
            'description' => 'required|min:4|max:250',
        ]);
        $user_id=\Auth::user()->id;

        $Rating = new Rating();
        $Rating->userId = $user_id;
        $Rating->rating = $request->rating;
        $Rating->description = $request->description;
        
        $Rating->save();

        return response()->json([
        'status' => 1,
        'message' => "Ratings Saved Successfully"
       ]);
    }

    /**
     * Customer Contact Save
     *    
     * Request $request 
     * @return jsonArray
     */
    public function userContacts(Request $request)
    {
       
        $request->validate([
            'name' => 'required|min:5|string',
            'email'=>'required|unique:content',
            'mobile' => 'required|numeric',
            'subject' => 'required|min:4|max:25',
            'description' => 'required|min:4|max:250',
        ]);
        $Contact = new Contact();
        $Contact->name = $request->name;
        $Contact->email = $request->email;
        $Contact->mobile = $request->mobile;
        $Contact->subject = $request->subject;
        $Contact->description = $request->description;
        
        $Contact->save();

        return response()->json([
        'status' => 1,
        'message' => "Ratings Saved Successfully"
       ]);
    }
}
