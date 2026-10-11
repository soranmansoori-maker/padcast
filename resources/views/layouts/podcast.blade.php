@extends('layouts.default')
@section('title')
    جدیدترین پادکست ها
@stop
@section('main')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option spad set-bg" data-setbg="/img/podcast-hero-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h2>پادکست ها</h2>
                        <div class="breadcrumb__links">
                            <a href="{{ route('homepage') }}"><i class="fa fa-home"></i> خانه</a>
                            <span>پادکست ها</span>
                        </div>
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
                                <a href="/album/{{ $lastPodcast->album }}"><h5>{{ $lastPodcast->name }}</h5></a>
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
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Podcast Section Begin -->
    <section class="podcast podcast--page spad">
        <div class="container">
            <div class="podcast__top">
                <div class="row clearfix">
                    <div class="col-lg-5 col-md-5">
                        <h2>جدیدترین پادکست ها</h2>
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
                                <div style="display:flex; align-items:center; gap:8px;">
                                    <form onsubmit="return getFile('{{ $podcast->file }}')"
                                          action="{{ route('download.update',['id'=>$podcast->id]) }}"
                                          method="post">
                                        @csrf
                                        <button type="submit" class="heart-icon"><i
                                                class="icon_download"></i></button>
                                    </form>

                                    @auth
                                        <form action="{{ route('podcast.like', ['id' => $podcast->id]) }}" method="post">
                                            @csrf
                                            <button type="submit" class="heart-icon">
                                                <i class="fa fa-heart"></i>
                                            </button>
                                            <span style="margin-left:6px;">{{ $podcast->likes_count ?? 0 }}</span>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" class="heart-icon" title="برای لایک وارد شوید">
                                            <i class="fa fa-heart"></i>
                                        </a>
                                        <span style="margin-left:6px;">{{ $podcast->likes_count ?? 0 }}</span>
                                    @endauth
                                </div>
                                <ul>
                                    <li><span
                                            class="icon_calendar"></span> {{ Verta::instance($podcast->created_at)->format('l %d %B %Y') }}
                                    </li>
                                    <li><span class="icon_profile"></span> توسط <b>{{$podcast->User->name}}</b></li>
                                    <li><span class="icon_tags_alt"></span> {{$podcast->Album->Category->name}}</li>
                                </ul>
                                <a href="/album/{{ $podcast->album }}"><h4>{{ $podcast->name }}</h4></a>
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
            <div class="row">
                <div class="col-lg-12 text-center">
                    {{ $podcasts->links() }}
                </div>
            </div>
        </div>
    </section>
    <!-- Podcast Section End -->
@endsection
