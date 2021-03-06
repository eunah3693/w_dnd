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
    <link rel="stylesheet" href="css/DND-STYLE/login.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/xeicon@2.3.3/xeicon.min.css">
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
    <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
    <script>
    // SDK??? ????????? ?????????. ????????? ?????? JavaScript ?????? ????????? ?????????.
    Kakao.init('11957eb969b57c54768c4fb033eaa8f8');
    </script>
</head>
<body>
    <article>
        <section class="logo">
            <a href="/"><img src="/image/login-logo.svg" alt=""></a>
        </section>
        <section class="login">
            <form action="/checklogin" method="POST">
                @csrf
                <fieldset>
                    <label>
                        <p>?????????</p>
                        <input type="text" name="id" placeholder="DNDlifecare@dnd.com"></label><br>
                    <label>
                        <p>????????????</p>
                        <input type="password" name="password" placeholder="??????, ??????, ???????????? ?????? 10??? ??????"></label><br>
                </fieldset>

                <script>
                    var idx = '{{Session::has('idx')}}';
                    if(idx){alert("?????? ?????????????????????.");window.location = '/';}
                    var msg = '{{Session::get('status')}}';
                    var exist = '{{Session::has('status')}}';
                    if(exist){
                        alert(msg);
                        window.location = '/login';
                    }
                </script>
                <button class="button login-btn" type="submit">
                ????????? ??????
                </button>
                <a class="button" id="custom-login-btn" href="javascript:loginWithKakao()">
                    <img src="/image/kakao_login_custom.png" >
                </a>
                <button class="join-btn " type="button">
                ????????? ???????????????? <span> ??? ?????? ?????????</span>
                </button>
                <button class="password-btn " type="button">
                ???????????? ??????
                </button>
                <button class="guest-btn " type="button">
                ??????????????? ????????????
                </button>
            </form>
        </section>
    </article>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="/js/DND-JS/login.js"></script>
    <script type="text/javascript">
        // function loginWithKakao() {
        //     // if(/com.dndlifecare/i.test(navigator.userAgent)) {
        //     //     window.location.href = '/MY_KAKAO_LOGIN_URL';
        //     //     return;
        //     // }else{
        //         location.href = '/login/kakao';
        //     // }
        // }

            function loginWithKakao() {
                Kakao.Auth.authorize({
                    redirectUri: 'https://dndlifecare.com/login/kakao/callback'
                })
            }


    </script>
     @if (session('alert')) <x-alert :message="@session('alert')" /> @endif
</body>
</html>

