
$("#join_form").submit(function (e) {
    if($("input:checkbox[name='terms_agree']").is(":checked") == false
    || $("input:checkbox[name='privacy_agree']").is(":checked") == false ) {
        alert("필수항목을 체크해주세요.");
        return false;
    }
});

$(document).ready(function () {
    $(".chkall_box.chk1").click(function () {
        $(".chk.all.chk1").click();
    });
    $(".chkall_box.chk2").click(function () {
        $(".chk.all.chk2").click();
    });
    $(".chk_box").click(function () {
        $(this).parent().find(".chk.ele").click();
    });

    $("input:checkbox").change(function () {
        var chkLength = $(".ele.chk1:checked").length;
        var chkLength2 = $(".ele.chk2:checked").length;
        if ($(this).is(".chk.all.chk1")) {
            if ($(this).is(":checked")) {
                $(this)
                    .parent()
                    .find(".chkall_box")
                    .attr("src", "/image/icon/check_ok.svg");
                if (chkLength != 2) {
                    $(".chk.ele.chk1")
                        .prop("checked", true)
                        .parent()
                        .find(".chk_box")
                        .attr("src", "/image/icon/small_check_ok.svg");
                }
            } else {
                $(this)
                    .parent()
                    .find(".chkall_box")
                    .attr("src", "/image/icon/check_no.svg");
                $(".chk.ele.chk1").trigger("click");
            }
        } else if ($(this).is(".chk.ele.chk1")) {
            if ($(this).is(":checked")) {
                $(this)
                    .parent()
                    .find(".chk_box")
                    .attr("src", "/image/icon/small_check_ok.svg");

                if (chkLength == 2) {
                    $(".chk.all.chk1").trigger("click");
                }
            } else {
                $(this)
                    .parent()
                    .find(".chk_box")
                    .attr("src", "/image/icon/small_check_no.svg");
                if (chkLength != 2) {
                    $(".chk.all.chk1")
                        .prop("checked", false)
                        .parent()
                        .find(".chkall_box")
                        .attr("src", "/image/icon/check_no.svg");
                }
            }
        } else if ($(this).is(".chk.all.chk2")) {
            if ($(this).is(":checked")) {
                $(this)
                    .parent()
                    .find(".chkall_box")
                    .attr("src", "/image/icon/check_ok.svg");
                if (chkLength2 != 4) {
                    $(".chk.ele.chk2")
                        .prop("checked", true)
                        .parent()
                        .find(".chk_box")
                        .attr("src", "/image/icon/small_check_ok.svg");
                }
            } else {
                $(this)
                    .parent()
                    .find(".chkall_box")
                    .attr("src", "/image/icon/check_no.svg");
                $(".chk.ele.chk2").trigger("click");
            }
        } else if ($(this).is(".chk.ele.chk2")) {
            if ($(this).is(":checked")) {
                $(this)
                    .parent()
                    .find(".chk_box")
                    .attr("src", "/image/icon/small_check_ok.svg");

                if (chkLength2 == 4) {
                    $(".chk.all.chk2").trigger("click");
                }
            } else {
                $(this)
                    .parent()
                    .find(".chk_box")
                    .attr("src", "/image/icon/small_check_no.svg");
                if (chkLength2 != 4) {
                    $(".chk.all.chk2")
                        .prop("checked", false)
                        .parent()
                        .find(".chkall_box")
                        .attr("src", "/image/icon/check_no.svg");
                }
            }
        }
    });
});

// 이용약관 팝업
function termsLayerPopup(type) {
    var $panel = $(".popup_panel_terms");
    var $panelContents = $panel.find(".popup_contents_terms");

    if ($panelContents.outerWidth() < $(document).width()) {
        $panelContents.css(
            "margin-left",
            "-" + $panelContents.outerWidth() / 2 + "px"
        );
    } else {
        $panelContents.css("left", "0px");
    }
    // 레이어 팝업 열기
    $.post("/api/term", { type: type }, function (res) {
        if (res.status == 200) {
            $panel.fadeIn();
            console.log(res.data.content);
            $(".popup-title").html(type);
            $(".main-contents-terms").html(res.data.content);
        }
    });
}

function termsLayerPopupClose() {
    var $panel = $(".popup_panel_terms");
    $panel.fadeOut();
}
