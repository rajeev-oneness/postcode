<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Model\Business;
use App\Model\BusinessCategory;

class BusinessController extends Controller
{
    /**
    * Go to Add Businesses.
    *
    * @return view
    */
    public function BusinessProfiles(){
        $productData= BusinessCategory::all();
      
        return view('/portal.business_profiles',compact('productData'));
    }


    public function addingBusiness(Request $request) {
        $response = [];
        $statusCode = 200;
        if (!$request->ajax()) {
            $statusCode = 400;
            $response = array('error' => 'Error occured in Ajax Call.');
            return response()->json($response, $statusCode);
        }
        $this->validate($request, [
            'name' => 'required',
            'discount_type' => 'required',
            'discount_value' => 'required',
            'imgInp' => 'required'     
                ], [
            'name.required' => 'Name is required',
            'discount_type.required' => 'Discount Type is required',
            'discount_value.required' => 'Discount Value is required',
            'imgInp.required' => 'Image Value is required'
            
                ]
        );
        try {
            $exam_name = $request->get('exam_name');
            $exam_Duration = $request->get('exam_Duration');
            $exam_Total_Marks = $request->get('exam_Total_Marks');
           
            $exam_cut_off = $request->get('exam_cut_off');
            $exam_desc = $request->get('exam_desc');
            $exam_negative_marking_flag = $request->get('exam_negative_marking_flag');
            $original_paper_flag = $request->get('original_paper_flag');
            $exam_year = $request->get('exam_year');
            $exam_month = $request->get('exam_month');
            $exam_date = $request->get('exam_date');
         
           
            $Business = new Business();
            $Business->exam_name = $exam_name;
            $Business->exam_Duration = $exam_Duration;
            $Business->exam_Total_Marks = $exam_Total_Marks;
            $Business->exam_cut_off = $exam_cut_off;
            $Business->exam_desc = $exam_desc;
            $Business->exam_negative_marking_flag = $exam_negative_marking_flag;
            $Business->original_paper_flag = $original_paper_flag;
            $Business->exam_year = $exam_year;
            $Business->exam_month = $exam_month;
            $Business->exam_date = $exam_date;
           
           
         
            $Business->save();

            $response = array(
                'status' => 1,
                'message' => 'Employee Details Are Inserted Successfully'
            );
        } catch (\Exception $e) {
            $response = array(
                'exception' => true,
                'exception_message' => $e->getMessage(),
            );
            $statusCode = 400;
        } finally {
           return response()->json($response, $statusCode);
        }
    }
}
