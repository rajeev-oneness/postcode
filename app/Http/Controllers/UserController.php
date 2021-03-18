<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Rating;
use App\Model\Contact;
use App\Model\Business;
use App\Model\Testimonial;
use Mail;
use Validator,Redirect,Response;

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

     /**
     * Go to Add Business.
     *
     * @return json
     */
    public function addUserBusiness(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:businesses',
            'mobile' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',           
        ]);
       $validator->validate();
          

    $fileName = time().'.'.$request->image->extension(); 
    $request->image->move(public_path('uploads/'), $fileName);
    $busiprofileimg ='uploads/'.$fileName;

    $password = 123456;

    $password1 = \Hash::make($password);

    $servicesid =1;
    $state_id=1;
    $address ='New Jersey';
    $pin_code=700058;
    $business_categoryId=1;
    $closing_hour=10;
    $productId=1;
    $description='Products Under One Roof';
    $facebook_link='https://www.amazon.in/';
    $instagram_link='https://www.amazon.in/';
    $twitter_link='https://www.amazon.in/';
    $youtube_link='https://www.amazon.in/';
    $linkedin_link='https://www.amazon.in/';

    $name = $request->name;
            $email = $request->email;

        
  $Business = new Business();        
    $Business->email = $email;
    $Business->abn = $request->abn;
    $Business->password = $password1;
    $Business->company_website = $request->company_website;
    $Business->image = $busiprofileimg;
    $Business->name = $name;
    $Business->address = $address;
    $Business->mobile = $request->mobile;  
    $Business->open_hour = $request->open_hour;  
    $Business->closing_hour = $closing_hour;  
    $Business->services = $servicesid; 
    $Business->products = $productId; 
    $Business->state_id = $state_id;  
    $Business->business_categoryId = $business_categoryId;  
    $Business->pin_code = $pin_code;  
    $Business->description = $description;  
    $Business->facebook_link = $facebook_link;  
    $Business->instagram_link = $instagram_link;  
    $Business->twitter_link = $twitter_link; 
    $Business->youtube_link = $youtube_link; 
    $Business->linkedin_link = $linkedin_link;     
    
    // echo json_encode($Business);die;

    $Business->save();

    // $deal= $Business->id;

    $businessname = $Business->name;
    $businessemail = $Business->email;

    // echo json_encode($Businessemail);die;
    \Mail::send('emails/mail', array('name'=>$name,'email'=>$email,'password'=>$password),function($message) use ($name,$email,$password) {
        $message->to($email,$name)->subject('Welcome To PostCode');
        $message->from('sagaranimesh3317@gmail.com','Post Code');
                        });

    return view('user.thankyou');

}

// public function BusinessSearch(Request $request) {
//     $slug = $request->id;
    
//     $data = Business::where([ 
//         ['name', 'LIKE', '%' . $slug . '%'],
//     ])->get();
//     // echo json_encode($data);die;
//     return view('course_filter', compact('data', 'slug'));
// }

public function search_main(Request $request) {
    $name = $request->name;
    // $slug = $request->id;
    $data = Business::where([ 
        ['name', 'LIKE', '%' . $name . '%'],
    ])->pluck('name')->ToArray();
    return $data;
}

}
