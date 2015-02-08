$(document).ready(function()    {

    $('#input-title').syncTranslit({destination: 'input-slug'});

    $('#toggle-brief, #toggle-meta, #toggle-source').click(function () {
        var target = '#wrap-' + this.id.split('-')[1];
        $(target).toggle('fast');
    });


    $("#tag_add_submit").on("click", function (event) {
        event.preventDefault();
        $('#wrap-form-tag-create').hide();

        $.ajax({
            url: "/tag/create",
            type: "post",
            // data: $form.serialize(),
            data: {'Tag[name]': $('#input-tag-name').val()},
            success: function(data) {
                if(data.id) {
                    createTagFormElement(data.id, data.name);
                }
            }
        });
    });  


    $("a.tagging-delete").on("click", function (event) {
        event.preventDefault();
        var tagName =  $(this).data('name');
        var wrapDiv = $(this).parent('div');

        $.ajax({
            url: "/tagging/delete",
            type: "post",
            data: {id: $(this).data('id') },
            success: function(data) {
                if(data.id) {
                    wrapDiv.remove();
                    createTagFormElement(data.tag_id, tagName);
                }
            }
        });
    });  


    $("#toggle-form-tag-create").click(function () {
        $('#wrap-form-tag-create').toggle();
    });


    function createTagFormElement(tagId, tagName) {
        var div = $('<div>');
        $('<input type="checkbox">').prop({name: 'ArticleTag[tag_id][' +tagId + ']'}).appendTo(div);
        $('<label>').text(tagName).appendTo(div);
        div.prependTo('#tagging-list');
    }

}); 



