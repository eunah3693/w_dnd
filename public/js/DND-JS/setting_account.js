//프로필 사진 바꾸기
var sel_file;

$(document).ready(function () {
    $("#profile-pic").on("change", handleImgFileSelect);
});

function handleImgFileSelect(e) {
    var files = e.target.files;
    var filesArr = Array.prototype.slice.call(files);

    filesArr.forEach(function (f) {
        if (!f.type.match("image.*")) {
            alert("확장자는 이미지 확장자만 가능합니다.");
            return;
        } else {
            $(".pet_icon_setting").attr(
                "src",
                "/image/icon/user_icon_setting.svg"
            );
            alert("이미지가 변경 완료! 저장해주세요!");
        }

        sel_file = f;

        var reader = new FileReader();
        reader.onload = function (e) {
            $("#img").attr("src", e.target.result);
        };
        reader.readAsDataURL(f);
    });
}

$(function () {
    $(".pet_gender")
        .find("input")
        .click(function () {
            $(this).addClass("on").siblings().removeClass("on");
        });

    var arrow_num = 0;
    $(".arrow_down").click(function () {
        if (arrow_num == 0) {
            $(".ui-selectmenu-button.ui-button").trigger("click");
            arrow_num = 1;
        } else {
            $(".ui-selectmenu-button.ui-button").blur();
            arrow_num = 0;
        }
    });
    var cal_num = 0;
    $(".calendar_icon").click(function () {
        if (cal_num == 0) {
            $(".date_input").focus();
            cal_num = 1;
        } else {
            $(".date_input").blur();
            cal_num = 0;
        }
    });

    $("#datepicker").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        monthNames: [
            "1",
            "2",
            "3",
            "4",
            "5",
            "6",
            "7",
            "8",
            "9",
            "10",
            "11",
            "12",
        ],
        monthNamesShort: [
            "1",
            "2",
            "3",
            "4",
            "5",
            "6",
            "7",
            "8",
            "9",
            "10",
            "11",
            "12",
        ],
    });
});
