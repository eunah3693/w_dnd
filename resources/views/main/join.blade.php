<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=720, user-scalable=no"/>
    <title>DND @yield('title')</title>
    <link rel="shortcut icon" href="/image/favicon.png">
    <link rel="icon" href="/image/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/image/favicon.png">
    <link rel="stylesheet" href="css/DND-STYLE/common.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/xeicon@2.3.3/xeicon.min.css">
    <link rel="stylesheet" href="css/DND-STYLE/join.css">
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
                    <a class="ham-wrapper" href="/login">
                        <img class="back-icon" src="/image/back.svg" alt="">
                    </a>
                </li>
                <li class="logo-icon">회원 가입</li>
            </ul>
        </nav>
    </header>
    <article>
        <section class="user-info-section">
            <form action="/api/join" method="post" id="join_form">
                <fieldset class="info">
                    @csrf
                    <div class="label">
                        닉네임 <p class="confirm-text nickname"></p>
                    </div>
                    <input  placeholder="닉네임을 입력해주세요." type="text" name="nickname" onchange="nickname_chk()" id="nickname" >
                    <div class="label">
                        이메일 <p class="confirm-text email "></p>
                    </div>
                    <input  placeholder="이메일을 입력해주세요." type="text" name="email" id="email" onchange="email_chk()" >
                    <div class="label">
                        비밀번호 <p class="confirm-text pw"></p>
                    </div>
                    <input placeholder="숫자, 영문자, 특수문자 조합으로 8자리 이상" type="password" name="password" id="pw" onkeyup="join_pw_chk()" >
                    <div class="label">
                        비밀번호&nbsp 확인
                    </div>
                    <input placeholder="비밀번호 확인해주세요." type="password" name="rpassword"  id="r_pw" onkeyup="join_pw_chk()" >
                    <br> <br>
                    <div class="label_right">
                        <button type=button onclick="auth_type_check();" id="user_auth_btn">본인 인증하기</button>
                    </div>
                    <br>
                    <div class="label">
                        핸드폰 <p class="confirm-text tel"></p>
                        <input type="text" name="tel" id="tel" style="background-color: #ececec"  placeholder="본인인증을 해주세요." readonly  required>
                    </div>
                    <div class="label">
                        <input type="hidden" name="birth" id="birth" style="background-color: #ececec"  placeholder="본인인증을 해주세요."  readonly>
                    </div>
                    <div class="label">
                        <input type="hidden" name="sex" id="sex" style="background-color: #ececec"  placeholder="본인인증을 해주세요."   readonly>
                    </div>
                <input type="hidden" name="name" id="name">

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
 <!-- kcp -->
 <div align="center" id="cert_info">
    <form name="form_auth" method="post">
        <input type="hidden" name="ordr_idxx" class="frminput" value="" size="40" readonly="readonly" maxlength="40"/>

        <!-- 요청종류 -->
        <input type="hidden" name="req_tx"       value="cert"/>
        <!-- 요청구분 -->
        <input type="hidden" name="cert_method"  value="01"/>
        <!-- 웹사이트아이디 : ../cfg/cert_conf.php 파일에서 설정해주세요 -->
        <input type="hidden" name="web_siteid"   value="J20082105830"/>
        <!-- 노출 통신사 default 처리시 아래의 주석을 해제하고 사용하십시요
             SKT : SKT , KT : KTF , LGU+ : LGT
        <input type="hidden" name="fix_commid"      value="KTF"/>
        -->
        <!-- 사이트코드 : ../cfg/cert_conf.php 파일에서 설정해주세요 -->
        <input type="hidden" name="site_cd"      value="A96PH" />
        <!-- Ret_URL : ../cfg/cert_conf.php 파일에서 설정해주세요 -->
        <input type="hidden" name="Ret_URL"      value="https://dndlifecare.com/kcp/SMART_ENC/smartcert_proc_res.php" />
        <!-- cert_otp_use 필수 ( 메뉴얼 참고)
             Y : 실명 확인 + OTP 점유 확인 , N : 실명 확인 only
        -->
        <input type="hidden" name="cert_otp_use" value="Y"/>
        <!-- cert_enc_use 필수 (고정값 : 메뉴얼 참고) -->
        <input type="hidden" name="cert_enc_use" value="Y"/>
        <!-- 리턴 암호화 고도화 -->
        <input type="hidden" name="cert_enc_use_ext" value="Y"/>

        <!-- cert_able_yn input 비활성화 설정 -->
        <input type="hidden" name="cert_able_yn" value=""/>

        <input type="hidden" name="res_cd"       value=""/>
        <input type="hidden" name="res_msg"      value=""/>

        <!-- up_hash 검증 을 위한 필드 -->
        <input type="hidden" name="veri_up_hash" value=""/>

        <!-- web_siteid 을 위한 필드 -->
        <input type="hidden" name="web_siteid_hashYN" value="Y"/>

        <!-- 가맹점 사용 필드 (인증완료시 리턴)-->
        <input type="hidden" name="param_opt_1"  value="opt1"/>
        <input type="hidden" name="param_opt_2"  value="opt2"/>
        <input type="hidden" name="param_opt_3"  value="opt3"/>
    </form>

</div>

<header id="kcp_auth" style="display: none">
    <nav class="nav-top default">
        <ul>
            <li></li>
            <li class="logo-icon">본인 인증</li>
            <li  style="font-size: 30px;text-align: center">
                <a href="/join" style="display: block;margin-top: 9px;">X</a>
            </li>
        </ul>
    </nav>
</header>
<iframe id="kcp_cert" name="kcp_cert" width="100%" height="1500px" frameborder="0" scrolling="no" style="display:none;margin-top: 150px;"></iframe>
 <!-- kcp끝 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="/js/DND-JS/join.js"></script>
<script src="/js/DND-JS/common.js"></script>
@if (session('alert')) <x-alert :message="@session('alert')" /> @endif
</body>
</html>
