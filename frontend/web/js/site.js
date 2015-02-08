$(document).ready(function() {

    $('.topmenu li.root').mouseenter(function(event) {
        event.preventDefault();
        $(this).children('ul').show();
    }) 

    $('.topmenu li.root').mouseleave( function(event) { 
        // if( !$(event.target).is($(this)) ) {
            $(this).children('ul').slideUp('fast');
        // }
    });


    $('.bxslider').show().bxSlider({
        pager: false,
        speed: 800,
        pause: 6000,
        auto: true,
        controls: true,
        captions: true
    });  


    $(".activate-toggle-form").click(function(e){
        e.preventDefault();
        $('.toggle-form').toggle();
    });


});
    
