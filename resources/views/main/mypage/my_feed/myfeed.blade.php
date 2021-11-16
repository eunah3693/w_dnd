@extends('main.layouts.layout')

@section('nav', 100004)
@section('title', '마이피드')

@section('top_back', '/my')

@section('css')
<link rel="stylesheet" href="css/DND-STYLE/myfeed.css">
<link rel="stylesheet" href="css/DND-STYLE/tiles.css">
<link rel="stylesheet" href="css/DND-STYLE/horizontal-scroll.css">
@endsection

@section('js')
<script src="/js/DND-JS/horizontal-scroll.js"></script>
<script src="/js/DND-JS/tiles.js"></script>

@endsection

@section('content')
    <div class="myfeed-head">
        <a href=""><img class="profile-pic" src="/image/face.jpg" alt=""></a>
        <div class="user-info">
            <p class="user-name">김집사 님</p>
            <p class="user-level">Lv.2</p>
            <div class="level-bar"></div>
        </div>
        <a href="/setting_account"><i class="xi-cog xi-2x"></i></a>
    </div>
    <div class="myfeed-intro">
        <p>안녕하세요 벨라 집사입니다
            <br> 벨라 똥 이따시만하지롱
            <br> 방이초 앞에서 포켓몬고 할 사람 구해여
        </p>
        <p>김벨라: 보더콜리 3세
        </p>
    </div>
    <section class="tiles-section">
        <form class="pet-filter clearboth" action="/myfeed" method="get">
            <button type="button"><img src="/image/desk.jpg" alt=""></button>
            <button type="button"><img src="/image/desk.jpg" alt=""></button>
            <button type="button"><img src="/image/desk.jpg" alt=""></button>
        </form>
        <div class="tiles-div">
            <ul>
                <li><a href="/myfeed_cards"><img src="/image/Happy.jpg" alt=""></a></li>
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
        <div class="page-navigator-bg">
            <a class="mission-button" href="/mission">미션</a>
            <a class="daily-button" href="/mission_post">일상</a>
        </div>
        <div class="page-navigator-wrapper">
            <button class="page-navigator-button">+</button>
        </div>
    </section>

@endsection



