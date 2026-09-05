<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManageCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::with('user')
            ->where('status', '=', '1')
            ->where('parent', '=', 0)
            ->latest('created_at')->paginate(10);
        $count = Comment::with('user')
            ->where('status', '=', '1')
            ->where('parent', '=', 0)->count();
        $disable = Comment::with('user')
            ->where('status', '=', '0')
            ->where('parent', '=', 0)
            ->latest('created_at')->paginate(10);
        $dCount = Comment::with('user')
            ->where('status', '=', '0')
            ->where('parent', '=', 0)->count();
        return view('admin.comment.index', compact('comments', 'count', 'disable', 'dCount'));
    }

    public function approve(Request $request, $id)
    {
        Comment::where('id', $id)->update([
            'status' => '1',
        ]);
        return redirect(route('comments.index'))->with('com-approved-success','کامنت موردنظر با موفقیت منتشر گردید.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user()->id;
        $request->validate([
            'commentID' => 'required|integer|min:1',
            'reply' => 'required|string|max:500',
        ]);
        Comment::create([
            'comment' => $request['reply'],
            'user' => $user,
            'parent' => $request['commentID'],
            'album' => $request['albumID'],
            'status' => '1',
        ]);
        return redirect(route('comments.index'))->with('reply-add-success', 'پاسخ موردنظر با موفقیت ثبت شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $comments = Comment::where('status', '=', '0')->latest()->paginate(15);
        $counter = Comment::where('status', '=', '0')->latest()->get();
        $count = count($counter);
        return view('admin.comment.requests', compact('comments', 'count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('com-del-success', 'کامنت موردنظر با موفقیت حذف گردید.');
    }
}
