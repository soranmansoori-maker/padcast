@extends('layouts.default')
@section('title')
    مرجع رایگان پادکست و کتاب های صوتی
@stop
@section('style')
    <!-- Owl Stylesheets -->
    <link rel="stylesheet" href="/plugins/owlcarousel/owlcarousel/assets/owl.carousel.min.css"
          xmlns="http://www.w3.org/1999/html">
    <link rel="stylesheet" href="/plugins/owlcarousel/owlcarousel/assets/owl.theme.default.min.css">

    <!-- javascript -->
    <script src="/plugins/owlcarousel/vendors/jquery.min.js"></script>
    <script src="/plugins/owlcarousel/owlcarousel/owl.carousel.js"></script>

    <style>
        /* Improve readability for album tags and empty-item text */
        .episodes__item .tags,
        .episodes__item .tags span {
            color: #0b0b0b !important;
        }

        /* Ensure empty carousel item text is visible on white bg */
        .owl-carousel .item { color: #0b0b0b !important; }

        /* Readable caption for featured podcasts / popular albums carousels */
        .vip-caption { padding: 8px 4px; text-align: center; }
        .vip-caption__title { font-size: 14px; font-weight: 700; color: #0b0b0b; white-space: normal; line-height: 1.4; }
        .vip-caption__sub { font-size: 12px; color: #555; margin-top: 2px; }

        /* Center the round cover image within its carousel item (item has text-align:right from RTL styles, which pushes the block-level image to the right edge instead of centering it under the caption) */
        .owl-carousel .item img { display: block; margin: 0 auto; }
    </style>
@stop
@section('main')
    <!-- Hero Section Begin -->
    <section class="hero spad set-bg" data-setbg="img/hero/hero-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero__text">
                        <h5><span class="icon_calendar"></span> {{ Verta::now()->format('l %d %B %Y') }}</h5>
                        <h2>WaveCast : مرجع رایگان به اشتراک گذاری پادکست و کتاب صوتی</h2>
                        <a href="{{ route('login') }}" class="primary-btn">وارد شوید</a>
                        <a href="{{ route('register') }}" class="primary-btn white-btn">ثبت نام رایگان</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero__pic set-bg" data-setbg="img/hero/hero-video.png">
                        <a href="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/249690664&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true"
                           class="play-btn video-popup"><img src="img/hero/play-btn.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="single__track">
            <div class="container">
                <div class="row">
                    @if(!empty($lastPodcast))
                    <div class="col-lg-4">
                        <div class="single__track__item">
                            <a href="/album/{{ $lastPodcast->album }}">
                                <div class="single__track__item__pic">
                                    <img src="{{ $lastPodcast->cover }}" alt="{{ $lastPodcast->name }}">
                                </div>
                            </a>
                            <div class="single__track__item__text">
                                <a href="/album/{{ $lastPodcast->album }}#Podcast-{{ $lastPodcast->id }}"><h5>{{ $lastPodcast->name }}
                                        : {{ (strlen($lastPodcast->Album->title) > 55) ? mb_substr($lastPodcast->Album->title,0,55,'utf-8').'...' : $lastPodcast->Album->title }}</h5>
                                </a>
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
                                                        <div class="jp-current-time" role="timer" aria-label="time">0:00
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="jp-duration ml-auto" role="timer" aria-label="duration">00:00</div>
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
                @else
                    <div class="col-lg-4">
                        <div class="single__track__item">
                                <div class="single__track__item__pic">
                                    <img src="/img/no-image.png" alt="بدون تصویر">
                                </div>
                            <div class="single__track__item__text">
                                <h5>فایل یافت نشد!</h5>
                                <span>------</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8" style="direction: ltr !important;">
                        <div class="single__track__option ltr">
                            <div class="jp-jplayer jplayer" data-ancestor=".jp_container"
                                 data-url="">
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
                                                        <div class="jp-current-time" role="timer" aria-label="time">0:00
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="jp-duration ml-auto" role="timer" aria-label="duration">00:00</div>
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
                @endif
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Podcast Section Begin -->
    <section class="podcast spad">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <label class="badge badge-primary i-badge">پادکست های ویژه</label>
                </div>
            </div>
            <div class="row" style="margin: 30px auto">
                <div class="col-12">
                    @if($vipPodcasts->isNotEmpty())
                        <div class="owl-carousel owl-theme">
                            @foreach($vipPodcasts as $vip)
                                <div class="item">
                                    <a href="/album/{{ $vip->album }}#Podcast-{{ $vip->id }}"><img src="{{ $vip->cover }}"
                                                                                                   alt="{{ $vip->name }}"/>
                                        <div class="vip-caption">
                                            <div class="vip-caption__title">{{ (strlen($vip->name) > 30) ? mb_substr($vip->name,0,30,'utf-8').'...' : $vip->name }}</div>
                                            <div class="vip-caption__sub">{{ (strlen($vip->Album->title) > 20) ? mb_substr($vip->Album->title,0,20,'utf-8').'...' : $vip->Album->title }}</div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-warning text-center" role="alert">لیست خالی است!</div>
                    @endif
                </div>
            </div>
            <div class="podcast__top" style="margin-top: 100px">
                <div class="row clearfix">
                    <div class="col-lg-5 col-md-5">
                        <h3>جدیدترین پادکست ها</h3>
                    </div>
                </div>
            </div>
            <div class="row podcast-filter">
                <?php $num = 0 ?>
                @forelse($podcasts as $podcast)
                    <?php $num++ ?>
                    <div class="col-lg-12 mix cat-{{ $podcast->Album->Category->id }}">
                        <div class="podcast__item">
                            <a href="/album/{{ $podcast->album }}#Podcast-{{ $podcast->id }}">
                                <div class="podcast__item__pic">
                                    <img height="310" width="310" src="{{ $podcast->cover }}"
                                         alt="{{ $podcast->name }}">
                                </div>
                            </a>
                            <div class="podcast__item__text">
                                <script>
                                    function getFile(file) {
                                        window.open(file, 'Download');
                                    }
                                </script>
                                <form onsubmit="return getFile('{{ $podcast->file }}')"
                                      action="{{ route('download.update',['id'=>$podcast->id]) }}"
                                      method="post">
                                    @csrf
                                    <button type="submit" class="heart-icon"><i class="icon_download"></i></button>
                                </form>
                                <ul>
                                    <li><span
                                            class="icon_calendar"></span> {{ Verta::instance($podcast->created_at)->format('l %d %B %Y') }}
                                    </li>
                                    <li><span class="icon_profile"></span> توسط <b>{{$podcast->User->name}}</b></li>
                                    <li><span class="icon_tags_alt"></span> {{$podcast->Album->Category->name}}</li>
                                </ul>
                                <a href="/album/{{ $podcast->album }}#Podcast-{{ $podcast->id }}">
                                    <h4>{{ $podcast->name }}
                                        : {{ (strlen($podcast->Album->title) > 70) ? mb_substr($podcast->Album->title,0,70,'utf-8').'...' : $podcast->Album->title }}</h4>
                                </a>
                                <p>{{ $podcast->description }}</p>
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
                                            <div class="player_bars">
                                                <div class="jp-progress">
                                                    <div class="jp-seek-bar">
                                                        <div>
                                                            <div class="jp-play-bar">
                                                                <div class="jp-current-time" role="timer"
                                                                     aria-label="time">
                                                                    0:00
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="jp-duration ml-auto" role="timer" aria-label="duration">
                                                    00:00
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
                    @empty
                        <div class="item text-center col-12">
                            <div class="alert alert-warning" role="alert">
                                موردی یافت نشد!
                            </div>
                        </div>
                @endforelse
            </div>
            {{ $podcasts->links() }}
        </div>
    </section>
    <!-- Podcast Section End -->

    <!-- Episodes Section Begin -->
    <section class="episodes spad">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <label class="badge badge-warning i-badge">محبوب ترین آلبوم ها</label>
                </div>
            </div>
            <div class="row" style="margin: 30px auto">
                <div class="col-12">
                    @if($vipAlbums->isNotEmpty())
                        <div class="owl-carousel owl-theme">
                            @foreach($vipAlbums as $vipAlbum)
                                <div class="item">
                                    <a href="/album/{{ $vipAlbum->id }}">
                                        <img src="{{ $vipAlbum->cover }}" alt="{{ $vipAlbum->name }}"/>
                                        <div class="vip-caption">
                                            <div class="vip-caption__title">{{ (strlen($vipAlbum->title) > 30) ? mb_substr($vipAlbum->title,0,30,'utf-8').'...' : $vipAlbum->title }}</div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-warning text-center" role="alert">لیست خالی است!</div>
                    @endif
                </div>
            </div>
            <div class="row" style="margin-top: 100px">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3>آخرین آلبوم های بروز شده</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse($updated as $album)
                    <div class="col-lg-3 col-md-4">
                        <div class="episodes__item set-bg" data-setbg="{{$album->Album->cover}}">
                            <div class="tags"><span class="icon_folder"></span> {{$album->Album->title}}</div>
                            <a href="/album/{{ $album->album }}#Podcast-{{ $album->id }}"
                               class="play-btn"><img src="/img/play.png" alt=""></a>
                            <div class="episodes__text">
                                <h4 class="updated-albums-title">{{$album->name}}</h4>
                                <br>
                                <p><span
                                        class="icon_calendar"></span> {{ Verta::instance($album->created_at)->format('l %d %B %Y') }}
                                </p>
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
        </div>
    </section>
    <!-- Episodes Section End -->
@endsection
@section('script')
    <!-- vendors -->
    <script src="/plugins/owlcarousel/vendors/highlight.js"></script>
    <script src="/plugins/owlcarousel/js/app.js"></script>
    <script>
        $(window).on('load', function () {
            $('.owl-carousel').each(function () {
                var count = $(this).children('.item').length;
                $(this).owlCarousel({
                    rtl: true,
                    loop: count > 5,
                    margin: 10,
                    nav: true,
                    autoplay: count > 1,
                    autoplayTimeout: 3000,
                    autoplayHoverPause: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 3
                        },
                        1000: {
                            items: 5
                        }
                    }
                });
                $(this).trigger('refresh.owl.carousel');
            });
        })
    </script>
@endsection
