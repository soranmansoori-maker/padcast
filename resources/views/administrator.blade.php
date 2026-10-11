@extends('admin.master')
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style">
                        <li class="breadcrumb-item 	bcrumb-1">
                            <a href="{{ route('dashboard') }}">
                                <i class="material-icons">home</i>
                                خانه</a>
                        </li>
                        <li class="breadcrumb-item active">داشبورد</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Widgets -->
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <a href="{{ route('podcasts.index') }}">
                    <div class="info-box7 l-bg-green order-info-box7">
                        <div class="info-box7-block">
                            <h4 class="m-b-20">پادکست های منتشر شده</h4>
                            <h2 class="text-right"><i
                                        class="fas fa-podcast pull-left"></i><span>{{ $podcastCount }}</span></h2>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-sm-6">
                <a href="{{ route('podcasts.show', 'requests') }}">
                    <div class="info-box7 l-bg-purple order-info-box7">
                        <div class="info-box7-block">
                            <h4 class="m-b-20">پادکست های منتظر تایید</h4>
                            <h2 class="text-right"><i
                                        class="fas fa-compact-disc pull-left"></i><span>{{ $disabled }}</span></h2>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-sm-6">
                <a href="{{ route('albums.index') }}">
                    <div class="info-box7 l-bg-orange order-info-box7">
                        <div class="info-box7-block">
                            <h4 class="m-b-20">تعداد کل آلبوم ها</h4>
                            <h2 class="text-right"><i
                                        class="fas fa-layer-group pull-left"></i><span>{{ $albumCount }} </span></h2>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-sm-6">
                <a href="{{ route('users.index') }}">
                    <div class="info-box7 l-bg-cyan order-info-box7">
                        <div class="info-box7-block">
                            <h4 class="m-b-20">تعداد کاربران</h4>
                            <h2 class="text-right"><i
                                        class="fas fa-users pull-left"></i><span>{{ $usersCount }} نفر</span></h2>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="header">
                        <h2><strong>نمودار</strong> رشد وب سایت در چهار ماه اخیر</h2>
                    </div>
                    <div class="body">
                        <div id="growthChart"></div>
                        <div class="row">
                            <div class="col-4">
                                <p class="text-muted font-15 text-truncate">هدف</p>
                                <h5>
                                    <i class="fas fa-arrow-circle-up col-green m-r-5"></i>15هزار
                                </h5>
                            </div>
                            <div class="col-4">
                                <p class="text-muted font-15 text-truncate">هفته گذشته</p>
                                <h5>
                                    <i class="fas fa-arrow-circle-down col-red m-r-5"></i>2.8هزار
                                </h5>
                            </div>
                            <div class="col-4">
                                <p class="text-muted text-truncate">ماه گذشته</p>
                                <h5>
                                    <i class="fas fa-arrow-circle-up col-green m-r-5"></i>12.5هزار
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="header">
                        <h2><strong>نمودار</strong> کلی داده ها</h2>
                    </div>
                    <div class="body">
                        <canvas id="pie-chart" width="350"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-2">
                <div class="col-xs-12">
                    <div class="support-box text-center l-bg-red">
                        <div class="icon m-b-10">
                            <div class="chart chart-bar-2" data-values="6,4,8,6,8,10,5,6,7,9,5,6,4,8,6,8,10,5,6,7,9,5"></div>
                        </div>
                        <div class="text m-b-10">مجموع مشاهده آلبوم ها</div>
                        <h3 class="m-b-0">{{ $albumView }}
                            <i class="material-icons">album</i>
                        </h3>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="support-box text-center l-bg-cyan">
                        <div class="icon m-b-10">
                            <span class="chart chart-line-2" data-values="3,4,6,5,6,4,7,9"></span>
                        </div>
                        <div class="text m-b-10">مجموع دانلود پادکست ها</div>
                        <h3 class="m-b-0">{{ $podcastDownload }}
                            <i class="material-icons"> cloud_download</i>
                        </h3>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="support-box text-center green">
                        <div class="icon m-b-10">
                            <div class="chart chart-pie-2" data-values="30,35,25,8"></div>
                        </div>
                        <div class="text m-b-10">تعداد نظرات کاربران</div>
                        <h3 class="m-b-0">{{ $commentsCount }}
                            <i class="material-icons">comment</i>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <div class="card">
                    <div class="header">
                        <h2>
                            <strong>پادکست های</strong> اخیر</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="#" onClick="return false;" class="dropdown-toggle" data-toggle="dropdown"
                                   role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="{{ route('podcasts.index') }}">لیست پادکست ها</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('podcasts.show', 'requests') }}">لیست منتظر تایید</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="tableBody">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نام پادکست</th>
                                    <th>آلبوم</th>
                                    <th>توسط کاربر</th>
                                    <th>تاریخ ثبت</th>
                                    <th>دفعات دانلود</th>
                                    <th>وضعیت</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($podcasts as $podcast)
                                    <tr>
                                        <td class="table-img">
                                            <img height="39" width="39"
                                                 src="{{ $podcast->cover != '' ? $podcast->cover : '/img/no-image.png' }}"
                                                 alt="">
                                        </td>
                                        <td>{{ $podcast->name }}</td>
                                        <td>{{ $podcast->Album()->first()->title }}</td>
                                        <td>{{ $podcast->User()->first()->name }}</td>
                                        <td>{{ Verta::instance($podcast->created_at)->format('%d %B %Y') }}</td>
                                        <td>{{ $podcast->download_count }}</td>
                                        <td>
                                            @if($podcast->status == '1')
                                                <span class="label bg-green shadow-style">منتشر شده</span>
                                            @else
                                                <span class="label l-bg-orange shadow-style">در انتظار تایید</span>
                                            @endif
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
            <!-- #END# Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="header">
                        <h2>
                            <strong>نظرات </strong>جدید</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="#" onClick="return false;" class="dropdown-toggle" data-toggle="dropdown"
                                   role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="{{ route('comments.index') }}">لیست نظرات</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('comments.show', 'requests') }}">نظرات منتظر تایید</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="recent-comment">
                            @forelse($comments as $comment)
                                <div class="notice-board">
                                    <div class="table-img">
                                        <img width="39" height="39" class="notice-object"
                                             src="{{ $comment->User()->first()->image != '' ? $comment->User()->first()->image : '/img/no-image.png' }}"
                                             alt="...">
                                    </div>
                                    <div class="notice-body">
                                        <p>{{ (strlen($comment->comment) > 60) ? mb_substr($comment->comment,0,60,'utf-8').'...' : $comment->comment }}</p>
                                        <small class="text-muted">{{ $comment->User()->first()->name }}
                                            | {{ Verta::instance($comment->created_at)->format('%d %B %Y') }}</small>
                                    </div>
                                </div>
                            @empty

                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @section('script')
            <script src="/assets/js/chart.min.js"></script>
            <script src="/assets/js/bundles/echart/echarts.js"></script>
            <script src="/assets/js/bundles/apexcharts/apexcharts.min.js"></script>
            <script src="/assets/js/pages/index.js"></script>
            <script type="text/javascript">
                var user_grow = @json($userGrow_array);
                var album_grow = @json($albumGrow_array);
                var podcast_grow = @json($podcastGrow_array);
                var pod_count = @json($podcastCount);
                var pod = [pod_count];
                var cat_count = @json($categoryCount);
                var cat = [cat_count];
                var album_count = @json($albumCount);
                var album = [album_count];
                var user_count = @json($usersCount);
                var user = [user_count];
                var pod_count = @json($podcastCount);
                var pod = [pod_count];
                dataGrowChart(user_grow, album_grow, podcast_grow);
                siteDataChart(cat, album, user, pod);
            </script>
@endsection
