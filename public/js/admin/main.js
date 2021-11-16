$(function () {
    // member.php
    //테이블 오름차순/내림차순
    var table_v1 = 0; //v 표시 회전
    var table_v2 = 0; //v 표시 회전
    var table_v3 = 0; //v 표시 회전
    var table_v4 = 0; //v 표시 회전
    var table_v5 = 0; //v 표시 회전
    var table_v6 = 0; //v 표시 회전
    var table_v7 = 0; //v 표시 회전

    $(".table_arrow1")
        .parent("th")
        .click(function () {
            //화살표 회전
            if (table_v1 == "0") {
                table_v1 = 180;
            } else if (table_v1 == "180") {
                table_v1 = 0;
            }
            //console.log(table_v1);
            $(this)
                .find("i")
                .css({
                    transform: "rotate(" + table_v1 + "deg)",
                });
        });
    $(".table_arrow2")
        .parent("th")
        .click(function () {
            //화살표 회전
            if (table_v2 == "0") {
                table_v2 = 180;
            } else if (table_v2 == "180") {
                table_v2 = 0;
            }
            //console.log(table_v1);
            $(this)
                .find("i")
                .css({
                    transform: "rotate(" + table_v2 + "deg)",
                });
        });
    $(".table_arrow3")
        .parent("th")
        .click(function () {
            //화살표 회전
            if (table_v3 == "0") {
                table_v3 = 180;
            } else if (table_v3 == "180") {
                table_v3 = 0;
            }
            //console.log(table_v1);
            $(this)
                .find("i")
                .css({
                    transform: "rotate(" + table_v3 + "deg)",
                });
        });
    $(".table_arrow4")
        .parent("th")
        .click(function () {
            //화살표 회전
            if (table_v4 == "0") {
                table_v4 = 180;
            } else if (table_v4 == "180") {
                table_v4 = 0;
            }
            //console.log(table_v1);
            $(this)
                .find("i")
                .css({
                    transform: "rotate(" + table_v4 + "deg)",
                });
        });
    $(".table_arrow5")
        .parent("th")
        .click(function () {
            //화살표 회전
            if (table_v5 == "0") {
                table_v5 = 180;
            } else if (table_v5 == "180") {
                table_v5 = 0;
            }
            //console.log(table_v1);
            $(this)
                .find("i")
                .css({
                    transform: "rotate(" + table_v5 + "deg)",
                });
        });
    $(".table_arrow6")
        .parent("th")
        .click(function () {
            //화살표 회전
            if (table_v6 == "0") {
                table_v6 = 180;
            } else if (table_v6 == "180") {
                table_v6 = 0;
            }
            //console.log(table_v1);
            $(this)
                .find("i")
                .css({
                    transform: "rotate(" + table_v6 + "deg)",
                });
        });
    $(".table_arrow7")
        .parent("th")
        .click(function () {
            //화살표 회전
            if (table_v7 == "0") {
                table_v7 = 180;
            } else if (table_v7 == "180") {
                table_v7 = 0;
            }
            //console.log(table_v1);
            $(this)
                .find("i")
                .css({
                    transform: "rotate(" + table_v7 + "deg)",
                });
        });

    //테이블정렬 click시 css지정
    $(".table_align").click(function () {
        $(this).toggleClass("click");
    });

    //모든페이지
    $(".fa.fa-search").click(function () {
        var search_input = $(this).parent().parent().siblings("input");
        if (search_input.val() == "") {
            alert("검색어를 입력해주세요.");
            return true;
        }
    });
    
});

target_element = null;
function handleImgFileSelect(e) {
    target_element = e;
    var files = e.files;
    var filesArr = Array.prototype.slice.call(files);

    filesArr.forEach(function(f) {
        if(!f.type.match("image.*")) {
            alert("확장자는 이미지 확장자만 가능합니다.");
            return;
        }

        var reader = new FileReader();
        reader.onload = function(e) {
            $(target_element).siblings('img').eq(0).attr("src", e.target.result);
        }
        reader.readAsDataURL(f);
    });
}