<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>WaveCast | مدیریت وب سایت</title>
    <!-- Favicon-->
    <link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon">
    <!-- Plugins Core Css -->
    <link href="/assets/css/app.min.css" rel="stylesheet">
    <link href="/assets/js/bundles/materialize-rtl/materialize-rtl.min.css" rel="stylesheet">
    <!-- Custom Css -->
    <link href="/assets/css/style.css" rel="stylesheet"/>
    <!-- Theme style. You can choose a theme from css/themes instead of get all themes -->
    <link href="/assets/css/styles/all-themes.css" rel="stylesheet"/>
    <link href="/assets/js/bundles/multiselect/css/multi-select.css" rel="stylesheet">
    <link href="/assets/css/form.min.css" rel="stylesheet">
    <style>
        /* Hide raw numeric fallback inside sparkline containers to avoid visible data strings when JS hasn't yet rendered */
        .chart[data-values] { color: transparent !important; }
    </style>
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
@include('admin.sidebar')
<section class="content">
    @yield('content')
</section>
<!-- Plugins Js -->
<script src="/assets/js/app.min.js"></script>

<!-- Custom Js -->
<script src="/assets/js/admin.js"></script>
<script src="/assets/js/form.min.js"></script>
<script src="/assets/js/bundles/multiselect/js/jquery.multi-select.js"></script>
<script src="/assets/js/pages/forms/advanced-form-elements.js"></script>
<script src="/assets/js/bundles/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js"></script>
<script src="/assets/js/pages/forms/form-validation.js"></script>
@yield('script')
</body>
