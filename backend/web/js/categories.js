$(document).ready(function()    {

    $(".place-for-phantom").phantomInput();
    $('#category-name').syncTranslit({destination: 'category-slug'});
    

    $('.menu-accordion').click(function() {   
        $('tr.row-category').hide();
        $(this).parents('tbody').find('tr.row-category').show('slow');
    });


}); 

