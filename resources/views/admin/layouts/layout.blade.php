<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>관리자페이지</title>
        <meta name="description" content="admin page">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Icons -->
        <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
        <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/favicon.png') }}">
        <!-- Fonts and Styles -->
        @yield('css_before')
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
        <link rel="stylesheet" id="css-main" href="{{ mix('/css/oneui.css') }}">
        <link rel="stylesheet" id="css-theme" href="{{ mix('css/themes/modern.css') }}">
        <link rel="stylesheet" href="/css/admin.css">
        @yield('css_after')
        <!-- Scripts -->
        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
        <script src="{{ mix('js/oneui.app.js') }}"></script>
        <script src="{{ asset('/js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    </head>
    <body>
        @yield('page-container')

        @yield('js_after')

        @if (session('noti')) <x-notifications :type="@session('type')" :message="@session('message')" /> @endif
    </body>
</html>
