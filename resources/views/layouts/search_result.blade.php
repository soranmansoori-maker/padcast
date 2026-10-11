@extends('layouts.default')
@section('title', 'نتایج جستجو')
@section('style')
    <link rel="stylesheet" href="/plugins/pretty-checkbox/pretty-checkbox.min.css">
@stop
@section('main')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option spad set-bg" data-setbg="/img/albumt-hero-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h2>نتایج جستجو برای "{{ $key }}"</h2>
                        <div class="breadcrumb__links">
                            <a href="{{ route('homepage') }}"><i class="fa fa-home"></i> خانه</a>
                            <span>نتایج جستجو</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <section class="podcast podcast--page spad">
        <div class="container">
            <div class="row">
                @if ($errors->any())
                    <div class="alert alert-danger" style="padding: 2px !important;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <span style="font-size: 13px">{{ $error }}</span>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if( empty($categories) && empty($albums) &&  empty($podcasts))
                            <div class="container">
                                <div class="row">
                                    <div class="container">
                                        <div class="d-flex justify-content-center search-result">
                                            <img src="/img/search-not-found.png" alt="not found"/>
                                            <span class="align-self-center">متاسفانه جستجو شما نتیجه ای در بر نداشت!</span>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="container">
                                <br/>
                                <div class="row justify-content-center">
                                    <div class="col-12 col-md-10 col-lg-8 search-box-r">
                                        <div class="card card-sm">
                                            <form action="{{ route('advanced') }}" method="post">
                                                @csrf
                                                <div class="card-body row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <i class="fa fa-search search-box-icon"></i>
                                                    </div>
                                                    <!--end of col-->
                                                    <div class="col">
                                                        <input class="form-control form-control-lg form-control-borderless" type="search"
                                                               name="key" placeholder="عبارت دیگری را امتحان کنید :)" required
                                                               oninvalid="this.setCustomValidity('یک کلمه کلیدی وارد کنید')"
                                                               oninput="setCustomValidity('')">
                                                    </div>
                                                    <!--end of col-->
                                                    <div class="col-auto">
                                                        <button class="btn btn-lg btn-secondary" type="submit">جستجو</button>
                                                    </div>
                                                    <!--end of col-->
                                                </div>
                                                <div class="col-xs-1" style="margin: 5px auto">
                                                    <div class="pretty p-svg p-curve">
                                                        <input type="checkbox" name="search-cat" value="true" />
                                                        <div class="state p-primary">
                                                            <!-- svg path -->
                                                            <svg class="svg svg-icon" viewBox="0 0 20 20">
                                                                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                                                            </svg>
                                                            <label>دسته بندی ها</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-svg p-curve">
                                                        <input type="checkbox" name="search-album" value="true" />
                                                        <div class="state p-warning">
                                                            <!-- svg path -->
                                                            <svg class="svg svg-icon" viewBox="0 0 20 20">
                                                                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                                                            </svg>
                                                            <label>آلبوم ها</label>
                                                        </div>
                                                    </div>
                                                    <div class="pretty p-svg p-curve">
                                                        <input type="checkbox" name="search-podcast" value="true" />
                                                        <div class="state p-success">
                                                            <!-- svg path -->
                                                            <svg class="svg svg-icon" viewBox="0 0 20 20">
                                                                <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                                                            </svg>
                                                            <label>پادکست ها</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!--end of col-->
                                </div>
                            </div>
                    @endif

                    @if(!empty($categories))
                    <h3 class="result-title result-title-cat"><span>دسته بندی ها</span></h3>
                    @forelse($categories as $category)
                            <div class="col-sm d-flex justify-content-center result-panel">
                                <div class="property-card">
                                    <a href="/category/{{ $category->id }}">
                                        <div class="property-image" style="background-image:url('{{ $category->cover }}')">
                                            <div class="property-image-title">
                                                <h5>{{ $category->name }}</h5>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="property-description">
                                        <h5> {{ $category->name }} </h5>
                                    </div>
                                </div>
                            </div>
                    @empty
                        <div class="container">
                            <div class="d-flex justify-content-center search-result">
                                <img src="/img/search-not-found.png" width="120" alt="not found"/>
                                <span class="align-self-center">هیچ دسته بندی با این عنوان یافت نشد!</span>
                            </div>
                        </div>
                    @endforelse
                    @endif

                    @if(!empty($albums))
                    <h3 class="result-title result-title-album"><span>آلبوم ها</span></h3>
                @forelse($albums as $album)
                    <div class="col-sm result-panel">
                        <a href="/album/{{ $album->id }}">
                            <div class="profile-card-2"><img width="200" height="200" src="{{ $album->cover }}"
                                                             alt="{{ $album->title }}">
                                <div class="profile-name">{{ $album->title }}</div>
                                <div class="profile-username">{{$album->Category->name}}</div>
                            </div>
                        </a>
                    </div>
                @empty
                        <div class="container">
                            <div class="d-flex justify-content-center search-result">
                                <img src="/img/search-not-found.png" width="120" alt="not found"/>
                                <span class="align-self-center">هیچ آلبومی با این عنوان یافت نشد!</span>
                            </div>
                        </div>
                @endforelse
                    @endif
                    @if(!empty($podcasts))
                        <h3 class="result-title result-title-cat"><span>پادکست ها</span></h3>
                        <?php $num = 0 ?>
                        @forelse($podcasts as $podcast)
                            <?php $num++ ?>
                            <div class="col-lg-12 mix cat-{{ $podcast->Album->Category->id }} result-panel">
                                <div class="podcast__item">
                                    <a href="/album/{{ $podcast->album }}#Podcast-{{ $podcast->id }}">
                                        <div class="podcast__item__pic">
                                            <img height="310" width="310" src="{{ $podcast->cover }}" alt="{{ $podcast->name }}">
                                        </div>
                                    </a>
                                    <div class="podcast__item__text">
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
                                        <a style="margin-left: 50px" href="#" class="heart-icon"><i class="social_share"></i></a>
                                        <ul>
                                            <li><span class="icon_calendar"></span> {{ Verta::instance($podcast->created_at)->format('l %d %B %Y') }}</li>
                                            <li><span class="icon_profile"></span> توسط <b>{{$podcast->User->name}}</b></li>
                                            <li><span class="icon_tags_alt"></span> {{$podcast->Album->Category->name}}</li>
                                        </ul>
                                        <a href="/album/{{ $podcast->album }}"><h4>{{ $podcast->name }}</h4></a>
                                        <p>{{ $podcast->description }}</p>
                                        <div class="track__option ltr">
                                            <div class="jp-jplayer jplayer" data-ancestor=".jp_container-{{ $num }}"
                                                 data-url="{{ $podcast->file }}"></div>
                                            <div class="jp-audio jp_container-{{ $num }}" role="application" aria-label="media player">
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
                        @empty
                            <div class="container">
                                <div class="d-flex justify-content-center search-result">
                                    <img src="/img/search-not-found.png" width="120" alt="not found"/>
                                    <span class="align-self-center">هیچ پادکستی با این عنوان یافت نشد!</span>
                                </div>
                            </div>
                        @endforelse
                    @endif
            </div>
        </div>
    </section>
@endsection

