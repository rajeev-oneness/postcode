<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Rating;
use App\Model\RatingResponse;
use App\Model\Business;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($businessId)
    {
        if(auth()->check()) {
            $id = $businessId;
            return view('front.home.review', compact('id'));
        }
        return redirect()->route('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rating = new Rating;
        $rating->userId = auth()->user()->id;
        $rating->business_id = $request->business_id;
        $rating->rating = $request->rating;
        $rating->description = $request->description;
        $rating->save();
        return redirect()->route('directory');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {
        $business_id = Business::where('user_id', auth()->id())->get();
        $ratings = Rating::where('business_id', $business_id[0]->id)->with('user', 'response')->get();
        return view('business-portal.rating.manage_ratings', compact('ratings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addResponse($ratingId)
    {
        $rating = Rating::find(decrypt($ratingId));
        $response = RatingResponse::where('rating_id', $rating->id)->get();
        return view('business-portal.rating.add_response', compact('rating', 'response'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeResponse(Request $request)
    {
        // dd($request->all());
        $response = new RatingResponse;
        $response->user_id = $request->user_id;
        $response->business_id = $request->business_id;
        $response->rating_id = $request->rating_id;
        $response->response = $request->response;
        $response->save();
        return redirect()->route('business-admin.manage_ratings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $lead_delete_id = $request->appdel_id;
        $delete_event = Rating::where('id', $lead_delete_id)->delete();
        if(auth()->user()->userType == 3){
            return redirect()->route('business-admin.manage_ratings');
        }
        // return redirect()->route('admin.manage_offers');
    }
}
