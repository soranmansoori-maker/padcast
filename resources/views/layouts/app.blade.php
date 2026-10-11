<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>WaveCast - @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Favicon-->
    <link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon">
    <!-- Plugins Core Css -->
    <link href="/assets/css/app.min.css" rel="stylesheet">
    <link href="/assets/js/bundles/materialize-rtl/materialize-rtl.min.css" rel="stylesheet">
    <!-- Custom Css -->
    <link href="/assets/css/style.css" rel="stylesheet" />
    <link href="/assets/css/pages/extra_pages.css" rel="stylesheet" />
    @yield('style')
</head>
<body>
            @yield('content')

    <!-- Plugins Js -->
    <script src="/assets/js/app.min.js"></script>
    <!-- Extra page Js -->
    <script src="/assets/js/pages/examples/pages.js"></script>
</body>
</html>
