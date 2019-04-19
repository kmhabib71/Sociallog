$(function () {
    $(document).on('click', '.replyReact_wrapper', function () {
        $('#replyShow_here').removeAttr('id');
        //        $reply_in = $(this).find('.replyIn');
        //        $($reply_in).attr('id', 'reply_inn');
        $reply_inn = $(this).find('.oldReplyShow');
        $($reply_inn).attr('id', 'oldReplyShowRemove');
        $reply_coun = $(this).find('.replyShow');
        $($reply_coun).attr('id', 'replyShow_here');
        //    $reply_in = $(this).find('.oldReplyShow');

    });
    //    $(document).on('click', '.replyReact_wrapper', function () {
    //    
    //    $('#reply_inn').removeAttr('id');
    //    
    //    });
    $(document).on('click', '.replyButton', function () {
        $('#reply_inn').removeAttr('id');
        $reply_in = $(this).find('.replyIn');
        $($reply_in).attr('id', 'reply_inn');

        $('#replyInputRemove').removeAttr('id');
        $('#replyInputRemove').removeAttr('id');
        $inputHide = $(this).find('.replyInput');
        $($inputHide).attr('id', 'replyInputRemove');

        $('#reply_inn').removeAttr('id');
        $reply_in = $(this).find('.replyIn');
        $($reply_in).attr('id', 'reply_inn');
        //        $('.replyInput').hide();
        //        $repVa  = $(this).find('.replyIn');
        //        $$repValue =$($repVa).val();
        $parent_comment_id = $(this).data('comment');
        $commented_On = $(this).data('tweet');
        //        $('.replyInput').hide();
        //        $tweet_ide = $(this).data('tweet');

        $repl = $(this).find('.replyInput');
        $($repl).show();

        //        $($repl).attr('id', 'replyInputRemove');
        //        
    });
    $(document).on('click', '.replyButtonReply', function () {
        $('#reply_inn').removeAttr('id');
        $reply_in = $(this).find('.replyIn');
        $($reply_in).attr('id', 'reply_inn');
        $('#replyInputRemove').removeAttr('id');
        $('#replyInputRemove').removeAttr('id');
        $inputHide = $(this).find('.replyInput');
        $($inputHide).attr('id', 'replyInputRemove');

        //        $('#reply_inn').removeAttr('id');
        $('.replyInput').hide();
        //        $repVa  = $(this).find('.replyIn');
        //        $$repValue =$($repVa).val();
        $parent_comment_id = $(this).data('comment');
        $commented_On = $(this).data('tweet');
        //        $('.replyInput').hide();
        //        $tweet_ide = $(this).data('tweet');

        $repl = $(this).find('.replyInput');
        $($repl).show();

        //        $($repl).attr('id', 'replyInputRemove');
        //        
    });
    $(document).on('click', '.postReply', function () {

        //       $repVa  = $(this).find('.replyIn');
        //        $$repValue =$($repVa).val();
        //        $('#oldReplyShowRemove').remove()
        //        $('#replyInputRemove').removeAttr('id');
        //        $('#oldCommentShowRemove').removeAttr('id');
        $reply = $('#reply_inn').val();
        $parent_comment_id = $(this).data('comment');
        $commented_On = $(this).data('tweet');
        $commentReplyID = $(this).data('reply');
        $pageid = $(this).data('pageid');



        //     var bar = '' + tweet_id;

        //alert($comment);
        if ($reply != "") {
            $.post('http://localhost/socialbd/core/ajax/pageReplyComment.php', {
                reply: $reply,
                parent_comment_id: $parent_comment_id,
                commented_On: $commented_On,
                commentReplyID: $commentReplyID,
                pageid: $pageid
            }, function (data) {
                $("#replyShow_here").append(data);
                $('#reply_inn').val("");
                $('#replyInputRemove').hide();
                //                $('#reply_inn').remove();
                $('#reply_inn').removeAttr('id');
                //                $('#oldReplyShowRemove').remove();
                //                $('#comment_id').val('0');

                //        load_comment();


            });
        }
    });
    $(document).on('click', '.replyPostReply', function () {

        //       $repVa  = $(this).find('.replyIn');
        //        $$repValue =$($repVa).val();
        //        $('#oldReplyShowRemove').remove()
        //        $('#replyInputRemove').removeAttr('id');
        //        $('#oldReplyShowRemove').remove();
        $reply = $('#reply_inn').val();
        $parent_comment_id = $(this).data('comment');
        $commented_On = $(this).data('tweet');
        $commentReplyID = $(this).data('reply');
        $pageid = $(this).data('pageid');

        //     var bar = '' + tweet_id;
        //        if ($reply != 0) {
        //            alert($reply);
        //        } else {
        //            alert('not Found');
        //        }

        //alert($comment);
        if ($reply != "") {
            $.post('http://localhost/socialbd/core/ajax/pageReplyComment.php', {
                reply: $reply,
                parent_comment_id: $parent_comment_id,
                commented_On: $commented_On,
                commentReplyID: $commentReplyID,
                pageid: $pageid
            }, function (data) {
                $("#replyShow_here").append(data);
                $('#reply_inn').val("");
                $('#replyInputRemove').hide();
                $('#reply_inn').removeAttr('id');
                //                $('#oldReplyShowRemove').remove();
                //                $('#comment_id').val('0');

                //        load_comment();


            });
        }
    });

    $(document).on('click', '.replyCountSyle', function () {
        $('#replyCountSyleID').removeAttr('id');
        $(this).attr('id', 'replyCountSyleID');
        //        $reply = $('#reply_inn').val();
        $parent_comment_idd = $(this).data('comment');
        $commented_Onn = $(this).data('tweet');
        $.post('http://localhost/socialbd/core/ajax/replyComment.php', {

            parent_comment_idd: $parent_comment_idd,
            commented_Onn: $commented_Onn
        }, function (data) {
            $('#replyCountSyleID').html(data);

        });

        //     var bar = '' + tweet_id;

        //alert($comment);

    });






});


//    $.post('http://localhost/socialbd/core/ajax/replyComment.php', {
//            $parent_comment_id: $parent_comment_id, $commented_On:$commented_On
//        }, function (data) {
//            $("#display_comment").html(data);
//            //           $('#comment_content').val("");
//            $('#comment_id').val('0');
//
//            //        load_comment();
//
//
//        });
//        $tweet_comment = $(this).data('comment');
//        $('#replyAppear').removeAttr('id');
//        $.post('http://localhost/socialbd/core/ajax/replyComment.php', {
//                tweet_idg: $tweet_id,
//                tweet_comment: $tweet_comment
//            },
//
//            function (data) {
//                $('#replyAppear').html(data);
//            });

//});
