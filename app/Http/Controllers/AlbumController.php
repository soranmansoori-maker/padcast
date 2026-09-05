<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Comment;
use App\Models\Podcast;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::has('podcasts')->orderBy('id', 'desc')->paginate(20);
        return view('layouts.album', compact('albums'));
    }

    public function show($id)
    {
        $lastPodcast = Podcast::with('album')->where('album', '=', $id)->latest('created_at')->first();
        $podcasts = Podcast::with('album')->where('album', '=', $id)->orderBy('id', 'desc')->paginate(15);
        $albumName = Album::with('category')->where('id', '=', $id)->first();
        $cat = DB::table('categories')->get();
        $latestComments = Comment::with('album')->where('status', '=', '1')->latest('created_at')->take(5)->get();
        $comments = Comment::with('user')->where('album', '=', $id)
            ->where('status', '=', '1')
            ->where('parent', '=', 0)
            ->latest('created_at')->get();
        $replies = Comment::with('user')->where('album', '=', $id)
            ->where('status', '=', '1')
            ->where('parent', '>', 0)
            ->latest('created_at')->get();
        $countCM = $comments->count() + $replies->count();
        DB::table('albums')
            ->where('id', $id)
            ->update([
                'view_count' => DB::raw('view_count + 1'),
            ]);

        if (Auth::check()) {
            UserActivity::record(Auth::user(), 'album', $id, 'view', ['source' => 'album_show']);
        }

        return view('layouts.album_details', compact('lastPodcast','podcasts', 'albumName', 'cat', 'comments', 'replies', 'countCM', 'latestComments'));
    }

}
