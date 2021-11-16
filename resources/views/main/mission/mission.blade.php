@extends('main.layouts.layout')

@section('title', '도전미션')
@section('nav', 100001)

@section('css')
<link rel="stylesheet" href="css/DND-STYLE/mission.css">
@endsection
@section('js')
<script src="/js/DND-JS/mission.js"></script>
@if (session('confirm'))
<script>
    if(confirm("{{ session('confirm') }}")){
        window.location = "{{ session('next_url') }}";
    }
</script>
@endif
@endsection


@section('content')
<div class="container">
    <ul class="tab_title">
        <li class="on"><a href="/mission">전체 미션</a></li>
        <li><a href="/mission?type=1">찜한 미션</a></li>
    </ul>
    <div class="tab_cont">
        <div class="on tab-one">
            @if ( $user_stary_mission->is_story_mission_complete != 1 )
                @isset($story_mission->idx)
                <div class="story-mission-section">
                    @if ($story_mission->idx == 1)
                    <a class="mission_pet_check" href="/story_first?idx={{ $story_mission->mission_idx }}">
                    @else
                    <a href="/mission_detail?idx={{ $story_mission->mission_idx }}">
                    @endif
                        <div class="story-mission-div">
                            <img src="/files/{{ $story_mission->main_file_idx }}" alt="">
                            <div class="story-title-wrapper">
                                <p>스토리미션</p>
                                <p class="story-subtitle">{{ $story_mission->title }}</p>
                            </div>

                        </div>
                    </a>
                </div>
                @endisset
            @endif
            @foreach ($missions as $k => $v)
            <section class="daily-mission-section mission-section">
                @if ($k == '일일미션')
                <div class="m-title-div">
                    <img src="/image/daily.svg" alt="">
                </div>
                @elseif ($k == '주간미션')
                <div class="m-title-div">
                    <img src="/image/weekly.svg" alt="">
                </div>
                @else ($k == '자유미션')
                <div class="m-title-div">
                    <img src="/image/event.svg" alt="">
                </div>
                @endif

                @foreach ($v as $item)
                <div class="daily-mission-box mission-box">
                    <a href="/mission_detail?idx={{ $item->mission_idx }}">
                        <img src="/thum/{{ $item->thum_file_idx }}" alt="">
                        <div class="cont-box">
                            <h2>{{ $item->title }}</h2>
                            <div class="detail">{{ $item->preview }}</div>
                            <div class="counting">
                                <!-- <div><img src="image/clock.svg" alt=""></div> -->
                                <div>미션 완료: {{ $item->post }} / {{ $item->participation_count }}번</div>
                            </div>
                            <div class="treat"><img class="t-icon" src="/image/icon/icon_treat.svg" alt=""> <p>{{ $item->point }}</p></div>
                        </div>
                    </a>
                    @if ($item->user_bookmark == 0)
                        <div class="bookmark-wrapper" {{ $k == '일일미션' ? "data-val=$item->idx data-daily=1" : "data-val=$item->mission_idx data-daily=0" }}><img src="image/bookmark.svg" alt=""></div>
                    @else
                        <div class="bookmark-wrapper"{{ $k == '일일미션' ? "data-val=$item->idx data-daily=true" : "data-val=$item->mission_idx data-daily=false" }}><img src="image/bookmark-c.svg" alt=""></div>
                    @endif

                    @if ($k != '자유미션' && $user_stary_mission->is_story_mission_complete == 0 )
                        <div class="bg-layer locker"><img src="image/missionclear.svg" alt="">
                        <p class="locker-phrase">스토리 미션을 완료해야 도전 할 수 있어요!</p>
                    </div>
                    @elseif ( $item->post >= $item->participation_count )
                    <div class="bg-layer">
                        <img src="image/locker.svg" alt="">
                    </div>
                    @endif
                </div>
                @endforeach
            </section>
            @endforeach
        </div>
        <div class="tab-two">
            @if (count($missions) != 0)
            @foreach ($missions as $k => $v)
            <section class="daily-mission-section mission-section">
            @if ($k == '일일미션')
                <div class="m-title-div">
                    <img src="/image/daily-title.svg" alt="">
                </div>
                @elseif ($k == '주간미션')
                <div class="m-title-div">
                    <img src="/image/weekly-title.svg" alt="">
                </div>
                @else ($k == '자유미션')
                <div class="m-title-div">
                    <img src="/image/event-title.svg" alt="">
                </div>
                @endif

                @foreach ($v as $item)
                    @if ($item->user_bookmark == 1)
                    <div class="daily-mission-box mission-box mission-liked">
                        <a href="/mission_detail?idx={{ $item->mission_idx }} ">
                            <img src="/thum/{{ $item->thum_file_idx }}" alt="">
                            <div class="cont-box">
                                <h2>{{ $item->title }}</h2>
                                <div class="detail">{{ $item->preview }}</div>
                                <div class="counting">
                                    <!-- <div><img src="image/clock.svg" alt=""></div> -->
                                    <div>미션 완료: {{ $item->post }} / {{ $item->participation_count }}번</div>
                                </div>
                            </div>
                            <!-- <div class="cont-box">
                                <h2>{{ $item->title }}</h2>
                                <p class="detail">{{ $item->preview }}</p>
                                <p class="counting">{{ $item->post }}개 / {{ $item->participation_count }}개</p>
                            </div> -->
                        </a>


                        <!-- @if ($item->user_bookmark == 0)
                        <div class="bookmark-wrapper" {{ $k == '일일미션' ? "data-val=$item->idx data-daily=1" : "data-val=$item->mission_idx data-daily=0" }}> <img src="image/bookmark.svg" alt=""></div>
                    @else
                        <div class="bookmark-wrapper"{{ $k == '일일미션' ? "data-val=$item->idx data-daily=true" : "data-val=$item->mission_idx data-daily=false" }}><img src="image/bookmark-c.svg" alt=""></div>
                    @endif

                    @if ($k != '자유미션' && $user_stary_mission->is_story_mission_complete == 0 )
                        <div class="bg-layer"><img src="image/missionclear.svg" alt=""></div>
                    @elseif ( $item->post >= $item->participation_count )
                    <div class="bg-layer"><img src="image/locker.svg" alt=""></div>
                    @endif
 -->


                        <div class="bookmark-wrapper" {{ $k == '일일미션' ? "data-val=$item->idx data-daily=true" : "data-val=$item->mission_idx data-daily=false" }}> <img src="image/bookmark-c.svg" alt=""></div>
                        @if ($k != '자유미션' && $user_stary_mission->is_story_mission_complete == 0 )
                            <div class="bg-layer locker"><img src="image/missionclear.svg" alt="">
                            <p class="locker-phrase">스토리 미션을 완료해야 도전 할 수 있어요!</p>
                        </div>
                        @elseif ( $item->post >= $item->participation_count )
                            <div class="bg-layer"><img src="image/locker.svg" alt="">
                        </div>
                        @endif
                    </div>
                    @endif
                @endforeach
            </section>
            @endforeach
            @else
            @endif
        </div>
    </div>
</div>
@endsection
