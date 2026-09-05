<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManageCategoryController extends DashboardController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(10);
        $count = Category::orderBy('id', 'desc')->count();
        return view('admin.category.index', compact('categories', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:191',
            'description' => 'required|string|max:500',
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:1000',
        ]);
        $coverfile = $request['cover'];
        $cover = $this->UploadCategoryCover($coverfile);
        Category::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'cover' => $cover,
        ]);
        return redirect(route('categories.index'))->with('cat-add-success', 'دسته بندی موردنظر با موفقیت ایجاد گردید.');
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
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
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
        $sqlData = DB::table('categories')->where('id', '=', $id)->get();
        $request->validate([
            'name' => 'required|string|min:3|max:191',
            'description' => 'required|string|max:500',
            'cover' => 'image|mimes:jpeg,png,jpg|max:1000',
        ]);
        $coverfile = $request['cover'];
        if ($request->hasFile('cover')) {
            $cover = $this->UploadCategoryCover($coverfile);
        } else {
            $cover = $sqlData[0]->cover;
        }
        Category::where('id', $id)->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'cover' => $cover,
        ]);
        return redirect(route('categories.index'))->with('cat-edit-success', 'دسته بندی موردنظر با موفقیت ویرایش گردید.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('cat-del-success', 'دسته بندی موردنظر با موفقیت حذف گردید.');
    }
}
