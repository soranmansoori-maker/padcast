<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use App\Models\Like;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SitePodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $podcasts = Podcast::with('album','likes')->withCount('likes')->orderBy('created_at', 'desc')->paginate(10);
        $lastPodcast = Podcast::with('album','likes')->orderBy('download_count', 'desc')->first();
        return view('layouts.podcast', compact('podcasts', 'lastPodcast'));
    }

    public function update(Request $request)
    {
        $file = $request['file'];
        DB::table('podcasts')
            ->where('id', $request['id'])
            ->update([
                'download_count' => DB::raw('download_count + 1'),
            ]);
        return redirect()->back();
    }

    public function toggleLike(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $podcast = Podcast::findOrFail($id);
        $existing = Like::where('podcast_id', $podcast->id)->where('user_id', $user->id)->first();
        if ($existing) {
            $existing->delete();
            UserActivity::record($user, 'podcast', $podcast->id, 'unlike');
        } else {
            Like::create(['podcast_id' => $podcast->id, 'user_id' => $user->id]);
            UserActivity::record($user, 'podcast', $podcast->id, 'like');
        }

        return redirect()->back();
    }
}
