@extends('admin.layouts.sidebar')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">Dashboard</h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">App</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Dashboard</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-6 col-xl-5">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">Welcome to your app</h3>
                    </div>
                    <div class="block-content">
                        <p class="font-size-sm text-muted">
                            <ul class="snsList">

                                <li>SNS 공유하기</li>

                                <li><a href="#" id="vIconTw" onclick="return false;">a</a></li>

                                <li><a href="#" id="vIconTg" onclick="return false;">b</a></li>

                                <li><a href="#" id="vIconFb" onclick="return false;">c</a></li>

                                <li><a href="#" id="vIconKs" onclick="return false;">d</a></li>

                            </ul>
                        </p>
                        <p class="font-size-sm text-muted">
                            Feel free to use any examples you like from the full versions to build your own pages. <strong>Wish you all the best and happy coding!</strong>
                        </p>
                        <script>
                            jQuery(window).ready(function(){

                                jQuery(".snsList li a").click(function(){

      shareAct(this);

  });

});

function shareAct(a){

  var snsCode = jQuery(a).attr('id');

  var cUrl = "https://telegram.me/share/";

  switch(snsCode){

      case"vIconTg":
          //텔레그램
          cUrl = 'https://telegram.me/share/url?url='+cUrl;
      break;

      case"vIconFb":
          //페이스북
          cUrl = 'http://www.facebook.com/sharer/sharer.php?u='+cUrl;
      break;

      case"vIconKs":
          //카카오스토리
          cUrl = 'https://story.kakao.com/share?url='+cUrl;
      break;

  }

  window.open(cUrl,'','width=600,height=300,top=100,left=100,scrollbars=yes');

}
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
