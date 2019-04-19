$(function () {
    $(document).on('click', '.like-btn', function () {
        var tweet_id = $(this).data('tweet');
        var user_id = $(this).data('user');
        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);

        $.post('http://localhost/socialbd/core/ajax/like.php', {
            like: tweet_id,
            user_id: user_id
        }, function () {
            counter.show();
            button.addClass('unlike-btn');
            button.removeClass('like-btn');
            count++;
            counter.text(count);
            //            button.find('.fa-thumbs-up').addClass('fa-thumbs-up');
            //            button.find('.fa-thumbs-up').removeClass('fa-thumbs-up');
        });
    });
    $(document).on('click', '.unlike-btn', function () {
        var tweet_id = $(this).data('tweet');
        var user_id = $(this).data('user');
        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);

        $.post('http://localhost/socialbd/core/ajax/like.php', {
            unlike: tweet_id,
            user_id: user_id
        }, function () {
            counter.show();
            button.addClass('like-btn');
            button.removeClass('unlike-btn');
            count--;
            if (count === 0) {
                counter.hide();
            } else {
                counter.text(count);
            }
            counter.text(count);
            //            button.find('.fa-thumbs-up').addClass('fa-thumbs-up');
            //            button.find('.fa-thumbs-up').removeClass('fa-thumbs-up');
        });
    });

    $(document).on('click', '.commentLike-btn', function () {
        var tweet_id = $(this).data('tweet');
        var comment_id = $(this).data('comment');
        var user_id = $(this).data('user');
        var counter = $(this).find('.commentLikesCounter');
        var count = counter.text();
        var button = $(this);

        $.post('http://localhost/socialbd/core/ajax/like.php', {
            commentLike: tweet_id,
            commentID: comment_id,
            user_id: user_id
        }, function () {
            counter.show();
            button.addClass('commentUnlike-btn');
            button.removeClass('commentLike-btn');
            count++;
            counter.text(count);
            //            button.find('.fa-thumbs-up').addClass('fa-thumbs-up');
            //            button.find('.fa-thumbs-up').removeClass('fa-thumbs-up');
        });
    });
    $(document).on('click', '.commentUnlike-btn', function () {
        var tweet_id = $(this).data('tweet');
        var comment_id = $(this).data('comment');
        var user_id = $(this).data('user');
        var counter = $(this).find('.commentLikesCounter');
        var count = counter.text();
        var button = $(this);

        $.post('http://localhost/socialbd/core/ajax/like.php', {
            commentUnlike: tweet_id,
            commentID: comment_id,
            user_id: user_id
        }, function () {
            counter.show();
            button.addClass('commentLike-btn');
            button.removeClass('commentUnlike-btn');
            count--;
            if (count === 0) {
                counter.hide();
            } else {
                counter.text(count);
            }
            counter.text(count);
            //            button.find('.fa-thumbs-up').addClass('fa-thumbs-up');
            //            button.find('.fa-thumbs-up').removeClass('fa-thumbs-up');
        });
    });

    $(document).on('click', '.replyLike-btn', function () {
        var tweet_id = $(this).data('tweet');
        var reply_id = $(this).data('comment');
        var user_id = $(this).data('user');
        var replyed_id = $(this).data('reply');
        var counter = $(this).find('.replyLikesCounter');
        var count = counter.text();
        var button = $(this);


        $.post('http://localhost/socialbd/core/ajax/like.php', {
            replyLike: tweet_id,
            replyID: reply_id,
            replyedID: replyed_id,
            user_id: user_id
        }, function () {
            counter.show();
            button.addClass('replyUnlike-btn');
            button.removeClass('replyLike-btn');
            count++;
            counter.text(count);
            //            button.find('.fa-thumbs-up').addClass('fa-thumbs-up');
            //            button.find('.fa-thumbs-up').removeClass('fa-thumbs-up');
        });
    });
    $(document).on('click', '.replyUnlike-btn', function () {
        var tweet_id = $(this).data('tweet');
        var reply_id = $(this).data('comment');
        var user_id = $(this).data('user');
        var replyed_id = $(this).data('reply');
        var counter = $(this).find('.replyLikesCounter');
        var count = counter.text();
        var button = $(this);

        $.post('http://localhost/socialbd/core/ajax/like.php', {
            replyUnLike: tweet_id,
            replyID: reply_id,
            replyedID: replyed_id,
            user_id: user_id
        }, function () {
            counter.show();
            button.addClass('replyLike-btn');
            button.removeClass('replyUnlike-btn');
            count--;
            if (count === 0) {
                counter.hide();
            } else {
                counter.text(count);
            }
            counter.text(count);
            //            button.find('.fa-thumbs-up').addClass('fa-thumbs-up');
            //            button.find('.fa-thumbs-up').removeClass('fa-thumbs-up');
        });
    });
});
