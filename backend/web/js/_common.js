$(document).ready(function()    {

    $('.stylerize').styler();
    
    
    $(".confirm-delete").click( function() { 
        if (confirm('Удалить этот элемент?'))   {
            createOverlay();          
            return true;
        } else {  
            return false; 
        }
    });


    $(".activate-toggle-form").click(function(e){
        e.preventDefault();
        $('.nav-tabs li').removeClass('active');
        $(this).parent('li').addClass('active');
        $('.toggle-form').toggle();
    });




    setTimeout(function () { 
        $('#notice').fadeOut('2000')}, 
        '3000');

    setLeftSideLayout();

    // custom scrollbar

    $("html").niceScroll({styler:"fb",cursorcolor:"#65cea7", cursorwidth: '6', cursorborderradius: '0px', background: '#424f63', spacebarenabled:false, cursorborder: '0',  zindex: '1000'});

    $(".left-side").niceScroll({styler:"fb",cursorcolor:"#65cea7", cursorwidth: '3', cursorborderradius: '0px', background: '#424f63', spacebarenabled:false, cursorborder: '0'});


    $(".left-side").getNiceScroll();
    if ($('body').hasClass('left-side-collapsed')) {
        $(".left-side").getNiceScroll().hide();
    }

    // ...................................

    $('.'+activeMenuItem).addClass('active');
    $('.'+activeMenuItem).parents('.menu-list').addClass('nav-active');


    // ...................................
    // Toggle Left Menu
    $('.menu-list > a').click(function() {
      
        var parent = $(this).parent();
        var sub = parent.find('> ul');

        if(!$('body').hasClass('left-side-collapsed')) {
            if(sub.is(':visible')) {
                sub.slideUp(200, function(){
                    parent.removeClass('nav-active');
                    $('.main-content').css({height: ''});
                    mainContentHeightAdjust();
                });
            } else {
                visibleSubMenuClose();
                parent.addClass('nav-active');
                sub.slideDown(200, function(){
                    mainContentHeightAdjust();
                });
            }
        }
        return false;
    });

    function visibleSubMenuClose() {
        $('.menu-list').each(function() {
            var t = $(this);
            if(t.hasClass('nav-active')) {
                t.find('> ul').slideUp(200, function(){
                    t.removeClass('nav-active');
                });
            }
        });
    }

   function mainContentHeightAdjust() {
      // Adjust main content height
      var docHeight = $(document).height();
      if(docHeight > $('.main-content').height())
         $('.main-content').height(docHeight);
   }

   //  class add mouse hover
   $('.custom-nav > li').hover(function(){
      $(this).addClass('nav-hover');
   }, function(){
      $(this).removeClass('nav-hover');
   });


   
    function setLeftSideLayout() {
        var body = $('body');
    
        if($.cookie('left-side-collapsed') == 'yes') {
            if (!body.hasClass('left-side-collapsed')) {
                body.addClass('left-side-collapsed'); 
                $('#alt-toggle-btn').addClass('fa-chevron-right');
            }    
        }   else {
            if (body.hasClass('left-side-collapsed')) {
                body.removeClass('left-side-collapsed'); 
            } 
            $('#alt-toggle-btn').addClass('fa-chevron-left');
        }
    }

    // Menu Toggle

    $('.toggle-btn, #alt-toggle-btn').click(function(){
       
        var body = $('body');
        $(this).removeClass('fa-chevron-left fa-chevron-right');

        if (!body.hasClass('left-side-collapsed')) {
            $.cookie("left-side-collapsed", 'yes', { path: '/'});
            $(this).addClass('fa-chevron-right');
        }  else {
            $.cookie("left-side-collapsed", 'no', { path: '/'});
            $(this).addClass('fa-chevron-left');
        }  

        $(".left-side").getNiceScroll().hide();
       
        if ($('body').hasClass('left-side-collapsed')) {
            $(".left-side").getNiceScroll().hide();
        }
        var bodyposition = body.css('position');

        if(bodyposition != 'relative') {

            if(!body.hasClass('left-side-collapsed')) {
                body.addClass('left-side-collapsed');
                $('.custom-nav ul').attr('style','');

                $(this).addClass('menu-collapsed');
                
            } else {
                body.removeClass('left-side-collapsed chat-view');
                $('.custom-nav li.active ul').css({display: 'block'});

                $(this).removeClass('menu-collapsed');
            }
        } else {

            if(body.hasClass('left-side-show'))
                body.removeClass('left-side-show')
            else
                body.addClass('left-side-show');
            mainContentHeightAdjust();
        }
   });
   

   searchform_reposition();

   $(window).resize(function(){

      if($('body').css('position') == 'relative') {
         $('body').removeClass('left-side-collapsed');
      } else {
         $('body').css({left: '', marginRight: ''});
      }
      searchform_reposition();
   });

   function searchform_reposition() {
      if($('.searchform').css('position') == 'relative') {
         $('.searchform').insertBefore('.left-side-inner .logged-user');
      } else {
         $('.searchform').insertBefore('.menu-right');
      }
   }

    // panel collapsible
    $('.panel .tools .fa').click(function () {
        var el = $(this).parents(".panel").children(".panel-body");
        if ($(this).hasClass("fa-chevron-down")) {
            $(this).removeClass("fa-chevron-down").addClass("fa-chevron-up");
            el.slideUp(200);
        } else {
            $(this).removeClass("fa-chevron-up").addClass("fa-chevron-down");
            el.slideDown(200); }
    });

    $('.todo-check label').click(function () {
        $(this).parents('li').children('.todo-title').toggleClass('line-through');
    });

    $(document).on('click', '.todo-remove', function () {
        $(this).closest("li").remove();
        return false;
    });

    // $("#sortable-todo").sortable();


    // panel close
    $('.panel .tools .fa-times').click(function () {
        $(this).parents(".panel").parent().remove();
    });


    // tool tips
    // $('.tooltips').tooltip();
    // popovers
    // $('.popovers').popover();



    // options = { color: 'rgba(0,0,0,0.5)', add_icon: false }
    function createOverlay(options)  {
        var color = (options !== undefined && options.color !== undefined) ? options.color : 'rgba(0,0,0,0.5)';
        
        $('<div />')
        .attr('id', 'overlay')
        .css({
            'position': 'fixed',
            'top': 0,
            'left': 0,
            'width':  '100%',
            'height': '100%',
            'background': color,        
            'z-index': '200',
         })
        .appendTo('body');

        if(options !== undefined && options.add_icon === true) {
            $('<div />')
            .attr('id', 'loading_icon')
            .css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 40) + $(window).scrollTop()) + "px")
            .appendTo('body');
        }
    }


    function removeOverlay()  {
        $('#overlay, #loading_icon').remove();
    }


});  