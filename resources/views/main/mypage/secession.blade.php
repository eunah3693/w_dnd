@extends('main.layouts.layout')

@section('title', '탈퇴하기')
@section('nav', 100004)

@section('top_back', '/my')

@section('css')
<link rel="stylesheet" href="css/DND-STYLE/setting.css">
@endsection

@section('js')
@endsection

@section('content')
<form action="/api/secession" method="post" enctype="multipart/form-data">
    @csrf
    <section class="user-info-section">
            <fieldset>
                <div class="label">
                    회원님의 탈퇴 사유를 알려주세요.
                </div>
                <br>
                <div class="radio">
                    <input type="radio" name="text1" value="이용이 불편하고 장애가 많다."> <span>이용이 불편하고 장애가 많다.</span><br>
                    <input type="radio" name="text1" value="다른 사이트를 이용할 예정이다."> <span>다른 사이트를 이용할 예정이다.</span><br>
                    <input type="radio" name="text1" value="컨텐츠가 부족하다."> <span>컨텐츠가 부족하다.</span><br>
                    <input type="radio" name="text1" value="사용빈도가 적다."> <span>사용빈도가 적다.</span><br>
                    <input type="radio" name="text1" value="유저간에 트러블이 생겼다."> <span>유저간에 트러블이 생겼다.</span><br>
                    <input type="radio" name="text1" checked value="기타"> <span>기타</span><br>
                </div>
                <br>
                <div class="label">
                    개선사항
                </div>
                <textarea class="intro" style="resize: none; height:200px; " name="text2" placeholder="기타 의견을 입력해주세요."></textarea>
                <br>
                @if($user->is_sns != 1)
                <div class="label">
                    비밀번호
                </div>
                <input value="" type="password" name="pw" placeholder="본인확인을 위해 비밀번호를 입력해주세요.">
                @endif
            </fieldset>
            <button class="save-btn" type="submit">
            탈퇴하기
            </button>
    </section>
</form>
@endsection

