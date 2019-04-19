$(document).ready(function(){
//    $('.postReply').click(function () {
//       $('#oldReplyShowRemove').remove();
////       $repVa  = $(this).find('.replyIn');
////        $$repValue =$($repVa).val();
////        $('#oldReplyShowRemove').remove()
////        $('#replyInputRemove').removeAttr('id');
//        
//        $reply = $('#reply_inn').val();
//        $parent_comment_id = $(this).data('comment');
//        $commented_On = $(this).data('tweet');
//        
//        
//        //     var bar = '' + tweet_id;
//
//        //alert($comment);
//        if ($reply != "") {
//            $.post('http://localhost/socialbd/core/ajax/replyComment.php', {
//                reply: $reply,
//                parent_comment_id: $parent_comment_id,
//                commented_On: $commented_On
//            }, function (data) {
//                $("#replyShow_here").html(data);
//                $('#reply_inn').val("");
//                 $('#replyInputRemove').hide();
////                $('#comment_id').val('0');
//
//                //        load_comment();
//
//
//            });
//        }
//    });
  
    $('.replyCountSyle').click(function(){
        $('#replyCountSyleID').removeAttr('id');
       $(this).attr('id', 'replyCountSyleID');
//        $reply = $('#reply_inn').val();
        $parent_comment_idd = $(this).data('comment');
        $commented_Onn = $(this).data('tweet');
         $.post('http://localhost/socialbd/core/ajax/replyComment.php',{
               
                parent_comment_idd: $parent_comment_idd,
                commented_Onn: $commented_Onn
            }, function (data) {
             $('#replyCountSyleID').html(data);
             
         });
        
        //     var bar = '' + tweet_id;

        //alert($comment);
     
    });
});