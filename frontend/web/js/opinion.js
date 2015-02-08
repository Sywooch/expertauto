$(document).ready(function() {

    $('.stylerize').styler();

    $(".rating-stars .star").mouseenter(function () {      
        var $this = $(this),
            $line = $this.parent();

        if(!$line.hasClass('freeze')) {
            var $stars = $line.children(),
                rate = $stars.index($this) + 1;

            $stars.slice(0, rate).addClass('active');
            $stars.slice(rate, 10).removeClass('active');
        }
     });

    $("div.rating-stars").mouseleave(function () {
        var $this = $(this),
            $stars = $this.children();

        if(!$this.hasClass('freeze')) {
            $stars.removeClass('active');
        }
    });


    $(".rating-stars .star").click(function () {
        var $this = $(this),
            $line = $this.parent(),
            $stars = $line.children(),
            rate = $stars.index($this) + 1,
            targetInput = $line.data('rate-input');

        $stars.slice(0, rate).addClass('active');
        $stars.slice(rate, 10).removeClass('active');
        $line.addClass('freeze');        
        $('#' + targetInput).val(rate);
    });

    $(".cascade-city-dealer #city_id").on('change', function () {
        var id = $(this).val(),
            action = '/opinion/dealerlist',
            $targetId = $('#select-dealer_id'),
            prompt = '--Выберите дилера--';

        $.get(action, {id: id},
            function (data) {
               $targetId[0].options.length = 0;
                if(data.length > 0)  {
                    $targetId.append($('<option/>').attr('value', '').text(prompt));
                    $.each(data, function (i, val) {
                        $targetId.append($('<option/>').attr('value', val.id).html(val.name));
                    })
                }
                $targetId.trigger('refresh');
            }
        ); // end get
    });


    

});
    
