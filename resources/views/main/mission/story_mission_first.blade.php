@extends('main.layouts.layout')

@section('top_back', '/mission')
@section('nav', 100001)
@section('title', '도전미션 상세페이지')

@section('css')
<link rel="stylesheet" href="css/DND-STYLE/mission_detail.css">
@endsection

@section('js')
@endsection

@section('content')
{{-- <section class="middle-description">
    <div class="cont-box">
        <h2>스토리 진행할 펫을 선택하세요!</h2>
        <br>
        <div class="story-mission-btn-group pet-btn">
            <button class="btn">새로 등록하러 가기</button>
            <button class="btn">선택 안할래요..</button>
        </div>
    </div>
</section> --}}
<section class="middle-description" style="margin-top: 10%; width: 77%;">
    <form action="/api/mission/storytype/insert" method="post">
        @csrf
    <div class="cont-box" style="line-height: 1.6;">
        <h2>[스토리미션 시작하기]</h2>
        <h2>1. 내 반려견 연령을 선택하세요!</h2>
        <p>( *선택연령에 따라 스토리 내용이 달라집니다.)</p>
        <br>
        <div class="story-mission-btn-group">
            <label class="box-radio-input"><input type="radio" name="story_mission_type" value="0"><span>퍼피 1년이내</span></label>
            <label class="box-radio-input"><input type="radio" name="story_mission_type" checked value="1"><span>성견 1~8년 이내</span></label>
            <label class="box-radio-input"><input type="radio" name="story_mission_type" value="2"><span>노령견 8년 이상</span></label>
            <input name="mission_idx" type="hidden" value="{{ Request::input('idx') }}">
        </div>
        <br>
        <h2>2. 반려견을 선택하세요.</h2>
        <br>
        <div class="pet-filter-story clearboth">
            @foreach ($pets as $item)
                <label class="box-radio-input pets">
                    <input type="radio" name="pet_idx" {{ $loop->index == 0 ? 'checked':'' }} value="{{ $item->idx }}">
                    <div>
                        @if ($item->file_idx)
                        <img src="/files/{{ $item->file_idx }}" alt="{{ $item->pet }}">
                        @else
                        <img src="/image/icon/pet_profile.svg" alt="{{ $item->pet }}">
                        @endif
                    </div>
                    <p style="text-align: center;">{{ $item->name }}</p>
                </label>
            @endforeach
        </div>
    </div>
    <button type="submit" class="form-submit-btn">미션완료!</button>
    </form>
</section>
@endsection
