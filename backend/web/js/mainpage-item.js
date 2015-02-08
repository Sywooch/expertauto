$(document).ready(function()    {

    var pos = 0;
    var mainpageId = 0;

    $('.icon-plus').click(function(){
        pos         = $(this).data('pos');
        mainpageId  = $(this).data('mainpage_id');
    });

    
    $(document).on('click', 'input[type="radio"]', function() { 

        $.post('/mainpage-item/create', 
             {mainpage_id: mainpageId, article_id: $(this).val(), pos: pos},
             function(data){ location.reload(); 
        });         

    });




}); 



