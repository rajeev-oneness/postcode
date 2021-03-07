<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Rating;
use App\Model\Contact;
use App\Model\Testimonial;

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

    /**
     * Customer Contact Save
     *    
     * Request $request 
     * @return jsonArray
     */
    public function userTestimonialss(Request $request)
    {
       
        $request->validate([
            'tm_name' => 'required|min:5|string',
            'tm_comment'=>'required|max:200|unique:content',
            'tm_rating' => 'required',
            'tm_image' => 'required',
        ]);
        $fileName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/'), $fileName);
        $testiimg = 'uploads/' . $fileName;

        $Testimonial = new Testimonial();
        $Testimonial->tm_name = $request->tm_name;
        $Testimonial->tm_comment = $request->tm_comment;
        $Testimonial->tm_rating = $request->tm_rating;
        $Testimonial->tm_image = $testiimg;
        
        $Testimonial->save();

        return response()->json([
        'status' => 1,
        'message' => "Ratings Saved Successfully"
       ]);
    }
}
