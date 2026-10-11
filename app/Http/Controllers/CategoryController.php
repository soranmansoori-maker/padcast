<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')->get();
        return view('layouts.category', compact('categories'));
    }

    public function show($id)
    {
        $albums = Album::where('category', '=', $id)->paginate(15);
        $catName = DB::table('categories')->where('id', '=', $id)->first();
        return view('layouts.cat_albums', compact('albums', 'catName'));
    }
}
