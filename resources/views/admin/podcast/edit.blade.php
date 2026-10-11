@extends('admin.master')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style ">
                        <li class="breadcrumb-item">
                            <h4 class="page-title">ویرایش پادکست</h4>
                        </li>
                        <li class="breadcrumb-item bcrumb-1">
                            <a href="../../index.html">
                                <i class="fas fa-home"></i> خانه</a>
                        </li>
                        <li class="breadcrumb-item bcrumb-2">
                            <a href="#" onClick="return false;">پادکست</a>
                        </li>
                        <li class="breadcrumb-item active">ویرایش پادکست</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <strong>ویرایش : </strong> {{ $data['podcasts']->name }}</h2>
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
                              action="{{ route('podcasts.update', $data['podcasts']->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="name" value="{{ $data['podcasts']->name }}" required>
                                    <label class="form-label">نام پادکست</label>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <div class="input-field col s12">
                                        <div class="form-group form-float">
                                            <select name="album" required>
                                                @foreach($data['albums'] as $album)
                                                    <option value="{{ $album->id }}" {{ $data['podcasts']->album == $album->id ? 'selected' : '' }}>{{ $album->title }}</option>
                                                @endforeach
                                            </select>
                                            <label>تغییر آلبوم</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 align-items-center align-self-center">
                                    <h2 class="card-inside-title">وضعیت انتشار</h2>
                                    <div class="row">
                                        <div class="form-check form-check-radio">
                                            <label>
                                                <input name="status" type="radio" value="1" {{ $data['podcasts']->status == '1' ? 'checked' : '' }}/>
                                                <span>منتشر شود</span>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-radio">
                                            <label>
                                                <input name="status" type="radio" value="0" {{ $data['podcasts']->status == '0' ? 'checked' : '' }}/>
                                                <span>منتشر نشود</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-5">
                                    <div class="form-group form-float">
                                        <h2 class="card-inside-title">تغییر کاور پادکست</h2>
                                        <div class="badge col-cyan">فرمت های مجاز : jpg , png - حداکثر سایز تصویر کاور :
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
                                    <img class="edit-img-preview" src="{{ $data['podcasts']->cover != '' ? $data['podcasts']->cover : '/img/no-image.png' }}" width="90" />
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-float">
                                        <h2 class="card-inside-title">تغییر فایل پادکست</h2>
                                        <div class="badge col-cyan">فرمت های مجاز : MP3 , WAV - حداکثر سایز فایل پادکست
                                            : 20 مگابایت
                                        </div>
                                        <div class="file-field input-field">
                                            <div class="btn btn-primary">
                                                <span>آپلود فایل</span>
                                                <input type="file" name="file">
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
                                                  required>{{ $data['podcasts']->description }}</textarea>
                                    <label class="form-label">توضیحات</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success waves-effect" type="submit">ویرایش پادکست</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
