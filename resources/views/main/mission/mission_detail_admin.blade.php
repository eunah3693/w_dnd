@extends('main.layouts.layout')

@section('top_back', '/mission')
@section('nav', 100001)

@section('title', '도전미션 상세페이지')

@section('css')
<link rel="stylesheet" href="/css/DND-STYLE/mission_detail.css">
@endsection

@section('js')
<script src="/js/DND-JS/mission_detail.js"></script>
@endsection

@section('content')
<section class="top-description">
    @if($mission_pool->category != '스토리미션')
    <img src="/files/{{ $mission_pool->main_file_idx }}" alt="">
    @endif
    <!-- <button class="challenge" onclick="alert('!')">미션 도전</button> -->
</section>
<section class="middle-description">
    <div class="cont-box ms">
        <h2 class="md-h2">{!! preg_replace("/\]/", "]</span>", preg_replace("/\[/", "<span>[", $mission_pool->title)) !!}</h2>
        <h3 class="md-h3">{{ $mission_pool->sub_title }}</h2>
        <div class="treat"><p>보상 {{ $mission_pool->point }}</p><img class="t-icon" src="/image/icon/icon_treat.svg" alt=""> </div>
        <div class="difficulty md-div">
            <div class="difficulty-wrapper">
                <img src="/image/difficulty{{$mission_pool->difficulty}}.svg" alt="">
            </div>
        </div>
        <div class="story-board md-div">
        <p>
            <span>
            {!! $mission_pool->content !!}
            </span>
        </p>
        </div>
        {{-- 동영상 --}}
        <div class="goal-div md-div">
            <div class="goal-title">
                <div class="goal-cont">
                    <div class="arrow-left">
                        <!-- <img src="image/left-arrow.svg" alt=""> -->
                    </div>
                    <div class="arrow-right">
                        <!-- <img src="image/right-arrow.svg" alt=""> -->
                    </div>
                    <div class="cam-icon">
                        <img src="/image/cam-icon.svg" alt="">
                    </div>
                    <p>{{ $mission_pool->goal }}</p>
                </div>
            </div>
            <div class="ex-video">{!! $mission_pool->youtube !!}</div>
        </div>
        {{-- 이런 아이들에게 좋아요 --}}
        @if($mission_pool->target)
        <div class="target-div md-div">
            <div class="target-title">
                <div>
                    <img src="/image/target.svg" alt="">
                </div>
            </div>
                <div class="target-circle">
                    @foreach ($target as $t)
                    <div>
                        <p>{{ $t }}</p>
                    </div>
                    @endforeach
                </div>
        </div>
        @endif
        @if($mission_pool->how)
        <div class="how-div md-div">
            <div class="how-title">
                <p>
                    HOW?
                </p>
            </div>
            <div class="how-cont">
            <p>{!! nl2br($mission_pool->how) !!}</p>
            </div>
        </div>
        @endif
        <div class="tips-div md-div">
            <div class="tips-title">
                <p>
                    Tips!
                </p>
            </div>
            <div class="how-cont" id="mission_tips">
                <p>{!! nl2br($mission_pool->tips) !!}</p>
                <p class="md-hidden-p">{!! nl2br($mission_pool->tips2) !!}</p>
            </div>
            <div class="tips-btn">
                <div class="tips-open">
                    <div class="tips-wrapper">
                        <img src="/image/unfold.svg" alt="">
                    </div>
                </div>
                <div class="tips-close hidden">
                    <div class="tips-wrapper">
                        <img src="/image/fold.svg" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="tips-hidden-div md-div">
          <div class="tips-hidden-title">
                <p>
                    Tips!
                </p>
            </div>
            <div class="how-cont">
                <p>
                1. 환경의 사회화는 다양한 일상 소리에 대해 무던해지고 익숙하게 만드는 것입니다. <br>
                2. 엘리베이터 소리, 초인종 소리, 천둥소리, 바람소리, 진공청소기 소리, TV소리, 휴대폰 벨소리, 자동차소리 등 일상에 자주 들릴 법한 소리를 들려주세요. <br>
                3. 낯선 소리에 적응하게 되면 분리불안, 공격성을 예방할 수 있습니다.
                </p>
            </div>
        </div> -->
        <!-- <div class="c">{!! $mission_pool->content !!}</div> -->

    </div>
</section>
<a class="post-link-btn mission_pet_check" style="color: #fff" onclick="alert('임시 페이지에선 도전이 불가능합니다.')" class="challenge">미션 도전</a>
<div class="button-box ">
    <a class="surf" href="/newsfeed_cards?mission_pool_idx={{ $mission_pool->idx }}" > 다른 댕집사 게시물 보러가기</a>
</div>
@endsection
