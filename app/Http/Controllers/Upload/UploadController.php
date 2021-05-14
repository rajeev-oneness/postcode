<?php

namespace App\Http\Controllers\Upload;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Business;
use App\Model\BusinessCategory;
use App\Model\Postcode;
use App\Model\Offer;
use App\Model\Event;
use App\Model\EventCategory;
use App\Model\Community;
use App\Model\CommunityCategory;
use App\User;
use DB,Hash;

class UploadController extends Controller
{
    public function downloadCSV($formatFor)
    {
        $data = [];$header = [];$title ='';
    	switch ($formatFor){
    		case 'business': 
    			$header = ['business_category_Id','name','email','abn',' company_website','address,','pin_code','mobile', 'open_hour(in am pm)', 'closing_hour(in am pm)', 'Description', 'Facebook link', 'Instagram link', 'Twitter link', 'Youtube link', 'Linkedin link', 'Latitude', 'Longitude'];
    			$title = 'Business Import Format';break;
    		case 'community': 
    			$header = ['community Category id(1: Tips, 2: Ideas, 3: Category 3, 4: Category 4, 5: Category 5, 6: other Topics)', 'Title', 'Description'];
    			$title = 'Community Import Format';break;
    		case 'offer': 
    			$header = ['Title', 'Short Description', 'Description', 'Promo Code', 'Price','Expire_date(YYYY-MM-DD)', 'How to redeem'];
    			$title = 'Offer Import Format';break;
    		case 'event':
    			$header = ['Event_category_id', 'Name', 'Description', 'Short_description', 'Start_date(YYYY-MM-DD)', 'End_date(YYYY-MM-DD)', 'Frequency', 'Age Group(1: < 5 years, 2: 6-12, 3: 13-19, 4: 20-60, 5: 60+)', 'Price', 'Booking_details', 'Contact_details'];
    			$title = 'Event Import Format';break;
    	}
    	$f = fopen('php://memory', 'w');
    	fputcsv($f, $header, ',');
    	// here inside the Foreach data will be Append when Export CSV will Apply
    	// for ($i=1; $i < 20; $i++) {
    		// $lineData = ['rajeev','gupta','hellorealtesting@test.com','1024hjhjh','Creativity','109',1,date('Y-m-d')];
    		// fputcsv($f, $lineData, ',');
    	// }
    	fseek($f, 0);
    	header('Content-Type: text/csv');
    	header('Content-Disposition: attachment; filename="'.$title.'.csv'.'";');
    	fpassthru($f);
    }
    public function businessUpload(Request $req) {
        if($req->hasFile('business_csv')){
            $extension= ['csv'];
            $getExtesion = $req->file('business_csv')->getClientOriginalExtension();
            if(in_array($getExtesion,$extension)){
                $path = $req->file('business_csv')->getRealPath();
                $firstline = true;
                if (($handle = fopen ( $path, 'r' )) !== FALSE) {
                    while (($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {
                        if($firstline){
                            $firstline = false;
                            continue;
                        }
                        // dd($data);

                        try{
                            if($data[1] != ''){
                                \DB::beginTransaction();
                                $business = Business::where('name',$data[1])->first();
                                if(!$business){
                                    $business = new Business;
                                }
                                $password = str_random(8);
                                $hashedPassword = \Hash::make($password);

                                $name = $data[1];
                                $email = $data[2];
                                
                                $stateId = Postcode::where('postcode', $data[6])->with('state')->get();

                                $user = new User;
                                $user->name = $name;
                                $user->email = $email;
                                $user->password = $hashedPassword;
                                $user->address = $data[5];
                                $user->stateId = $stateId[0]->stateId;
                                $user->countryId = 1;
                                $user->postcode = $data[6];
                                $user->userType = 3;
                                $user->save();

                                $business->user_id = $user->id;
                                $business->email = $email;
                                $business->abn = $data[3];
                                $business->password = $hashedPassword;
                                $business->company_website = $data[4];
                                $business->name = $name;
                                $business->address = $data[5];
                                $business->mobile = $data[7];
                                $business->open_hour = $data[8];
                                $business->closing_hour = $data[9];
                                if($data[16] != '' && $data[17] != ''){
                                    $business->latitude = $data[16]; 
                                    $business->longitude = $data[17];
                                }
                                $business->business_categoryId = $data[0];
                                $business->pin_code = $data[6];

                                $business->state_id = $stateId[0]->stateId;
                                $business->country_id = 1;
                                $business->save();
                                $businessAccepted[] = [
                                    'business_name' => $data[1],
                                ];

                                \Mail::send('emails/mail', array('name' => $name, 'email' => $email, 'password' => $password), function ($message) use ($name, $email, $password) {
                                    $message->to($email, $name)->subject('Welcome To PostCode');
                                    $message->from('support@postcode.test', 'Post Code');
                                });

                                \DB::commit();
                                return back()->with('Success','CSV uploaded successfully!');;
                            }else{
                                $businessRejected[] = [
                                    'business_name' => $data[1],
                                    'reason' => 'Business name Position Name can not be Empty',
                                ];
                            }
                        }catch(Exception $e){
                            $businessRejected[] = [
                                'business_name' => $data[1],
                                'reason' => $e,
                            ];
                            \DB::rollback();
                        }
                    }
                }
            }
        }
    }
    public function offerUpload(Request $req) {
        if($req->hasFile('offer_csv')){
            $extension= ['csv'];
            $getExtesion = $req->file('offer_csv')->getClientOriginalExtension();
            if(in_array($getExtesion,$extension)){
                $path = $req->file('offer_csv')->getRealPath();
                $firstline = true;
                if (($handle = fopen ( $path, 'r' )) !== FALSE) {
                    while (($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {
                        if($firstline){
                            $firstline = false;
                            continue;
                        }
                        // dd($data);

                        try{
                            if($data[0] != ''){
                                \DB::beginTransaction();
                                $offer = Offer::where('title',$data[0])->first();
                                if(!$offer){
                                    $offer = new Offer;
                                }
                                        
                                $offer->title = $data[0];
                                $offer->price = $data[4];           
                                $offer->short_description = $data[1]; 
                                $offer->description = $data[2];         
                                $offer->promo_code = $data[3];
                                $offer->howcanredeem = $data[6];
                                $offer->expire_date = $data[5];
                                $offer->created_by = auth()->user()->id;
                                $offer->address = auth()->user()->address;
                                $offer->postcode = auth()->user()->postcode;
                                $offer->save();
                                
                                $offerAccepted[] = [
                                    'offer_name' => $data[1],
                                ];

                                \DB::commit();
                                return back()->with('Success','CSV uploaded successfully!');;
                            }else{
                                $offerRejected[] = [
                                    'offer_name' => $data[0],
                                    'reason' => 'Offer name Position Name can not be Empty',
                                ];
                            }
                        }catch(Exception $e){
                            $offerRejected[] = [
                                'offer_name' => $data[0],
                                'reason' => $e,
                            ];
                            \DB::rollback();
                        }
                    }
                }
            }
        }
    }
    public function eventUpload(Request $req) {
        if($req->hasFile('event_csv')){
            $extension= ['csv'];
            $getExtesion = $req->file('event_csv')->getClientOriginalExtension();
            if(in_array($getExtesion,$extension)){
                $path = $req->file('event_csv')->getRealPath();
                $firstline = true;
                if (($handle = fopen ( $path, 'r' )) !== FALSE) {
                    while (($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {
                        if($firstline){
                            $firstline = false;
                            continue;
                        }
                        // dd($data);

                        try{
                            if($data[1] != ''){
                                \DB::beginTransaction();
                                
                                $event = new Event;
                                $event->name = $data[1];
                                $event->short_description = $data[3];           
                                $event->description = $data[2];           
                                $event->price = $data[8]; 
                                $event->event_category_id = $data[0];         
                                $event->address = auth()->user()->address;
                                $event->country_id = auth()->user()->countryId;
                                $event->state_id = auth()->user()->stateId;
                                $event->postcode = auth()->user()->postcode;
                                $event->start = $data[4];
                                $event->end = $data[5];           
                                $event->frequency = $data[6];  
                                $event->age_group = $data[7];         
                                $event->booking_details = $data[9];
                                $event->contact_details = $data[10];
                                $event->created_by = auth()->user()->id;
                                $event->save();
                                
                                $eventAccepted[] = [
                                    'event_name' => $data[1],
                                ];

                                \DB::commit();
                                return back()->with('Success','CSV uploaded successfully!');;
                            }else{
                                $eventRejected[] = [
                                    'event_name' => $data[1],
                                    'reason' => 'Event name Position Name can not be Empty',
                                ];
                            }
                        }catch(Exception $e){
                            $eventRejected[] = [
                                'event_name' => $data[1],
                                'reason' => $e,
                            ];
                            \DB::rollback();
                        }
                    }
                }
            }
        }
    }
    public function communityUpload(Request $req) {
        if($req->hasFile('ommunity_csv')){
            $extension= ['csv'];
            $getExtesion = $req->file('ommunity_csv')->getClientOriginalExtension();
            if(in_array($getExtesion,$extension)){
                $path = $req->file('ommunity_csv')->getRealPath();
                $firstline = true;
                if (($handle = fopen ( $path, 'r' )) !== FALSE) {
                    while (($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {
                        if($firstline){
                            $firstline = false;
                            continue;
                        }

                        try{
                            if($data[1] != ''){
                                \DB::beginTransaction();
                                
                                $community = new Community;
                                $community->communityCategoryId = $data[0];
                                $community->title = $data[1];
                                $community->description = $data[2];
                                $community->created_by = auth()->id();
                                $community->save();
                                
                                $eventAccepted[] = [
                                    'event_name' => $data[1],
                                ];

                                \DB::commit();
                                return back()->with('Success','CSV uploaded successfully!');;
                            }else{
                                $eventRejected[] = [
                                    'event_name' => $data[1],
                                    'reason' => 'Event name Position Name can not be Empty',
                                ];
                            }
                        }catch(Exception $e){
                            $eventRejected[] = [
                                'event_name' => $data[1],
                                'reason' => $e,
                            ];
                            \DB::rollback();
                        }
                    }
                }
            }
        }
    }

    public function downloadEventCategoryCSV()
    {
        $header = ['id','name'];
    	$title = 'Event Category List';
    	$f = fopen('php://memory', 'w');
    	fputcsv($f, $header, ',');
    	// here inside the Foreach data will be Append when Export CSV will Apply
        $categories = EventCategory::all();
        foreach ($categories as $val) {
            $lineData = [$val->id, $val->name];
            fputcsv($f, $lineData, ',');
        }
    	fseek($f, 0);
    	header('Content-Type: text/csv');
    	header('Content-Disposition: attachment; filename="'.$title.'.csv'.'";');
    	fpassthru($f);
    }
    public function downloadBusinessCategoryCSV()
    {
        $header = ['id','name'];
    	$title = 'Business Category List';
    	$f = fopen('php://memory', 'w');
    	fputcsv($f, $header, ',');
    	// here inside the Foreach data will be Append when Export CSV will Apply
        $categories = BusinessCategory::all();
        foreach ($categories as $val) {
            $lineData = [$val->id, $val->name];
            fputcsv($f, $lineData, ',');
        }
    	fseek($f, 0);
    	header('Content-Type: text/csv');
    	header('Content-Disposition: attachment; filename="'.$title.'.csv'.'";');
    	fpassthru($f);
    }
    public function downloadCommunityCategoryCSV()
    {
        $header = ['id','name'];
    	$title = 'Community Category List';
    	$f = fopen('php://memory', 'w');
    	fputcsv($f, $header, ',');
    	// here inside the Foreach data will be Append when Export CSV will Apply
        $categories = CommunityCategory::all();
        foreach ($categories as $val) {
            $lineData = [$val->id, $val->name];
            fputcsv($f, $lineData, ',');
        }
    	fseek($f, 0);
    	header('Content-Type: text/csv');
    	header('Content-Disposition: attachment; filename="'.$title.'.csv'.'";');
    	fpassthru($f);
    }
}
