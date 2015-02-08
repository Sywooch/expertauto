$(document).ready(function () {
    var h = 0, iconTopShift = 0, flagSubmitted = false, paragraphBackground = '#f7f7f7';

    function hideIcon() {
        $("#icon_photo, #icon_video").css('left', -10000);
    }

    function showImageForm() {
        flagSubmitted = true;
        $('#wrap-image-form').css({top: h + 50, left: '180px'});
        $('#wrap-image-form textarea')
            .focus(function () {
                $(this).css('height', '70px');
            });
        hideIcon();
    }

    function showVideoForm() {
        flagSubmitted = true;
        $('#wrap-video-form').css({top: h + 54, left: '220px'});
        hideIcon();
    }


    $("#icon_photo, p, h2, h3, h4").click(function () { showImageForm(); });
    $("#icon_video").click(function () { showVideoForm(); });

    $("p, h2, h3, h4").mouseenter(function () {
        if (flagSubmitted === false) {
            $('#image-input-pos').val($(this).prev().data('parag-index'));

            $(this).css({background: '#eee'});
            h = $(this).offset().top - $('#media-content').offset().top - iconTopShift;

            $("#icon_photo").css({"top": h, "left": "670px"});
            $("#icon_video").css({"top": h, "left": "766px"});
        }
    });

    $("p, h2, h3, h4").mouseleave(function () {
        $(this).css({'background': paragraphBackground});
    });

    //.................
    $("#image-btn-submit").click(function () {
        $('#wrap-image-form textarea').css('height', '30px');
        $('.media-form').css({left: '-10000px'});
    });

    $(".btn-cancel").click(function (event) {
        event.preventDefault();
        flagSubmitted = false;
        $('#wrap-image-form textarea').css('height', '30px');
        $('.media-form').css({left: '-10000px' });
    });

    //................
    $("figcaption span").click(function () {

        if (flagSubmitted) {
            return false;
        }
        flagSubmitted = true;

        var curentId = $(this).data('id'), $span = $(this), $figcaption = $span.parents('figcaption'), storeText = $span.text();

        hideIcon();
        $span.hide();

        var $form = $('<div />');
        var textArea = $('<textarea/>')
                          .css({'height': $figcaption.height() + 60})
                          .val(storeText)
                          .appendTo($form);
        $('<button />')
            .addClass('btn btn-primary btn-xs').css('margin-right', '10px')
            .text('Отмена')
            .click(function () {
                flagSubmitted = false;
                $form.remove();
                $span.show();
            })
            .appendTo($form);

        $('<button />')
            .addClass('btn btn-primary btn-xs').text('Изменить')
            .click(function () {
                $.post('/ajax/universal',  { model: 'image_article', field: 'caption', id: curentId, newvalue: textArea.val() },
                    function (data) {
                        if (data.state === 'success') {
                            $form.remove();
                            $span.text(data.newvalue).show();
                            flagSubmitted = false;
                        }
                    }
                    );
            })
            .appendTo($form);

        $form.appendTo($figcaption);
        textArea.focus();
    });

    $('.youTybe-wrap iframe').each(function () {
        var w = 480, height = Math.round(w / $(this).attr('width') * $(this).attr('height'));
        $(this).attr({'width': w, 'height': height});
        $(this).parents('div').show();
    });

});