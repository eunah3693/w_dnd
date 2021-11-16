@extends('main.layouts.layout')

@section('top_back', '/mission')
@section('nav', 100001)

@section('title', '도전미션 상세페이지')

@section('css')
<link rel="stylesheet" href="css/DND-STYLE/mission_detail.css">
@endsection

@section('js')
<script src="/js/DND-JS/mission_detail.js"></script>
@endsection

@section('content')
<section class="top-description">
    <img src="/files/{{ $mission->missionPool->main_file_idx }}" alt="">
    <!-- <button class="challenge" onclick="alert('!')">미션 도전</button> -->

{{-- 미션할수 없을때 --}}
@if ( $mission->post >= $mission->missionPool->participation_count )
    <span style="background-color: #fcca00;
    border: none;
    padding: 25px 0px;
    width: calc(720px * 0.9);
    border-radius: 20px;
    font-weight: bold;
    position: fixed;
    top: 132px;
    text-align: center;
    left: calc( 50% - 324px);
    cursor: pointer;
    font-weight: bold;
    font-size: 22px;">모두 완료했어요</span>
{{-- 쿨다운 시간이 적용되어있는 지 확인 --}}
@elseif ($mission->missionPool->cooldown && $mission->user_mission_datetime )
    <br><span id="count" style="background-color: #fcca00;
    border: none;
    padding: 25px 0px;
    width: calc(720px * 0.9);
    border-radius: 20px;
    font-weight: bold;
    position: fixed;
    top: 132px;
    text-align: center;
    left: calc( 50% - 324px);
    cursor: pointer;
    font-weight: bold;
    font-size: 22px;"></span>
@else
<span style="background-color: #fcca00;
    border: none;
    padding: 25px 0px;
    width: calc(720px * 0.9);
    border-radius: 20px;
    font-weight: bold;
    position: fixed;
    top: 132px;
    text-align: center;
    left: calc( 50% - 324px);
    cursor: pointer;
    font-weight: bold;
    font-size: 22px;"><a href="/mission_post?mission_idx={{ $mission->idx }}" class="challenge">미션 도전</a></span>
@endif

<input type="hidden" id="user_mission_datetime" value="{{ $mission->user_mission_datetime }}">
<input type="hidden" id="cooldown" value="{{ $mission->missionPool->cooldown }}">
</section>
<section class="middle-description">
    <div class="cont-box ms">
        <h2 class="c">{{ $mission->missionPool->title }}</h2>
        <div class="c">{!! $mission->missionPool->content !!}</div>
    </div>
</section>
<div class="button-box ">
    <a class="surf" href="/newsfeed_cards?mission_pool_idx={{ $mission->missionPool->idx }}" > 다른 댕집사 게시물 보러가기</a>
</div>
<script>

var _second = 1000;
var _minute = _second * 60;
var _hour = _minute * 60;
var _day = _hour * 24;

setInterval(function() {
    // 쿨타임 적용
    if($('#user_mission_datetime').val() && $('#cooldown').val())
    {
        var date = $('#user_mission_datetime').val().replace(/\-/g, '/');
        var mission_date = new Date(date);

        var cooldown = Number($('#cooldown').val());
        mission_date.setHours(mission_date.getHours() + cooldown);

        var now = new Date().getTime();
        var distance = mission_date.getTime() - now;

        if(mission_date.getTime() > now)
        {

            var hours = Math.floor((distance % _day) / _hour);
            var minutes = Math.floor((distance % _hour) / _minute);
            var seconds = Math.floor((distance % _minute) / _second);
            $('#count').text("아직할수없어요. " + hours + "시간 " + minutes + "분 " + seconds + "초 뒤에 도전할수 있어요.");
        }else{
            $('#count').html('<a href="/mission_post?mission_idx={{ $mission->idx }}" class="challenge">미션 도전</a>')
        }
    }
}, 1000);


</script>
@endsection
