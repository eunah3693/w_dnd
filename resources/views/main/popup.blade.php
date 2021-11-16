<!-- 메인 레이아웃 -->
@extends('main.layouts.layout')

<!-- html head title과 상단 탑 네비에 타이틀 사용 -->
@section('title', '회원 가입')

<!-- 버튼 타입인지 -->
@section('top_back', '/login')

<!-- 해당페이지에서만 사용하는 css -->
@section('css')
<link rel="stylesheet" href="css/DND-STYLE/join.css">
@endsection

<!-- 해당페이지에서만 사용하는 js -->
@section('js')
<script src="/js/DND-JS/join.js"></script>

@endsection

<!-- 컨텐츠 내용-->
@section('content')
    <section class="user-info-section">
        <form action="/join" method="post">
            <fieldset class="info">
                @csrf
                <label><p>닉네임&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</p> <input type="text" name="nickname" required><p class="confirm-text yes">사용 가능한 닉네임 입니다.</p><p class="confirm-text no">이미 사용중인 닉네임입니다.</p></label><br>
                <label><p>이메일&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: </p> <input type="text" name="email" required><p class="confirm-text yes ">사용 가능한 이메일 입니다.</p><p class="confirm-text no">이미 사용중인 닉네임입니다.</p></label><br>
                <label><p>비밀번호&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</p> <input type="password" name="password" required><p class="confirm-text yes">6자 이상 특수기호 1자 이상을 포함해주세요.</p><p class="confirm-text no">사용 불가능한 비밀번호 입니다.</p></label><br>
                <label><p>비밀번호&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</p> <input type="password" name="rpassword" required><p class="confirm-text yes">비밀번호가 일치합니다.</p><p class="confirm-text no">일치하지 않는 비밀번호 입니다.</p></label><br>
                <label><p>핸드폰 번호&nbsp:</p> <input type="tel" name="tel" required><button type=button>인증하기</button></label><br>


            </fieldset>
            <fieldset class="chkbox-list">

            <div class="chkbox-wrapper">
            <input class="chk ele" id="cb1"  name="sms_agree" type="checkbox" value="1"><label for="cb1"> <span> SMS 동의</span></label> <br>
            </div>
                <input class="chk ele" id="cb2"  name="email_agree" type="checkbox" value="2"><label for="cb2"><span>메일 동의</span> </label> <br>
                <input class="chk ele" id="cb3"  name="push_agree" type="checkbox" value="3"><label for="cb3"> <span>앱푸시 동의</span></label> <br>
                <input class="chk ele" id="cb4"  name="alimtalk_agree" type="checkbox" value="4"> <label for="cb4"><span>알림톡 동의</span></label> <br>
                <input class="chk ele" id="cb5"  name="privacy_agree" type="checkbox" value="5">  <label for="cb5"><span>개인정보처리방침 동의 (필수)</span></label><br>
                <input class="chk ele" id="cb6"  name="terms_agree" type="checkbox" value="6"><label for="cb6"> <span>이용약관 동의  (필수)</span></label> <br>
                <input class="chk all" id="allagree" name="all_agree" type="checkbox" value="6"><label for="allagree"><span>전체 동의</span></label>


            </fieldset>

            <button class="save-btn" type="submit">
            회원가입
            </button>
        </form>
    </section>
@endsection
