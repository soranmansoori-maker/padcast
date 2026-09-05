<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManageAlbumController extends DashboardController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::orderBy('id', 'desc')->paginate(10);
        $count = Album::orderBy('id', 'desc')->count();
        return view('admin.album.index', compact('albums', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::table('categories')->orderBy('id', 'asc')->get();
        return view('admin.album.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user()->id;
        $request->validate([
            'title' => 'required|string|min:3|max:100',
            'category' => 'required|integer',
            'description' => 'required|string|max:500',
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:1000',
        ]);
        $coverfile = $request['cover'];
        $cover = $this->UploadAlbumCover($coverfile);
        Album::create([
            'title' => $request['title'],
            'category' => $request['category'],
            'description' => $request['description'],
            'cover' => $cover,
            'user' => $user,
        ]);
        return redirect(route('albums.index'))->with('album-add-success', 'آلبوم موردنظر با موفقیت ایجاد گردید.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        $categories = Category::latest()->get();
        return view('admin.album.edit', compact('album', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sqlData = DB::table('albums')->where('id', '=', $id)->get();
        $request->validate([
            'title' => 'required|string|min:3|max:100',
            'category' => 'required|integer',
            'description' => 'required|string|max:500',
            'cover' => 'image|mimes:jpeg,png,jpg|max:1000',
        ]);
        $coverfile = $request['cover'];
        if ($request->hasFile('cover')) {
            $cover = $this->UploadAlbumCover($coverfile);
        } else {
            $cover = $sqlData[0]->cover;
        }
        Album::where('id', $id)->update([
            'title' => $request['title'],
            'category' => $request['category'],
            'description' => $request['description'],
            'cover' => $cover,
        ]);
        return redirect(route('albums.index'))->with('album-edit-success', 'آلبوم موردنظر با موفقیت ویرایش گردید.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        $album->delete();
        return redirect()->back()->with('album-del-success', 'آلبوم موردنظر با موفقیت حذف گردید.');
    }
}
