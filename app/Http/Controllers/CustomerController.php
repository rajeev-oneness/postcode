<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator, Redirect, Response;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index() {
        $customers = User::where('userType', 2)->orderBy('created_at', 'DESC')->get();
        return view('portal.customer.index', compact('customers'));
    }
    
    public function add() {
        return view('portal.customer.add');
    }

    public function store(Request $req) {
        $req->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]*$/',
            'email' => 'required|email|unique:users',
            'password'=> 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8'

        ]);
        // dd($req->name);
        $customer = new User;
        $customer->name = $req->name;
        $customer->email = $req->email;
        $customer->password = Hash::make($req->password);
        $customer->userType = 2;
        $customer->save();
        return redirect()->route('admin.customers');
    }

    public function edit($customerId) {
        $customer = User::find(decrypt($customerId));
        return view('portal.customer.edit', compact('customer'));
    }

    public function update(Request $req) {
        $req->validate([
            'name' => 'required|regex:/^[a-zA-z]+([\s][a-zA-Z]+)*$/'
        ]);
        $customer = User::find($req->customerId);
        $customer->name = $req->name;
        $customer->save();
        return redirect()->route('admin.customers');
    }

    public function delete($customerId) {
        $customer = User::find(decrypt($customerId));
        $customer->delete();
        return redirect()->route('admin.customers');
    }
}
