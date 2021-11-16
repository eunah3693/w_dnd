
@section('mypage','마이페이지')

@extends('main.layouts.layout')
@section('nav', 100004)

@section('title', '마이 페이지')

@section('css')
<link rel="stylesheet" href="css/DND-STYLE/mypage.css">
@endsection

@section('js')

@endsection

@section('content')

<nav class="nav-top">
    <div class="mypage-head clearboth">
        <a href="/myfeed"><img class="profile-pic" src="{{ $data->file_idx ? '/files/'.$data->file_idx:'/image/mp_top_profile_icon.svg' }}" alt=""></a>
        <div class="user-info">
            <p class="user-name">{{ $data->nickname }}</p>
            <div class="user-treat"> <div class="tr-img-wrapper"><img src="image/small_treat_icon.svg" alt=""></div><p> {{ number_format($treat) }}</p></div>
            <!-- <p class="user-treat">500트릿</p> -->
            <p class="user-level">Lv.{{ $data->level }}</p>
            <div class="level-bar-wrapper">
                <div class="level-bar" style="width: {{ $exp }}%"></div>
            </div>
        </div>
        <a class="setting-wrapper"  href="/setting_account"><div class="setting-icon-wrapper"><img src="image/mp_setting_icon.svg" alt=""></div></a>
    </div>
</nav>

<div class="mypet-section">
    @for ($i = 0; $i < 3; $i++)
        @isset($data->pets[$i])
        <div class="pet-list">
            <a href="/mypet?idx={{$data->pets[$i]->idx}}">
                <img src="{{ $data->pets[$i]->file_idx ? '/files/'.$data->pets[$i]->file_idx:'/image/icon/pet_profile.svg' }}" alt="">
                <div class="wheel-wrapper">
                    <img src="image/mp_setting_icon(wheel).svg" alt="">
                </div>
            </a>
            <p class="pet-name registered">{{ $data->pets[$i]->name }}</p>
        </div>
        @else
        <div class="pet-list">
            <a href="/mypet">
                <img src="/image/mp_non_profile_icon.svg" alt="">
            </a>
            <p class="pet-name unregistered">등록하기</p>
        </div>
        @endisset
    @endfor
</div>
<div class="mf-wrapper">
    <div class="myfeed-button">
        <a href="/myfeed?user_idx={{ $data->idx }}"><p>마이 피드 바로가기</p></a>
    </div>
</div>
<div class="menu-icons-section">
    <div class="icon-list">
        <a href="/mytreat"><img src="image/1_on.svg" alt=""></a>
        <!-- <p class="pet-name">트릿관리</p> -->
    </div>
    <div class="icon-list">
        <a href="/myhistory"><img src="image/2_on.svg" alt=""></a>
        <!-- <p class="pet-name">당첨내역</p> -->
    </div>            <div class="icon-list">
        <a href="/myqna"><img src="image/3_on.svg" alt=""></a>
        <!-- <p class="pet-name">1:1문의</p> -->
    </div>
    <div class="icon-list">
        <a href="/mylists"><img src="image/4_on.svg" alt=""></a>
        <!-- <p class="pet-name">찜한목록</p> -->
    </div>
</div>
<div class="bottom-lists-section">
    <ul>
        <li><a href="/setting_notification"><div class="mb-icon-wrapper"><img src="image/setting_notification.svg" alt=""></div><p>알림 설정</p><div class="mb-arrow-wrapper"><img src="image/arrow_r.svg" alt=""></div></a></li>
        <li><a href="/term"><div class="mb-icon-wrapper"><img src="image/terms.svg" alt=""></div><p>이용 약관</p><div class="mb-arrow-wrapper"><img src="image/arrow_r.svg" alt=""></div></a></li>
        <li><a href="/faq"><div class="mb-icon-wrapper"><img src="image/faq.svg" alt=""></div><p> 자주하는 질문</p><div class="mb-arrow-wrapper"><img src="image/arrow_r.svg" alt=""></div></a></li>
        <li><a href="/logout"><div class="logout-arrow-wrapper"><img src="image/logout.svg" alt=""></div></a></li>
    </ul>
</div>
@endsection
