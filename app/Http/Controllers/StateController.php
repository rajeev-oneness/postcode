<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\BusinessCategory;
use App\Model\State;
use Validator,Redirect,Response;

class StateController extends Controller
{
    /**
    * Go to State view.
    *
    * @return view
    */
    public function statesView(){
        return view('/portal.state.state');
    }

     /**
    * Go to Add States.
    *
    * @return view
    */
    public function addStates(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1',
            'code' => 'required',      
        ]);
       $validator->validate();

        $State = new State();
        $State->name = $request->name;         
        $State->code = $request->code;

        $State->save();
           
            return redirect()->route('admin.manage_state');
    }

     /**
     * Go to manage events view.
     *
     * @param  Request $request
     * @return view
     */
    public function manageStateView(Request $request){
        $categories = State::all();
        // echo json_encode($categories1);die;
        return view('/portal.state.manage_states',compact('categories'));
    }

      /**
     * Go to Edit Offers view.
     *
     * @param  Request $request
     * @return view
     */
    // public function editStates(Request $request) {      
    //     $lead_events_id = $request->app_id;
    //     $editedstates_data = State::where('id', $lead_events_id)->first();
    //     // echo json_encode($businessSerData);die;
    //     return view('portal.state.edit_states', compact('editedstates_data'));
        
    // }
/**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editStates($id)
    {
        
        $editedstates_data = State::findOrFail(decrypt($id));
        return view('portal.state.edit_states', compact('editedstates_data'));
    }
    /**
    * Go to Update Offers.
    *
    * @return view
    */
    public function updateStates(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'code' => 'required|min:5',
        ]);
        $validator->validate();

        $hid_id = $request->hid_id;
        $update_state_data = State::where('id', $hid_id)->update(['name' => $request->name, 'code' => $request->code]);   
            return redirect()->route('admin.manage_state');
    }

     /**
     * Go to Delete Offers.
     *
     * @param  Request $request
     * @return view
     */
    public function deleteStates(Request $request) {
        $lead_delete_id = $request->appdel_id;
        $delete_state = State::where('id', $lead_delete_id)->delete();
        return redirect()->route('admin.manage_state');
    }
}
