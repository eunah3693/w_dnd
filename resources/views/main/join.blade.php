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
                <li class="logo-icon">?????? ??????</li>
            </ul>
        </nav>
    </header>
    <article>
        <section class="user-info-section">
            <form action="/api/join" method="post" id="join_form">
                <fieldset class="info">
                    @csrf
                    <div class="label">
                        ????????? <p class="confirm-text nickname"></p>
                    </div>
                    <input  placeholder="???????????? ??????????????????." type="text" name="nickname" onchange="nickname_chk()" id="nickname" >
                    <div class="label">
                        ????????? <p class="confirm-text email "></p>
                    </div>
                    <input  placeholder="???????????? ??????????????????." type="text" name="email" id="email" onchange="email_chk()" >
                    <div class="label">
                        ???????????? <p class="confirm-text pw"></p>
                    </div>
                    <input placeholder="??????, ?????????, ???????????? ???????????? 8?????? ??????" type="password" name="password" id="pw" onkeyup="join_pw_chk()" >
                    <div class="label">
                        ????????????&nbsp ??????
                    </div>
                    <input placeholder="???????????? ??????????????????." type="password" name="rpassword"  id="r_pw" onkeyup="join_pw_chk()" >
                    <br> <br>
                    <div class="label_right">
                        <button type=button onclick="auth_type_check();" id="user_auth_btn">?????? ????????????</button>
                    </div>
                    <br>
                    <div class="label">
                        ????????? <p class="confirm-text tel"></p>
                        <input type="text" name="tel" id="tel" style="background-color: #ececec"  placeholder="??????????????? ????????????." readonly  required>
                    </div>
                    <div class="label">
                        <input type="hidden" name="birth" id="birth" style="background-color: #ececec"  placeholder="??????????????? ????????????."  readonly>
                    </div>
                    <div class="label">
                        <input type="hidden" name="sex" id="sex" style="background-color: #ececec"  placeholder="??????????????? ????????????."   readonly>
                    </div>
                <input type="hidden" name="name" id="name">

                </fieldset>
                <fieldset class="chkbox-list">
                    <div class="chkbox_wrap">
                        <div class="chkallbox_line chk1">
                            <input class="chk all chk1" id="allagree1" name="all_agree" type="checkbox" value="6">
                            <img src="/image/icon/check_no.svg" alt="????????????" class="chkall_box chk1">
                            <label for="allagree1"><span class="fw">???????????? ?????? ??????(??????)</span></label><br>

                        </div>
                        <div class="line"></div>

                        <div class="chkbox_line chk1">
                            <input class="chk ele chk1" id="cb5"  name="privacy_agree" type="checkbox" value="5">
                            <img src="/image/icon/small_check_no.svg" alt="????????????" class="chk_box">
                            <label for="cb5"><span> ???????????????????????? ?????? (??????)</span></label>
                            <div class="detail" onclick="termsLayerPopup('????????????????????????')">[ ?????? ]</div>
                        </div>
                        <div class="chkbox_line chk1">
                            <input class="chk ele chk1" id="cb6"  name="terms_agree" type="checkbox" value="6">
                            <img src="/image/icon/small_check_no.svg" alt="????????????" class="chk_box">
                            <label for="cb6"><span> ???????????? ??????  (??????)</span></label>
                            <div class="detail" onclick="termsLayerPopup('????????????')">[ ?????? ]</div>
                        </div>

                    </div>
                    <div class="chkbox_wrap">
                        <div class="chkallbox_line chk2">
                            <input class="chk all chk2" id="allagree2" name="all_agree" type="checkbox" value="6">
                            <img src="/image/icon/check_no.svg" alt="????????????" class="chkall_box chk2">
                            <label for="allagree2"><span  class="fw">?????? ?????? ?????? ??????(??????)</span></label><br>

                        </div>
                        <div class="line"></div>
                        <div class="chkbox_line chk2">
                            <input class="chk ele chk2" id="cb1"  name="sms_agree" type="checkbox" value="1">
                            <img src="/image/icon/small_check_no.svg" alt="????????????" class="chk_box">
                            <label for="cb1"><span> SMS ??????</span></label>

                        </div>
                        <div class="chkbox_line chk2">
                            <input class="chk ele chk2" id="cb2"  name="email_agree" type="checkbox" value="2">
                            <img src="/image/icon/small_check_no.svg" alt="????????????" class="chk_box">
                            <label for="cb2"><span> ????????? ??????</span> </label>
                        </div>
                        <div class="chkbox_line chk2">
                            <input class="chk ele chk2" id="cb3"  name="push_agree" type="checkbox" value="3">
                            <img src="/image/icon/small_check_no.svg" alt="????????????" class="chk_box">
                            <label for="cb3"><span> ????????? ??????</span></label>
                        </div>
                        <div class="chkbox_line chk2">
                            <input class="chk ele chk2" id="cb4"  name="alimtalk_agree" type="checkbox" value="4">
                           <img src="/image/icon/small_check_no.svg" alt="????????????" class="chk_box">
                            <label for="cb4"><span> ????????? ??????</span></label>
                        </div>

                    </div>
                </fieldset>
                <button class="save-btn" type="submit">
                ????????????
                </button>
            </form>
        </section>
    </article>
</div>
<div class="popup_panel_terms clearboth">
    <div class="popup_bg"></div>
    <div class="popup_contents_terms">
        <h2 class="popup-title">????????????</h2>
        <p class="popup-subtitle"></p>
        <div class="main-contents-terms">
        </div>
        <div class="btn-lists">
            <a href="javascript:void(0)" class="close-btn"  onclick="termsLayerPopupClose()">??????</a>
        </div>
    </div>
</div>
 <!-- kcp -->
 <div align="center" id="cert_info">
    <form name="form_auth" method="post">
        <input type="hidden" name="ordr_idxx" class="frminput" value="" size="40" readonly="readonly" maxlength="40"/>

        <!-- ???????????? -->
        <input type="hidden" name="req_tx"       value="cert"/>
        <!-- ???????????? -->
        <input type="hidden" name="cert_method"  value="01"/>
        <!-- ????????????????????? : ../cfg/cert_conf.php ???????????? ?????????????????? -->
        <input type="hidden" name="web_siteid"   value="J20082105830"/>
        <!-- ?????? ????????? default ????????? ????????? ????????? ???????????? ??????????????????
             SKT : SKT , KT : KTF , LGU+ : LGT
        <input type="hidden" name="fix_commid"      value="KTF"/>
        -->
        <!-- ??????????????? : ../cfg/cert_conf.php ???????????? ?????????????????? -->
        <input type="hidden" name="site_cd"      value="A96PH" />
        <!-- Ret_URL : ../cfg/cert_conf.php ???????????? ?????????????????? -->
        <input type="hidden" name="Ret_URL"      value="https://dndlifecare.com/kcp/SMART_ENC/smartcert_proc_res.php" />
        <!-- cert_otp_use ?????? ( ????????? ??????)
             Y : ?????? ?????? + OTP ?????? ?????? , N : ?????? ?????? only
        -->
        <input type="hidden" name="cert_otp_use" value="Y"/>
        <!-- cert_enc_use ?????? (????????? : ????????? ??????) -->
        <input type="hidden" name="cert_enc_use" value="Y"/>
        <!-- ?????? ????????? ????????? -->
        <input type="hidden" name="cert_enc_use_ext" value="Y"/>

        <!-- cert_able_yn input ???????????? ?????? -->
        <input type="hidden" name="cert_able_yn" value=""/>

        <input type="hidden" name="res_cd"       value=""/>
        <input type="hidden" name="res_msg"      value=""/>

        <!-- up_hash ?????? ??? ?????? ?????? -->
        <input type="hidden" name="veri_up_hash" value=""/>

        <!-- web_siteid ??? ?????? ?????? -->
        <input type="hidden" name="web_siteid_hashYN" value="Y"/>

        <!-- ????????? ?????? ?????? (??????????????? ??????)-->
        <input type="hidden" name="param_opt_1"  value="opt1"/>
        <input type="hidden" name="param_opt_2"  value="opt2"/>
        <input type="hidden" name="param_opt_3"  value="opt3"/>
    </form>

</div>

<header id="kcp_auth" style="display: none">
    <nav class="nav-top default">
        <ul>
            <li></li>
            <li class="logo-icon">?????? ??????</li>
            <li  style="font-size: 30px;text-align: center">
                <a href="/join" style="display: block;margin-top: 9px;">X</a>
            </li>
        </ul>
    </nav>
</header>
<iframe id="kcp_cert" name="kcp_cert" width="100%" height="1500px" frameborder="0" scrolling="no" style="display:none;margin-top: 150px;"></iframe>
 <!-- kcp??? -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="/js/DND-JS/join.js"></script>
<script src="/js/DND-JS/common.js"></script>
@if (session('alert')) <x-alert :message="@session('alert')" /> @endif
</body>
</html>
