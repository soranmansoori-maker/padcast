<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user()->id;
        $request->validate([
            'comment' => 'required|string|min:10|max:500',
        ]);
        Comment::create([
            'comment' => $request['comment'],
            'album' => $request['album'],
            'user' => $user,
            'status' => '0',
            'parent' => 0,
        ]);
        return redirect()->back()->with('success','کاربر گرامی، دیدگاه شما با موفقیت ثبت شد و پس از بررسی منتشر خواهد شد.');
    }
}
