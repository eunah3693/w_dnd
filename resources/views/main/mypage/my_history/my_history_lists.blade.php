@extends('main.layouts.layout')

@section('title', '당첨 내역')
@section('nav', 100004)

@section('top_back', '/my')

@section('css')
<link rel="stylesheet" href="css/DND-STYLE/my_history.css">

@endsection

@section('js')
<script src="/js/DND-JS/my_history.js"></script>
@endsection

@section('content')
<section>
        <ul>
            @foreach ($data as $item)
            <li class="history-lists">
                <div class="a-group">
                    @if ($item->status == '배송지미입력')
                    <a href="/adress?idx={{ $item->idx }}">
                        <div class="img-box">
                            <img src="/files/{{ $item->event->thum_file_idx }}" alt="">
                        </div>
                    </a>
                    @else
                    <a href="/myshipping?idx={{ $item->idx }}">
                        <div class="img-box">
                            <img src="/files/{{ $item->event->thum_file_idx }}" alt="">
                        </div>
                    </a>
                    @endif
                    <div class="cont-box">
                        <p class="date">{{  substr($item->created_at, 0, 10) }}</p>
                        @if ($item->status == '배송지미입력')
                        <p class="title"><a href="/adress?idx={{ $item->idx }}">{{ $item->event->title }}</a></p>
                        @else
                        <p class="title"><a href="/myshipping?idx={{ $item->idx }}">{{ $item->event->title }}</a></p>
                        @endif
                        @if ($item->status == '배송지미입력')
                        <p class="status-btn"><a href="/adress?idx={{ $item->idx }}">배송지 입력하기</a></p>
                        @else
                        <p class="status" style="margin-right:8px;"><a href="/myshipping?idx={{ $item->idx }}">{{ $item->status }}</a></p>
                        @endif
                        @if ($item->status == '배송완료' && $item->count == 0)
                        <p class="review-btn"><a href="/myreview?order_idx={{ $item->idx }}">리뷰쓰기</a></p>
                        @elseif($item->count == 1)
                        <p class="review-btn"><a href="/myreview?order_idx={{ $item->idx }}">리뷰작성완료</a></p>
                        @endif
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </section>
@endsection
