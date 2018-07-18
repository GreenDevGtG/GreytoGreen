jQuery(document).ready(function($) {


    $(window).resize(function() {
        console.log($(window).width());
        if($(window).width() <=768) {
            $('#main').removeClass("embed-responsive-16by9");
            $('#main').addClass("embed-responsive-1by1");
        }
        else {
            $('#main').removeClass("embed-responsive-1by1");
            $('#main').addClass("embed-responsive-16by9");
        }
    });

    $(window).click(function()
    {
        $('input[type="checkbox"]').prop('checked', false);
    });
    $('.menu,.burger').click(function(event)
    {
        event.stopPropagation();
    });

});