$(function () {
    //     $('.deleteTweet').click(function(){
    //            $('.delBack').show();
    //        });
    // $('.deleteTweet').click(function){
    //     
    //     var tweet_id = $(this).data('tweet');
    // } 
    $(document).on('click', '.deleteTweet', function () {
        var tweet_id = $(this).data('tweet');
        $.post('http://localhost/socialbd/core/ajax/deleteTweet.php', {
            showPopup: tweet_id
        }, function (data) {
            $('.delshow').html(data);
            $('.close-retweet-popup, .cancel-it').click(function () {
                $('.retweet-popup').hide();
            });
            $(document).on('click', '.delete-it', function () {
                $.post('http://localhost/socialbd/core/ajax/deleteTweet.php', {
                    deleteTweet: tweet_id
                }, function () {
                    $('.retweet->popup').hide();
                    location.reload();
                });
            });
        });
    });
    $(document).on('click', '.imageDeleteTweet', function () {
        var tweet_id = $(this).data('tweet');
        var image_id = $(this).data('imageid');

        $.post('http://localhost/socialbd/core/ajax/deleteTweet.php', {
            showPopup: tweet_id,
            image_id: image_id
        }, function (data) {
            $('.delshow').html(data);
            $('.close-retweet-popup, .cancel-it').click(function () {
                $('.retweet-popup').hide();
            });
            $(document).on('click', '.delete-it', function () {
                var image_id = $(this).data('imageid');
                //                alert(tweet_id);
                $.post('http://localhost/socialbd/core/ajax/deleteTweet.php', {
                    imageDeleteTweet: tweet_id,
                    imageId: image_id
                }, function () {
                    $('.retweet->popup').hide();
                    location.reload();
                });
            });
        });
    });

    $(document).on('click', '.deleComment', function () {
        $('#deletePopupShow').removeAttr('id');
        $reply_i = $(this).siblings('.deleteCommentt');
        $($reply_i).attr('id', 'deletePopupShow');
        var commentID = $(this).data('comment');
        var tweet_id = $(this).data('tweet');

        $.post('http://localhost/socialbd/core/ajax/pageDeleteComment.php', {
            deletePopupShow: commentID,
            tweetId: tweet_id
        }, function (data) {

            $('#deletePopupShow').html(data);
            $('#deletePopupShow').removeAttr('id');
        });
    });


    $(document).on('click', '#cancelDeleteComment', function () {
        $('#deletePopupShow').removeAttr('id');
        $('.deleteWrape').remove();
    });



    $(document).on('click', '.deleteComment', function () {
        var commentID = $(this).data('comment');
        var tweet_id = $(this).data('tweet');

        $.post('http://localhost/socialbd/core/ajax/pageDeleteComment.php', {
            deleteComment: commentID
        }, function () {
            location.reload();
        });
    });

    $(document).on('click', '.editComment', function () {
        $('#editPopupShow').removeAttr('id');
        $reply_i = $(this).siblings('.editCommentt');
        $($reply_i).attr('id', 'editPopupShow');
        var commentID = $(this).data('comment');
        var tweet_id = $(this).data('tweet');
        var fcommentdata = $(this).data('commentdata');

        alert(fcommentdata);
        $.post('http://localhost/socialbd/core/ajax/pageDeleteComment.php', {
            editPopupShow: commentID,
            editTweetId: tweet_id,
            editcommen: fcommentdata
        }, function (data) {

            $('#editPopupShow').html(data);
            $('#editPopupShow').removeAttr('id');
        });
    });

    $(document).on('click', '.editReply', function () {
        $('#editReplyShow').removeAttr('id');
        $('.editWrap').remove();
        $reply_i = $(this).siblings('.editReplyy');
        $($reply_i).attr('id', 'editReplyShow');
        var commentID = $(this).data('comment');
        var tweet_id = $(this).data('tweet');
        var replyd = $(this).data('reply');
        var fcommentdata = $(this).data('commentdata');

        $.post('http://localhost/socialbd/core/ajax/pageDeleteComment.php', {
            editReplyShow: commentID,
            editRTweetId: tweet_id,
            editReplId: replyd,
            editRepl: fcommentdata
        }, function (data) {

            $('#editReplyShow').html(data);
            $('#editReplyShow').removeAttr('id');
        });
    });


    $(document).on('click', '#cancelDeleteComment', function () {
        $('#editPopupShow').removeAttr('id');
        $('.deleteWrape').remove();
    });



    $(document).on('click', '.deleteComment', function () {
        var commentID = $(this).data('comment');
        var tweet_id = $(this).data('tweet');

        $.post('http://localhost/socialbd/core/ajax/pageDeleteComment.php', {
            deleteComment: commentID
        }, function () {
            location.reload();
        });
    });

    $(document).on('click', '.postReplyy', function () {
        var commentID = $(this).data('comment');
        var tweet_id = $(this).data('tweet');
        var replyd = $(this).data('reply');
        var fcommentdata = $(this).siblings('.replyInp');
        $fcommentDataVal = $(fcommentdata).val();
        $.post('http://localhost/socialbd/core/ajax/pageDeleteComment.php', {
            editReplySho: commentID,
            editRTweetI: tweet_id,
            editReplI: replyd,
            editRep: $fcommentDataVal
        }, function () {
            location.reload();
        });
    });
    $(document).on('click', '.editCom', function () {
        var commentID = $(this).data('comment');
        var tweet_id = $(this).data('tweet');
        var fcommentdata = $(this).siblings('.replyInpo');
        $fcommentDataVal = $(fcommentdata).val();
        $.post('http://localhost/socialbd/core/ajax/pageDeleteComment.php', {
            editCommSho: commentID,
            editCommTweetI: tweet_id,
            editCommData: $fcommentDataVal
        }, function () {
            location.reload();
        });
    });


});
