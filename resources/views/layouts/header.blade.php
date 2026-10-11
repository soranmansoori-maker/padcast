<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="WaveCast - مرجع رایگان پادکست و کتاب های صوتی">
    <meta name="keywords" content="وواکست, پادکست, کتاب صوتی">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WaveCast - @yield('title')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800;900&display=swap"
          rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="/css/style.css" type="text/css">
    <style>
        /* Hide legacy raster logo that contains the old brand text */
        img[src*="/img/logo.png"] { display: none !important; }

        /* Homepage visual tweaks: fonts and icon color accents */
        body {
            font-family: 'Nunito', Tahoma, Arial, sans-serif;
            color: #e9eef7;
        }

        /* Brand tweaks */
        .brand-text { letter-spacing: 0.4px; color: #ffffff; }

        /* Hero section headline */
        .hero__text h2 {
            font-weight: 800;
            font-size: 2.6rem;
            line-height: 1.05;
            color: #ffffff;
            text-shadow: 0 6px 18px rgba(15,15,30,0.45);
        }

        .hero__text h5 { color: #bfc8d8; }

        /* Accent color for icons across the homepage */
        .fa, .icon_calendar, .icon_profile, .icon_tags_alt, .icon_folder, .icon_volume-high, .icon_download {
            color: #6C5CE7; /* soft purple accent */
        }

        /* Podcast card titles and meta */
        .podcast__item__text h4, .episodes__text h4, .single__track__item__text h5 {
            color: #f7fbff;
            font-weight: 700;
        }

        /* Subtle button adjustment on hero */
        .primary-btn { background: linear-gradient(90deg,#6C5CE7,#5CE1E6); border: none; }
        .white-btn { color: #191923; background: #ffffff; }
    </style>
    @yield('style')
</head>

<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>
<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__search">
        <form action="{{ route('find') }}" method="post">
            @csrf
            <input class="form-control header-s" type="text" name="key" placeholder="کلمه کلیدی..." required
                   oninvalid="this.setCustomValidity('یک کلمه کلیدی وارد کنید')"
                   oninput="setCustomValidity('')">
            <button type="submit" aria-label="جستجو"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <div class="offcanvas__logo">
        @include('layouts.partials.logo', ['size' => 40, 'fontSize' => '1.1rem'])
    </div>
    <div id="mobile-menu-wrap"></div>
    @if (Route::has('login'))
        @auth
            @if(auth()->user()->role == 'user')
                <div class="dropdown">
                    <img class="dropbtn" style="border-radius: 50%" src="{{ auth()->user()->image != '' ? auth()->user()->image : '/img/no-image.png' }}" alt="user" width="36" height="36">
                    <div class="dropdown-content">
                        <a href="{{ route('profile.index') }}">
                            <i class="fa fa-user"></i> پروفایل
                        </a>
                        <a href="{{ route('logout') }}" onClick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i> {{ __('auth.Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
                <a href="{{ route('podcast.index') }}">
                    <button class="btn btn-warning upload-btn" name="user-login"><i
                                class="fa fa-cloud-upload" aria-hidden="true"></i> بارگذاری پادکست
                    </button>
                </a>
            @else
                <div class="dropdown">
                    <img class="dropbtn" style="border-radius: 50%" src="{{ auth()->user()->image != '' ? auth()->user()->image : '/img/no-image.png' }}" alt="user" width="36" height="36">
                    <div class="dropdown-content">
                        <a href="{{ route('profile-setting.index') }}">
                            <i class="fa fa-user"></i> پروفایل
                        </a>
                        <a href="{{ route('logout') }}" onClick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i> {{ __('auth.Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
                <a href="{{ route('admin-dashboard') }}">
                    <button class="btn btn-primary upload-btn" name="user-login"><i
                                class="fa fa-home" aria-hidden="true"></i> داشبورد مدیریت
                    </button>
                </a>
            @endif
        @else
            <a href="{{ route('login') }}">
                <button class="btn btn-warning upload-btn" name="user-login"><i
                            class="fa fa-user" aria-hidden="true"></i> ورود / عضویت
                </button>
            </a>
        @endif
    @endif
</div>
<!-- Offcanvas Menu End -->
<!-- Header Section Begin -->
<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="header__logo d-flex align-items-center">
                    @include('layouts.partials.logo', ['size' => 48, 'fontSize' => '1.6rem'])
                </div>
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ route('homepage') }}">خانه</a></li>
                        <li class="{{ request()->is('podcasts') ? 'active' : '' }}"><a href="{{ route('podcasts') }}">پادکست ها</a></li>
                        <li class="{{ request()->is('categories') ? 'active' : '' }}"><a href="{{ route('categories') }}">دسته بندی ها</a></li>
                        <li class="{{ request()->is('albums') ? 'active' : '' }}"><a href="{{ route('albums') }}">آلبوم ها</a></li>
                        <li class="{{ request()->is('search') ? 'active' : '' }}"><a href="{{ route('search') }}">جستجو پیشرفته</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-4">
                <div class="header__left">
                    <div class="header__left__search">
                        <form action="{{ route('find') }}" method="post">
                            @csrf
                            <input class="form-control header-s" type="text" name="key" placeholder="کلمه کلیدی..." required
                                   oninvalid="this.setCustomValidity('یک کلمه کلیدی وارد کنید')"
                                   oninput="setCustomValidity('')">
                            <button type="submit" aria-label="جستجو"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="header__left__upload">
                        @if (Route::has('login'))
                            @auth
                                @if(auth()->user()->role == 'user')
                                    <div class="dropdown">
                                        <img class="dropbtn" style="border-radius: 50%" src="{{ auth()->user()->image != '' ? auth()->user()->image : '/img/no-image.png' }}" alt="user" width="36" height="36">
                                        <div class="dropdown-content">
                                            <a href="{{ route('profile.index') }}">
                                                <i class="fa fa-user"></i> پروفایل
                                            </a>
                                            <a href="{{ route('logout') }}" onClick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out"></i> {{ __('auth.Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                    <a href="{{ route('podcast.index') }}">
                                        <button class="btn btn-warning upload-btn" name="user-login"><i
                                                    class="fa fa-cloud-upload" aria-hidden="true"></i> بارگذاری پادکست
                                        </button>
                                    </a>
                                @else
                                    <div class="dropdown">
                                        <img class="dropbtn" style="border-radius: 50%" src="{{ auth()->user()->image != '' ? auth()->user()->image : '/img/no-image.png' }}" alt="user" width="36" height="36">
                                        <div class="dropdown-content">
                                            <a href="{{ route('profile-setting.index') }}">
                                                <i class="fa fa-user"></i> پروفایل
                                            </a>
                                            <a href="{{ route('logout') }}" onClick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out"></i> {{ __('auth.Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                    <a href="{{ route('admin-dashboard') }}">
                                        <button class="btn btn-primary upload-btn" name="user-login"><i
                                                    class="fa fa-home" aria-hidden="true"></i> داشبورد مدیریت
                                        </button>
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('login') }}">
                                    <button class="btn btn-warning upload-btn" name="user-login"><i
                                            class="fa fa-user" aria-hidden="true"></i> ورود / عضویت
                                    </button>
                                </a>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="canvas__open" aria-label="باز کردن منو"><i class="fa fa-bars"></i></button>
    </div>
</header>
<!-- Header Section End -->
