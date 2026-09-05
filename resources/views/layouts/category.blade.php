@extends('layouts.default')
@section('title')
    لیست دسته بندی ها
@stop
@section('main')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option spad set-bg" data-setbg="/img/call-about-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h2>دسته بندی ها</h2>
                        <div class="breadcrumb__links">
                            <a href="{{ route('homepage') }}"><i class="fa fa-home"></i> خانه</a>
                            <span>دسته بندی ها</span>
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
                @forelse($categories as $category)
                    <div class="col-sm d-flex justify-content-center">
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
                    <div class="item text-center col-12">
                        <div class="alert alert-warning" role="alert">
                            موردی یافت نشد!
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection

