$("#btn_guide_close").on("click", function () {
    var $panel = $(".guide_panel");
    $panel.fadeOut();
});

function guidePopupOpen() {
    var $panel = $(".guide_panel");

    // 레이어 팝업 열기
    $panel.fadeIn();
    $(".guide-title").html("");
    $(".guide-subtitle").html("");
    $("#btn_guide_next").text("");
    if (typeof Swiper == "function") {
        var swiper = new Swiper(".g-swiper-container", {
            loop: $(this).find("swiper-slide").length > 1 ? true : false,
            pagination: {
                el: ".swiper-pagination",
            },
        });
    }
}
