@extends('main.simple')

@section('css_before')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/Mention.js-master/Mention.js-master/recommended-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/slick-carousel/slick.css') }}">
    <link rel="stylesheet" href="/js/plugins/magnific-popup/magnific-popup.css">
<style>
.active{
    background: red;
}
#my_modal {
    display: none;
    width: 100%;
    height: 100vh;
    border: 1px solid #888;
    border-radius: 3px;
}
.hashtag{
    color: red;
}
#my_modal .modal_close_btn {
    position: absolute;
    top: 10px;
    right: 10px;
}
</style>
@endsection

@section('js_after')
<script type="text/javascript" src="{{ asset('js/plugins/Mention.js-master/Mention.js-master/bootstrap-typeahead.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/Mention.js-master/Mention.js-master/mention.js') }}"></script>
<script type="text/javascript" src="http://hammerjs.github.io/dist/hammer.min.js"></script>
<script type="text/javascript" src="{{ asset('js/plugins/slick-carousel/slick.js') }}"></script>

<script>
function hammerIt(elm) {
    hammertime = new Hammer(elm, {});
    hammertime.get('pinch').set({
        enable: true
    });

    var posX = 0,
        posY = 0,
        scale = 1,
        last_scale = 1,
        last_posX = 0,
        last_posY = 0,
        max_pos_x = 0,
        max_pos_y = 0,
        transform = "",
        el = elm;

    hammertime.on('doubletap pan pinch panend pinchend pinchout pinchstart swipeleft', function(ev) {
        if (ev.type == "doubletap") {
            console.log("2")
            transform =
                "translate3d(0, 0, 0) " +
                "scale3d(2, 2, 1) ";
            scale = 2;
            last_scale = 2;
            try {
                if (window.getComputedStyle(el, null).getPropertyValue('-webkit-transform').toString() != "matrix(1, 0, 0, 1, 0, 0)") {
                    transform =
                        "translate3d(0, 0, 0) " +
                        "scale3d(1, 1, 1) ";
                    scale = 1;
                    last_scale = 1;
                }
            } catch (err) {}
            el.style.webkitTransform = transform;
            transform = "";
        }
        if( ev.type == "pinchstart"){
           // jQuery(elm).css('position','fixed').css('z-index','99999')
        }
        if( ev.type == "swipeleft"){
            el.src = 'files/171';
        }

        //pan
        if (scale != 1) {
            posX = last_posX + ev.deltaX;
            posY = last_posY + ev.deltaY;
            max_pos_x = Math.ceil((scale - 1) * el.clientWidth / 2);
            max_pos_y = Math.ceil((scale - 1) * el.clientHeight / 2);
            if (posX > max_pos_x) {
                posX = max_pos_x;
            }
            if (posX < -max_pos_x) {
                posX = -max_pos_x;
            }
            if (posY > max_pos_y) {
                posY = max_pos_y;
            }
            if (posY < -max_pos_y) {
                posY = -max_pos_y;
            }
        }


        //pinch
        if (ev.type == "pinch") {
            scale = Math.max(.999, Math.min(last_scale * (ev.scale), 4));
        }

        if(ev.type == "pinchend"){
            transform =
                        "translate3d(0, 0, 0) " +
                        "scale3d(1, 1, 1) ";
                    scale = 1;
                    last_scale = 1;
            //alert("닫음!")
        }

        if (scale != 1) {
            transform =
                "translate3d(" + posX + "px," + posY + "px, 0) " +
                "scale3d(" + scale + ", " + scale + ", 1)";
        }

        if (transform) {
            el.style.webkitTransform = transform;
        }
    });
}
hammerIt(document.getElementById("square"))
jQuery(document).ready(function(){

    jQuery("#full").focus();
    jQuery("#full").mention({
        delimiter: '@',
            users: [{
                name: 'Lindsay Made',
                username: 'LindsayM',
                image: 'http://placekitten.com/25/25'
            }, {
                name: 'Rob Dyrdek',
                username: 'robdyrdek',
                image: 'http://placekitten.com/25/24'
            }]
    });
jQuery('.lazy').slick({
    dots: true,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    adaptiveHeight: true
});

var txt = jQuery('#text').text();
console.log(txt);
txt = txt.replace(/([^\&])(#\S+)/g, "$1<a class='hashtag'>$2</a>")
jQuery('#text').html(txt);
});
</script>
@endsection
@section('content')
    <!-- Hero -->
    메인페이지@@
    <form action="/files" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button type="submit">전송</button>
	</form>

<div id="text">
    내용내용 #안녕 #내용 내용
</div>
<textarea id="full"></textarea>

<div id="card"></div>

<br>
<img id="square" class="square" src="files/175"  width="100%" >
    <!-- END Page Content -->
@endsection
