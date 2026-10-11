<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hekmatinasser\Verta\Verta;

class PodcastController extends PanelController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user()->id;
        $folder_path = "uploads/podcast/" . $user;
        $folder_size = $this->folderSize($folder_path);
        $diskSize = $this->formatSize($folder_size);
        $data = Podcast::where('user', '=', $user)->latest()->paginate(15);
        $albums = Album::latest()->get();
        $count = count($data);
        $diskSize = $diskSize;
        return view('user.podcast.index', compact('data', 'count', 'albums', 'diskSize'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user()->id;
        $albums = DB::table('albums')->where('user', '=', $user)->latest()->get();
        return view('user.podcast.create', compact('albums'));
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
            'name' => 'required|string|min:3|max:100',
            'description' => 'required|string|max:500',
            'album' => 'required|integer',
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
            'status' => '0',
            'user' => $user,
        ]);
        return redirect(route('podcast.index'))->with('pod-add-success','پادکست موردنظر با موفقیت ثبت شد و پس از بازبینی توسط تیم مدیریت منتشر خواهد شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Podcast $podcast)
    {
        $user = auth()->user()->id;
        $data = [
            'podcasts' => $podcast,
            'albums' => DB::table('albums')->where('user', '=', $user)->latest()->get()
        ];
        return view('user.podcast.edit', compact('data'));
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
        $sqlData = DB::table('podcasts')->where('id', '=', $id)->get();
        $userID = auth()->user()->id;
        $request->validate([
            'name' => 'required|string|min:3|max:100',
            'description' => 'required|string|max:500',
            'album' => 'required|integer',
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
        ]);
        return redirect(route('podcast.index'))->with('pod-edit-success','پادکست موردنظر با موفقیت ویرایش گردید.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Podcast $podcast)
    {
        $podcast->delete();
        return redirect(route('podcast.index'))->with('pod-delete-success', 'پادکست موردنظر از سیستم حذف گردید.');

    }
}
