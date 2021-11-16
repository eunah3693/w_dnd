@extends('main.layouts.layout')

@section('title', '답변 보기')
@section('nav', 100004)

@section('top_back', '/myqna')

@section('css')
<!-- <link rel="stylesheet" href="css/DND-STYLE/my_qna.css"> -->
<!-- <link rel="stylesheet" href="css/DND-STYLE/board_detail.css"> -->
<link rel="stylesheet" href="css/DND-STYLE/my_qna_answer.css">





@endsection

@section('js')


@endsection

@section('content')
<section>
    <div class="ntf-lists likes">
        <ul>
            <li>
                <a href="">
                    <div class="ntf-img-wrapper">
                            <img src="image/Q_icon.svg" alt="">
                    </div>
                    <div class="q-wrapper">
                        <div class="title-box">
                            <p>{{ $data->title }}</p>
                        </div>
                        <div class="date-box">
                            <p><span>작성일 </span> {{ $data->created_at }}</p>
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
    @if($data->answered_at)
    <div class="ntf-lists likes">
        <ul>
            <li>
                <a href="">
                    <div class="ntf-img-wrapper">
                            <img src="image/A_icon.svg" alt="">
                    </div>
                    <div class="q-wrapper">
                        <div class="title-box">
                            <p>안녕하세요. 관리자입니다.</p>
                        </div>
                        <div class="date-box">
                            <p><span>작성일</span>  {{ $data->answered_at }}</p>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="">
                    <div class="contents-wrapper">
                        <p class="cont-box">
                            {{ $data->content2 }}
                        </p>
                    </div>
                </a>
            </li>
        </ul>
    </div>
    @else
    <br><p style="text-align: center;">답변이 없습니다.</p>
    @endif
</section>
@endsection
