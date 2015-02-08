(function($) {

  $.fn.phantomDot = function(options) {
    
    var defaults = {
      urlPrefix:          '',
      urlController:      '/ajax/universal',    
      activeClassName:    'active',    
      noActiveClassName:  'no-active',    
      };
       
    var o = $.extend(defaults, options);

    return this.each(function() {

      $(this).click( function(e) {

        var $this = $(this);
        var argums =  this.id.split('-');
        var newvalue  = ($this.hasClass(o.activeClassName)) ? 0 : 1;

        $this.hide();

        $.post(o.urlPrefix + o.urlController, 
          {
           'model':    argums[0],           
           'field':    argums[1],           
           'id':       argums[2],
           'newvalue': newvalue 
          },
          function(data){          
            if(data.state == 'success'){
              $this.toggleClass(o.activeClassName +' ' +o.noActiveClassName);
              $this.show();
            } 
          }  
        );

      });

    });
  } 
})(jQuery);