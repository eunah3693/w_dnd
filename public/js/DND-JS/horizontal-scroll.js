// 스크롤 아래방향으로 갈 때 숨기고 위로 올라갈 때 나타내기
$(function(){
    var lastScrollTop = 0;
    var delta = 15;
    $(window).scroll(function(event) {
        var st = $(this).scrollTop();
        if(Math.abs(lastScrollTop - st) <= delta )
            return;
        if((st > lastScrollTop) && (lastScrollTop > 0)) {
            $(".horizontal-scroll-menu").css("top", "0");
        } else {
            $(".horizontal-scroll-menu").css("top", "127px");
        }
        lastScrollTop = st;
    });
  });
  // 가로스크롤 휠
  $(function(){
    $(".filter-scroll").on('mousewheel',function(e){
      var wheelDelta = e.originalEvent.wheelDelta;
        e.preventDefault();
        $(this).scrollLeft(-wheelDelta + $(this).scrollLeft());
    });
  });
  //미션 누르면 오른쪽에 하위 항목 나타나기
  // 파라미터가 없을때 로딩시 인풋박스 모두 체크
$(function(){
    if(!getParameterByNameWithLike('tag'))
    {
        $('.filter-scroll .box-radio-input input').prop('checked', true);
    }
    if($(".input-mission").is(":checked")){
        $('.input-hide').css('visibility','visible');
    }else{
        $('.input-hide').css('visibility','hidden');
    }

    $('.box-radio-input input').click( function() {
        if(this.value == '미션')
        {
            if($(this).is(":checked")) $('.input-hide input').prop('checked', true);
            else $('.input-hide input').prop('checked', false);
        }
        $('form').submit();
    });
});


