@extends('admin.master')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style ">
                        <li class="breadcrumb-item">
                            <h4 class="page-title">لیست کامنت های تایید نشده</h4>
                        </li>
                        <li class="breadcrumb-item bcrumb-1">
                            <a href="{{ route('admin-dashboard') }}">
                                <i class="fas fa-home"></i> خانه</a>
                        </li>
                        <li class="breadcrumb-item bcrumb-2">
                            <a href="#" onClick="return false;">کامنت</a>
                        </li>
                        <li class="breadcrumb-item active">لیست کامنت های منتظر تایید</li>
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
                                <h2><strong>مدیریت </strong>کامنت های منتظر تایید - تعداد کل : <span class="badge badge-light">{{ $count }}</span></h2>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('com-del-success'))
                        <div id="msg-alert" class="alert alert-success alert-block">
                            <button style="float: left" type="button" class="close" data-dismiss="alert">×
                            </button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @elseif ($message = Session::get('com-approve-success'))
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
                                <th>متن کامنت</th>
                                <th width="10%">آلبوم</th>
                                <th>توسط</th>
                                <th>وضعیت</th>
                                <th>تاریخ انتشار</th>
                                <th>تاریخ بروزرسانی</th>
                                <th colspan="2">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $num = 0; ?>
                            @foreach($comments as $comment)
                                <?php $num++; ?>
                                <tr>
                                    <th scope="row">{{ $num }}</th>
                                    <td>{{ $comment->comment }}</td>
                                    <td>{{ $comment->Album()->first()->title }}</td>
                                    <td>{{ $comment->User->name }}</td>
                                    <td>@if($comment->status == 1)
                                            منتشر شده
                                        @else
                                            عدم انتشار
                                        @endif
                                    </td>
                                    <td>{{ Verta::instance($comment->created_at)->format('%d %B %Y') }}</td>
                                    <td>{{ Verta::instance($comment->updated_at)->format('%d %B %Y') }}</td>
                                    <td>
                                        <a href="{{ route('comments.approve',$comment->id) }}" type="button"
                                           class="btn btn-success btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">done</i>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('comments.destroy',$comment->id) }}" method="post">
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
                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
