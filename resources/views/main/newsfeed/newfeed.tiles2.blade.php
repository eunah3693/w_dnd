<!-- 메인 레이아웃 -->
@extends('main.layouts.layout')

<!-- html head title과 상단 탑 네비에 타이틀 사용 -->
@section('title', '뉴스피드')
@section('nav', 100003)


<!-- 버튼 타입인지 -->
@section('top_back', 'javascript:window.history.back()')

<!-- 해당페이지에서만 사용하는 css -->
@section('css')
<link rel="stylesheet" href="css/DND-STYLE/newsfeed_tiles.css">

@endsection

<!-- 해당페이지에서만 사용하는 js -->
@section('js')
<script src="/js/DND-JS/newsfeed_tiles.js"></script>

@endsection

<!-- 컨텐츠 내용-->
@section('content')

<div class="horizontal-scroll-menu">
    <label class="filter-fixed" action="/newsfeed" method="get">
        <input type="checkbox">최신 순
    </label>
    <div class="filter-scroll" action="/newsfeed" method="get">
        <label class="filter-scroll" action="/newsfeed" method="get">
            <input type="checkbox">미션
        </label>
        <label class="filter-scroll" action="/newsfeed" method="get">
            <input type="checkbox">일상
        </label>
        <label class="filter-scroll" action="/newsfeed" method="get">
            <input type="checkbox">놀이
        </label>
        <!-- <label class="filter-scroll" action="/newsfeed" method="get">
            <input type="checkbox">교육
        </label>
        <label class="filter-scroll" action="/newsfeed" method="get">
            <input type="checkbox">케어
        </label>
        <label class="filter-scroll" action="/newsfeed" method="get">
            <input type="checkbox">산책  -->
        </label>
    </div>
</div>
<section class="tiles-section">
    <div class="tiles-div">
        <ul>
            <li><a href=""><img src="/image/happy.jpg" alt=""></a></li>
            <li><a href=""><img src="/image/missionBanner.png" alt=""></a></li>
            <li><a href=""><img src="/image/sq.png" alt=""></a></li>
            <li><a href=""><img src="/image/bye.jpg" alt=""></a></li>
            <li><a href=""><img src="/image/2019.jpg" alt=""></a></li>
            <li><a href=""><img src="/image/hi.jpg" alt=""></a></li>
            <li><a href=""><img src="/image/bear.jpg" alt=""></a></li>
            <li><a href=""><img src="/image/journey.jpg" alt=""></a></li>
            <li><a href=""><img src="/image/desk.jpg" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
            <li><a href=""><img src="" alt=""></a></li>
        </ul>
    </div>
</section>


@endsection
