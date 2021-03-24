<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Rating;
use App\Model\Contact;
use App\Model\Business;
use App\Model\Testimonial;
use App\Model\Newsletter;
use Mail;
use Validator, Redirect, Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    private $businesses;
    /**
     * Go to  Business Profile.
     *
     * @return view
     */
    public function Signup()
    {
        return view('/user.signup');
    }
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
        $user_id = \Auth::user()->id;

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
            'email' => 'required|unique:content',
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
            'tm_comment' => 'required|max:200|unique:content',
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

    /**
     * Go to Add Business.
     *
     * @return json
     */
    public function addUserBusiness(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'abn' => 'required',
            'company_website' => 'required',
            'email' => 'required|email|unique:businesses',
            'mobile' => 'required|numeric|digits:10',
            'open_hour' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
 try {
        // dd(config('mail.username'));
        $fileName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/'), $fileName);
        $businessProfileImg = 'uploads/' . $fileName;

        $password = str_random(8);
        // $servicesid = 1;
        // $state_id = 1;
        // $address = 'New Jersey';
        // $pin_code = 700058;
        // $business_categoryId = 1;
        // $closing_hour = 10;
        // $productId = 1;
        // $description = 'Products Under One Roof';
        // $facebook_link = 'https://www.amazon.in/';
        // $instagram_link = 'https://www.amazon.in/';
        // $twitter_link = 'https://www.amazon.in/';
        // $youtube_link = 'https://www.amazon.in/';
        // $linkedin_link = 'https://www.amazon.in/';

        $name = $request->name;
        $email = $request->email;

     

        $business = new Business();
        $business->email = $email;
        $business->abn = $request->abn;
        $business->password = Hash::make($password);
        $business->company_website = $request->company_website;
        $business->image = $businessProfileImg;
        $business->name = $name;
        //$business->address = $address;
        $business->mobile = $request->mobile;
        $business->open_hour = $request->open_hour;
        // $business->closing_hour = $closing_hour;
        //$business->services = $servicesid;
        //$business->products = $productId;
        //$business->state_id = $state_id;
        $business->business_categoryId = 1;
        //$business->pin_code = $pin_code;
        //$business->description = $description;
        //$business->facebook_link = $facebook_link;
        //$business->instagram_link = $instagram_link;
        //$business->twitter_link = $twitter_link;
        //$business->youtube_link = $youtube_link;
       // $business->linkedin_link = $linkedin_link;

        // echo json_encode($business);die;
        $business->save();
        // dd(hash()->make($password));
        // $deal= $business->id;

        //$businessname = $business->name;
        //$businessemail = $business->email;

        // echo json_encode($businessemail);die;
        \Mail::send('emails/mail', array('name' => $name, 'email' => $email, 'password' => $password), function ($message) use ($name, $email, $password) {
            $message->to($email, $name)->subject('Welcome To PostCode');
            $message->from('sagaranimesh3317@gmail.com', 'Post Code');
        });

        return view('user.thankyou');
       
    }catch (\Exception $e) {
        report($e);

        return false;
    }
    }

    // public function BusinessSearch(Request $request) {
    //     $slug = $request->id;

    //     $data = Business::where([ 
    //         ['name', 'LIKE', '%' . $slug . '%'],
    //     ])->get();
    //     // echo json_encode($data);die;
    //     return view('course_filter', compact('data', 'slug'));
    // }

    public function search_main(Request $request)
    {
        $name = $request->name;
        // $slug = $request->id;
        $data = Business::where([
            ['name', 'LIKE', '%' . $name . '%'],
        ])->pluck('name')->ToArray();
        return $data;
    }

    public function subscribeNewsletter(request $request) {
        $request->validate([
            'email' =>['required','email','unique:newsletters'],
        ]);
        $newsletter = new Newsletter;
        $newsletter->email = $request->email;
        $newsletter->save();
        $request->session()->flash('newsletter', 'Subscribed successfully!');
        return back();
    }
}
