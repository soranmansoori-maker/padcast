<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>{{config('app.name')}} - @yield('title')</title>
    <!-- Favicon-->
    <link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon">
    <!-- Plugins Core Css -->
    <link href="/assets/css/app.min.css" rel="stylesheet">
    <link href="/assets/js/bundles/materialize-rtl/materialize-rtl.min.css" rel="stylesheet">
    <!-- Custom Css -->
    <link href="/assets/css/style.css" rel="stylesheet" />
    <!-- Theme style. You can choose a theme from css/themes instead of get all themes -->
    <link href="/assets/css/styles/all-themes.css" rel="stylesheet" />
    @yield('style')
</head>

<body class="light rtl">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30">
            <img class="loading-img-spin" src="/assets/images/loading.png" alt="admin">
        </div>
        <p>لطفا صبر کنید...</p>
    </div>
</div>
<!-- #END# Page Loader -->
@include('layouts.sidebar')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul class="breadcrumb breadcrumb-style ">
                        <li class="breadcrumb-item">
                            <h4 class="page-title">@yield('page-title')</h4>
                        </li>
                        <li class="breadcrumb-item bcrumb-1">
                            <a href="{{ route('dashboard') }}">
                                <i class="fas fa-home"></i> خانه</a>
                        </li>
                        <li class="breadcrumb-item bcrumb-2">
                            <a onClick="return false;">@yield('page-name')</a>
                        </li>
                        <li class="breadcrumb-item active">@yield('page-desc')</li>
                    </ul>
                </div>
            </div>
        </div>
    @yield('content')
    </div>
</section>
<!-- Plugins Js -->
<script src="/assets/js/app.min.js"></script>
<script src="/assets/js/admin.js"></script>
@yield('script')
</body>
