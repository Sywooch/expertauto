$(document).ready(function()    {

    $("#select-main_category_id").on('change', function() {
        var s = $(this).val();
        var params = {
            'action':'/category/mainlist',
            'targetId':'select-category_id',
            'prompt': '--Выберите--',
            'wrapTargetId':'wrap-select-category_id',
            };
        $.get(params.action, {'id': s}, 
        function(data) {    
            var $targetId     = $('#' +params.targetId);
            var $warpTargetId = $('#' +params.warpTargetId);
            $targetId[0].options.length = 0;     

            if(data.length > 0)  {
                $targetId.append($('<option/>').attr('value', '').text(params.prompt));
                $.each(data, function(i, val) {
                    $targetId.append($('<option/>').attr('value', val.id).html(val.name)); 
                })
                $targetId.trigger('refresh'); 
            } 
        }); // end get
    });  



}); 



