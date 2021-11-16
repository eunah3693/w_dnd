// 햄버거 메뉴 애니메이션
$(function () {
    $(".ham-icon").on("click", function () {
        $(".ham-menu-bg").fadeIn();
        $(".ham-menu").fadeIn(500);

        // $('.ham-menu').animate({
        //     width: "toggle"
        // });
        // // $("html, body").css({"overflow":"hidden", "height":"100%"});
        // $(".ham-menu").bind("touchmove", function(e) {
        //     e.preventDefault();
        // });
        // $(".ham-menu").bind("touchmove", function(e) {
        //     e.stopPropagation();
        // });
    });
    $(".close-icon").on("click", function () {
        $(".ham-menu-bg").fadeOut();
        $(".ham-menu").fadeOut(500);

        // $('.ham-menu').animate({
        //     width: "toggle"
        // });
        // $("html, body").css({"overflow":"auto", "height":"auto"});
        // $(".ham-menu").unbind('touchmove');
    });
});
// 검색바
$(function () {
    var $searchToggle = $(".search-toggle");

    $searchToggle.on("click", function (event) {
        var $target = $(this);
        var $container = $target.closest(".search-wrapper");

        // $(".search-toggle")

        if (!$container.hasClass("active")) {
            $container.addClass("active");
            event.preventDefault();
            $(".logo-icon").fadeOut();
            //console.log($target, $target.closest(".input-holder").length);
        } else if ($container.hasClass("active")) {
            $(".logo-icon").fadeIn();
            $container.removeClass("active");
            //console.log($target, $target.closest(".input-holder").length);
        }
    });
});
// 슬라이드
$(function () {
    if (typeof Swiper == "function") {
        var swiper = new Swiper(".swiper-container", {
            autoHeight: true,
            loop: $(this).find("swiper-slide").length > 1 ? true : false,
            pagination: {
                el: ".swiper-pagination",
            },
        });
    }
});
// 레이어 팝업

function layerPopupOpen(title, subtitle, nxtBtn) {
    var $panel = $(".popup_panel");
    var $panelContents = $panel.find(".popup_contents");

    if ($panelContents.outerWidth() < $(document).width()) {
        $panelContents.css(
            "margin-left",
            "-" + $panelContents.outerWidth() / 2 + "px"
        );
    } else {
        $panelContents.css("left", "0px");
    }
    // 레이어 팝업 열기
    $panel.fadeIn();
    $(".popup-title").text(title);
    $(".popup-subtitle").text(subtitle);
    $("#btn_popup_next").text(nxtBtn);
    // $('.popup_contents').html(popupCont);

    // $('.popup-contents').html(contents);
}
function layerPopupClose() {
    var $panel = $(".popup_panel");
    $panel.fadeOut();
    $(".popup_contents h2").removeClass("on");
}

// 두번째 팝업
function layerPopup2Open(title, subtitle, nxtBtn) {
    var $panel = $(".popup_panel2");
    console.log($panel);
    var $panelContents = $panel.find(".popup_contents");

    if ($panelContents.outerWidth() < $(document).width()) {
        $panelContents.css(
            "margin-left",
            "-" + $panelContents.outerWidth() / 2 + "px"
        );
    } else {
        $panelContents.css("left", "0px");
    }
    // 레이어 팝업 열기
    $panel.fadeIn();
    $(".popup-title").text(title);
    $(".popup-subtitle").text(subtitle);
    $("#btn_popup_next2").text(nxtBtn);
    // $('.popup-contents').html(contents);
}
$("#btn_popup_close2").on("click", layerPopup2Close);

$("#btn_popup_next2").click(function () {
    $(location).attr("href", "/mypet");
});

function layerPopup2Close() {
    var $panel = $(".popup_panel2");
    $panel.fadeOut();
}

$(document)
    .ready(function () {
        $("#progress_loading").hide(); //첫 시작시 로딩바를 숨겨준다.
    })
    .ajaxStart(function () {
        $("#progress_loading").show(); //ajax실행시 로딩바를 보여준다.
    })
    .ajaxStop(function () {
        $("#progress_loading").hide(); //ajax종료시 로딩바를 숨겨준다.
    });

// 가로스크롤 휠
$(function () {
    $(".filter-scroll").on("mousewheel", function (e) {
        var wheelDelta = e.originalEvent.wheelDelta;
        e.preventDefault();
        $(this).scrollLeft(-wheelDelta + $(this).scrollLeft());
    });
});

// 알람 있는지 가져오기
$.ajax({
    headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
    type: "POST", //요청 메소드 방식
    url: "/notification/get_check",
    dataType: "json", //서버가 요청 URL을 통해서 응답하는 내용의 타입
    success: function (result) {
        if (result.is_check == true) {
            $(".is_notification").addClass("n-active");
        } else {
            $(".is_notification").removeClass("n-active");
        }
    },
    error: function (a, b, c) {
        console.log(a + b + c);
    },
});

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    console.log(name)
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
        console.log(regex)
    return results == null
        ? ""
        : decodeURIComponent(results[1].replace(/\+/g, " "));
}
function getParameterByNameWithLike(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    console.log(name)
    var regex = new RegExp("[\\?&]" + name + "(?:.*)=([^&#]*)"),
        results = regex.exec(location.search);
        console.log(regex)
    return results == null
        ? ""
        : decodeURIComponent(results[1].replace(/\+/g, " "));
}

// 뉴스피드 도전미션 버튼 네비게이터
$(function () {
    $(".page-navigator-button").click(function () {
        $(".page-navigator-bg").fadeToggle();
        $(this).toggleClass("page-navigator-button-after");
    });
});

//펫필터
$(function () {
    $(".pet-label").click(function () {
        $(this).toggleClass("button-active");
    });
});

// 신고 버튼
function setReport(post_idx) {
    var title = "해당 게시물을 신고 할까요?";
    var subtitle = "신고하시는 사유를 선택 해 주세요";
    var nxtBtn = "신고";

    layerPopupOpen(title, subtitle, nxtBtn);
    $(".popup-contents").html(
        '<form method="POST" action="/api/post/set_report">' +
            '<div class="form_line" >' +
            '<input type="radio" id="op1" name="msg" value="부적절한 게시물입니다."> ' +
            '<label for="op1">부적절한 게시물입니다.</label>' +
            "</div>" +
            '<div class="form_line" >' +
            '<input type="hidden" name="post_idx" value="' +
            post_idx +
            '">' +
            '<input type="radio" id="op2" name="msg" value="기타">' +
            '<label for="op2">기타</label> <br>' +
            "</div>" +
            '<div class="popup-btn-lists"><a href="javascript:void(0)" id="btn_popup_close">닫기</a>' +
            '<button class="btn-confirm popup-btn" id="btn_popup_next" type="button">신고하기</button></div></form>'
    );
    var url ='/api/post/set_report';
    $(".popup_contents h2").addClass("on");
    $("#btn_popup_close").on("click", layerPopupClose);
    $("#btn_popup_next").on("click", function () {
        console.log($("input:radio[name='msg']:checked").val(), post_idx);
        var data = {
            post_idx: post_idx,
            msg: $("input:radio[name='msg']:checked").val(),
        };
        ajaxWithUrlAndPostIdx(url, data);
        layerPopupClose();
    });
}
// 게시물 삭제
function deleteComment(post_idx) {
    var title = "해당 댓글을 삭제 할까요?";
    var subtitle = "";
    var nxtBtn = "삭제";
    $(".popup-contents").html(
        '<form method="POST" action="/api/post/delete">' +
            '<input type="hidden" name="post_idx" value="' +
            post_idx +
            '">' +
            '<div class="popup-btn-lists"><a href="javascript:void(0)" id="btn_popup_close">닫기</a>' +
            '<button class="btn-confirm popup-btn" type="submit">삭제하기</button></div></form>'
    );

    layerPopupOpen(title, subtitle, nxtBtn);
    $("#btn_popup_close").on("click", layerPopupClose);
}

function setComment(idx) {
    $(location).attr('href','/post_detail?post_idx='+ idx +'&comment=true');
}
// 게시물 좋아요
function setLike(post_idx, id) {
    var url = "/api/post/set_like";
    var data = { post_idx: post_idx };

    ajaxWithUrlAndPostIdx(url, data);

    // 로그인 여부 확인 필요
    if ($(id).data('like') == true) {
        var like_number = $(id).parents(".like").children(".like_number");
        $(id).data('like', false);
        like_number.text(Number(like_number.text()) - 1);
        $(id).attr("src",'/image/n-heart.svg');
    } else {
        // 추가
        var like_number = $(id).parents(".like").children(".like_number");
        $(id).data('like', true);
        $(id).attr("src",'/image/n-heart-p.svg');
        like_number.text(Number(like_number.text()) + 1);
        // 추가
    }
}

// 게시물 북마크
function setBookMark(post_idx, id) {
    var url = "/api/post/set_bookmark";
    var data = { post_idx: post_idx };
    ajaxWithUrlAndPostIdx(url, data);
    if ($(id).hasClass("deactive")) {
        $(id).addClass("active");
        $(id).removeClass("deactive");
        $(id).attr("src",'/image/n-bookmark-p.svg');
    } else {
        $(id).removeClass("active");
        $(id).addClass("deactive");
        $(id).attr("src", '/image/n-bookmark.svg');
    }
}

function setReplyLike(post_idx, id, main_post_idx) {
    var url = "/api/post/set_reply_like";
    var data = {
        post_idx: post_idx,
        main_post_idx: main_post_idx,
    };
    if ($(id).hasClass("active-l") === false) {
        $(id).addClass("active-l");
    } else {
        $(id).removeClass("active-l");
    }
    ajaxWithUrlAndPostIdx(url, data);
}
function ajaxWithUrlAndPostIdx(url, data) {
    $.post(url, data, function (res) {
        if (res.msg) {
            alert(res.msg);
        }
    });
}

//네비게이션 하단 바 클릭 시 링크 이동 방지 + alert 창
$(".guest").on("click", function membersOnly(e) {
    e.preventDefault();
    var result = confirm("로그인 해주세요");
    if (result) {
        location.href = "/login";
    }
});

$(".mission_pet_check").on("click", function membersOnly(e) {
    console.log(this.href);
    var url = this.href;
    e.preventDefault();
    $.get("/api/my/pets/count").done(function (result) {
        if (result.count === 0) {
            layerPopup2Open("펫 등록을 안하셨나요?", "", "등록하기");
            $(".popup-contents").html(
                "펫 등록 후 <br> 미션 및 이벤트에 참여해보세요!"
            );
            $(".popup-contents").addClass("txtcenter-class");
            $(".popup-subtitle").addClass("padding-class");
        } else {
            location.href = url;
        }
    });
});
// 앱에서 호출하는 거..
function onPageFinished() {
    var uuid = window.localStorage.getItem("uuid");
    // 자동로그인까지 진행함...
    if (uuid != null) {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            data: { uuid: uuid },
            url: "/device/uuid",
            success: function (res) {
                console.log(res.status);
                if (res.status == 200) location.reload();
            },
        });
    }
}
function openLink(url) {
    if (/com.dndlifecare/i.test(navigator.userAgent)) {
        app_openExternal(url);
    } else {
        window.open(url);
    }
}
function openAppGallery(idx, init) {
    if (/com.dndlifecare/i.test(navigator.userAgent)) {
        $.get('/api/files/post/'+idx, function(res){
            if(res.status == 200 && res.urls)
            {
                var data = {
                    urls : res.urls,
                    init : init
                }
                if (typeof(app_openGallery) == 'function') {
                    app_openGallery(data);
                }
            }
        });

    } else {
        //앱이 아닐경우 처리 안함
    }
}
