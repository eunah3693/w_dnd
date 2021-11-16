@extends('main.layouts.layout')

@section('title', '당첨 내역')
@section('nav', 100004)

@section('top_back', '/myhistory')

@section('css')
<link rel="stylesheet" href="css/DND-STYLE/adress.css">
<link rel="stylesheet" href="css/DND-STYLE/my_history.css">


@endsection

@section('js')

@endsection

@section('content')
<section>
        <ul>
            <li class="history-lists">
                <div class="a-group">
                    @if ($data->status == '배송지미입력')
                    <a href="/adress?idx={{ $data->idx }}">
                        <div class="img-box">
                            <img src="/files/{{ $data->event->thum_file_idx }}" alt="">
                        </div>
                    </a>
                    @else
                    <a href="/myshipping?idx={{ $data->idx }}">
                        <div class="img-box">
                            <img src="/files/{{ $data->event->thum_file_idx }}" alt="">
                        </div>
                    </a>
                    @endif
                    <div class="cont-box">
                        <p class="date">{{  substr($data->created_at, 0, 10) }}</p>
                        @if ($data->status == '배송지미입력')
                        <p class="title"><a href="/adress?idx={{ $data->idx }}">{{ $data->event->title }}</a></p>
                        @else
                        <p class="title"><a href="/myshipping?idx={{ $data->idx }}">{{ $data->event->title }}</a></p>
                        @endif
                        @if ($data->status == '배송지미입력')
                        <p class="status-btn">{{ $data->status }}</p>
                        @else
                        <p class="status">{{ $data->status }}</p>
                        @endif
                    </div>
                </div>
            </li>
            <li>
                <div class="adress-box">
                    <div class="head clearboth">
                        <p>배송지정보</p>
                        <p class="tracking-num">송장번호 {{ $data->delivery_num }}</p>
                    </div>
                    <div class="adress-form">
                        <form class="info clearboth" action="">
                            <p>수령인</p><p class="input">{{ $data->name }}</p>
                            <p>휴대폰</p><p class="input">{{ $data->tel }}</p>
                            <p>주소지</p><p class="input">({{ $data->zip }}) {{ $data->addr1 }} {{ $data->addr2 }}</p>
                            <p>배송메모</p><p class="input">{{ $data->msg }}</p>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </section>
@endsection
