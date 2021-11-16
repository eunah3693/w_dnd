// 필터 적용 시 액티브 클래스 넣었다 빼기
$(function(){
    $('.horizontal-scroll-menu').children('button').click(function() {
        $(this).toggleClass('filter-active');
    });
});

