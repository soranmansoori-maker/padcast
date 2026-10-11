@extends('admin.master')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style ">
                        <li class="breadcrumb-item">
                            <h4 class="page-title">ویرایش مشخصات کاربر</h4>
                        </li>
                        <li class="breadcrumb-item bcrumb-1">
                            <a href="{{ route('admin-dashboard') }}">
                                <i class="fas fa-home"></i> خانه</a>
                        </li>
                        <li class="breadcrumb-item bcrumb-2">
                            <a href="#" onClick="return false;">کاربر</a>
                        </li>
                        <li class="breadcrumb-item active">ویرایش کاربر</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <strong> ویرایش کاربر</strong> : {{ $user->name }}</h2>
                    </div>
                    <div class="body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            @if ($message = Session::get('pass-error'))
                                <div id="msg-alert" class="alert alert-danger alert-block">
                                    <button style="float: left" type="button" class="close" data-dismiss="alert">×
                                    </button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                        <form id="form_validation" method="POST" enctype="multipart/form-data"
                              action="{{ route('users.update', $user->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input id="first-name" type="text"
                                                   class="input100 form-control @error('first-name') is-invalid @enderror"
                                                   name="first-name" value="{{ $first }}" required autofocus
                                                   oninvalid="this.setCustomValidity('نام کاربر را وارد کنید')"
                                                   oninput="setCustomValidity('')">
                                            <span class="focus-input100"></span>
                                            <label class="form-label">نام کاربر</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input id="last-name" type="text"
                                                   class="input100 form-control @error('last-name') is-invalid @enderror"
                                                   name="last-name" value="{{ $last }}" required autofocus
                                                   oninvalid="this.setCustomValidity('نام خانوادگی کاربر را وارد کنید')"
                                                   oninput="setCustomValidity('')">
                                            <span class="focus-input100"></span>
                                            <label class="form-label"> نام خانوادگی کاربر</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <img class="edit-img-preview" src="{{ $user->image != '' ? $user->image : '/img/no-image.png' }}" width="90" />
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group form-float">
                                        <h2 class="card-inside-title">تصویر پروفایل</h2>
                                        <div class="badge col-cyan">فرمت های مجاز : jpg , png - حداکثر سایز تصویر :
                                            1 مگابایت
                                        </div>
                                        <div class="file-field input-field">
                                            <div class="btn btn-info">
                                                <span>آپلود تصویر</span>
                                                <input type="file" name="image">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input id="mobile" type="text"
                                                   class="input100 form-control @error('mobile') is-invalid @enderror"
                                                   name="mobile"
                                                   value="{{ $user->mobile }}" autocomplete="mobile">
                                            <span class="focus-input100"></span>
                                            <label class="form-label">شماره تماس</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input id="email" type="email"
                                                   class="input100 form-control @error('email') is-invalid @enderror"
                                                   name="email"
                                                   value="{{ $user->email }}" required autocomplete="email"
                                                   oninvalid="this.setCustomValidity('پست الکترونیک خود را وارد کنید')"
                                                   oninput="setCustomValidity('')">
                                            <span class="focus-input100"></span>
                                            <label class="form-label">پست الکترونیک</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-field col s12">
                                        <div class="form-group form-float">
                                            <select name="role" required>
                                                <option value="" disabled selected>نقش کاربری را انتخاب کنید</option>
                                                <option value="user" {{ $user->role == 'user' ? 'selected="selected"' : '' }}>کاربر عادی</option>
                                                <option value="admin" {{ $user->role == 'admin' ? 'selected="selected"' : '' }}>مدیر سایت</option>
                                            </select>
                                            <label>انتخاب نقش کاربری</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2 class="card-inside-title">تغییر کلمه عبور</h2>
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="password" class="input100 form-control"
                                                   name="old_password" placeholder="رمز عبور فعلی"
                                                   oninvalid="this.setCustomValidity('رمز عبور فعلی خود را وارد کنید')"
                                                   oninput="setCustomValidity('')">
                                            <span class="focus-input100"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input id="new_password" type="password"
                                                   class="input100 form-control @error('new_password') is-invalid @enderror"
                                                   name="new_password" placeholder="رمز عبور جدید"
                                                   oninvalid="this.setCustomValidity('رمز عبور جدید خود را وارد کنید')"
                                                   oninput="setCustomValidity('')">
                                            <span class="focus-input100"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success waves-effect" type="submit">ویرایش کاربر</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
