<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>DND 관리자페이지  @yield('title')</title>

    <meta name="description" content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework">
    <meta property="og:site_name" content="OneUI">
    <meta property="og:description" content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="/media/favicons/favicon.png">
    <link rel="icon" sizes="192x192" type="image/png" href="/media/favicons/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/media/favicons/favicon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Fonts and OneUI framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="/css/oneui.css">
    <link rel="stylesheet"  href="/css/admin.css">
    <link rel="stylesheet" href="/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="/js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="/js/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/js/plugins/ion-rangeslider/css/ion.rangeSlider.css">
    <link rel="stylesheet" href="/js/plugins/dropzone/dist/min/dropzone.min.css">
    <link rel="stylesheet" href="/js/plugins/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" href="/js/plugins/summernote/summernote.css">
    <link rel="stylesheet" href="/js/plugins/slick-carousel/slick.css">
    <link rel="stylesheet" href="/js/plugins/slick-carousel/slick-theme.css">

    @yield('css')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/js/oneui.core.min.js"></script>
    <script src="/js/oneui.app.min.js"></script>
    <script src="/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="/js/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="/js/plugins/chart.js/Chart.bundle.min.js"></script>
    <script src="/js/pages/be_pages_dashboard.min.js"></script>
    <script src="/js/plugins/select2/js/select2.full.min.js"></script>
    <script src="/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js"></script>
    <script src="/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
    <script src="/js/plugins/dropzone/dropzone.min.js"></script>
    <script src="/js/plugins/flatpickr/flatpickr.min.js"></script>
    <script src="/js/plugins/summernote/summernote.js"></script>
    <script src="/js/pages/summernote.js"></script>
    <script src="/js/admin/main.js"></script>
    <script src="/js/plugins/slick-carousel/slick.min.js"></script>
    <script src="/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>

    @yield('js')

</head>
<body>

    <div>
        @include('admin.layouts.header')
        <!-- main-content -->
        @yield('content')
    </div>
    @if (session('alert')) <x-alert :message="@session('alert')" /> @endif
    @if (session('noti')) <x-notifications :message="@session('noti')" /> @endif
</body>
</html>
