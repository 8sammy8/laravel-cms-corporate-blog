addComment = {
    moveForm: function (d, m) {
        $('#single-comment-' + d).append($('#comment-new'));
        $('input#comment_parent').val(d);
        var cl = $('a#cancel-comment-reply-link').show();
        cl.click( function () {
            $('#single-comment-' + m).append($('#comment-new'));
            $('input#comment_parent').val('');
            cl.hide();
            }

        );
    }
};