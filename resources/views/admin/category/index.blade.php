@extends('admin.master')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style ">
                        <li class="breadcrumb-item">
                            <h4 class="page-title">لیست دسته بندی ها</h4>
                        </li>
                        <li class="breadcrumb-item bcrumb-1">
                            <a href="{{ route('admin-dashboard') }}">
                                <i class="fas fa-home"></i> خانه</a>
                        </li>
                        <li class="breadcrumb-item bcrumb-2">
                            <a href="#" onClick="return false;">دسته بندی</a>
                        </li>
                        <li class="breadcrumb-item active">لیست دسته بندی ها</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-md-6">
                                <h2><strong>مدیریت </strong>دسته بندی ها - تعداد کل : <span class="badge badge-light">{{ $count }}</span></h2>
                            </div>
                            <div class="col-md-6">
                                <div class="left-align">
                                    <a href="{{ route('categories.create') }}">
                                    <button type="button" class="btn btn-primary btn-border-radius waves-effect">افزودن جدید</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('cat-add-success'))
                        <div id="msg-alert" class="alert alert-success alert-block">
                            <button style="float: left" type="button" class="close" data-dismiss="alert">×
                            </button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @elseif ($message = Session::get('cat-edit-success'))
                        <div id="msg-alert" class="alert alert-success alert-block">
                            <button style="float: left" type="button" class="close" data-dismiss="alert">×
                            </button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @elseif ($message = Session::get('cat-del-success'))
                        <div id="msg-alert" class="alert alert-success alert-block">
                            <button style="float: left" type="button" class="close" data-dismiss="alert">×
                            </button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="body table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>کاور</th>
                                <th>نام دسته بندی</th>
                                <th>توضیحات دسته بندی</th>
                                <th>تاریخ انتشار</th>
                                <th>تاریخ بروزرسانی</th>
                                <th colspan="2">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $num = 0; ?>
                            @foreach($categories as $category)
                                <?php $num++; ?>
                                <tr>
                                    <th scope="row">{{ $num }}</th>
                                    <td><img src="{{ $category->cover != '' ? $category->cover : '/img/no-image.png' }}" width="70" height="70"/></td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>{{ Verta::instance($category->created_at)->format('%d %B %Y') }}</td>
                                    <td>{{ Verta::instance($category->updated_at)->format('%d %B %Y') }}</td>
                                    <td>
                                        <a href="{{ route('categories.edit',$category->id) }}" type="button"
                                           class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">edit</i>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('categories.destroy',$category->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                           class="btn bg-deep-orange btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
