var _pw_chk = false; // 유효성 체크
var _ni_chk = false; // 유효성 체크
var _ph_chk = false; // 유효성 체크
var _em_chk = false; // 유효성 체크

$(document).on("click", ".ele", function () {
    // var totLength = $(".ele.chk1").length;
    // var chkLength = $(".ele.chk1:checked").length;
    // if (totLength > 0 && totLength == chkLength) {
    //     $(".chk.chk1").prop("checked", true);
    // } else {
    //     $(".chk.chk1").prop("checked", false);
    // }
});

$(document).ready(function () {
    init_orderid();
    // $("#allagree").click(function () {
    //     if ($(".all").is(":checked")) {
    //         $("input[type=checkbox]").prop("checked", true);
    //     } else {
    //         $("input[type=checkbox]").prop("checked", false);
    //     }
    // });
});

//비밀번호 유효성
function join_pw_chk() {
    var pwExt = /^(?=.*[a-zA-Z])(?=.*[!@#$%^*+=-])(?=.*[0-9]).{8,25}$/;

    var pw = $("#pw").val();
    var r_pw = $("#r_pw").val();

    // 조합 여부
    if (!pwExt.test(pw)) {
        $(".confirm-text.pw")
            .css("color", "#e02d2d")
            .text("숫자+영문자+특수문자 조합으로 8자리 이상");
        _pw_chk = false;
        return false;
    }

    // 비밀번호 확인
    if (pw != r_pw) {
        $(".confirm-text.pw")
            .css("color", "#e02d2d")
            .text("비밀번호가 서로 같지 않습니다.");
        _pw_chk = false;
        return false;
    }
    // 사용 가능 문자
    $(".confirm-text.pw")
        .css("color", "#0088ff")
        .css("float", "right")
        .text("사용가능합니다.");
    _pw_chk = true;
}

//닉네임 유효성
function nickname_chk() {
    var nickname = $("#nickname").val();

    var data = { nickname: nickname };

    $.post(
        "/api/join/check/nickname",
        data,
        function (res) {
            if (res.data == 0) {
                _ni_chk = true;
                $(".confirm-text.nickname")
                    .css("color", "#0088ff")
                    .text("사용 가능한 닉네임 입니다.");
            } else {
                $(".confirm-text.nickname")
                    .css("color", "#e02d2d")
                    .text("이미 사용중인 닉네임입니다.");
                _ni_chk = false;
            }
        },
        "json"
    );
}
//휴대폰 번호 유효성
function ph_chk() {
    var tel = $("#tel").val();
    var data = { tel: tel };

    $.post(
        "/api/join/check/tel",
        data,
        function (res) {
            if (res.data == 0) {
                _ph_chk = true;
                $(".confirm-text.tel")
                    .css("color", "#0088ff")
                    .text("사용 가능한 전화번호 입니다.");
            } else {
                $(".confirm-text.tel")
                    .css("color", "#e02d2d")
                    .text("이미 사용중인 전화번호입니다.");
                _ph_chk = false;
            }
        },
        "json"
    );
}
//이메일 주소 유효성
function email_chk() {
    var regExp = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i;

    var mail = $("#email").val();
    var data = { email: mail };
    if (!regExp.test(mail)) {
        $(".confirm-text.email")
            .css("color", "#e02d2d")
            .text("이메일 주소를 확인하세요");
        _em_chk = false;
        return false;
    }
    $.post(
        "/api/join/check/email",
        data,
        function (res) {
            if (res.data == 0) {
                _em_chk = true;
                $(".confirm-text.email")
                    .css("color", "#0088ff")
                    .text("사용 가능한 이메일 입니다.");
            } else {
                $(".confirm-text.email")
                    .css("color", "#e02d2d")
                    .text("이미 사용중인 이메일입니다.");
                _em_chk = false;
            }
        },
        "json"
    );
}

// 인증창 종료후 인증데이터 리턴 함수
function auth_data(frm) {
    console.log(frm);
    if (frm.code == 00) {
        console.log("성공");
        $("#tel").val(frm.phone_no);
        var tel = frm.phone_no;
        var data = { tel: tel };
        $.post(
            "/api/join/check/tel",
            data,
            function (res) {
                if (res.data == 0) {
                    _ph_chk = true;
                    var sex = frm.sex_code == '01' ? 'M':'F';
                    $("#name").val(frm.user_name);
                    $("#birth").val(frm.birth_day);
                    $("#sex").val(sex);
                    $("#user_auth_btn").text("인증완료").attr("disabled", true);
                } else {
                    alert('이미 사용중인 전화번호입니다.');
                    location.reload();
                    _ph_chk = false;
                }
            },
            "json"
        );
    }else{
        location.reload();
    }
    //스마트폰 처리
    if (
        (navigator.userAgent.indexOf("Android") > -1 ||
            navigator.userAgent.indexOf("iPhone") > -1 ||
            navigator.userAgent.indexOf("iOS") > - 1)
    ) {
        document.getElementById("cert_info").style.display = "";
        document.getElementById("kcp_cert").style.display = "none";
        document.getElementById("join_data").style.display = "";
        document.getElementById("kcp_auth").style.display = "none";
    }

}

// 인증창 호출 함수
function auth_type_check() {
    var auth_form = document.form_auth;
    console.log(auth_form);

    if (auth_form.ordr_idxx.value == "") {
        alert("요청번호는 필수 입니다.");
        return false;
    } else {
        if (
            (navigator.userAgent.indexOf("Android") > -1 ||
            navigator.userAgent.indexOf("iPhone") > -1 ||
            navigator.userAgent.indexOf("iOS") > - 1 )
        ) {
            auth_form.target = "kcp_cert";
            document.getElementById("kcp_cert").style.display = "";
            document.getElementById("cert_info").style.display = "none";
            document.getElementById("kcp_auth").style.display = "";
            document.getElementById("join_data").style.display = "none";
        } else {
            var return_gubun;
            var width = 410;
            var height = 500;

            var leftpos = screen.width / 2 - width / 2;
            var toppos = screen.height / 2 - height / 2;

            var winopts =
                "width=" +
                width +
                ", height=" +
                height +
                ", toolbar=no,status=no,statusbar=no,menubar=no,scrollbars=no,resizable=no";
            var position = ",left=" + leftpos + ", top=" + toppos;
            var AUTH_POP = window.open("", "auth_popup", winopts + position);

            auth_form.target = "auth_popup";
        }
        auth_form.action = "/kcp/SMART_ENC/smartcert_proc_req.php"; // 인증창 호출 및 결과값 리턴 페이지 주소
        auth_form.submit();
        return true;

    }
    return false;
}

// 요청번호 생성 예제 ( up_hash 생성시 필요 )
init_orderid();
function init_orderid() {
    var today = new Date();
    var year = today.getFullYear();
    var month = today.getMonth() + 1;
    var date = today.getDate();
    var time = today.getTime();

    if (parseInt(month) < 10) {
        month = "0" + month;
    }

    var vOrderID = year + "" + month + "" + date + "" + time;

    document.form_auth.ordr_idxx.value = vOrderID;
}
// $("#join_form").submit(function (e) {
//     if (_pw_chk && _ni_chk && _em_chk && _ph_chk) {
//         return true;
//     } else {
//         alert("필수입력란을 확인해주세요.");
//     }
//     return false;
// });

$("#join_form").submit(function (e) {
    if($("input:checkbox[name='terms_agree']").is(":checked") == false
    || $("input:checkbox[name='privacy_agree']").is(":checked") == false ) {
        alert("필수항목을 체크해주세요.");
        return false;
    }
    if (_pw_chk && _ni_chk && _em_chk && _ph_chk) {
        return true;
    } else if (!_ni_chk){
        alert("닉네임을 다시 확인해주세요.");
        $('#nickname').focus();
        return false;
    } else if (!_em_chk){
        alert("이메일을 다시 확인해주세요.");
        $('#email').focus();
        return false;
    } else if (!_pw_chk){
        alert("비밀번호를 다시 확인해주세요.");
        $('#pw').focus();
        return false;
    } else if (!_ph_chk){
        alert("핸드폰 번호를 다시 확인해주세요.");
        return false;
    } else{
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
                    .attr("src", "image/icon/check_ok.svg");
                if (chkLength != 2) {
                    $(".chk.ele.chk1")
                        .prop("checked", true)
                        .parent()
                        .find(".chk_box")
                        .attr("src", "image/icon/small_check_ok.svg");
                }
            } else {
                $(this)
                    .parent()
                    .find(".chkall_box")
                    .attr("src", "image/icon/check_no.svg");
                $(".chk.ele.chk1").trigger("click");
            }
        } else if ($(this).is(".chk.ele.chk1")) {
            if ($(this).is(":checked")) {
                $(this)
                    .parent()
                    .find(".chk_box")
                    .attr("src", "image/icon/small_check_ok.svg");

                if (chkLength == 2) {
                    $(".chk.all.chk1").trigger("click");
                }
            } else {
                $(this)
                    .parent()
                    .find(".chk_box")
                    .attr("src", "image/icon/small_check_no.svg");
                if (chkLength != 2) {
                    $(".chk.all.chk1")
                        .prop("checked", false)
                        .parent()
                        .find(".chkall_box")
                        .attr("src", "image/icon/check_no.svg");
                }
            }
        } else if ($(this).is(".chk.all.chk2")) {
            if ($(this).is(":checked")) {
                $(this)
                    .parent()
                    .find(".chkall_box")
                    .attr("src", "image/icon/check_ok.svg");
                if (chkLength2 != 4) {
                    $(".chk.ele.chk2")
                        .prop("checked", true)
                        .parent()
                        .find(".chk_box")
                        .attr("src", "image/icon/small_check_ok.svg");
                }
            } else {
                $(this)
                    .parent()
                    .find(".chkall_box")
                    .attr("src", "image/icon/check_no.svg");
                $(".chk.ele.chk2").trigger("click");
            }
        } else if ($(this).is(".chk.ele.chk2")) {
            if ($(this).is(":checked")) {
                $(this)
                    .parent()
                    .find(".chk_box")
                    .attr("src", "image/icon/small_check_ok.svg");

                if (chkLength2 == 4) {
                    $(".chk.all.chk2").trigger("click");
                }
            } else {
                $(this)
                    .parent()
                    .find(".chk_box")
                    .attr("src", "image/icon/small_check_no.svg");
                if (chkLength2 != 4) {
                    $(".chk.all.chk2")
                        .prop("checked", false)
                        .parent()
                        .find(".chkall_box")
                        .attr("src", "image/icon/check_no.svg");
                }
            }
        }
    });
});

// 이용약관 팝업
function termsLayerPopup(type) {
    var $panel = $(".popup_panel_terms");
    console.log($panel);
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
