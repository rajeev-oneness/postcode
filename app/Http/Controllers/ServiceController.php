<?php

namespace App\Http\Controllers;

use App\Model\Service;
use App\Model\BusinessCategory;
use App\Model\Business;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Go to Services View.
     *
     * @return view
     */
    public function Services()
    {
        $servicesData = Business::all();
        if(auth()->user()->userType == 3) {
            return view('business-portal.service.services', compact('servicesData'));
        }
        return view('/portal.service.services', compact('servicesData'));
    }

    /**
     * Go to Add Services.
     *
     * @return view
     */
    public function addServices(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $validator->validate();
        try {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/'), $fileName);
            $servicedesc = 'uploads/' . $fileName;

            $Service = new Service();
            $business = Business::where('user_id', auth()->user()->id)->first();
            if(auth()->user()->userType != 3){
                $businessId = $request->businessId;         
            } else {
                $businessId = $business->id;
            }
            $Service->businessId = $businessId;
            $Service->name = $request->name;
            $Service->image = $servicedesc;
            $Service->details = $request->details;
            $Service->price = $request->price;
            $Service->created_by = auth()->user()->id;

            $Service->save();

            if(auth()->user()->userType == 3) {
                return redirect()->route('business-admin.manage_service');
            }
            return redirect()->route('admin.manage_service');
        } catch (\Exception $e) {
            report($e);

            return false;
        }
    }

    /**
     * Go to manage Services view.
     *
     * @param  Request $request
     * @return view
     */
    public function manageServiceView(Request $request)
    {
        if(auth()->user()->userType == 3) {
            $service_manage = Service::where('created_by', auth()->user()->id)->with('busicategorytype')->get();
            return view('business-portal.service.manage_service', compact('service_manage'));
        }
        $userId = Auth::user()->id;
        $service_manage = Service::with('busicategorytype')->get();
        return view('/portal.service.manage_service', compact('service_manage'));
    }

    /**
     * Go to Edit Services.
     *
     * @param  Request $request
     * @return view
     */
    // public function editServices(Request $request)
    // {
    //     $lead_edit_id = $request->app_id;
       
    //     $editedservice_data = Service::where('id', $lead_edit_id)->first();
    //     // echo json_encode($businessSerData);die;
    //     return view('portal.service.edit_service', compact('editedservice_data', 'businessSerData'));
    // }

    public function editServices($id) {      
     
        $businessSerData = Business::all();
        $editedservice_data = Service::findOrFail(decrypt($id));
        // echo json_encode($edited_data);die;
        if(auth()->user()->userType == 3) {
            return view('business-portal.service.edit_service',compact('editedservice_data', 'businessSerData'));
        }
        return view('portal.service.edit_service',compact('editedservice_data', 'businessSerData'));
        
    }

    /**
     * Go to Update Service.
     *
     * @return view
     */
    public function updateServices(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            
        ]);
        $validator->validate();
        try {
            $hid_id = $request->hid_id;
            $business = Business::where('user_id', auth()->user()->id)->first();
            if(auth()->user()->userType != 3){
                $businessId = $request->business_categoryId;         
            } else {
                $businessId = $business->id;
            }
            if($request->hasFile('image')) {
                $fileName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/'), $fileName);
                $servc = 'uploads/' . $fileName;
                Service::where('id', $hid_id)->update([
                    'image' => $servc
                ]);
            }

            $update_service_data = Service::where('id', $hid_id)->update([
                'name' => $request->name, 
                'businessId' => $businessId, 
                'details' => $request->details,
                'price' => $request->price
            ]);
            if(auth()->user()->userType == 3) {
                return redirect()->route('business-admin.manage_service');
            }
            return redirect()->route('admin.manage_service');
        } catch (\Exception $e) {
            report($e);

            return false;
        }
    }

    /**
     * Go to Delete Service.
     *
     * @return view
     */
    public function deleteServices($lead_delete_id)
    {
        $delete_ser = Service::where('id', decrypt($lead_delete_id))->delete();
        if(auth()->user()->userType == 3) {
            return redirect()->route('business-admin.manage_service');
        }
        return redirect()->route('admin.manage_service');
    }
}
