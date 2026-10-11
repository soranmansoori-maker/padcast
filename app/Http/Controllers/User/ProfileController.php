<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends PanelController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userID = auth()->user()->id;
        $podcast = DB::table('podcasts')->where('user', '=', $userID)->get();
        $album = DB::table('albums')->where('user', '=', $userID)->get();
        $downloads = DB::table('podcasts')->where('user', '=', $userID)->sum('download_count');
        $PodcastCount = count($podcast);
        $AlbumCount = count($album);
        $folder_path = "uploads/podcast/".$userID;
        $folder_size = $this->folderSize($folder_path);
        $diskSize = $this->formatSize($folder_size);
        return view('user.profile', compact('PodcastCount', 'AlbumCount', 'diskSize', 'downloads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
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
        if (isset($request->old_password)){
            $user = User::findOrFail(auth()->user()->id);
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|min:8|max:20|different:password',
            ]);
            if (Hash::check($request->old_password, $user->password)) {
                $user->fill([
                    'password' => Hash::make($request->new_password)
                ])->save();
                return redirect(route('profile.index'))->with('success','رمز عبور شما با موفقیت تغییر یافت.');
            } else {
                return redirect(route('profile.index'))->with('error','خطا در تغییر رمز عبور، لطفا ورودی های خود را بررسی کنید.');
            }
        }else{
            $request->validate([
                'first_name' => ['required', 'string', 'max:191'],
                'last_name' => ['required', 'string', 'max:191'],
                'country' => ['string', 'nullable', 'max:191'],
                'state' => ['string', 'nullable', 'max:191'],
                'city' => ['string', 'nullable', 'max:191'],
                'about' => ['string', 'nullable', 'max:500'],
            ]);
            if (User::where('id', $id)->update([
                'name' => $request['first_name']." ".$request['last_name'],
                'country' => $request['country'],
                'state' => $request['state'],
                'city' => $request['city'],
                'about' => $request['about'],
            ])){
                return redirect()->back()->with('done','اطلاعات شما با موفقیت تغییر یافت.');
            }else{
                return redirect()->back()->with('notdone','خطا، ویرایش اطلاعات انجام نشد!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
