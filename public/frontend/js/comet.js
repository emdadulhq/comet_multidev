(function ($) {
    $(document).ready(function () {




    $('a.comment-reply-btn').click(function (e) {
        e.preventDefault();
        let cid = $(this).attr('c_id');
        $('.comment-reply-box-'+cid).toggle();

    });


    });
})(jQuery)
