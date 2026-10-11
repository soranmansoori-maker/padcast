@extends('layouts.default')
@section('title')
    {{ $catName->name }} - لیست آلبوم ها
@stop
@section('main')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option spad set-bg" data-setbg="/img/call-about-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h2>{{ $catName->name }} - لیست آلبوم ها</h2>
                        <div class="breadcrumb__links">
                            <a href="{{ route('homepage') }}"><i class="fa fa-home"></i> خانه</a>
                            <span>{{ $catName->name }} - </span>
                            <span>آلبوم ها</span>
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
            @forelse($albums as $album)
    <div class="col-sm">
        <a href="/album/{{ $album->id }}">
        <div class="profile-card-2"><img width="200" height="200" src="{{ $album->cover }}" alt="{{ $album->title }}">
            <div class="profile-name">{{ $album->title }}</div>
            <div class="profile-username">{{$album->Category->name}}</div>
        </div>
        </a>
    </div>
            @empty
                <div class="item text-center col-12">
                    <div class="alert alert-warning" role="alert">
                        موردی یافت نشد!
                    </div>
                </div>
            @endforelse
        </div>
            <br>
                {{ $albums->links() }}
        </div>
    </section>
@endsection

