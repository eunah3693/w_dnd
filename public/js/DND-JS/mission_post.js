// 펫 필터
$(function(){
    $('button').click(function() {
        $(this).toggleClass('button-active');
    });
});

// //프로필 사진 바꾸기
// var sel_file;

//  $(document).ready(function() {
//      $("li").on("change", handleImgFileSelect);
//  });

//  function handleImgFileSelect(e) {
//      var files = e.target.files;
//      var filesArr = Array.prototype.slice.call(files);

//      filesArr.forEach(function(f) {
//          if(!f.type.match("image.*")) {
//             alert("확장자는 이미지 확장자만 가능합니다.");
//             return;
//          } else {
//             alert("이미지가 변경되었습니다.");
//             $('.pic-label').addClass('pic-label-none');
//             console.log($(".pic-label::after"));
//          }

//          sel_file = f;

//          var reader = new FileReader();
//          reader.onload = function(e) {
//             $("#img").attr("src", e.target.result);
//          }
//          reader.readAsDataURL(f);
//      });
//  }




$('#textarea').mentiony({
    onDataRequest: function (mode, keyword, onDataRequestCompleteCallback) {
        $.ajax({
            method: "post",
            url: "/api/get_user_list",
            data: {text:keyword},
            dataType: "json",
            success: function (response) {
                var data = response.data;
                data = jQuery.grep(data, function( item ) {
                    return item.name.toLowerCase().indexOf(keyword.toLowerCase()) > -1;
                });
                onDataRequestCompleteCallback.call(this, data);
            }
        });

    },
    timeOut: 500, // Timeout to show mention after press @
    debug: 0, // show debug info
});
