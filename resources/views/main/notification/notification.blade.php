@extends('main.layouts.layout')

@section('title', '알림')
@section('nav', 100003)

@section('css')
<link rel="stylesheet" href="css/DND-STYLE/notification.css">
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
// 알람 읽었다고 보내는 API
$.post('/api/notification', function(res){});
</script>
@endsection

@section('content')
    <section class="scrolling-pagination">
        @if (!Session::get('idx'))
        <p>로그인이 필요합니다.</p>
        @else
            @if (count($data) == 0)
            <p style="text-align: center;margin-top: 100px;">알람이 없습니다.</p>
            @endif
            @foreach ($data as $val)
            <div class="ntf-lists likes @if($val->is_check == 0)ntl-active @endif">
                <ul>
                    <li>
                        <a href="{{ $val->related_url }}">

                            <div class="ntf-img-wrapper">
                                @if($val->type == 'post_like' || $val->type == 'reply_like')
                                    <img src="image/like_icon.svg" alt="">
                                @elseif($val->type == 'level_up')
                                    <img src="image/level_icon.svg" alt="">
                                @elseif($val->type == 'mission' || $val->type == 'event')
                                    <img src="image/trophy_icon.svg" alt="">
                                @elseif($val->type == 'mention' || $val->type == 'post_reply')
                                    <img src="image/reply_icon.svg" alt="">
                                @elseif($val->type == 'treat')
                                    <img src="image/treat_icon.svg" alt="">
                                @else
                                    <img src="image/multi_icon.svg" alt="">
                                @endif
                            </div>
                            <div class="cont-box">
                                <p>{{ $val->content }}</p>
                            </div>
                            <div class="date-box">
                                <p>{{ $val->created_at }}</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            @endforeach
            {!! $data->render() !!}
        @endif
        </section>
@endsection
