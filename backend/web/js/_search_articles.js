$(document).ready(function()    {

    $("#submit-modal-search").on('click', function(e) {
        e.preventDefault();
        var data = $('#form-search').serialize();

        $.get('/article/search', 
            data,
            function(data) {    
                var foundList = $('#found-list');
                foundList.empty();
                if(data.length > 0)  {
                    $.each(data, function(i, val) {
                        $div = $('<div>');
                        $('<input type="radio">').val(val.id).appendTo($div);
                        $('<span>').text(val.title).appendTo($div);
                        $div.appendTo(foundList);
                    }); 
                }
            }
        ); 

    });  


}); 



