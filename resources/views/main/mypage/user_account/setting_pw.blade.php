@extends('main.layouts.layout')

@section('title', '패스워드 변경')
@section('nav', 100004)

@section('top_back', '/my')

@section('css')
<link rel="stylesheet" href="css/DND-STYLE/setting.css">

@endsection

@section('js')
<script src="/js/DND-JS/setting_pw.js"></script>
@if (session('change_pw'))
<script>
alert('임시비밀번호입니다. 변경해주세요.');
</script>
{{ Session::forget('change_pw') }}
@endif
@endsection

@section('content')
    <section class="user-info-section" style= "height: 100vh;">
        <form action="/api/my/update_auth" method="post">
            @csrf
            <fieldset >
                <div class="label">
                    새패스워드 입력
                </div>
                <input type="password" required name="pw"  class="pw">
                <div class="label">
                    새패스워드 확인
                </div>
                <input type="password" required name="rpw" >
            </fieldset>
            <button class="save-btn" type="submit">
                저장하기
            </button>
        </form>
    </section>
@endsection




