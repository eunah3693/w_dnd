@extends('main.layouts.layout')

@section('title', '답변 보기')
@section('nav', 100004)

@section('top_back', '/faq')

@section('css')
<link rel="stylesheet" href="/css/DND-STYLE/my_qna_answer.css">
@endsection

@section('js')
@endsection

@section('content')
<section>
    <div class="ntf-lists likes">
        <ul style="margin-bottom:0px">
            <li>
                <a href="">
                    <div class="ntf-img-wrapper">
                            <img src="image/Q_icon.svg" alt="">
                    </div>
                    <div class="q-wrapper" style="padding: 40px 20px;">
                        <div class="title-box">
                            <p>{{ $data->title }}</p>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
    <div class="ntf-lists likes">
        <ul style="margin-bottom:0px">
            <li>
                <a href="" class= "faq-a-wrapper">
                    <div class="ntf-img-wrapper">
                            <img src="image/A_icon.svg" alt="">
                    </div>
                    <div class="q-wrapper">
                        <div class="title-box">
                            <p>안녕하세요. 관리자입니다.</p>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="">
                    <div class="contents-wrapper">
                        <p class="cont-box">
                            {{ $data->content }}
                        </p>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</section>
@endsection
