@extends('main.layouts.layout')

@section('title', '공지사항 상세')
@section('nav', 100002)


@section('top_back', '/notice')

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
                    <div class="q-wrapper" >
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
                            {!! $data->content !!}
                        </p>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</section>
@endsection
