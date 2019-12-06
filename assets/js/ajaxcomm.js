function ajaxComment() {
    var selector = {
        commentMainFrame: '#comment',
        commentList: '#commentlist',
        commentNumText: '#comment h3',
        commentReplyButton: '#comment span.reply',
        submitForm: '#commentform',
        submitTextarea: '#textarea',
        submitButton: '#submit',
    };
    var parentId = '';
    bindCommentReplyButton();
    $(selector.submitTextarea).after('<div style="display:none;" id="ajaxCommentMsg"><\/div>');
    $msg = $('#ajaxCommentMsg');
    $(document).on('submit', selector.submitForm, function() {
        $msg.empty();
        $(selector.submitButton).val('发射中哦=A=');
        $(selector.submitButton).attr('disabled', true).fadeTo('slow', 0.5);
        if ($(selector.submitForm).find('#author')[0]) {
            if ($(selector.submitForm).find('#author').val() == '') {
                message('昵称没填呢QAQ');
                enableCommentButton();
                return false;
            }
            if ($(selector.submitForm).find('#mail').val() == '') {
                message('邮箱没填呢QAQ');
                enableCommentButton();
                return false;
            }
            var filter = /^[^@\s<&>]+@([a-z0-9]+\.)+[a-z]{2,4}$/i;
            if (!filter.test($(selector.submitForm).find('#mail').val())) {
                message('邮箱地址不正确呢QAQ');
                enableCommentButton();
                return false;
            }
        }
        if ($(selector.submitForm).find(selector.submitTextarea).val() == '') {
            message('评论似乎什么也没写呢QAQ');
            enableCommentButton();
            return false;
        }
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serializeArray(),
            error: function() {
                message('发射失败,请重试!');
                setTimeout(NProgress.done, 500)
                enableCommentButton();
                return false;
            },
            success: function(data) {
                if (!$(selector.commentList, data).length) {
                    errorMsg = data.match(/.+/g).join().match(/\<div.+\>.+\<\/div\>/g).join().match(/[^\,]+/g);
                    $msg.html(errorMsg[0] + errorMsg[1] + errorMsg[2]);
                    enableCommentButton();
                    return false;
                } else {
                    userCommentId = $(selector.commentList, data).html().match(/id=\"?comment-\d+/g).join().match(/\d+/g).sort(function(a, b) {
                        return a - b;
                    }).pop();
                    commentLi = '<li id="comment-' + userCommentId + '" class="comment">' + $('#comment-' + userCommentId, data).html(); + '<\/li>';
                    if (parentId) {
                        if ($('#' + parentId).find(".comment-children").length <= 0) {
                            $('#' + parentId).append("<ul class='children'></ul>");
                        }
                        $('#' + parentId + " .children:first").append(commentLi);
                        parentId = ''
                        $body.animate({
                            scrollTop: $('#comment-' + userCommentId).offset().top - 450
                        }, 900);
                    } else {
                        $(selector.commentList).prepend(commentLi)
                        $body.animate({
                            scrollTop: $('#comment-' + userCommentId).offset().top - 200
                        }, 900);
                    }
                    //$('#comment-' + userCommentId).slideDown('slow');

                    //console.log(userCommentId);
                    $(selector.commentNumText).length ? (n = parseInt($(selector.commentNumText).text().match(/\d+/)), $(selector.commentNumText).html($(selector.commentNumText).html().replace(n, n + 1))) : 0;
                    TypechoComment.cancelReply();
                    $(selector.submitTextarea).val('');
                    $(selector.commentReplyButton + ' b, #cancel-comment-reply-link').unbind('click');
                    bindCommentReplyButton();
                    enableCommentButton();

                }
            }
        });
        return false;
    });

    function bindCommentReplyButton() {
        $(document).on('click', selector.commentReplyButton, function() {
            parentId = $(this).parents('li.comment').attr("id");
            $(selector.submitTextarea).focus();
        });
        $(document).on('click', '#cancel-comment-reply-link', function() {
            parentId = '';
        });
    }

    function enableCommentButton() {
        $(selector.submitButton).attr('disabled', false).fadeTo('', 1);
        $(selector.submitButton).val('发射=A=');
    }

    function message(msg) {
        $msg.hide();
        $msg.html(msg).slideToggle('fast');
    }
}