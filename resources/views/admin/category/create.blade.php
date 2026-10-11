@extends('admin.master')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style ">
                        <li class="breadcrumb-item">
                            <h4 class="page-title">افزودن دسته بندی جدید</h4>
                        </li>
                        <li class="breadcrumb-item bcrumb-1">
                            <a href="{{ route('admin-dashboard') }}">
                                <i class="fas fa-home"></i> خانه</a>
                        </li>
                        <li class="breadcrumb-item bcrumb-2">
                            <a href="#" onClick="return false;">دسته بندی</a>
                        </li>
                        <li class="breadcrumb-item active">افزودن دسته بندی</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <strong>افزودن</strong> دسته بندی جدید</h2>
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
                              action="{{ route('categories.store') }}">
                            @csrf
                            <div class="row clearfix">
                                <div class="col-md-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="name" required>
                                    <label class="form-label">نام دسته بندی</label>
                                </div>
                            </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <h2 class="card-inside-title">تصویر دسته بندی</h2>
                                        <div class="badge col-cyan">فرمت های مجاز : jpg , png - حداکثر سایز تصویر :
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
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                        <textarea name="description" cols="30" rows="5" class="form-control no-resize"
                                                  required></textarea>
                                    <label class="form-label">توضیحات</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success waves-effect" type="submit">افزودن دسته بندی</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
