function sharePage(id) {
    var title = "해당 게시물을 공유할까요?";
    var subtitle = "";
    var nxtBtn = "공유!";
    var url = "https://dndlifecare.com" + $(id).data("url");
    layerPopupOpen(title, subtitle, nxtBtn);
    $(".popup-contents").html(
        '<div class="share-wrapper">' +
            '  <div class="share-links" onclick="facebookShare(\'' +
            $(id).attr("id") +
            "')\">" +
            '    <a><img src="/image/facebook.svg" alt=""></a>' +
            "  </div>" +
            '  <div class="share-links" id="create-kakao-link-btn">' +
            '    <a><img src="/image/kakaotalk.svg" alt=""></a>' +
            "  </div>" +
            '  <div class="share-links last-link" onclick="TourUrlCopy(\'' +
            $(id).attr("id") +
            "')\">" +
            '    <a><img class="urlimg" src="/image/copyurl.svg" alt=""></a>' +
            "  </div></div>" +
            '<div class="popup-btn-lists"><a href="javascript:void(0)" id="btn_popup_close">닫기</a>'
    );

    kakaoShare(url);
    $("#btn_popup_close").on("click", layerPopupClose);
}
function kakaoShare(url) {
    Kakao.Link.createDefaultButton({
        container: "#create-kakao-link-btn",
        objectType: 'feed',
        content:{
            title :'DND LIFECARE',
            description: '반려동물과 보호자 모두의  삶이 더 행복해질 수 있도록',
            imageUrl:'https://dndlifecare.com/image/og.jpg',
            link: {
                mobileWebUrl: 'https://dndlifecare.com',
                webUrl: 'https://dndlifecare.com',
            }
        },
        buttons: [
            {
                title: '자세히보기',
                link: {
                    mobileWebUrl: url,
                    webUrl: url,
                },
            },
        ],
    });
}

function facebookShare(id) {
    var url = "https://dndlifecare.com" + $("#" + id).data("url");
    var encodeUrl = encodeURIComponent(url);
    var facebook = "https://www.facebook.com/sharer/sharer.php?u=";
    openLink(facebook + encodeUrl);
}

function TourUrlCopy(id) {
    var addrTxt = "https://dndlifecare.com" + $("#" + id).data("url");
    var isIE = document.all ? true : false;
    var isIE = false;
    var agent = navigator.userAgent.toLowerCase();
    if (
        (navigator.appName == "Netscape" &&
            navigator.userAgent.search("Trident") != -1) ||
        agent.indexOf("msie") != -1
    ) {
        isIE = true;
    }
    if (isIE) {
        if (confirm("이 글의 주소를 클립보드에 복사하시겠습니까?"))
            window.clipboardData.setData("Text", addrTxt);
    } else {
        temp = prompt("Ctrl+C를 눌러 주소를 클립보드로 복사하세요.", addrTxt);
    }
}

function getPageReload()
{
    var temp = [];
    $("li[id^=cards]").each(function () {
        temp.push($(this).data('idx'));
    })
    $.ajax({
        headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
        type: "POST", //요청 메소드 방식
        url: "/api/post/get_like",
        dataType: "json", //서버가 요청 URL을 통해서 응답하는 내용의 타입
        data: {idx_list: JSON.stringify(temp)},
        success: function (result) {
            data = JSON.parse(result.data);
            data.forEach(function (e) {
                $("li#cards_"+e.post_idx+" span.like_number").text(e.cnt);
                if(e.user == 1) {$("li#cards_"+e.post_idx+" .like img").attr('src','/image/n-heart-p.svg'); }
                else{ $("li#cards_"+e.post_idx+" .like img").attr('src','/image/n-heart.svg'); }
                if(e.book == 1) { $("li#cards_"+e.post_idx+" .bookmark img.xi-bookmark").attr('src','/image/n-bookmark-p.svg').attr('xi-bookmark active'); }
                else { $("li#cards_"+e.post_idx+" .bookmark img.xi-bookmark").attr('src','/image/n-bookmark.svg').attr('xi-bookmark deactive');  }
            });
        },
        error: function (a, b, c) {
            console.log(a + b + c);
        },
    });
}

window.onpageshow =  function(event) { // BFCahe
    if (event.persisted) {
       // window.location.reload();
       console.log('12');
       getPageReload()
    }else{} //새로운페이지
}
