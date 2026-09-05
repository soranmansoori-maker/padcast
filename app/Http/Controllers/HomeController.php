<?php

namespace App\Http\Controllers;
use App\Http\Controllers\User\PanelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends PanelController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user()->id;
        $podcast = DB::table('podcasts')->where('user', '=', $user)->get();
        $album = DB::table('albums')->where('user', '=', $user)->get();
        $downloads = DB::table('podcasts')->where('user', '=', $user)->sum('download_count');
        $podcastCount = count($podcast);
        $albumCount = count($album);
        $folder_path = "uploads/podcast/".$user;
        $folder_size = $this->folderSize($folder_path);
        $diskSize = $this->formatSize($folder_size);
        return view('dashboard', compact('podcastCount','albumCount', 'diskSize', 'downloads'));
    }
}
