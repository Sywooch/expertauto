$(document).ready(function() {


    $('.btn-quote').click(function(){

        var quoteText = selectedText();
        var quoteId = $(this).data('id');

        if(quoteText.length > 5) {
            $('.toggle-form, #wrap-input-quote').show();
            $('#forumpost-quote_id').val(quoteId); 
            $('#forumpost-quote_text').val(quoteText).focus(); 
        } else {
            alert('Сначала выделите текст для цитаты');
        }
    });
    

    function selectedText() {
        if(window.getSelection)
            txt = window.getSelection().toString();
        else if(document.getSelection)
            txt = document.getSelection();                
        else if(document.selection)
            txt = document.selection.createRange().text;
        return txt;
    }

    

});
    
