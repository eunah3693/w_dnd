<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=720, user-scalable=no"/>
    <title>DND LIFE CARE</title>
    <link rel="shortcut icon" href="/image/favicon.png">
    <link rel="icon" href="/image/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/image/favicon.png">
    <link rel="stylesheet" href="css/DND-STYLE/common.css">
    <link rel="stylesheet" href="css/DND-STYLE/mission.css">
    <link rel="stylesheet" href="/js/plugins/slick-carousel/slick.css">
    <link rel="stylesheet" href="/js/plugins/slick-carousel/slick-theme.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/xeicon@2.3.3/xeicon.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>
    <header>
        <nav class="ham-menu">
            <ul class="ham-menu-header">
                <li class="logo-icon"><img src="/image/main-logo.png" alt=""></li>
                <li class="close-icon ham-icon"><i class="xi-close xi-3x"></i></a></li>
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
                <li class="logo-icon">도전 미션</li>

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
        <div class="container">
            <ul class="tab_title">
                <li class="on">전체 미션</li>
                <li>찜한 미션</li>
            </ul>
            <div class="tab_cont">
                <div class="on tab-one">
                    <div class="story-mission-section">
                        <div class="story-mission-div">
                            <img src="/image/missionBanner.png" alt="">
                            <p>스토리미션</p>
                        </div>
                    </div>
                    @foreach ($missions as $k => $v)
                        <section class="daily-mission-section mission-section">
                            <h4>{{ $k }}</h4>
                            @foreach ($v as $item)
                            <div class="daily-mission-box mission-box">
                                <a href="/mission_detail">
                                    <img src="/image/missionDaily.jpg" alt="">
                                    <div class="cont-box">
                                        <h2>{{ $item->title }}</h2>
                                        <p class="detail">{{ $item->preview }}</p>
                                        <p class="counting">{{ $item->post }}개 / {{ $item->participation_count }}개</p>
                                    </div>
                                </a>
                                @if ($item->user_bookmark == 0)
                                    <button><i class="xi-plus-circle-o xi-2x"></i>찜 하기</button>
                                @else
                                    <button><i class="xi-minus-circle-o xi-2x"></i>찜 취소</button>
                                @endif
                            </div>
                            @endforeach

                        </section>
                    @endforeach

                    </div>
                    <div class="tab-two">
                        @foreach ($missions as $k => $v)
                        <section class="daily-mission-section mission-section">
                            <h4>{{ $k }}</h4>
                            @foreach ($v as $item)
                            <div class="daily-mission-box mission-box  mission-liked">
                                <a href="/mission_detail">
                                    <img src="/image/missionDaily.jpg" alt="">
                                    <div class="cont-box">
                                        <h2>{{ $item->title }}</h2>
                                        <p class="detail">{{ $item->preview }}</p>
                                        <p class="counting">{{ $item->post }}개 / {{ $item->participation_count }}개</p>
                                    </div>
                                </a>
                                @if ($item->user_bookmark == 0)
                                    <button><i class="xi-plus-circle-o xi-2x"></i>찜 하기</button>
                                @else
                                    <button><i class="xi-minus-circle-o xi-2x active"></i>찜 취소</button>
                                @endif

                            </div>
                            @endforeach

                        </section>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </article>
</body>
<script src="/js/plugins/slick-carousel/slick.js"></script>
<script src="/js/DND-JS/main.js"></script>
<script src="/js/DND-JS/mission.js"></script>
</html>
