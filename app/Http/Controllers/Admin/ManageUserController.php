<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ManageUserController extends DashboardController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')->latest()->paginate(10);
        $count = DB::table('users')->get()->count();
        return view('admin.user.index', compact('users', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
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
            'first-name' => ['required', 'string', 'max:191'],
            'last-name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['nullable', 'numeric', 'digits:11', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required'],
            'image' => 'image|mimes:jpeg,png,jpg|max:1000',
        ]);
        $imagefile = $request['image'];
        $image = $this->UploadUserImage($imagefile);
        $user = User::create([
            'name' => $request['first-name'].' '.$request['last-name'],
            'email' => $request['email'],
            'mobile' => $request['mobile'],
            'password' => Hash::make($request['password']),
            'role' => $request['role'],
            'image' => $image,
        ]);
        Storage::makeDirectory('/uploads/podcast/'. $user->id);
        return redirect(route('users.index'))->with('user-add-success', 'حساب کاربری موردنظر با موفقیت ایجاد گردید.');
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
    public function edit(User $user)
    {
        $exp = explode(' ', $user->name);
        $first = $exp[0];
        $last = $exp[1];
        return view('admin.user.edit', compact('user', 'first', 'last'));
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
        $sqlData = DB::table('users')->where('id', '=', $id)->get();
        if (isset($request->old_password)){
            $user = User::findOrFail($id);
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|min:8|max:20|different:password',
            ]);
            if (Hash::check($request->old_password, $user->password)) {
                $user->fill([
                    'password' => Hash::make($request->new_password)
                ])->save();
            } else {
                return redirect()->back()->with('pass-error','خطا در تغییر رمز عبور، لطفا ورودی های خود را بررسی کنید.');
            }
        }
        $request->validate([
            'first-name' => ['required', 'string', 'max:191'],
            'last-name' => ['required', 'string', 'max:191'],
            'email' => 'unique:users,email,'.$id,
            'mobile' => ['nullable', 'numeric', 'digits:11', 'unique:users,mobile,'.$id],
            'role' => ['required'],
            'image' => 'image|mimes:jpeg,png,jpg|max:1000',
        ]);
        $imagefile = $request['image'];
        if ($request->hasFile('image')) {
            $image = $this->UploadUserImage($imagefile);
        } else {
            $image = $sqlData[0]->image;
        }
        User::where('id', $id)->update([
            'name' => $request['first-name'].' '.$request['last-name'],
            'email' => $request['email'],
            'mobile' => $request['mobile'],
            'role' => $request['role'],
            'image' => $image,
        ]);
        return redirect(route('users.index'))->with('user-edit-success', 'کاربر موردنظر با موفقیت ویرایش گردید.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('user-del-success', 'کاربر موردنظر با موفقیت حذف گردید.');
    }
}
