@extends('layouts.user')
@section('title', 'ویرایش آلبوم')
@section('style')
    <link href="/assets/js/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css" rel="stylesheet"/>
    <link href="/assets/js/bundles/multiselect/css/multi-select.css" rel="stylesheet">
    <link href="/assets/css/form.min.css" rel="stylesheet">
@stop
@section('content')
@section('page-title', 'ویرایش آلبوم')
@section('page-name', 'آلبوم')
@section('page-desc', 'ویرایش آلبوم')
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <strong>ویرایش : </strong> {{ $album->name }}</h2>
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
                              action="{{ route('album.update', $album->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="title" value="{{ $album->title }}" required>
                                            <label class="form-label">نام آلبوم</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group form-float">
                                        <h2 class="card-inside-title">تغییر تصویر آلبوم</h2>
                                        <div class="badge col-cyan">فرمت های مجاز : jpg , png - حداکثر سایز تصویر :
                                            1 مگابایت
                                        </div>
                                        <div class="file-field input-field">
                                            <div class="btn btn-info">
                                                <span>آپلود تصویر</span>
                                                <input type="file" name="cover">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <img class="edit-img-preview" src="{{ $album->cover != '' ? $album->cover : '/img/no-image.png' }}" width="90" />
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="input-field col s12">
                                        <div class="form-group form-float">
                                            <select name="category" required>
                                                <option value="" disabled selected>دسته بندی را انتخاب کنید</option>
                                                @foreach($categories as $cat)
                                                    <option value="{{ $cat->id }}" {{ $album->category == $cat->id ? 'selected="selected"' : '' }}>{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                            <label>انتخاب دسته بندی</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                        <textarea name="description" cols="30" rows="5" class="form-control no-resize"
                                                  required>{{ $album->description }}</textarea>
                                    <label class="form-label">توضیحات</label>
                                </div>
                            </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success waves-effect" type="submit">ویرایش آلبوم</button>
                            </div>
                        </form>
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
