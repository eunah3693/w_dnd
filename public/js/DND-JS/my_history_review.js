$('#star_grade a').click(function(){
    $(this).parent().children("a").removeClass("on");  /* 별점의 on 클래스 전부 제거 */
    $(this).addClass("on").prevAll("a").addClass("on"); /* 클릭한 별과, 그 앞 까지 별점에 on 클래스 추가 */
    $('#score').val($('#star_grade .on').length);
    return false;
});
//프로필 사진 바꾸기
var sel_file;

 $(document).ready(function() {
     $("#profile-pic").on("change", handleImgFileSelect);
 });

 function handleImgFileSelect(e) {
     var files = e.target.files;
     var filesArr = Array.prototype.slice.call(files);

     filesArr.forEach(function(f) {
         if(!f.type.match("image.*")) {
             alert("확장자는 이미지 확장자만 가능합니다.");
             return;
         } else {
            alert("이미지가 변경 완료! 저장해주세요!");
         }

         sel_file = f;

         var reader = new FileReader();
         reader.onload = function(e) {
             $("#img").attr("src", e.target.result).css('display','');
         }
         reader.readAsDataURL(f);
     });
 }
