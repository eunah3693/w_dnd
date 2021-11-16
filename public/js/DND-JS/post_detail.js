$("#textarea").mentiony({
    onDataRequest: function (mode, keyword, onDataRequestCompleteCallback) {
        $.ajax({
            method: "post",
            url: "/api/get_user_list",
            data: { text: keyword },
            dataType: "json",
            success: function (response) {
                var data = response.data;
                data = jQuery.grep(data, function (item) {
                    return (
                        item.name.toLowerCase().indexOf(keyword.toLowerCase()) >
                        -1
                    );
                });
                onDataRequestCompleteCallback.call(this, data);
            },
        });
    },
    timeOut: 500, // Timeout to show mention after press @
    debug: 0, // show debug info
});

function setComment(reply_idx, user_name) {
    $("#post_idx").val(reply_idx);
    $("#user_name").text(user_name);
    $(".post-comment-info").css("display", "");
}
function setCommentClose(post_idx) {
    $("#post_idx").val(post_idx);
    $(".post-comment-info").css("display", "none");
}

function setCommentForm()
{
    var txt_input = $("#textarea").val();
    var blank_pattern = /^\s+|\s+$/g;
    if( txt_input.replace( blank_pattern, '' ) == "" ){
        alert("내용을 입력해주세요.")
    }else if(txt_input.length == 0)
    {
        alert("내용을 입력해주세요.")
    }else{
        var data = $("#comment_form").serialize();
        $.post('/api/post/set_reply', data, function(res)
        {
            // 진동
            navigator.vibrate = navigator.vibrate || navigator.webkitVibrate || navigator.mozVibrate || navigator.msVibrate;
            if (navigator.vibrate) {navigator.vibrate(500); }
            if(res.status == 200)
            {
                $('.comment-img').css('display','none');            //사진삭제
                var file = '/image/mp_top_profile_icon.svg';
                if(res.data.user.file_idx != null && res.data.user.file_idx != '') file = '/thum/'+res.data.user.file_idx;

                var list = '<li>'
                            +'<div>'
                            +'<div class="comment-title';
                            if(res.data.main_post_idx != res.data.parent_idx) list += ' sub-comment'
                            list += '">'
                                    +'<div class="image-box">'
                                    +'<a href="/myfeed?user_idx='+res.data.user.idx+'">'
                                    +'<img src="'+file+'" alt="">'
                                    +'</a>'
                                    +'</div>'
                                    +'<div class="comment-likes" onclick="setReplyLike('+res.data.idx+', this,'+res.data.main_post_idx+')"><i class="xi-heart xi-2x"></i></div>'
                                    +'<div class="content-box">'
                                    +'<p class="nickname">'+res.data.user.nickname+'</p>'
                                    +'<p class="content">'+res.data.content+'</p>'
                                    +'<p class="bottom"><span class="comment-date">'+res.data.date+'</span>';
                            if(res.data.main_post_idx == res.data.parent_idx) list += '<a data-commentidx="'+res.data.idx+'" onclick="setComment('+res.data.idx+',\''+res.data.user.nickname+'\')" class="comment">답글달기</a>';
                            list += '<button class="comment-report" onclick="setReport('+res.data.idx+')">신고</button>'
                                    +'<button class="comment-delete" onclick="deleteComment('+res.data.idx+')">삭제</button>'
                                    +'</p>'
                                    +'</div>'
                                    +'<ul id="comment_list_ul'+res.data.idx+'"></ul>'
                                    +'</div>'
                                    +'</div>'
                                    +'</li>';

                if(res.data.main_post_idx == res.data.parent_idx) $('#comment_list_ul').append(list);
                else $('#comment_list_ul'+res.data.parent_idx).append(list); setCommentClose(res.data.main_post_idx);

                window.scrollTo(0, document.getElementById("comment_list_ul").scrollHeight + 150);
                $('#textarea').val('');
                $('.mentiony-content').html('');
                $('.comment-number').text(Number($('.comment-number').text())+1);
            }
        });
    }
}
$('.mentiony-content').attr('onkeypress','commentOnkeypress()');

function commentOnkeypress(){
    if(event.keyCode == 13) {
        event.preventDefault();
        setCommentForm();
    }

}
