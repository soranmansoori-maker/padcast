<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Category;
use App\Models\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index()
    {
        return view('layouts.search');
    }

    public function search(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:100',
        ]);
        $key = $request['key'];

        $categories = DB::table('categories')->where([
            ['name', 'LIKE', '%' . $key . '%'],
        ])->get();

        $albums = Album::with('category')->where([
            ['title', 'LIKE', '%' . $key . '%'],
        ])->get();

        $podcasts = Podcast::with('album')->where([
            ['name', 'LIKE', '%' . $key . '%'],
        ])->orderBy('created_at', 'desc')->get();

        // dd($categories,$albums,$podcasts);
        return view('layouts.search_result', compact('categories', 'albums', 'podcasts', 'key'));

    }

    public function advancedSearch(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:100',
            'search-cat' => 'string|max:4',
            'search-album' => 'string|max:4',
            'search-podcast' => 'string|max:4',
        ]);
        $key = $request['key'];

        if ($request['search-cat'] == 'true') {
            $categories = DB::table('categories')->where([
                ['name', 'LIKE', '%' . $key . '%'],
            ])->get();
        } else {
            $categories = '';
        }
        if ($request['search-album'] == 'true') {
            $albums = Album::with('category')->where([
                ['title', 'LIKE', '%' . $key . '%'],
            ])->get();
        } else {
            $albums = '';
        }
        if ($request['search-podcast'] == 'true') {
            $podcasts = Podcast::with('album')->where([
                ['name', 'LIKE', '%' . $key . '%'],
            ])->orderBy('created_at', 'desc')->get();
        } else {
            $podcasts = '';
        }
        // dd($categories,$albums,$podcasts);
        return view('layouts.search_result', compact('categories', 'albums', 'podcasts', 'key'));

    }
}
