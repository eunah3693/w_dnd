@extends('main.layouts.layout')

@section('title', '자주 하는 질문')
@section('nav', 100004)

@section('top_back', '/my')

@section('css')
<link rel="stylesheet" href="css/DND-STYLE/my_qna.css">
@endsection

@section('js')
@endsection

@section('content')

<section class="faq-section q-section">
        @foreach ($data as $item)
        <a href="/faq_detail?idx={{ $item->idx }}" class="q-box question ">
            <div class="cont-box">
                <h2 class="f-q"><span>Q.</span> {{$item->title}}</h2>
                <!-- <div>{!! $item->content !!}</div> -->
                <!-- <p class="counting">{{ substr($item->created_at, 0, 10) }}</p> -->
            </div>
        </a>
        @endforeach
    </section>
@endsection
