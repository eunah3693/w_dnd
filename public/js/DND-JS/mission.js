// 탭 메뉴
$(function(){
    var index = getParameterByName('type');
    var index = index == 1 ? 1:0;
    $(".tab_title li").removeClass("on");
    $(".tab_title li").eq(index).addClass("on");
    $(".tab_cont > div").hide();
    $(".tab_cont > div").eq(index).show();
});
// 찜하기 활성화 시 색상 바꾸기 + 찜한 항목 삭제하기
$(function(){
    $('.bookmark-wrapper').click( function() {
        var res = {mission_idx: $(this).data('val'), is_daily: $(this).data('daily')}
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: res,
            type: "POST", //요청 메소드 방식
            url:"/mission/bookmark",
            dataType:"json", //서버가 요청 URL을 통해서 응답하는 내용의 타입
            success : function(result){
                if(result.status != '200')
                {
                    alert(result.msg)
                }
            },
            error : function(a, b, c){
                alert(a + b + c);
            }
        });
        if($(this).html() == '<img src="image/bookmark.svg" alt="">' ) {
        $(this).html('<img src="image/bookmark-c.svg" alt="">');
        }
        else {
        $(this).html('<img src="image/bookmark.svg" alt="">');
        }
    });

    $('.mission-liked').children('button').click(function(){
        $(this).parent('.mission-liked').slideUp();
    });
});
// 30자 이상 입력 시 ...으로 반환
// $(function(){
//     $('.cont-box').each(function(){
//         var content = $(this).children('.detail');
//         var content_txt = content.text();
//         var content_txt_short = content_txt.substring(0,25)+"...";

//         if(content_txt.length >= 25){
//             content.html(content_txt_short)
//         }
//     });
