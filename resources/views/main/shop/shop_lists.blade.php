@extends('main.layouts.layout')

@section('title', '교환소')
@section('nav', 100002)

@section('css')
<link rel="stylesheet" href="css/DND-STYLE/shop_lists.css">
<link rel="stylesheet" href="css/DND-STYLE/mission.css">


@endsection

@section('js')

@endsection

@section('search')
@section('content')
@if (count($banner) != 0)
<section class="main-banner-section">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach ($banner as $item)
            <div class="swiper-slide">
                <div class="main-event-banner-img  main-banner-img">
                    <a href="{{ $item->link_url }}">
                        <img src="/files/{{ $item->file_idx }}" alt="{{ $item->title }}">
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>
@endif
{{-- <section class="item-lists">
    <ul>
        @foreach ($data as $item)
        <li class="list-box">
            <a href="/shop_detail?idx={{ $item->idx }}">
                <img src="/files/{{ $item->thum_file_idx }}" alt="{{ $item->title }}">
            </a>
            <div class="cont-box">
                <h2>{{ $item->title }}</h2>
                <div class="price treat"><img class="t-icon" src="/image/icon/icon_treat.svg" alt=""> <p>{{ $item->participation_point }}</p></div>

                <p class="stock">남은수량: {{ $item->stock - count($item->eventJoinCount) }}/{{ $item->stock }}개</p>
            </div>
            @if ( count($item->eventJoinCount) >= $item->stock )
                <div class="bg-layer"><p>재고 소진</p></div>
            @endif
        </li>
        @endforeach
    </ul> --}}
</section>
<section class="daily-mission-section mission-section shop-box">
    @foreach ($data as $item)
    <div class="daily-mission-box mission-box  shop-box">
        <a href="/shop_detail?idx={{ $item->idx }}">
            <img src="/files/{{ $item->thum_file_idx }}" alt="{{ $item->title }}">
            <div class="cont-box">
                <h2>{{ $item->title }}</h2>
                <div class="price treat"><img class="t-icon" src="/image/icon/icon_treat.svg" alt=""> <p>{{ $item->participation_point }}</p></div>

                <p class="stock counting">남은수량: {{ $item->stock - count($item->eventJoinCount) }}/{{ $item->stock }}개</p>
            </div>
        </a>
        @if ( count($item->eventJoinCount) >= $item->stock )
                <div class="bg-layer"><p>재고 소진</p></div>
            @endif
    </div>
    @endforeach
</section>
@endsection


