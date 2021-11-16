<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=720, user-scalable=no"/>
    <meta property="og:type" content="website">
    <meta property="og:title" content="DND LIFECARE">
    <meta property="og:description" content="반려동물과 보호자 모두의  삶이 더 행복해질 수 있도록">
    <meta property="og:image" content="/image/og.jpg">
    <meta property="og:url" content="https://dndlifecare.com/">
    <META HTTP-EQUIV="Expires" CONTENT="Mon, 06 Jan 1990 00:00:01 GMT"> <META HTTP-EQUIV="Expires" CONTENT="-1"> <META HTTP-EQUIV="Pragma" CONTENT="no-cache"> <META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
    <title>DND @yield('title')</title>
    <link rel="shortcut icon" href="/image/favicon.png">
    <link rel="icon" href="/image/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/image/favicon.png">
    <link rel="stylesheet" href="/css/DND-STYLE/common.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/xeicon@2.3.3/xeicon.min.css">
    <link rel="apple-touch-icon" sizes="57x57" href="/image/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/image/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/image/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/image/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/image/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/image/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/image/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/image/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/image/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/image/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/image/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/image/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/image/favicon/favicon-16x16.png">
    <link rel="manifest" href="/image/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('css')
</head>
<body >
    <header>
        <!-- nav -->
        @include('main.layouts.nav')
    </header>
    <article>
        <!-- main-content -->
        @yield('content')
        <div class="popup_panel clearboth">
            <div class="popup_bg"></div>
            <div class="popup_contents">
                <h2 class="popup-title"></h2>
                <p class="popup-subtitle"></p>
                <div class="radio-lists main-contents">
                    <p class="popup-contents"></p>
                </div>
            </div>
        </div>
        <div class="popup_panel2 clearboth">
            <div class="popup_bg"></div>
            <div class="popup_contents">
                <h2 class="popup-title"></h2>
                <p class="popup-subtitle"></p>
                <div class="radio-lists main-contents">
                    <p class="popup-contents"></p>
                </div>
                <div class="popup-btn-lists">
                    <a href="javascript:void(0)" id="btn_popup_close2">닫기</a>
                    <a class="btn-confirm" href="javascript:void(0)"  id="btn_popup_next2"></a>
                </div>
            </div>
        </div>
    </article>

    <!-- 로딩바 -->
    <div id = "progress_loading" style="position: absolute;left: 50%;top: 50%;">
        <img src="/image/loading.gif"/>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script src="/js/DND-JS/common.js"></script>

    @yield('js')
    @if (session('alert')) <x-alert :message="@session('alert')" /> @endif
</body>
</html>
