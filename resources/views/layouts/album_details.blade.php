@extends('layouts.default')
@section('title')
    آلبوم {{ $albumName->title }}
@stop
@section('style')
    <link rel="stylesheet" href="/plugins/needShareButton/dist/needsharebutton.min.css">
@endsection
@section('main')
    @if(Session::has('download.in.the.next.request'))
        <meta http-equiv="refresh" content="5;url={{ Session::get('download.in.the.next.request') }}">
    @endif
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option spad set-bg" data-setbg="/img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text episodes__breadcrumb__text">
                        <ul>
                            <li><span
                                    class="icon_calendar"></span> {{ Verta::instance($albumName->created_at)->format('l %d %B %Y') }}
                            </li>
                            <li><span class="icon_profile"></span> توسط {{$albumName->User->name}}</li>
                            <li><span class="icon_tags_alt"></span> {{$albumName->Category->name}}</li>
                            <div id="share-button-3" class="need-share-button-default" data-share-position="topCenter"
                                 data-share-networks="Mailto,Twitter,Facebook,Linkedin,Reddit,Tumblr"></div>
                        </ul>
                        <h2>{{ $albumName->title }}</h2>
                    </div>
                </div>
            </div>
        </div>
        @if($lastPodcast != '')
            <div class="single__track">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="single__track__item">
                                <div class="single__track__item__pic">
                                    <img src="{{ $lastPodcast->cover }}" alt="">
                                </div>
                                <div class="single__track__item__text">
                                    <h5>{{ $lastPodcast->name }}</h5>
                                    <span>{{$lastPodcast->User->name}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8" style="direction: ltr !important;">
                            <div class="single__track__option ltr">
                                <div class="jp-jplayer jplayer" data-ancestor=".jp_container"
                                     data-url="{{ $lastPodcast->file }}">
                                </div>
                                <div class="jp-audio jp_container" role="application" aria-label="media player">
                                    <div class="jp-gui jp-interface">
                                        <!-- Player Controls -->
                                        <div class="player_controls_box">
                                            <button class="jp-play player_button" tabindex="0"></button>
                                        </div>
                                        <!-- Progress Bar -->
                                        <div class="player_bars">
                                            <div class="jp-progress">
                                                <div class="jp-seek-bar">
                                                    <div>
                                                        <div class="jp-play-bar">
                                                            <div class="jp-current-time" role="timer" aria-label="time">
                                                                0:00
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="jp-duration ml-auto" role="timer" aria-label="duration">00:00
                                            </div>
                                        </div>
                                        <!-- Volume Controls -->
                                        <div class="jp-volume-controls">
                                            <button class="jp-mute" tabindex="0"><span
                                                    class="icon_volume-high"></span></button>
                                            <div class="jp-volume-bar">
                                                <div class="jp-volume-bar-value" style="width: 0%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Episodes Details Section Begin -->
    <section class="episodes-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="episodes__details__content">
                        <div class="episodes__details__text">
                            <p style="text-align: justify">
                                {{ $albumName->description }}
                            </p>
                        </div>
                        <br/>
                        <hr>
                        <div class="row podcast-filter">
                            <?php $num = 0 ?>
                            @forelse($podcasts as $podcast)
                                <?php $num++ ?>
                                <div class="col-lg-12 mix">
                                    <div id="Podcast-{{ $podcast->id }}" class="podcast__item">
                                        <div class="podcast__item__pic__2">
                                            <img height="200" width="200" src="{{ $podcast->cover }}"
                                                 alt="{{ $podcast->name }}">
                                        </div>
                                        <div class="podcast__item__text__2">
                                            <script>
                                                function getFile(file){
                                                    window.open(file,'Download');
                                                }
                                            </script>
                                            <form onsubmit="return getFile('{{ $podcast->file }}')" action="{{ route('download.update',['id'=>$podcast->id]) }}"
                                                  method="post">
                                                @csrf
                                            <button type="submit" class="heart-icon"><i
                                                    class="icon_download"></i></button>
                                            </form>
                                            <ul>
                                                <li><span
                                                        class="icon_calendar"></span> {{ Verta::instance($podcast->created_at)->format('l %d %B %Y') }}
                                                </li>
                                            </ul>
                                            <h4>{{ $podcast->name }}</h4>
                                            <div class="track__option ltr">
                                                <div class="jp-jplayer jplayer" data-ancestor=".jp_container-{{ $num }}"
                                                     data-url="{{ $podcast->file }}"></div>
                                                <div class="jp-audio jp_container-{{ $num }}" role="application"
                                                     aria-label="media player">
                                                    <div class="jp-gui jp-interface">
                                                        <!-- Player Controls -->
                                                        <div class="player_controls_box">
                                                            <button class="jp-play player_button" tabindex="0"></button>
                                                        </div>
                                                        <!-- Progress Bar -->
                                                        <div class="player_bars_2">
                                                            <div class="jp-progress">
                                                                <div class="jp-seek-bar">
                                                                    <div style="width: 320px !important;">
                                                                        <div class="jp-play-bar">
                                                                            <div class="jp-current-time" role="timer"
                                                                                 aria-label="time">
                                                                                0:00
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div style="right: -50px !important;"
                                                                 class="jp-duration ml-auto" role="timer"
                                                                 aria-label="duration">00:00
                                                            </div>
                                                        </div>
                                                        <!-- Volume Controls -->
                                                        <div class="jp-volume-controls float-right">
                                                            <button class="jp-mute" tabindex="0"><span
                                                                    class="icon_volume-high"></span></button>
                                                            <div class="jp-volume-bar">
                                                                <div class="jp-volume-bar-value"
                                                                     style="width: 0%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                    <div class="item text-center col-12">
                                        <div class="alert alert-warning" role="alert">
                                            موردی یافت نشد!
                                        </div>
                                    </div>
                                @endforelse
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                {{ $podcasts->links() }}
                            </div>
                        </div>
                        <br/>
                        <hr>
                        <div class="episodes__details__form">
                            <h4>دیدگاه خود را بنویسید</h4>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if ($message = Session::get('success'))
                                <div id="msg-alert" class="alert alert-success alert-block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @else
                            @if (Route::has('login'))
                                @auth
                                    <form action="{{ route('comment.store',['album'=>$albumName->id]) }}"
                                          method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <textarea placeholder="متن دیدگاه" name="comment" maxlength="500"></textarea>
                                                <button type="submit" class="site-btn">ثبت دیدگاه</button>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <h5 class="text-center">برای ثبت دیدگاه باید وارد حساب کاربری خود شوید. <a
                                            href="{{ route('login') }}">ورود</a></h5>
                                @endif
                            @endif
                            @endif
                        </div>
                        <br/>
                        <hr>
                        <div id="Comments" class="blog__details__comment">
                            <h4>{{ $countCM }} دیدگاه</h4>
                            @foreach($comments as $comment)
                                <div id="Comment-{{ $comment->id }}" class="blog__details__comment__item">
                                    <div class="blog__details__comment__item__pic">
                                        <img
                                            src="{{ $comment->User->image != '' ? $comment->User->image : '/img/no-image.png' }}"
                                            alt="">
                                    </div>
                                    <div class="blog__details__comment__item__text">
                                        <div
                                            class="comment__date">{{ Verta::instance($comment->created_at)->format('%d %B %Y') }}</div>
                                        <h5>{{ $comment->User->name }}</h5>
                                        <p>{{ $comment->comment }}</p>
                                    </div>
                                </div>
                                @foreach($replies as $reply)
                                    @if($reply->parent == $comment->id)
                                        <div class="blog__details__comment__item blog__details__comment__item--reply">
                                            <div class="blog__details__comment__item__pic">
                                                <img
                                                    src="{{ $reply->User->image != '' ? $reply->User->image : '/img/no-image.png' }}"
                                                    alt="">
                                            </div>
                                            <div class="blog__details__comment__item__text">
                                                <div
                                                    class="comment__date">{{ Verta::instance($reply->created_at)->format('%d %B %Y') }}</div>
                                                <h5>{{ $reply->User->name }}</h5>
                                                <p>{{ $reply->comment }}</p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="sidebar">
                        <div class="sidebar__search">
                            <form action="{{ route('find') }}" method="post">
                                @csrf
                                <input class="form-control header-s" type="text" name="key" placeholder="کلمه کلیدی..." required
                                       oninvalid="this.setCustomValidity('یک کلمه کلیدی وارد کنید')"
                                       oninput="setCustomValidity('')">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="sidebar__categories">
                            <h4>دسته بندی ها</h4>
                            <ul>
                                @foreach($cat as $category)
                                    <li><a href="#"><i class="fa fa-angle-double-left"></i> {{$category->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="sidebar__recent">
                            <h4>آخرین دیدگاه ها</h4>
                            @foreach($latestComments as $latest)
                            <a href="/album/{{$latest->Album->id}}#Comment-{{ $latest->id }}" class="sidebar__recent__item">
                                <h6>{{ (strlen($latest->Album->title) > 100) ? mb_substr($latest->Album->title,0,100,'utf-8').'...' : $latest->Album->title }}</h6>
                                <p><span class="icon_calendar"></span> {{ Verta::instance($latest->created_at)->format('l %d %B %Y') }}</p>
                                <p>{{ (strlen($latest->comment) > 150) ? mb_substr($latest->comment,0,140,'utf-8').'...' : $latest->comment }}</p>
                            </a>
                            @endforeach
                        </div>
                        <div class="sidebar__banner set-bg" data-setbg="/img/episodes-single/sidebar-banner.jpg">
                            <span>مرجع رایگان پادکست و کتاب صوتی</span>
                            <h2>WaveCast</h2>
                        </div>
                        <div class="sidebar__tags">
                            <h4>برچسب های محبوب</h4>
                            <a href="#">رمان</a>
                            <a href="#">ایده_پردازی</a>
                            <a href="#">پادکست</a>
                            <a href="#">ویدیو</a>
                            <a href="#">خلاقیت</a>
                            <a href="#">ورزش</a>
                            <a href="#">موزیک</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script src="/plugins/needShareButton/dist/needsharebutton.js"></script>
    <script>
        new needShareDropdown(document.getElementById('share-button-3'));
    </script>
@endsection