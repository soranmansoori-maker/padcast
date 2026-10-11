@extends('layouts.user')
@section('title', 'لیست پادکست ها')
@section('content')
@section('page-title', 'لیست پادکست ها')
@section('page-name', 'پادکست')
@section('page-desc', 'لیست پادکست ها')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <div class="row clearfix">
                    <div class="col-md-6">
                        <h2>پادکست های من - تعداد کل : <span
                                class="badge badge-light">{{ $count }}</span>
                        </h2>
                    </div>
                    <div class="col-md-6">
                        <div class="left-align">
                            <a href="{{ route('podcast.create') }}">
                                <button type="button" class="btn btn-primary btn-border-radius waves-effect"><i
                                        style="font-size: 15px !important;" class="fa fa-plus"></i> افزودن جدید
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @if ($message = Session::get('pod-add-success'))
                        <script type="text/javascript">
                            window.onload = function () {
                                var msg = @json($message);
                                showSuccessMessage(msg);
                            };
                        </script>
                    @elseif ($message = Session::get('pod-edit-success'))
                        <script type="text/javascript">
                            window.onload = function () {
                                var msg = @json($message);
                                showSuccessMessage(msg);
                            };
                        </script>
                    @elseif ($message = Session::get('pod-delete-success'))
                        <script type="text/javascript">
                            window.onload = function () {
                                var msg = @json($message);
                                showSuccessMessage(msg);
                            };
                        </script>

                    @endif
                    <div class="table-responsive">
                        <table id="tableExport" class="display table table-hover  order-column width-per-100">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>کاور</th>
                                <th>عنوان</th>
                                <th>آلبوم</th>
                                <th>وضعیت</th>
                                <th>تاریخ انتشار</th>
                                <th>تاریخ بروزرسانی</th>
                                <th class="center">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($data as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td class="table-img">
                                        <img width="39" height="39" src="{{ $item->cover != '' ? $item->cover : '/img/no-image.png' }}" alt="">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->Album()->first()->title }}</td>
                                    <td>
                                            <span class="label {{ $item->status == 1 ? 'bg-teal' : 'bg-blue' }} m-b-10">{{ $item->status == 1 ? 'منتشر شده' : 'در حال بازبینی' }}</span>
                                    </td>
                                    <td>{{ Verta::instance($item->created_at)->format('%d %B %Y') }}</td>
                                    <td>{{ Verta::instance($item->updated_at)->format('%d %B %Y') }}</td>
                                    <td class="center">
                                        <form id="delete-item-{{$item->id}}" action="{{ route('podcast.destroy',$item->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                        <a href="{{ route('podcast.edit',$item->id) }}"
                                           class="btn btn-tbl-edit">
                                            <i class="material-icons">create</i>
                                        </a>
                                        <button data-id="{{$item->id}}" data-content="{{ $item->name }}"
                                                type="button"
                                                class="delete-btn btn btn-tbl-delete waves-effect">
                                            <i class="material-icons">delete_forever</i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('script')
        <script src="/assets/js/table.min.js"></script>
        <!-- Export table -->
        <script src="/assets/js/pages/apps/support.js"></script>
        <script src="/assets/js/pages/ui/dialogs.js"></script>
        <script>
            $(document).on("click", ".delete-btn", function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var content = $(this).data('content');
                showConfirmPodcastMessage(id, content);
            });
        </script>
@stop
