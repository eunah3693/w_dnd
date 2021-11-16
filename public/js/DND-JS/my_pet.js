function CheckText(val) {
    var kind2_etc = document.getElementById("kind2_etc");
    if (val == "other") {
        $("#breed").val("");
        if (navigator.appName.indexOf("Microsoft") > -1) {
            var visible = "block";
        } else {
            var visible = "block";
        }
        kind2_etc.style.display = visible;
    } else {
        $("#breed").val(document.getElementById("kind2").value);
        kind2_etc.style.display = "none";
    }
}

$(function () {
    if ($("select#kind2").length && false) {
        $.get("/api/dogs/breed/list").done(function (res) {
            $("select#kind2 option").remove();
            res.data.forEach(function (e) {
                $("select#kind2").append(
                    '<option value="' + e.breed + '">' + e.breed + "</option>"
                );
                $("select#kind2").show();
            });
        });
    }

    if (document.getElementById("kind2").value == "other") {
        if (navigator.appName.indexOf("Microsoft") > -1) {
            var visible = "block";
        } else {
            var visible = "block";
        }
        kind2_etc.style.display = visible;
    } else {
        kind2_etc.style.display = "none";
    }
    // $("#kind2").selectmenu();
    // $(".ui-menu .ui-menu-item")
    //     .last()
    //     .on("change", function () {
    //         console.log("클릭");
    //     });
    $("#kind2").selectmenu({
        change: function (event, data) {
            console.log(data.item.value);
            CheckText(data.item.value);
        },
    });
});
