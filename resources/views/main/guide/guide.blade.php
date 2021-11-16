@extends('main.layouts.layout')

@section('title', '이용안내')
@section('nav', 100002)

@section('css')
<link rel="stylesheet" href="css/DND-STYLE/my_qna.css">
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>
<script>
$('ul.pagination').hide();
$(function() {
    $('.scrolling-pagination').jscroll({
        autoTrigger: true,
        padding: 0,
        loadingHtml: '<div style="text-align: center"><img class="center-block" src="/image/loading.gif" alt="Loading..." /></div>',
        nextSelector: '.pagination li.active + li a',
        contentSelector: '.scrolling-pagination',
        callback: function() {
            $('ul.pagination').remove();
        }
    });
});
</script>
@endsection

@section('content')
<section class="faq-section q-section  scrolling-pagination">
        @foreach ($data as $item)
        <a href="/guide_detail?idx={{ $item->idx }}" class="q-box question ">
            <div class="cont-box">
                <h2>{{$item->title}}</h2>
                <!-- <div>{!! $item->content !!}</div> -->
                <p class="counting">{{ substr($item->created_at, 0, 10) }}</p>
            </div>
        </a>
        @endforeach
        {!! $data->render() !!}
</section>
@endsection
