function openEventPopup(idx, treat) {
    var title = "지금 응모하시겠어요?";
    var subtitle = "";
    var nxtBtn = "";

    layerPopupOpen(title, subtitle, nxtBtn);
    $(".popup-contents").html(
        "<p>" +
            treat +
            "트릿이 차감됩니다</p>" +
            '<div class="popup-btn-lists"><a id="btn_popup_close">닫기</a>' +
            '<button class="btn-confirm popup-btn" onclick="joinEvent(' +
            idx +
            ')">응모하기</button></div>'
    );
    $("#btn_popup_close").on("click", layerPopupClose);
}
function joinEvent(idx) {
    var data = {
        event_idx: idx,
    };
    $.post(
        "/api/event",
        data,
        function (res) {
            if (res.status == 200) {
                if (
                    confirm(
                        "축하합니다! 당첨되었습니다. 주소지를 입력하러 가시겠습니까?"
                    )
                ) {
                    window.location = res.url;
                }
            } else {
                alert(res.msg);
            }
        },
        "json"
    );
    layerPopupClose();
}
//더보기 클릭시 슬라이드
$(function () {
    $(".review-box.plus").slideUp();

    $(".plus_review_wrap").click(function () {
        $(".review-box.plus").slideDown(500);
        $(this).fadeOut(500);
    });
});
