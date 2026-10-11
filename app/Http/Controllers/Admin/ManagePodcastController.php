<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagePodcastController extends DashboardController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $podcasts = Podcast::where('status', '=', '1')->latest()->paginate(15);
        $count = Podcast::where('status', '=', '1')->get()->count();
        return view('admin.podcast.index', compact('podcasts', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'albums' => DB::table('albums')->latest()->get()
        ];
        return view('admin.podcast.create', compact('data'));
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
            'name' => 'required|string|min:3|max:100',
            'description' => 'required|string|max:500',
            'album' => 'required|integer',
            'status' => 'required|integer',
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:1000',
            'file' => 'required|mimes:mp3,wav|max:20000',
        ]);
        $coverfile = $request['cover'];
        $podcastFile = $request['file'];
        $cover = $this->UploadCover($coverfile);
        $podcast = $this->UploadPodcast($podcastFile, $user);
        Podcast::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'album' => $request['album'],
            'cover' => $cover,
            'file' => $podcast,
            'status' => $request['status'],
            'user' => $user,
        ]);
        return redirect(route('podcasts.index'))->with('pod-create-success','پادکست موردنظر با موفقیت ایجاد گردید.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $podcasts = Podcast::where('status', '=', '0')->latest()->paginate(15);
        $counter = Podcast::where('status', '=', '0')->latest()->get();
        $count = count($counter);
        return view('admin.podcast.requests', compact('podcasts', 'count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Podcast $podcast)
    {
        $data = [
            'podcasts' => $podcast,
            'albums' => DB::table('albums')->latest()->get()
        ];
        return view('admin.podcast.edit', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request, $id)
    {
        Podcast::where('id', $id)->update([
            'status' => '1',
        ]);
        return redirect(route('podcasts.index'))->with('pod-approved-success','پادکست موردنظر با موفقیت منتشر گردید.');
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
        $sqlData = DB::table('podcasts')->where('id', '=', $id)->get();
        $userID = auth()->user()->id;
        $request->validate([
            'name' => 'required|string|min:3|max:100',
            'description' => 'required|string|max:500',
            'album' => 'required|integer',
            'status' => 'required|integer',
            'cover' => 'image|mimes:jpeg,png,jpg|max:1000',
            'file' => 'mimes:mp3,wav|max:20000'
        ]);
        $coverfile = $request['cover'];
        $podcastFile = $request['file'];
        if ($request->hasFile('cover')) {
            $cover = $this->UploadCover($coverfile);
        } else {
            $cover = $sqlData[0]->cover;
        }
        if ($request->hasFile('file')) {
            $podcast = $this->UploadPodcast($podcastFile, $userID);
        } else {
            $podcast = $sqlData[0]->file;
        }

        Podcast::where('id', $id)->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'album' => $request['album'],
            'cover' => $cover,
            'file' => $podcast,
            'status' => $request['status'],
        ]);
        return redirect(route('podcasts.index'))->with('pod-success','ویرایش پادکست با موفقیت انجام شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Podcast $podcast)
    {
        $podcast->delete();
        return redirect()->back()->with('pod-delete-success','پادکست موردنظر با موفقیت حذف گردید.');
    }

}
