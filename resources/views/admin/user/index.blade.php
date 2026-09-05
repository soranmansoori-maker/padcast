@extends('admin.master')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style ">
                        <li class="breadcrumb-item">
                            <h4 class="page-title">لیست کاربران</h4>
                        </li>
                        <li class="breadcrumb-item bcrumb-1">
                            <a href="{{ route('admin-dashboard') }}">
                                <i class="fas fa-home"></i> خانه</a>
                        </li>
                        <li class="breadcrumb-item bcrumb-2">
                            <a href="#" onClick="return false;">کاربران</a>
                        </li>
                        <li class="breadcrumb-item active">لیست کاربران</li>
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
                                <h2><strong>مدیریت </strong>کاربران - تعداد کل : <span class="badge badge-light">{{ $count }}</span></h2>
                            </div>
                            <div class="col-md-6">
                                <div class="left-align">
                                    <a href="{{ route('users.create') }}">
                                        <button type="button" class="btn btn-primary btn-border-radius waves-effect">افزودن جدید</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('user-add-success'))
                        <div id="msg-alert" class="alert alert-success alert-block">
                            <button style="float: left" type="button" class="close" data-dismiss="alert">×
                            </button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @elseif ($message = Session::get('user-edit-success'))
                        <div id="msg-alert" class="alert alert-success alert-block">
                            <button style="float: left" type="button" class="close" data-dismiss="alert">×
                            </button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @elseif ($message = Session::get('user-del-success'))
                        <div id="msg-alert" class="alert alert-success alert-block">
                            <button style="float: left" type="button" class="close" data-dismiss="alert">×
                            </button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="body table-responsive">
                        @if ($message = Session::get('success'))
                            <div id="msg-alert" class="alert alert-success alert-block">
                                <button style="float: left" type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>تصویر</th>
                                <th>نام کامل</th>
                                <th>پست الکترونیک</th>
                                <th>شماره تماس</th>
                                <th>نقش کاربری</th>
                                <th>وضعیت</th>
                                <th>تاریخ عضویت</th>
                                <th colspan="2">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                           <?php $num = 0; ?>
                            @foreach($users as $user)
                                <?php $num++; ?>
                                <tr>
                                    <th scope="row">{{ $num }}</th>
                                    <td><img src="{{ $user->image != '' ? $user->image : '/img/no-image.png' }}" width="70" height="70"/></td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->mobile ?? 'وارد نشده' }}</td>
                                    <td>{{ $user->role == 'admin' ? 'مدیر' : 'کاربر' }}</td>
                                    <td>{{ $user->status == '1' ? 'فعال' : 'غیرفعال' }}</td>
                                    <td>{{ Verta::instance($user->created_at)->format('%d %B %Y') }}</td>
                                    <td>
                                        <a href="{{ route('users.edit',$user->id) }}" type="button"
                                           class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">edit</i>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('users.destroy',$user->id) }}" method="post">
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
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
