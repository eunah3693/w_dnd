@extends('main.layouts.layout')

@section('title', '계정 설정')
@section('nav', 100004)

@section('top_back', '/my')

@section('css')
<link rel="stylesheet" href="/css/DND-STYLE/setting.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('js')
<script src="/js/DND-JS/setting_account.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection

@section('content')
<form action="/api/my/update" method="post" enctype="multipart/form-data">
    @csrf
    <section class="profile-pic-section">
        <div class="pfofile_img_wrap">
            <input type="file" id="profile-pic" name="file" accept="image/*">
            <label class="profile-pic-label" for="profile-pic">
                <img id="img" src="{{ $data->file_idx ? '/files/'.$data->file_idx:'/image/icon/user_profile.svg' }}" alt="">
                <div class="btn_wrap">
                    <img @if($data->file_idx) src="/image/icon/user_icon_setting.svg" @else src="/image/icon/user_icon_plus.svg" @endif alt="설정" class="pet_icon_setting">
                </div>
            </label>
        </div>

    </section>
    <section class="user-info-section">
            <fieldset>
                <div class="label">
                    이름
                </div>
                <input type="text" name="nickname" value="{{ $data->nickname }}">
                <div class="label">
                    이메일
                </div>
                <input type="text" readonly value="{{ $data->email }}" class="bg_gray_input">
                <div class="label">
                    핸드폰
                </div>
                <input type="tel" readonly value="{{ $data->tel }}"  class="bg_gray_input">
                <div class="label">
                    주소
                </div>
                <input type="text" readonly value="">
                <textarea class="intro" style="resize: none; height:200px; " name="myfeed_contents">{{ $data->my_feed }}</textarea>
            </fieldset>
            <button class="save-btn" type="submit">
            저장하기
            </button>
        @if($data->is_sns != 1)
        <a href="/setting_pw">
            <div class="pw-btn">패스워드 변경하기 </div>
        </a>
        @endif
        <p class="out-user"><a href="/secession" class="btn">탈퇴하기</a></p>
    </section>
</form>
@endsection

