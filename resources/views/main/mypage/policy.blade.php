@extends('main.layouts.layout')

@section('title', '개인정보처리방침')
@section('nav', 100004)

@section('top_back', '/')

@section('css')
<link rel="stylesheet" href="css/DND-STYLE/setting.css">
<link rel="stylesheet" href="css/DND-STYLE/terms_of_service.css">

@endsection

@section('js')

@endsection

@section('content')
    <section>
        <div class="content-box">
            @if( Request::get('idx') )
            {!! $data[Request::get('idx')]->content !!}
            @else
            {!! $data[0]->content !!}
            @endif
        </div>
        @foreach ($data as $item)
            <a href="/policy?idx={{ $loop->index }}">{{ $item->title }}</a>
        @endforeach
    </section>
@endsection
