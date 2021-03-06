<?php

namespace App\Http\Controllers;

use App\Model\Service;
use App\Model\BusinessCategory;

use Illuminate\Http\Request;
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
        $servicesData = BusinessCategory::all();
        return view('/portal.service.services', compact('servicesData'));
    }

    /**
     * Go to Add Services.
     *
     * @return view
     */
    public function addServices(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5|string',

        ]);
        $fileName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/'), $fileName);
        $servicedesc = 'uploads/' . $fileName;

        $Service = new Service();
        $Service->businessId = $request->business_categoryId;
        $Service->name = $request->name;
        $Service->image = $servicedesc;
        $Service->details = $request->details;
        $Service->price = $request->price;

        $Service->save();
        return redirect()->route('admin.dashboard');
    }

    /**
     * Go to manage Services view.
     *
     * @param  Request $request
     * @return view
     */
    public function manageServiceView(Request $request)
    {
        $userId = Auth::user()->id;

        $service_manage = Service::with('busicategorytype')->get();
        // echo json_encode($service_manage);die;
        return view('/portal.service.manage_service', compact('service_manage'));
    }

    /**
     * Go to Edit Services.
     *
     * @param  Request $request
     * @return view
     */
    public function editServices(Request $request)
    {
        $lead_edit_id = $request->app_id;
        $businessSerData = BusinessCategory::all();
        $editedservice_data = Service::where('id', $lead_edit_id)->first();
        // echo json_encode($businessSerData);die;
        return view('portal.service.edit_service', compact('editedservice_data', 'businessSerData'));
    }

    /**
     * Go to Update Service.
     *
     * @return view
     */
    public function updateServices(Request $request)
    {
        $fileName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/'), $fileName);
        $servc = 'uploads/' . $fileName;
        $hid_id = $request->hid_id;

        $update_service_data = Service::where('id', $hid_id)->update(['name' => $request->name, 'businessId' => $request->business_categoryId, 'details' => $request->details, 'image' => $servc, 'price' => $request->price]);
        return redirect()->route('admin.manage_service');
    }

    /**
     * Go to Delete Service.
     *
     * @return view
     */
    public function deleteServices(Request $request)
    {
        $lead_delete_id = $request->appdel_id;
        $delete_ser = Service::where('id', $lead_delete_id)->delete();
        return redirect()->route('admin.manage_service');
    }
}
