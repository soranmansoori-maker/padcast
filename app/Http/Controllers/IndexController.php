<?php

namespace App\Http\Controllers;
use App\Models\Album;
use App\Models\Category;
use App\Models\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hekmatinasser\Verta\Verta;


class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $podcasts = Podcast::with('album')->orderBy('created_at', 'desc')->paginate(8);
        $lastPodcast = Podcast::with('album')->orderBy('download_count', 'desc')->first();
        $updated = Podcast::with('album')->orderBy('id', 'desc')->take(8)->get();
        $vipPodcasts = Podcast::with('album')->orderBy('download_count', 'desc')->latest()->take(10)->get();
        $vipAlbums = Album::has('podcasts')->with('podcasts')->orderBy('view_count', 'desc')->latest()->take(10)->get();
        return view('welcome', compact('podcasts', 'lastPodcast', 'updated', 'vipPodcasts', 'vipAlbums'));
    }
}
