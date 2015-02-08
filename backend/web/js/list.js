$(document).ready(function() {

    $(".place-for-phantom").phantomInput();

    $('.show_hidden_form').click( function(event) { 
        event.preventDefault();
        $('.hidden_form').show();
        $('.focus_on_me').focus();
    });

    $('a.hide_hidden_form').click( function(event) { 
        event.preventDefault();
        $('.hidden_form').hide(); 
    });

});  