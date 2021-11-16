$(function(){
        $(".c *").addClass('c');

        $(".tips-open, .tips-close").click(function(){
                $('.md-hidden-p').slideToggle();
                $('.tips-open, .tips-close').toggle();
        });
        var tips = $('#mission_tips').html();
        tips = tips.replace(/\*/g, "<span class='star on'>★</span>");
        $('#mission_tips').html(tips);
});
