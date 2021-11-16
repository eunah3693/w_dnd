<div class="ham-menu-bg clearboth"></div>
<nav class="ham-menu">

    <ul class="ham-menu-header">
        <!-- <li class="logo-icon"><a href="/"><img src="/image/icon/ham-login-icon.png" alt=""></a></li> -->
        @if(session('idx'))
        <li style="font-size: 25px; color: #505050; font-weight: 500;">{{ session('nickname') }}님 환영합니다</li>
        @else
        <li><a href="/login"><img src="image/icon/ham-login-icon.png" alt=""></a></li>
        @endif
        <li class="close-icon ham-icon"><img src="image/icon/ham-close-icon.png" alt=""></li>
    </ul>
    <ul class="ham-menu-middle">
        <li><div class="ham-icon-div"><img src="image/icon/ham-notice-icon.png" alt=""></div><a href="/notice"> 공지사항</a></li>
        <li><div class="ham-icon-div"><img src="image/icon/ham-guide-icon.png" alt=""></div><a href="/guide">이용안내</a></li>
        <li><div class="ham-icon-div"><img src="image/icon/ham-openkakao-icon.png" alt=""></div><a onclick="openLink('http:\/\/open.kakao.com/o/gDY7lgIc')">오픈카톡</a></li>
        <li><div class="ham-icon-div"><img src="image/icon/ham-event-icon.png" alt=""></div><a href="/event">이벤트</a></li>
        <li><div class="ham-icon-div"><img src="image/icon/ham-shop-icon.png" alt=""></div><a href="/shop">교환소</a></li>
        <li><div class="ham-icon-div"><img src="image/icon/ham-newsfeed-icon.png" alt=""></div><a href="/newsfeed">뉴스피드</a></li>
        <li><div class="ham-icon-div"><img src="/image/icon/hma-mission-icon.svg" alt="" class="hma-mission-icon"></div><a href="/mission">도전미션</a></li>
        <li><div class="ham-icon-div"><img src="image/icon/ham-my-icon.png" alt=""></div><a href="/my">마이페이지</a></li>
    </ul>
    @if(session('idx'))
    <div class="nav_logout"><a href="/logout"><img src="image/icon/ham-logout-icon.png" alt=""></a></div>
    @endif
</nav>
@if(View::hasSection('top_back'))
<nav class="nav-top default">
    <ul>
        <li>
            <a class="ham-wrapper" href="@yield('top_back')">
                <img class="back-icon" src="/image/back.svg" alt="">
            </a>
        </li>
        <li>@yield('title')</li>
        @yield('search')
    </ul>
</nav>
@else
<nav class="nav-top default">
    <ul>
        <li>
            <div class="ham-wrapper">
                <img class="ham-icon" src="/image/ham.svg" alt="">
            </div>
        </li>
        @if(View::hasSection('title'))
        <li>
            @yield('title')
        </li>
        @else
            <li class="logo-icon">
                <a class="logo-wrapper" href="/"><img src="/image/mainlogo.svg" alt=""></a>
            </li>
        @endif
        @if(session('idx') && View::hasSection('main'))
        <li class="main-user-icon">
            <a href="/myfeed"><img class="star" src="/image/icon/main_profile.svg"></a>
        </li>
        @elseif(View::hasSection('main'))
        <li class="main-user-icon">
            <a href="/login"><img style="top:49px; right:45px;width:95px;"  src="/image/icon/login.svg"></a>
        </li>
        @endif
        @yield('search')
    </ul>
</nav>
@endif

<nav class="nav-bottom">
    <ul>
        <li>
            <a class="nav-icon" href="/newsfeed">
                @if(trim($__env->yieldContent('nav')) == '100000')
                <img src="/image/nb-newsfeed-hover.svg" alt="">
                @else
                <img src="/image/nb-newsfeed.svg" alt="">
                @endif
            </a>
        </li>
        <li>
            @if(session('idx'))
            <a class="nav-icon" href="/mission">
            @else
            <a class="guest" href="/mission">
            @endif
                @if(trim($__env->yieldContent('nav')) == '100001')
                <img src="/image/nb-mission-hover.svg" alt="">
                @else
                <img src="/image/nb-mission.svg" alt="">
                @endif
            </a>
        </li>
        <li>
            <a class="nav-icon" href="/">
                @if(trim($__env->yieldContent('nav')) == '100002')
                <img src="/image/nb-home-hover.svg" alt="">
                @else
                <img src="/image/nb-home.svg" alt="">
                @endif
            </a>
        </li>
        <li>
            @if(session('idx'))
            <a class="nav-icon " href="/notification">
            @else
            <a class="guest" href="/notification">
            @endif
                @if(trim($__env->yieldContent('nav')) == '100003')
                <img src="/image/nb-notification-hover.svg" alt="">
                <div class="is_notification"></div>
                @else
                <img src="/image/nb-notification.svg" alt="">
                <div class="is_notification"></div>
                @endif
            </a>
        </li>
        <li>
            @if(session('idx'))
            <a class="nav-icon" href="/my">
            @else
            <a class="guest" href="/my">
            @endif
                @if(trim($__env->yieldContent('nav')) == '100004')
                <img src="/image/nb-mypage-hover.svg" alt="">
                @else
                <img src="/image/nb-mypage.svg" alt="">
                @endif
            </a>
        </li>

        <!-- <li><a class="{{ trim($__env->yieldContent('nav')) == '100001' ? 'nav-active':'' }}" href="/mission"><img src="/image/mission-icon.png" alt=""></a></li>
        <li><a class="{{ trim($__env->yieldContent('nav')) == '100002' ? 'nav-active':'' }}" href="/"><img src="/image/home-icon.png" alt=""></a></li>
        <li><a class="{{ trim($__env->yieldContent('nav')) == '100003' ? 'nav-active':'' }}" href="/notification"><img src="/image/notification-icon.png" alt=""></a></li>
        <li><a class="{{ trim($__env->yieldContent('nav')) == '100004' ? 'nav-active':'' }}" href="/my"><img src="/image/mypage-icon.png" alt=""></a></li> -->
    </ul>
</nav>
