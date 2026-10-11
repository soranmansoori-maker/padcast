<?php

namespace App\Http\Controllers;

use App\Models\Subscribers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscribersController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:subscribers'],
        ]);
        Subscribers::create([
            'email' => $request['email'],
        ]);
        return redirect()->back()->with('success','کاربر گرامی، شما با موفقیت عضو خبرنامه شدید.');
    }
}
