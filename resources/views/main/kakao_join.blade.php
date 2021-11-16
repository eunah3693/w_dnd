<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=720, user-scalable=no"/>
    <title>DND @yield('title')</title>
    <link rel="shortcut icon" href="/image/favicon.png">
    <link rel="icon" href="/image/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/image/favicon.png">
    <link rel="stylesheet" href="/css/DND-STYLE/common.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/xeicon@2.3.3/xeicon.min.css">
    <link rel="stylesheet" href="/css/DND-STYLE/join.css">
    <link rel="apple-touch-icon" sizes="57x57" href="/image/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/image/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/image/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/image/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/image/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/image/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/image/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/image/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/image/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/image/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/image/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/image/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/image/favicon/favicon-16x16.png">
    <link rel="manifest" href="/image/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div id="join_data">
    <header>
        <nav class="nav-top default">
            <ul>
                <li>
                    <div class="ham-wrapper">
                        <img class="back-icon" src="/image/back.svg" alt="">
                    </div>
                </li>
                <li class="logo-icon">간편 회원 가입</li>
            </ul>
        </nav>
    </header>
    <article>
        <section class="user-info-section">
            <form action="/api/join/social/{{ $id }}" method="post" id="join_form">
                <fieldset class="info">
                    @csrf
                </fieldset>
                <fieldset class="chkbox-list">
                    <div class="chkbox_wrap">
                        <div class="chkallbox_line chk1">
                            <input class="chk all chk1" id="allagree1" name="all_agree" type="checkbox" value="6">
                            <img src="/image/icon/check_no.svg" alt="동의여부" class="chkall_box chk1">
                            <label for="allagree1"><span class="fw">이용약관 전체 동의(필수)</span></label><br>

                        </div>
                        <div class="line"></div>

                        <div class="chkbox_line chk1">
                            <input class="chk ele chk1" id="cb5"  name="privacy_agree" type="checkbox" value="5">
                            <img src="/image/icon/small_check_no.svg" alt="동의여부" class="chk_box">
                            <label for="cb5"><span> 개인정보처리방침 동의 (필수)</span></label>
                            <div class="detail" onclick="termsLayerPopup('개인정보처리방침')">[ 보기 ]</div>
                        </div>
                        <div class="chkbox_line chk1">
                            <input class="chk ele chk1" id="cb6"  name="terms_agree" type="checkbox" value="6">
                            <img src="/image/icon/small_check_no.svg" alt="동의여부" class="chk_box">
                            <label for="cb6"><span> 이용약관 동의  (필수)</span></label>
                            <div class="detail" onclick="termsLayerPopup('이용약관')">[ 보기 ]</div>
                        </div>

                    </div>
                    <div class="chkbox_wrap">
                        <div class="chkallbox_line chk2">
                            <input class="chk all chk2" id="allagree2" name="all_agree" type="checkbox" value="6">
                            <img src="/image/icon/check_no.svg" alt="동의여부" class="chkall_box chk2">
                            <label for="allagree2"><span  class="fw">정보 제공 수신 동의(선택)</span></label><br>

                        </div>
                        <div class="line"></div>
                        <div class="chkbox_line chk2">
                            <input class="chk ele chk2" id="cb1"  name="sms_agree" type="checkbox" value="1">
                            <img src="/image/icon/small_check_no.svg" alt="동의여부" class="chk_box">
                            <label for="cb1"><span> SMS 동의</span></label>

                        </div>
                        <div class="chkbox_line chk2">
                            <input class="chk ele chk2" id="cb2"  name="email_agree" type="checkbox" value="2">
                            <img src="/image/icon/small_check_no.svg" alt="동의여부" class="chk_box">
                            <label for="cb2"><span> 이메일 동의</span> </label>
                        </div>
                        <div class="chkbox_line chk2">
                            <input class="chk ele chk2" id="cb3"  name="push_agree" type="checkbox" value="3">
                            <img src="/image/icon/small_check_no.svg" alt="동의여부" class="chk_box">
                            <label for="cb3"><span> 앱푸시 동의</span></label>
                        </div>
                        <div class="chkbox_line chk2">
                            <input class="chk ele chk2" id="cb4"  name="alimtalk_agree" type="checkbox" value="4">
                           <img src="/image/icon/small_check_no.svg" alt="동의여부" class="chk_box">
                            <label for="cb4"><span> 알림톡 동의</span></label>
                        </div>

                    </div>
                </fieldset>
                <input type="hidden" name="birth" id="birth">
                <input type="hidden" name="name" id="name">
                <input type="hidden" name="sex" id="sex">
                <button class="save-btn" type="submit">
                회원가입
                </button>
            </form>
        </section>
    </article>
</div>
<div class="popup_panel_terms clearboth">
    <div class="popup_bg"></div>
    <div class="popup_contents_terms">
        <h2 class="popup-title">이용약관</h2>
        <p class="popup-subtitle"></p>
        <div class="main-contents-terms">
        </div>
        <div class="btn-lists">
            <a href="javascript:void(0)" class="close-btn"  onclick="termsLayerPopupClose()">닫기</a>
        </div>
    </div>
</div>
 <!-- kcp끝 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="/js/DND-JS/join_app.js"></script>
@if (session('alert')) <x-alert :message="@session('alert')" /> @endif
<script src="/js/DND-JS/common.js"></script>
</body>
</html>
