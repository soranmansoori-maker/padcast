@extends('admin.master')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style ">
                        <li class="breadcrumb-item">
                            <h4 class="page-title">لیست کامنت ها</h4>
                        </li>
                        <li class="breadcrumb-item bcrumb-1">
                            <a href="{{ route('admin-dashboard') }}">
                                <i class="fas fa-home"></i> خانه</a>
                        </li>
                        <li class="breadcrumb-item bcrumb-2">
                            <a href="#" onClick="return false;">کامنت</a>
                        </li>
                        <li class="breadcrumb-item active">لیست کامنت ها</li>
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
                                <h2><strong>مدیریت </strong>کامنت ها - تعداد کل : <span class="badge badge-light">{{ $count }}</span></h2>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('com-del-success'))
                        <div id="msg-alert" class="alert alert-success alert-block">
                            <button style="float: left" type="button" class="close" data-dismiss="alert">×
                            </button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @elseif ($message = Session::get('com-approved-success'))
                        <div id="msg-alert" class="alert alert-success alert-block">
                            <button style="float: left" type="button" class="close" data-dismiss="alert">×
                            </button>
                            <strong>{{ $message }}</strong>
                        </div>
                        @elseif ($message = Session::get('reply-add-success'))
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
                                        <button data-id="{{ $comment->id }}" data-comment="{{ $comment->comment }}" data-album="{{ $comment->album }}" type="button" data-toggle="modal" data-target="#replyModal"
                                           class="open-reply-modal btn btn-success btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">comment</i>
                                        </button>
                                            <!-- #START# Modal Form Example -->
                                                <div class="modal fade" id="replyModal" tabindex="-1" role="dialog"
                                                     aria-labelledby="formModal" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="formModal">درج پاسخ برای کامنت</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('comments.store') }}" method="post">
                                                                    @csrf
                                                                    <input type="hidden" id="commentID" name="commentID" value="">
                                                                    <input type="hidden" id="commentAlbum" name="albumID" value="">
                                                                    <label for="email_address1">متن کامنت</label>
                                                                    <div class="form-group">
                                                                        <div class="form-line">
                                                                            <textarea type="text" id="commentTxt" class="form-control"
                                                                                      placeholder="متن پاسخ وارد کنید" disabled readonly></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <label for="email_address1">متن پاسخ</label>
                                                                    <div class="form-group">
                                                                        <div class="form-line">
                                                                            <textarea type="text" id="replyTXT" name="reply" class="form-control"
                                                                                      required
                                                                                      oninvalid="this.setCustomValidity('متن پاسخ وارد کنید')"
                                                                                      oninput="setCustomValidity('')"
                                                                                      placeholder="متن پاسخ وارد کنید"></textarea>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-info waves-effect">ثبت پاسخ</button>
                                                                <button type="button" class="cancel-reply btn btn-danger waves-effect"
                                                                        data-dismiss="modal">لغو</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <!-- #END# Modal Form Example -->
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
@section('script')
    <script>
        $(document).on("click", ".cancel-reply", function () {
            $(".modal-body #replyTXT").val('');
        });
        $(document).on("click", ".open-reply-modal", function () {
            var id = $(this).data('id');
            var comment = $(this).data('comment');
            var album = $(this).data('album');
            $(".modal-body #commentID").val( id );
            $(".modal-body #commentTxt").val( comment );
            $(".modal-body #commentAlbum").val( album );
        });
    </script>
@endsection