<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AjaxUploadController extends Controller
{
    function index()
    {
        return view('ajax_upload');
    }

    function action(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'select_file' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        if($validation->passes())
        {
            $image = $request->file('select_file');
            $new_name = uniqid().time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/profile'), $new_name);
            User::where('id', $request->id)->update([
                'image' => "/uploads/profile/".$new_name,
            ]);
            return response()->json([
                'message'   => 'تصویر پروفایل با موفقیت تغییر یافت.',
                'uploaded_image' => '/uploads/profile/'.$new_name,
                'class_name'  => 'alert-success'
            ]);
        }
        else
        {
            return response()->json([
                'message'   => $validation->errors()->all(),
                'uploaded_image' => '',
                'class_name'  => 'alert-danger'
            ]);
        }
    }
}
