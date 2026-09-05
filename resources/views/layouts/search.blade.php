@extends('layouts.default')
@section('title', 'جستجو پیشرفته')
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
                        <h2>جستجو در WaveCast</h2>
                        <div class="breadcrumb__links">
                            <a href="{{ route('homepage') }}"><i class="fa fa-home"></i> خانه</a>
                            <span>جستجو پیشرفته</span>
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
                <div class="container">
                    <div class="d-flex justify-content-center search-result">
                        <img src="/img/search.png" alt="not found"/>
                        <span class="align-self-center">جستجو میان آلبوم ها و پادکست های WaveCast</span>
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
                                           name="key" placeholder="دنبال چه چیزی هستید؟" required
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
                                        <span class="badge badge-light">جستجو در : </span>
                                </div>
                                <div class="pretty p-svg p-curve">
                                    <input type="checkbox" name="search-cat" value="true" checked />
                                    <div class="state p-primary">
                                        <!-- svg path -->
                                        <svg class="svg svg-icon" viewBox="0 0 20 20">
                                            <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                                        </svg>
                                        <label>دسته بندی ها</label>
                                    </div>
                                </div>
                                <div class="pretty p-svg p-curve">
                                    <input type="checkbox" name="search-album" value="true" checked />
                                    <div class="state p-warning">
                                        <!-- svg path -->
                                        <svg class="svg svg-icon" viewBox="0 0 20 20">
                                            <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z" style="stroke: white;fill:white;"></path>
                                        </svg>
                                        <label>آلبوم ها</label>
                                    </div>
                                </div>
                                <div class="pretty p-svg p-curve">
                                    <input type="checkbox" name="search-podcast" value="true" checked />
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
    </section>
@endsection
