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
use App\User;
use Mail;
use Validator, Redirect, Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


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
        $businessCategories = BusinessCategory::all();
        $states = State::all();
        return view('/user.signup', compact('businessCategories', 'states'));
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
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'regex:/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/'
        ]);
    
    DB::beginTransaction();
    try {
        
        $fileName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/'), $fileName);
        $businessProfileImg = 'uploads/' . $fileName;

        $password = str_random(8);
        $hashedPassword = Hash::make($password);

        $name = $request->name;
        $email = $request->email;
        
        $stateId = Postcode::where('postcode', $request->pincode)->with('state')->get();

        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->password = $hashedPassword;
        $user->address = $request->address;
        $user->stateId = $stateId[0]->stateId;
        $user->countryId = 1;
        $user->postcode = $request->pincode;
        $user->userType = 3;
        // dd($user);
        $user->save();

        $business = new Business();
        $business->user_id = $user->id;
        $business->email = $email;
        $business->abn = $request->abn;
        $business->password = $hashedPassword;
        $business->company_website = $request->company_website;
        $business->image = $businessProfileImg;
        $business->name = $name;
        $business->address = $request->address;
        $business->mobile = $request->mobile;
        $business->open_hour = $request->open_hour;
        if($request->longitude != '' && $request->latitude != ''){
            $business->longitude = $request->longitude;
            $business->latitude = $request->latitude; 
        }
        $business->business_categoryId = $request->business_categoryId;
        $business->pin_code = $request->pincode;


        $business->state_id = $stateId[0]->stateId;
        $business->country_id = 1;
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

        DB::commit();
        return view('user.thankyou');
       
    }catch (\Exception $e) {
        unlink($businessProfileImg);
        DB::rollback();
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
            'email' =>['required','regex:/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/','unique:newsletters'],
        ]);
        $newsletter = new Newsletter;
        $newsletter->email = $request->email;
        $newsletter->save();
        $request->session()->flash('newsletter', 'Subscribed successfully!');
        return back();
    }

    public function userPortal() {
        $user = User::where('id', auth()->id())->where('userType', 2)->with('usercountry','userstate')->get()->toArray();
        // dd($user);
        return view('user-portal.dashboard', compact('user'));
    }
}
