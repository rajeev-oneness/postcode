<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CKEditorController extends Controller
{
    public function ckeditor_upload(Request $request)
    {

        if ($request->hasFile('upload')) {
           
            $product_licence = $request->file('upload');
            $file_ext = $product_licence->getClientOriginalExtension();
            $name = date("dmYhms") . "up" . rand(101, 99999) . "." . $file_ext;
            $destination_path_product_licence = "uploads/ckupload";
            $product_licence->move($destination_path_product_licence, $name);
            // }

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = \URL::to('uploads/ckupload/' . $name);
            // $url = asset('images/'.$fileName); 
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
}
