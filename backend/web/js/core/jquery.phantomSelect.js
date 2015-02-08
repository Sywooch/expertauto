(function($) {

  $.fn.phantomSelect = function(options) {
    
    var defaults = {
      arOptions:     [],
      urlPrefix:     '',
      urlController:  '/ajax/universal',
      argsController: {},
      split:         '-',
      iconDecorator: false,
      btnCss:        'btn-mini_close',
      };
       
    var o = $.extend(defaults, options);
    var postData = {}, newId ='';

    return this.each(function() {

      $(this).click( function(e) {

        var $this = $(this);
        var argums = this.id.split(o.split);                                     
        var oldValue = argums[3];
        

        $.each(argums, function(i, v) {   
          if(i<argums.length-1) newId += (v+ o.split);  
        });

        if(!($this.has("select").length) && !$(e.target).is('input[type=button]'))   
        {
          if(o.iconDecorator) {
            var oldIconClass = o.iconDecorator +oldValue.toString();
            $this.removeClass(oldIconClass);
          } else {
            var oldText = $this.text(); 
          }

          $this.empty();     
          var $sel = $('<select />');
          var $opt;
      
          $sel.css({'display':'inline-block', 'width': '80%', 'font': '16px Arial,sans-serif', 'background': '#f2f2f2', 'border': '1px solid #ccc'});

          $.each(o.arOptions, function(index, value) {                     
            opt = $('<option/>').val(index+1).text(value);
            if(argums[3] == index+1) opt.attr('selected', 'selected');
            opt.appendTo($sel);
          });
          
          $sel.appendTo($this).bind('change', function() 
          {
            var selectedValue = parseInt($sel.find('option:selected').val());
            postData['selected_value'] = selectedValue;

  
            $this.empty();

            $.ajax({
              type: "post",
              url:  o.urlPrefix + o.urlController, 
              data: {
                   'model':    argums[0],           
                   'field':    argums[1],           
                   'id':       argums[2],
                   'newvalue': selectedValue, 
                  },
              success:function(data){ 
                        var key = parseInt(data.newvalue)-1;
                        if(o.iconDecorator) {
                          $this.addClass(o.iconDecorator +(data.newvalue).toString());
                        } else { 
                          $this.text(o.arOptions[key]);
                        }  
                        $this.attr('id', newId +data.response);
                      }
            });
          });  

          $('<input />').attr({'type': 'button'})
                      .addClass(o.btnCss)
                      .appendTo($this)
                      .bind('click', function() { 
                          $this.empty();
                          if(o.iconDecorator) {
                            $this.addClass(oldIconClass);
                          } else {
                            $this.text(oldText);
                          }                                
                      });
        }      
   
      });
    });
   

  } 
})(jQuery);