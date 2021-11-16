@extends('main.layouts.layout')

@section('title', '찜한 목록')
@section('nav', 100004)

@section('top_back', '/my')

@section('css')
<link rel="stylesheet" href="css/DND-STYLE/my_lists.css">
<link rel="stylesheet" href="css/DND-STYLE/horizontal-scroll.css">

@endsection

@section('js')
<script src="/js/DND-JS/tiles.js"></script>
<script src="/js/DND-JS/horizontal-scroll.js"></script>

@endsection

@section('content')
<div class="horizontal-scroll-menu">
        <form class="filter-fixed" action="/my_lists" method="get">
            <button>최신 순</button>
        </form>
        <form class="filter-scroll" action="/my_lists" method="get">
            <button>미션</button>
            <button>일상</button>
            <button>놀이</button>
            <button>교육</button>
            <button>케어</button>
            <button>산책</button>
        </form>
    </div>
    <section class="lists-section">
        <div class="lists-div">
            <ul>
                <li><a href="/mylists_cards"><img src="/image/Happy.jpg" alt=""></a></li>
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
