@extends('main.layouts.layout')

@section('nav', 100002)
@section('main', true)

@section('css')
<link rel="stylesheet" href="css/DND-STYLE/mainpage_1.css">
@endsection
@section('js')
<script src="/js/DND-JS/main.js"></script>
<script>
    // 네비 색 변경
$(window).on('scroll', e => {
    var top = $('.nav-top').offset().top;

    if(top > 0 )
    {
        $('.nav-top').css('background-color','#fff');
    }else{
        $('.nav-top').css('background-color','transparent');
    }
})
// $(function(){
//     var top = $(".main-content-banner-section.first").offset().top;
//     var nav_top=$('.nav-top').offset().top;
//     var nav_height=$('.nav-top').height();
//     var top = $(".main-content-banner-section.first").offset().top;
//     //console.log(top);
//     if((nav_top+nav_height) >= top)
//     {
//         //console.log("흰색")
//         $('.nav-top').css('background-color','#fff');
//     }else{
//         $('.nav-top').css('background-color','transparent');
//     }
// })

var swiper = new Swiper('.swiper-container-card', {
    slidesPerView: 2.4,
    spaceBetween: 20,
});
@if($story_mission_next_index && $users->story_mission_type !== null)
var swiper = new Swiper('.swiper-container-card-story', {
    slidesPerView: 2.4,
    spaceBetween: 20,
    initialSlide: {{ $story_mission_next_index }}
});
@endif
</script>

{{-- 로그인 했을때 --}}
@if (session('idx'))
<script>
$.get('/api/my/pets/count').done(function (result) {
	if(result.count === 0) {
		layerPopup2Open("펫 등록을 안하셨나요?", "", "등록하기");
		$('.popup-contents').html('펫 등록 후 <br> 미션 및 이벤트에 참여해보세요!');
        $('.popup-contents').addClass("txtcenter-class");
        $('.popup-subtitle').addClass("padding-class");
	}
});
</script>
@endif
{{-- 회원가입시에만 보이는 팝업 --}}
@if (session('join'))
<script>
guidePopupOpen();
</script>
{{ Session::forget('join') }}
@endif
{{-- 회원가입시에만 보이는 팝업 끝--}}
@endsection

@section('content')
<section class="main-banner-section top-banner">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach ($banner_top as $item)
            <div class="swiper-slide">
                <div class="main-banner-img">
                    <a href="{{ $item->link_url }}">
                        <img src="/files/{{ $item->file_idx }}" alt="">
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>
{{-- 스토리미션 --}}
<section class="main-content-banner-section first">
<div class="main-sub-banner-list">
    <div class="main-page-top"><img class="icon" src="/image/icon/icon_mission.svg" alt=""><span class="title">{{ $mission_title }}</span><p class="url"><a href="/mission">더보기 <i class="xi-angle-right-min"></i></a></p></div>
    <div class="main-event-banner-wrapper">
        <div @if($story_mission_next_index && $users->story_mission_type !== null)class="swiper-container-card-story"@else class="swiper-container-card" @endif>
            <div class="swiper-wrapper">
                @if($mission_title == '스토리미션')
                    @isset ($first_story_mission)
                    <div class="swiper-slide">
                        <div class="main-banner-img card @if(!session('idx'))guest @endif">
                            <a class="mission_pet_check" href="/story_first?idx={{ $first_story_mission->mission_idx }}" >
                                <img src="/thum/{{ $first_story_mission->thum_file_idx }}" alt="">
                            </a>
                            {{-- 회원이 첫번째 미션을했는지 확인 --}}
                            @if ($users->story_mission_type !== null)
                            <div class="bg-layer locker"><img src="image/locker.svg" alt=""></div>
                            @endif
                        </div>
                        <div class="main-page-bottom"><p class="step @if ($users->story_mission_type !== null) disable @endif">Step 01</p><p class="title @if ($users->story_mission_type !== null) disable @endif">{{ $first_story_mission->title }}</p></div>
                    </div>
                    @endisset
                    @foreach ($story_mission as $k => $item)
                    <div class="swiper-slide">
                        <div class="main-banner-img card @if(!session('idx'))guest @endif" >
                            <a href="/mission_detail?idx={{ $item->mission_idx }}">
                                <img src="/thum/{{ $item->thum_file_idx }}" alt="">
                            </a>
                            {{-- 회원일때 --}}
                            @if ($users->story_mission_type !== null)
                                @if ($story_mission_next_index -1 < $loop->index )
                                {{-- 미션 미완료 --}}
                                    <div class="bg-layer"><img src="image/missionclear.svg" alt=""></div>
                                @elseif($story_mission_next_index -1 > $loop->index)
                                {{-- 미션 완료 --}}
                                    <div class="bg-layer locker"><img src="image/locker.svg" alt=""></div>
                                @endif
                                {{ $loop->index }}/{{ $story_mission_next_index -1 }}
                            {{-- 회원아닐때 --}}
                            @else
                                <div class="bg-layer"><img src="image/missionclear.svg" alt=""></div>
                            @endif
                        </div>
                        <div class="main-page-bottom">
                            @if($item->category == '일일미션')
                            <p class="step disable">Daily</p>
                            @elseif($item->category == '주간미션')
                            <p class="step disable">Weekly</p>
                            @else
                            <p class="step @if ($users->story_mission_type === null || $story_mission_next_index -1 < $loop->index || $story_mission_next_index -1 > $loop->index ) disable @endif">Step 0{{ $loop->index + 2 }}</p>
                            @endif
                            <p class="title @if ($users->story_mission_type === null || $story_mission_next_index -1 < $loop->index || $story_mission_next_index -1 > $loop->index) disable @endif">{{ $item->title }}</p></div>
                    </div>
                    @endforeach
                @else
                @foreach ($story_mission as $k => $item)
                <div class="swiper-slide">
                    <div class="main-banner-img card @if(!session('idx'))guest @endif" >
                        <a href="/mission_detail?idx={{ $item->mission_idx }}">
                            <img src="/thum/{{ $item->thum_file_idx }}" alt="">
                        </a>
                        @if ($users->story_mission_type !== null)
                            {{-- 미션을 했는지 확인 --}}
                            @if ($item->post >= $item->participation_count)
                            <div class="bg-layer locker"><img src="image/locker.svg" alt=""></div>
                            @endif
                        @endif
                    </div>
                    <div class="main-page-bottom"><p class="step">
                        @if($item->category == '일일미션')
                        <p class="step daily @if ($item->post >= $item->participation_count) disable @endif">Daily</p>
                        @elseif($item->category == '주간미션')
                        <p class="step weekly @if ($item->post >= $item->participation_count) disable @endif">Weekly</p>
                        @elseif($item->category == '자유미션')
                        <p class="step event @if ($item->post >= $item->participation_count) disable @endif">Event</p>
                        @endif</p><p class="title">{{ $item->title }}</p></div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
</section>
{{-- 인기 뉴수피드 --}}
<section class="main-content-banner-section">
    <div class="main-sub-banner-list">
        <div class="main-page-top"><img class="icon" src="/image/icon/icon_feed.svg" alt=""><span class="title">인기 뉴스피드</span><p class="url"><a href="/newsfeed?order=like">더보기 <i class="xi-angle-right-min"></i></a></p></div>
        <div class="main-event-banner-wrapper">
            <div class="swiper-container-card">
                <div class="swiper-wrapper">
                    @foreach ($post as $item)
                    <div class="swiper-slide">
                        <div class="main-banner-img card">
                            <a href="/post_detail?post_idx={{ $item->idx }}">
                                @isset($item->files[0])
                                <img class="user" src="/thum/{{ $item->files[0]->idx }}" alt="">
                                @else
                                <img class="user" src="/thum/1" alt="">
                                @endisset
                            </a>
                        </div>
                        <div class="main-page-bottom"><div class="title">{!! $item->content !!}</div><p class="like-comment"><span class="like"><img class="icon" src="/image/icon/icon_like.svg" alt="">{{ $item->like_count }}</span><span class="comment"><img class="icon" src="/image/icon/icon_comment.svg" alt="">{{ count($item->reply) + $item->sub_reply_count }}</span></p></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
{{-- dnd 트릿 교환소 --}}
<section class="main-content-banner-section">
    <div class="main-sub-banner-list">
        <div class="main-page-top"><img class="icon" src="/image/icon/icon_shop.svg" alt=""><span class="title">DND 트릿 교환소</span><p class="url"><a href="/shop">더보기 <i class="xi-angle-right-min"></i></a></p></div>
        <div class="main-event-banner-wrapper">
            <div class="swiper-container-card">
                <div class="swiper-wrapper">
                    @foreach ($shop as $item)
                    <div class="swiper-slide">
                        <div class="main-banner-img card">
                            <a href="/shop_detail?idx={{ $item->idx }}" >
                                <img src="/thum/{{ $item->thum_file_idx }}" alt="">
                            </a>
                        </div>
                        <div class="main-page-bottom"><p class="title">{{ $item->title }}</p><p class="treat"><img class="icon" src="/image/icon/icon_treat.svg" alt=""> <span>{{ number_format($item->participation_point) }}트릿</span></p></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<section class="main-event-banner-section ">
        <div class="main-event-banner-wrapper">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach ($banner_bottom as $item)
                    <div class="swiper-slide">
                        <div class="main-banner-img">
                            <a href="{{ $item->link_url }}">
                                <img src="/files/{{ $item->file_idx }}" alt="">
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
</section>

{{-- 이벤트 --}}
{{-- <section class="main-content-banner-section">
    <div class="main-sub-banner-list">
        <div class="main-page-top"><img class="icon" style="top: 5px" src="/image/icon/icon_event.svg" alt=""><span class="title">놓치면 손해<span class="style">!</span> 통큰 이벤트</span><p class="url"><a href="/event">더보기 <i class="xi-angle-right-min"></i></a></p></div>
        <div class="main-event-banner-wrapper">
            <div class="swiper-container-card">
                <div class="swiper-wrapper">
                    @foreach ($event as $item)
                    <div class="swiper-slide">
                        <div class="main-banner-img card">
                            <a  @if($item->link_url)href="{{ $item->link_url }}"@else href="/event_detail?idx={{ $item->idx }}"@endif>
                                <img src="/files/{{ $item->main_file_idx }}" alt="">
                            </a>
                        </div>
                        <div class="main-page-bottom"><p class="title">{{ $item->title }}</p></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section> --}}

{{-- 공지사항 --}}
<section class="main-content-banner-section notice">
    <div class="main-sub-banner-list">
        <div class="main-page-top"><img class="icon" src="/image/icon/icon_notice.svg" alt=""><span class="title">공지사항</span><p class="url"><a href="/notice">더보기 <i class="xi-angle-right-min"></i></a></p></div>
        <div class="main-notice-list">
            <ul>
                @foreach ($notice as $item)
                <li>
                    <a href="/notice_detail?idx={{ $item->idx }}">
                    <p class="title">{{ $item->title }}</p>
                    <p class="date">{{  substr($item->created_at, 0, 10) }}</p>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>

<div class="guide_panel ">
    <div class="guide_bg"></div>
    <div class="guide_contents  ">

        <!-- <div class="guide-div">
            <p class="guide-contents  "> -->
                <section class="guide-banner-section top-banner ">
                    <div class="g-swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="guide-banner-img">
                                    <div class="amg amg1">
                                        <img src="/image/g1.png" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="guide-banner-img">
                                    <div class="amg">
                                        <img src="/image/g2.png" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="guide-banner-img">
                                    <div class="amg">
                                        <img src="/image/g3.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </section>
            <!-- </p>
        </div> -->
    </div>
    <div class="btn-listss">
    <li id="btn_guide_close"><i class="xi-close xi-2x"></i></li>

            <!-- <a href="javascript:void(0)" id="btn_guide_close">닫기</a> -->
            <!-- <a class="btn-confirm" href="javascript:void(0)" id="btn_guide_next">신고하기</a> -->
        </div>
</div>
@include('main.layouts.footer')
@endsection
