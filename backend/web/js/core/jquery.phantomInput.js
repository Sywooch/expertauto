(function($) {

    $.fn.phantomInput = function(options) {
    
        var defaults = {
              urlPrefix:     '',
              urlController: '/ajax/universal',
              btnOkText:     'Ok',
              btnCancelText: 'Cancel',
              };
               
        var o = $.extend(defaults, options);

        return this.each(function() {
            $(this).click( function(e) { 

            if($('.phantom-input-wrap').size() == 0 && !$(e.target).closest('button')[0]) {

                var $this     = $(this);
                var storeText = $this.text();
                var argums    = this.id.split('-');

                $this.empty(); 
                var $wrap = $('<div />').addClass('form-inline phantom-input-wrap').appendTo($this);

                var $newInput = $('<input type="text" />')
                    .val(storeText)
                    .addClass('phantom-input')
                    .appendTo($wrap)
                    .focus();

                $('<button />')
                    .text(o.btnOkText)
                    .appendTo($wrap)
                    .bind('click', function() { 

                        $wrap.remove();

                        $.post(o.urlPrefix + o.urlController, 
                            {   'model':    argums[0],           
                                'field':    argums[1],           
                                'id':       argums[2],
                                'newvalue': $newInput.val(), 
                                },
                            function(data) {          
                                if(data.state == 'success') {
                                    $this.text(data.newvalue);
                                } 
                            }  
                        );
                    });  


                $('<button />')
                    .text(o.btnCancelText)
                    .appendTo($wrap)
                    .bind('click', function(e) {  
                        e.preventDefault(); 
                        $wrap.remove();
                        $this.text(storeText); 
                    });

                createCss($this);
                tuningInputWidth($this);
            }
        });
    });


    function  createCss($this) {
        $this.find('button').addClass('btn btn-primary btn-sm').css({'margin-left':  '5px'});
    }


    function tuningInputWidth($wrap) {
 
      var btnsWidth = 0, w = 0;
      $wrap.find('button').each(function() { 
                      btnsWidth += $(this).outerWidth(true);
                      })
      w = $wrap.outerWidth(true) - (btnsWidth) -20;
      // w = (w > 370) ? 370 : w;
      $('.phantom-input').outerWidth(w);

      
      var h =  $wrap.find('button').first().outerHeight(true);
      $('.phantom-input').outerHeight(h);


    }

  } 
})(jQuery);