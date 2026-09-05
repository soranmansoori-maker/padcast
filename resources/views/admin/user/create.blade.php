@extends('admin.master')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style ">
                        <li class="breadcrumb-item">
                            <h4 class="page-title">افزودن کاربر جدید</h4>
                        </li>
                        <li class="breadcrumb-item bcrumb-1">
                            <a href="{{ route('admin-dashboard') }}">
                                <i class="fas fa-home"></i> خانه</a>
                        </li>
                        <li class="breadcrumb-item bcrumb-2">
                            <a href="#" onClick="return false;">کاربر</a>
                        </li>
                        <li class="breadcrumb-item active">افزودن کاربر</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <strong>افزودن</strong> کاربر جدید</h2>
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
                        <form id="form_validation" method="POST" enctype="multipart/form-data"
                              action="{{ route('users.store') }}">
                            @csrf
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input id="first-name" type="text"
                                                   class="input100 form-control @error('first-name') is-invalid @enderror"
                                                   name="first-name" value="{{ old('first-name') }}" required autofocus
                                                   oninvalid="this.setCustomValidity('نام کاربر را وارد کنید')"
                                                   oninput="setCustomValidity('')">
                                            <span class="focus-input100"></span>
                                            <label class="form-label">نام کاربر</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input id="last-name" type="text"
                                                   class="input100 form-control @error('last-name') is-invalid @enderror"
                                                   name="last-name" value="{{ old('last-name') }}" required autofocus
                                                   oninvalid="this.setCustomValidity('نام خانوادگی کاربر را وارد کنید')"
                                                   oninput="setCustomValidity('')">
                                            <span class="focus-input100"></span>
                                            <label class="form-label"> نام خانوادگی کاربر</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                                                   value="{{ old('mobile') }}" autocomplete="mobile">
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
                                                   value="{{ old('email') }}" required autocomplete="email"
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
                                                    <option value="user">کاربر عادی</option>
                                                    <option value="admin">مدیر سایت</option>
                                            </select>
                                            <label>انتخاب نقش کاربری</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input id="password" type="password"
                                                   class="input100 form-control @error('password') is-invalid @enderror"
                                                   name="password"
                                                   required autocomplete="new-password"
                                                   oninvalid="this.setCustomValidity('رمز عبور را وارد کنید')"
                                                   oninput="setCustomValidity('')">
                                            <span class="focus-input100"></span>
                                            <label class="form-label">رمز عبور</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input id="password-confirm" type="password" class="input100 form-control"
                                                   name="password_confirmation" required autocomplete="new-password"
                                                   oninvalid="this.setCustomValidity('تکرار رمز عبور را وارد کنید')"
                                                   oninput="setCustomValidity('')">
                                            <span class="focus-input100"></span>
                                            <label class="form-label">تکرار رمز عبور</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success waves-effect" type="submit">افزودن کاربر</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
