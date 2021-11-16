
$(function(){
    $('.title > a').each(function(){
        var content = $('.title > a');
        var content_txt = content.text();
        var content_txt_short = content_txt.substring(0,15)+"...";
        console.log(content);
        console.log(content_txt);


        if(content_txt.length >= 25){
            content.html(content_txt_short);
        }
    });
});
