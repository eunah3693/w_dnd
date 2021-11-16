<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=720, user-scalable=no"/>
    <title>Document</title>
    <link rel="stylesheet" href="css/DND-STYLE/common.css">
    <link rel="stylesheet" href="css/DND-STYLE/mainpage.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/xeicon@2.3.3/xeicon.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

</head>
<body>

    <header>
        <div class="ham-menu-bg">
            <li class="close-icon"><i class="xi-close xi-3x"></i></a></li>
        </div>
        <nav class="ham-menu">
            <ul class="ham-menu-header">
                <li class="logo-icon"><img src="/image/main-logo.png" alt=""></li>
            </ul>
            <ul class="ham-menu-middle">
                <li><a href="/notice">공지사항</a></li>
                <li><a href="/guide">이용안내</a></li>
                <li><a href="#">오픈카톡</a></li>
                <li><a href="/event">이벤트</a></li>
                <li><a href="/shop">교환소</a></li>
            </ul>
            <ul class="ham-menu-bottom">
                <li><a href="/logout">로그아웃(+이미지)</a></li>
            </ul>
        </nav>
        <nav class="nav-top">
            <ul>
                <div class="status-bar"></div>
                <li ><i class="xi-bars xi-3x ham-icon"></i> </li>
                <li class="logo-icon"><img src="/image/main-logo.png" alt=""></li>
            </ul>
        </nav>
        <nav class="nav-bottom">
            <ul>
                <li><a href="/newsfeed"><i class="xi-view-list xi-2x"></i>뉴스피드</a></li>
                <li><a href="/mission"><i class="xi-pen xi-2x"></i>도전과제</a></li>
                <li><a href="/"><i class="xi-home xi-2x"></i>홈</a></li>
                <li><a href="/notification"><i class="xi-bell xi-2x"></i>알림</a></li>
                <li><a href="/my"><i class="xi-user xi-2x"></i>MY</a></li>
            </ul>
        </nav>
    </header>
    <article>
        <section class="main-banner-section top-banner">
            <!-- Swiper -->
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach ($banners as $banner)
                        @if($banner->position == 'top')
                        <div class="swiper-slide">
                            <div class="main-banner-img">
                                <a href="{{$banner->link_url}}">
                                    <img src="files/{{$banner->file_idx}}" alt="">
                                </a>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </section>
        <section class="main-icons">
            <ul>
                <li><a href="/guide"><i class="xi-help-o xi-3x"></i>이용안내</a></li>
                <li><a href="/event"><i class="xi-gift-o xi-3x"></i>이벤트</a></li>
                <li><a href="/shop"><i class="xi-shop xi-3x"></i>교환소</a></li>
                <li><a href="/myfeed"><i class="xi-star-o xi-3x"></i>마이피드</a></li>
            </ul>
        </section>
        <section class="main-event-banner-section main-banner-section">
        <div class="main-event-banner-wrapper">
            <!-- Swiper -->
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach ($banners as $banner)
                        @if($banner->position == 'bottom')
                        <div class="swiper-slide">
                            <div class="main-event-banner-img  main-banner-img">
                                <a href="{{$banner->link_url}}">
                                    <img src="files/{{$banner->file_idx}}" alt="">
                                </a>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
        </section>
        <section class="main-footer">
            <div class="footer-div">
                <p>
                    footer-contents
                </p>
            </div>
        </section>
    </article>
</body>
<script src="/js/DND-JS/main.js"></script>

</html>
