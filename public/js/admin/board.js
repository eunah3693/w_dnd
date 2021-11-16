$(function () {
    // 게시물 비저블
    if($(".btn_visible").length)
    $(".btn_visible").on("click", function (e) {
        if($(this).find('i').hasClass('fa-eye-slash')) {
            $(this).find('i').removeClass('fa-eye-slash');
            $(this).find('i').addClass('fa-eye');
        } else {
            $(this).find('i').removeClass('fa-eye');
            $(this).find('i').addClass('fa-eye-slash');
        }
        $.get('/api/admin/board/visible/'+$(this).data('idx')).done(function (r) {
            console.log(r);
        });
        e.preventDefault();
    });
    
    // 게시물 삭제
    if($(".btn_delete").length)
    $(".btn_delete").on("click", function (e) {
        if(confirm('삭제하시겠습니까?')) {
            location.href='/admin/board/delete/'+$(this).data('idx');
        }
        e.preventDefault();
    });
});