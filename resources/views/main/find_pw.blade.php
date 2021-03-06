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
    <nav class="nav-top default">
            <ul>
                <li>
                    <a class="ham-wrapper" href="/login">
                        <img class="back-icon" src="/image/back.svg" alt="">
                    </a>
                </li>
                <li class="logo-icon">?????????/???????????? ??????</li>
            </ul>
        </nav>
    <article>
        <section class="user-info-section" id="auth_section">
                <button type=button class="save-btn" onclick="auth_type_check();" id="user_auth_btn">??????????????????</button>
        </section>
        <form action="/api/pw/update" method="post">
        <section class="user-info-section"  id="pw_section" style="display: none">
            <fieldset class="info">
                <input name="idx" id="user_idx" type="hidden"  value="">
                <label><input id="user_id" readonly></label><br>
                <label><input placeholder="????????????" type="password" name="pw" id="pw" onkeyup="join_pw_chk()" required><p class="confirm-text pw"></p></label><br>
                <label><input placeholder="???????????? ??????" type="password" name="rpw"  id="r_pw" onkeyup="join_pw_chk()" required></label><br>
            </fieldset>
            <button type="submit" class="save-btn">????????????</button>
        </section>
        </form>
    </article>
</div>
@if (session('alert')) <x-alert :message="@session('alert')" /> @endif
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
<iframe id="kcp_cert" name="kcp_cert" width="100%" height="1500px" frameborder="0" scrolling="no" style="display:none"></iframe>
 <!-- kcp??? -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="/js/DND-JS/find_pw.js"></script>
    <script src="/js/DND-JS/common.js"></script>
</body>
</html>
