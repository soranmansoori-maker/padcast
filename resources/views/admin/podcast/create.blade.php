@extends('admin.master')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style ">
                        <li class="breadcrumb-item">
                            <h4 class="page-title">افزودن پادکست</h4>
                        </li>
                        <li class="breadcrumb-item bcrumb-1">
                            <a href="{{ route('admin-dashboard') }}">
                                <i class="fas fa-home"></i> خانه</a>
                        </li>
                        <li class="breadcrumb-item bcrumb-2">
                            <a href="#" onClick="return false;">پادکست</a>
                        </li>
                        <li class="breadcrumb-item active">افزودن پادکست جدید</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <strong>افزودن</strong> پادکست جدید</h2>
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
                        @if(count($data['albums']))
                                <form id="form_validation" method="POST" enctype="multipart/form-data"
                                      action="{{ route('podcasts.store') }}">
                                    @csrf
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                            <label class="form-label">نام پادکست</label>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-md-3">
                                            <div class="input-field col s12">
                                                <div class="form-group form-float">
                                                    <select name="album" required>
                                                        <option value="" disabled selected>آلبوم را انتخاب کنید</option>
                                                        @foreach($data['albums'] as $album)
                                                            <option value="{{ $album->id }}">{{ $album->title }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label>انتخاب آلبوم</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 align-items-center align-self-center">
                                            <h2 class="card-inside-title">وضعیت انتشار</h2>
                                            <div class="row">
                                                <div class="form-check form-check-radio">
                                                    <label>
                                                        <input name="status" type="radio" value="1" checked/>
                                                        <span>منتشر شود</span>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-radio">
                                                    <label>
                                                        <input name="status" type="radio" value="0"/>
                                                        <span>منتشر نشود</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <h2 class="card-inside-title">کاور پادکست</h2>
                                                <div class="badge col-cyan">فرمت های مجاز : jpg , png - حداکثر سایز تصویر کاور :
                                                    1 مگابایت
                                                </div>
                                                <div class="file-field input-field">
                                                    <div class="btn btn-info">
                                                        <span>آپلود تصویر</span>
                                                        <input type="file" name="cover" required>
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-float">
                                                <h2 class="card-inside-title">فایل پادکست</h2>
                                                <div class="badge col-cyan">فرمت های مجاز : MP3 , WAV - حداکثر سایز فایل پادکست
                                                    : 20 مگابایت
                                                </div>
                                                <div class="file-field input-field">
                                                    <div class="btn btn-primary">
                                                        <span>آپلود فایل</span>
                                                        <input type="file" name="file" required>
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                        <textarea name="description" cols="30" rows="5" class="form-control no-resize"
                                                  required>{{ old('description') }}</textarea>
                                            <label class="form-label">توضیحات</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success waves-effect" type="submit">افزودن پادکست</button>
                                    </div>
                                </form>
                            @else
                                <div class="alert alert-warning" style="color: #555 !important;">
                                    <strong style="color: #555 !important;">خطا!</strong> جهت بارگزاری پادکست میبایست ابتدا یک آلبوم ایجاد نمایید، شما هنوز آلبوم ایجاد نکرده اید. <a href="{{ route('albums.create') }}">ایجاد آلبوم</a>
                                </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
