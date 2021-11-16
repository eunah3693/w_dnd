@extends('main.layouts.layout')

@section('title', '교환소')
@section('nav', 100002)

@section('top_back', '/shop')

@section('css')
<link rel="stylesheet" href="css/DND-STYLE/shop_detail.css">

@endsection



@section('js')
<script src="/js/DND-JS/shop_detail.js"></script>
<script>
// 리뷰팝업
function review_popup(post_idx) {
    $('#review_img').attr('src','/files/'+post_idx);
    $(".popup_pane3").fadeIn();
    $(".btn_close_review").click(function () {
        $(".popup_pane3").fadeOut();
    });
}
</script>
@endsection

@section('search')
        <li>
            <div class="search-wrapper">
                <div class="input-holder">
                    <input type="search" class="search-input"  placeholder="검색어를 입력하세요" />
                    <button class="search-icon search-toggle"><span></span></button>
                </div>
            </div>
        </li>
@endsection

@section('content')
<section>
    <div class="top-detail">
        <img src="/files/{{ $data->main_file_idx }}" alt="">
        <h1>{{ $data->title }}</h1>
        <span class="price">{{ number_format($data->participation_point) }}트릿 </span>
        <span class="stock"> ({{ $data->stock - count($data->eventJoinCount) }}개 남음 / 총 {{ $data->stock }}개)</span>
        <p>{{ $data->preview }}</p>
        <p style=" color: #d2645c; padding-top:00px; ">[ 배송비: 착불 ]</p>
        @if ( $user_treat < $data->participation_point )
        <button class="ex_button" type="button" style="background-color: #7e7e7e;" disabled>{{ number_format($data->participation_point - $user_treat) }}트릿이 부족해요</button>
        @else
        <button id="game" style="background-color: #ef998c;" type="button" onclick="openEventPopup({{ $data->idx }}, {{ $data->participation_point }})">응모하기</button>
        @endif

    </div>
    <div class="mid-detail" style="margin-top: 70px">
        {{-- 내용들어가는곳 --}}
        {!! $data->content !!}
    </div>
    @if(count($event_review) != 0)
    <div class="review">
        <h2>리뷰</h2>
        @foreach ($event_review as $key => $item)
        @if($item->user)
        <div class="review-box  @if($key > 3) plus @endif">
            <div class="title clearboth">
                <div class="user-image">
                @if($item->user->file_idx)
                    <img src="/files/{{ $item->user->file_idx }}" alt="">
                @else
                    <img src="/image/app/no_user_profile.png" alt="">
                @endif
                </div>
                    <p class="nickname">{{ $item->user->nickname }}</p>
                    <div class="review_star">
                        @for ($i = 0; $i < 5; $i++)
                        @if ( $item->score > $i)
                        <span class="star on">★</span>
                        @else
                        <span class="star">★</span>
                        @endif
                        @endfor
                    </div>
            </div>
            <div class="review_line">
                <p class="title">{{ $data->title }}</p>
                <p class="date">{{ substr($item->created_at, 0, 10) }}</p>
                @if($item->file_idx)
                <img src="/files/{{ $item->file_idx }}" onclick="review_popup({{$item->file_idx}})" >
                @endif
                <p class="content">{{ $item->content }}</p>
            </div>

        </div>
        @endif
        @endforeach
    </div>
    <div class="plus_review_wrap">
        <div class="plus_review">
            더보기
        </div>
    </div>
    @endif
</section>
<div class="popup_pane3 clearboth" >
    <div class="popup_bg"></div>
    <img src="/image/app/image_error.jpg" id="review_img" class="review_img">
    <div class="btn_close_review">
        <img src="/image/icon/ham-close-icon_white.png" class="review_close">
    </div>
</div>
@endsection



