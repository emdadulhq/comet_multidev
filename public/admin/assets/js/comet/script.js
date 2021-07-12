(function ($) {
$(document).ready(function () {



    //Data Tables
    $('table.data_table').dataTable();
    //CK Editor
    CKEDITOR.replace('post_editor');
    CKEDITOR.replace('post_update_editor');


    //logout system
$('a#logout_button').click(function (e) {
e.preventDefault();
    $('form#logout_form').submit();
})


});


$(document).on('click', 'a#category_edit', function (e) {
    e.preventDefault();

    let id = $(this).attr('edit_id');

    $.ajax({
        url:'posts-category-edit/' + id,
        dataType: "json",
        success: function (data) {
            $('#category_modal_update form input[name="name"]').val(data.name);
            $('#category_modal_update form input[name="id"]').val(data.id);
    }
    });

});


$(document).on('click', 'a#post_edit', function (e) {
    e.preventDefault();

    let id = $(this).attr('edit_id');

    $.ajax({
        url:'post-edit/' + id,
        dataType: "json",
        success: function (data) {

            $('#post_modal_update form input[name="id"]').val(data.id);
            $('#post_modal_update form input[name="title"]').val(data.title);
            $('#post_modal_update .cl').html(data.cat_list);
            $('img#post_ftd_img_edit_load').attr('src',  'media/posts/'+data.ftd_img_edit);
            $('#post_modal_update textarea').html(data.post_content_edit);
            $('#post_modal_update').modal('show');
    }
    });

});




//Edit field
    $(document).on('click', 'a#tag_edit', function (e) {
        e.preventDefault();

        let id = $(this).attr('edit_id');

        $.ajax({
            url:'posts-tag-edit/' + id,
            dataType: "json",
            success: function (data) {
                $('#tag_modal_update form input[name="name"]').val(data.name);
                $('#tag_modal_update form input[name="id"]').val(data.id);
            }
        });

    });


//Featured Image Load
$(document).on('change', "input#ftd_img", function (e) {
e.preventDefault();


let post_image_url = URL.createObjectURL(e.target.files[0]);
$('img#post_ftd_img_load').attr('src', post_image_url);

});


//Featured Image Edit Load
$(document).on('change', "input#ftd_img_edit", function (e) {
e.preventDefault();


let post_image_url = URL.createObjectURL(e.target.files[0]);
$('img#post_ftd_img_edit_load').attr('src', post_image_url);

});


// Comet Slider Script
    $(document).on('click', '#add_slide', function (e) {
        e.preventDefault();
        let rand = Math.floor(Math.random()*10000);
        $('.slider-container').append('<div id="slider_card'+ rand +'" class="card">\n' +
            '                                                <div class="card-body">\n' +
            '                                                    <div id="" data-toggle="collapse" data-target="#slide'+ rand +'" style="cursor:\n' +
            '                                                    pointer;"\n' +
            '                                                         class="form-group"><h4>#Slide\n' +
            '                                                            01 <button id="slide_remove_btn" remove_id="'+ rand +'"' +
            ' class="close">&times;</button></h4></div>\n' +
            '                                                   <div class="collapse" id="slide'+ rand +'">\n' +
            '                                                       <div class="card-body" >\n' +
            '                                                           <div class="form-group">\n' +
            '                                                               <label for="">Sub Title</label>\n' +
            '                                                               <input name="slide_code[]" type="hidden"' +
            ' value="'+ rand +'" class="form-control">\n' +
            '                                                               <input name="subtitle[]" type="text" class="form-control">\n' +
            '                                                           </div>\n' +
            '                                                           <div class="form-group">\n' +
            '                                                               <label for="">Title</label>\n' +
            '                                                               <input name="title[]" type="text"' +
            ' class="form-control">\n' +
            '                                                           </div>\n' +
            '                                                           <div class="form-group">\n' +
            '                                                               <label for="">Button 01 Title</label>\n' +
            '                                                               <input name="btn1_title[]" type="text"' +
            ' class="form-control">\n' +
            '                                                           </div>\n' +
            '                                                           <div class="form-group">\n' +
            '                                                               <label for="">Button 01 Link</label>\n' +
            '                                                               <input name="btn1_link[]" type="text"' +
            ' class="form-control">\n' +
            '                                                           </div>\n' +
            '                                                           <div class="form-group">\n' +
            '                                                               <label for="">Button 02 Title</label>\n' +
            '                                                               <input name="btn2_title[]" type="text"' +
            ' class="form-control">\n' +
            '                                                           </div>\n' +
            '                                                           <div class="form-group">\n' +
            '                                                               <label for="">Button 02 Link</label>\n' +
            '                                                               <input name="btn2_link[]" type="text"' +
            ' class="form-control">\n' +
            '                                                           </div>\n' +
            '                                                       </div>\n' +
            '                                                   </div>\n' +
            '\n' +
            '                                                </div>\n' +
            '                                            </div>');
    });
    $(document).on('click', '#slide_remove_btn', function (e) {
        e.preventDefault();
        let remove_code = $(this).attr('remove_id');
            $('#slider_card'+remove_code).remove();
    });



})(jQuery)
