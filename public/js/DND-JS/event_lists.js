// 탭 메뉴
$(function(){
    var index = getParameterByName('type');
    var index = index == 1 ? 1:0;
    $(".tab_title li").removeClass("on");
    $(".tab_title li").eq(index).addClass("on");
    $(".tab_cont > div").hide();
    $(".tab_cont > div").eq(index).show();
});
