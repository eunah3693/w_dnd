@extends('main.layouts.layout')

@section('title', $title )
@section('nav', 100000)

@section('css')
<link rel="stylesheet" href="css/DND-STYLE/tiles.css">
<link rel="stylesheet" href="css/DND-STYLE/horizontal-scroll.css">
<link rel="stylesheet" href="css/DND-STYLE/myfeed.css">

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>
<script src="/js/DND-JS/tiles.js"></script>
<script src="/js/DND-JS/horizontal-scroll.js"></script>
<script>
$('ul.pagination').hide();
    $(function() {
        $('.scrolling-pagination').jscroll({
            autoTrigger: true,
            padding: 0,
            loadingHtml: '<div style="text-align: center"><img class="center-block" src="/image/loading.gif" alt="Loading..." /></div>',
            nextSelector: '.pagination li.active + li a',
            contentSelector: '.scrolling-pagination ul',
            callback: function() {
                $('ul.pagination').remove();
            }
        });
    });
</script>

@endsection

@section('search')
<form method="get">
        <li>
            <div class="search-wrapper">
                <div class="input-holder">
                    <input type="search" class="search-input" name="search"  placeholder="검색어를 입력하세요" />
                    <button class="search-icon search-toggle"><span></span></button>
                </div>
            </div>
        </li>
</form>
@endsection

@section('content')
@if ($title == '마이피드')
<div class="myfeed-head">
    <a class="profile-a" href="">
        @if ( $user->file_idx )
        <img class="profile-pic" src="/thum/{{$user->file_idx}}" alt="">
        @else
        <img class="profile-pic" src="image/mp_top_profile_icon.svg" alt="">
        @endif
    </a>
    <div class="user-info">
        <p class="user-name">{{ $user->nickname }}</p>
        <p class="user-level">Lv.{{ $user->level }}</p>
        <div class="level-bar"></div>
    </div>
    @if (session('idx') == $user->idx)
    <a href="/setting_account"><div class="setting-icon-wrapper"><img src="image/mp_setting_icon.svg" alt=""></div></a>
    @endif
</div>
<div class="myfeed-intro">
    <pre>{{ $user->my_feed }}</pre>
</div>
@endif
<form method="get">
    @if ($title != '마이피드')
    <div class="horizontal-scroll-menu">
        <div class="filter-fixed box">
            @if (Request::get('order') != 'like')
            <label class="box-radio-input sort time"><input type="checkbox" name="order" value="like"><span>최신순</span><div class="sort-icon"><img src="/image/sort.svg" alt=""></div></label>
            @else
            <label class="box-radio-input sort like"><input type="checkbox" name="order" value="date"><span>좋아요</span><div class="sort-icon"><img src="/image/sort.svg" alt=""></div></label>
            @endif
        </div>
        <div class="filter-scroll box">
            <label class="box-radio-input daily-m-btn"><input type="checkbox" name="tag[]"
                @if(Request::get('tag'))@foreach (Request::get('tag') as $item) @if ($item == '일상') checked @endif @endforeach @endif
                value="일상"><span>일상</span></label>
            <label class="box-radio-input "><input class="input-mission" type="checkbox" name="tag[]"
                @if(Request::get('tag'))@foreach (Request::get('tag') as $item) @if ($item == '미션') checked @endif @endforeach @endif
                value="미션"><span>미션</span></label>
            <label class="box-radio-input input-hide "><input type="checkbox" name="tag[]"
                @if(Request::get('tag'))@foreach (Request::get('tag') as $item) @if ($item == '놀이') checked @endif @endforeach @endif
                value="놀이"><span>놀이</span></label>
            <label class="box-radio-input input-hide "><input type="checkbox" name="tag[]"
                @if(Request::get('tag'))@foreach (Request::get('tag') as $item) @if ($item == '교육') checked @endif @endforeach @endif
                value="교육"><span>교육</span></label>
            <label class="box-radio-input input-hide "><input type="checkbox" name="tag[]"
                @if(Request::get('tag'))@foreach (Request::get('tag') as $item) @if ($item == '케어') checked @endif @endforeach @endif
                value="케어"><span>케어</span></label>
            <label class="box-radio-input input-hide "><input type="checkbox" name="tag[]"
                @if(Request::get('tag'))@foreach (Request::get('tag') as $item) @if ($item == '산책') checked @endif @endforeach @endif
                value="산책"><span>산책</span></label>
        </div>
    </div>
    @elseif($title == '마이피드')
    <input name="user_idx" type="hidden" value="{{$user->idx}}">
    <div class="pet-filter clearboth">
        @foreach ($user->pets as $item)
            <label class="box-radio-input">
                <input type="checkbox" name="pet_idx[]"
                @if(Request::get('pet_idx')) @foreach (Request::get('pet_idx') as $pet) @if ($pet == $item->idx ) checked @endif @endforeach @endif
                value="{{ $item->idx }}">
                <div>
                    @if ($item->file_idx)
                    <img src="/thum/{{ $item->file_idx }}" alt="{{ $item->pet }}">
                    @else
                    <img src="/image/icon/pet_profile.svg" alt="{{ $item->pet }}">
                    @endif
                </div>
            </label>
        @endforeach
    </div>
    @endif
</form>
    <section class="tiles-section">
        <div class="tiles-div scrolling-pagination">
            <ul>
                @if (count($post) == 0)
                    <li style="background:none; text-align:center; width:100%;"><img src="/image/icon/no_text.jpg" style="width:270px;"></li>
                @endif
                @foreach($post as $p)
                    <li class="item">
                        @if ($title == '뉴스피드')
                        <a href="/newsfeed_cards?page={{ $post->currentPage()}}&{{Request::getQueryString()}}#cards_{{$p->idx}}">
                        @elseif  ($title == '저장피드')
                        <a href="/mylists_cards?page={{ $post->currentPage()}}&{{Request::getQueryString()}}#cards_{{$p->idx}}">
                        @else
                        <a href="/myfeed_cards?user_idx={{ $user->idx }}&page={{ $post->currentPage()}}&{{Request::getQueryString()}}#cards_{{$p->idx}}">
                        @endif
                            @isset($p->files[0])
                                <img src="/thum/{{$p->files[0]->idx}}" alt="{{$p->idx}}">
                                @if( $p->mission_idx )
                                {{-- 미션일때 --}}
                                    <span>미션</span>
                                @endif
                                @if (count($p->files) > 1)
                                    {{-- 한상이상일때 --}}
                                    <img class="icon" src="/image/icon/img_list_38x34px.svg">
                                @elseif (strpos($p->files[0]->mime_type, 'video') !== false)
                                    {{-- 동영상일때 --}}
                                    <img class="icon" src="/image/icon/video_38x34px.svg">
                                @endif
                            @else
                            <img src="/thum/1" >
                            @endisset
                        </a>
                    </li>
                @endforeach
            </ul>
            {!! $post->render() !!}
        </div>
        <div class="page-navigator-bg">
            <a class="mission-button" href="/mission">미션</a>
            <a class="daily-button mission_pet_check" href="/mypost">일상</a>
        </div>
    </section>
    <div class="page-navigator-wrapper">
    </div>

    <button class="page-navigator-button"></button>
@endsection



