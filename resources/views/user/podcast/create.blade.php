@extends('layouts.user')
@section('title', 'افزودن پادکست')
@section('style')
    <link href="/assets/js/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css" rel="stylesheet"/>
    <link href="/assets/js/bundles/multiselect/css/multi-select.css" rel="stylesheet">
    <link href="/assets/css/form.min.css" rel="stylesheet">
@stop
@section('content')
@section('page-title', 'افزودن پادکست')
@section('page-name', 'پادکست')
@section('page-desc', 'افزودن پادکست جدید')
@section('content')
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
                        @if(count($albums))
                                <form id="form_validation" method="POST" enctype="multipart/form-data"
                                      action="{{ route('podcast.store') }}">
                                    @csrf
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                            <label class="form-label">نام پادکست</label>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-md-3">

                                            <div class="form-group form-float">
                                                <label>انتخاب آلبوم</label>
                                                <div class="input-field">
                                                    <select name="album">
                                                        <option value="" disabled selected>آلبوم را انتخاب کنید</option>
                                                        @foreach($albums as $album)
                                                            <option value="{{ $album->id }}">{{ $album->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
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
                                        <div class="col-md-4">
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
                                    <strong style="color: #555 !important;">خطا!</strong> جهت بارگزاری پادکست میبایست ابتدا یک آلبوم ایجاد نمایید، شما هنوز آلبوم ایجاد نکرده اید. <a href="{{ route('album.create') }}">ایجاد آلبوم</a>
                                </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="/assets/js/form.min.js"></script>
    <script src="/assets/js/pages/forms/advanced-form-elements.js"></script>
    <script src="/assets/js/bundles/multiselect/js/jquery.multi-select.js"></script>
    <script src="/assets/js/bundles/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js"></script>
    <script src="/assets/js/pages/forms/form-validation.js"></script>
    <script src="/assets/js/admin-create.js"></script>
@stop
