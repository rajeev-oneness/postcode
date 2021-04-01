<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Business;
use App\Model\BusinessCategory;
use App\Model\Event;
use App\Model\Rating;
use App\Model\Country;
use App\Model\State;
use App\Model\Postcode;
use Auth;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function directory() {
        $ratings = Rating::all();
        $businesses = Business::orderBy('created_at', 'DESC')->get();
        return view('front.directory', compact('businesses','ratings'));
    }
    
    public function homepage() {
        $businesses = Business::all();
        $postcodes = Postcode::all();
        $categories = BusinessCategory::all();
        return view('front.home.index', compact('businesses','postcodes','categories'));
    }

    public function search(Request $req) {
        // dd($req->all());
        $keyword = $req->keyword;
        $postcode = $req->postcode;
        $category = $req->category;
        $businesses = Business::where([
            ['name', 'LIKE', '%' . $keyword . '%'],
            ['pin_code', 'LIKE', '%' . $postcode . '%'],
            ['business_categoryId', 'LIKE', '%' . $category . '%'],
        ])->get();
        if(count($businesses) == 0){
            $req->session()->flash('noData', 'Sorry! no data found');
            return back();
        }
        // dd($businesses);
        return view('front.home.directory-search', compact('businesses'));
    }

    public function statePostcode($stateId) {
        // $state = State::find($stateId);
        // dd($stateId);
        $postcodes = Postcode::where('stateId', $stateId)->get();
        
        

        // $businesses = DB::table('postcodes')
        //             ->join('businesses', 'postcodes.postcode', '=', 'businesses.pin_code')
        //             ->where('postcodes.postcode', '=', $postcodes->postcode)
        //             ->get();
        
        
        dd($postcodes);
    }
}
