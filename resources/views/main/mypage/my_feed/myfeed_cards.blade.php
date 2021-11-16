@extends('main.layouts.layout')

@section('title', '마이피드')
@section('nav', 100004)

@section('top_back', '/myfeed')

@section('css')
<link rel="stylesheet" href="css/DND-STYLE/cards.css">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<link rel="stylesheet" href="/js/DND-JS/animista.css">
<link rel="stylesheet" href="css/DND-STYLE/horizontal-scroll.css">

@endsection
@section('js')
<script src="/js/DND-JS/cards.js"></script>
<script src="/js/DND-JS/horizontal-scroll.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


@endsection

@section('content')
    <div class="horizontal-scroll-menu">
        <form class="filter-fixed" action="/newsfeed" method="get">
            <button>최신 순</button>
        </form>
        <form class="filter-scroll" action="/newsfeed" method="get">
            <button>미션</button>
            <button>일상</button>
            <button>놀이</button>
            <button>교육</button>
            <button>케어</button>
            <button>산책</button>
        </form>
    </div>
    <section class="cards-section">
        <form class="pet-filter clearboth" action="/myfeed" method="get">
            <button type="button"><img src="/image/desk.jpg" alt=""></button>
            <button type="button"><img src="/image/desk.jpg" alt=""></button>
            <button type="button"><img src="/image/desk.jpg" alt=""></button>
        </form>
        <div class="cards-div">
            <ul>
                <li>
                    <div class="card-lists">
                        <div class="title clearboth">
                            <img src="/image/favicon.png" alt="">
                            <p>김집사</p>
                                <a href="javascript:void(0)" class="button btn_share">공유</a>
                                <a href="javascript:void(0)"  class="button btn_report">신고</a>
                        </div>
                        <div class="pics">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="swiper-slide-img-box">
                                            <a href="#">
                                                <img src="/image/hi.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="swiper-slide-img-box">
                                            <a href="#">
                                                <img src="/image/bye.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="swiper-slide-img-box">
                                            <a href="#">
                                                <img src="/image/desk.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="swiper-slide-img-box">
                                            <a href="#">
                                                <img src="/image/2019.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                        <div class="cont">
                            <p class="cont-box">
                                집사의 하루는 길고도 길다. <br>
                                집사란 무엇일까.. <br>
                                오늘은 월요일이다 . . . <br>
                                돈까스에 모밀 먹고 싶다. . . <br>
                            </p>
                            <div class="bookmark deactive"><i class="xi-bookmark-o xi-3x"></i></div>
                        </div>
                        <div class="likes-and-comments">
                            <div class="comments"><a href="/post_detail?post_idx=1&comment=true"><i class="xi-message-o xi-3x"></i></a></div>
                            <div class="likes"><i class="xi-heart-o xi-3x"></i></div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="card-lists">
                        <div class="title clearboth">
                            <img src="/image/favicon.png" alt="">
                            <p>김집사</p>
                                <a href="javascript:void(0)" class="button btn_share">공유</a>
                                <a href="javascript:void(0)"  class="button btn_report">신고</a>
                        </div>
                        <div class="pics">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="swiper-slide-img-box">
                                            <a href="#">
                                                <img src="/image/hi.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="swiper-slide-img-box">
                                            <a href="#">
                                                <img src="/image/bye.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="swiper-slide-img-box">
                                            <a href="#">
                                                <img src="/image/desk.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="swiper-slide-img-box">
                                            <a href="#">
                                                <img src="/image/2019.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                        <div class="cont">
                            <p class="cont-box">
                                집사의 하루는 길고도 길다. <br>
                                집사란 무엇일까.. <br>
                                오늘은 월요일이다 . . . <br>
                                돈까스에 모밀 먹고 싶다. . . <br>
                            </p>
                            <div class="bookmark deactive"><i class="xi-bookmark-o xi-3x"></i></div>
                        </div>
                        <div class="likes-and-comments">
                            <div class="comments"><a href="/post_detail?post_idx=1&comment=true"><i class="xi-message-o xi-3x"></i></a></div>
                            <div class="likes"><i class="xi-heart-o xi-3x"></i></div>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="page-navigator-bg">
                <a class="mission-button" href="/mission">미션</a>
                <a class="daily-button" href="/mission_post">일상</a>
            </div>
            <div class="page-navigator-wrapper">
                <button class="page-navigator-button">+</button>
            </div>
        </div>
    </section>

@endsection
