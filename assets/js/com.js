$(document).ready(function () {
    $(document).on('focusin', '.commentInput', function() {
    
         $tweet_id = $(this).data('tweet');
        $('#replyAppear').removeAttr('id'); $('#comment_form').removeAttr('id');
        $('#comment_content').removeAttr('id');
        $('#comment_id').removeAttr('id');
        $('#submit').removeAttr('id');
        $('#display_comment').removeAttr('id');
//        $('.containerer').removeClass();
//          $('#oldCommentShowRemove').remove(); $.post('http://localhost/socialbd/core/ajax/comment.php', {
//            tweet_idg: $tweet_id
//        }, function (data) {
//            $("#display_comment").html(data);
//            //           $('#comment_content').val("");
//            $('#comment_id').val('0');
//
//            //        load_comment();
//
//
//        });
    });
     $(document).on('click', '.moreComment', function() {
    
         $tweet_id = $(this).data('tweet');
        $('#replyAppear').removeAttr('id');
        $('#comment_form').removeAttr('id');
        $('#comment_content').removeAttr('id');
        $('#comment_id').removeAttr('id');
        $('#submit').removeAttr('id');
        $('#display_comment').removeAttr('id');
          $('#oldCommentShowRemove').remove(); 
        $.post('http://localhost/socialbd/core/ajax/comment.php', {
            tweet_idg: $tweet_id
        }, function (data) {
            $("#display_comment").html(data);
            //           $('#comment_content').val("");
            $('#comment_id').val('0');

            //        load_comment();


        });
    });
    $(document).on('click', '.mainComment', function() {
    
        $('#replyAppear').removeAttr('id');
        $('#comment_form').removeAttr('id');
        $('#comment_content').removeAttr('id');
        $('#comment_id').removeAttr('id');
        $('#submit').removeAttr('id');
        $('#display_comment').removeAttr('id');
    });

    $('.containerer').click(function () {
        //        $('#comment_form').removeAttr('id');
        //        $('#comment_content').removeAttr('id');
        //        $('#comment_id').removeAttr('id');
        //        $('#submit').removeAttr('id');
        $('#display_comment').removeAttr('id');
    });
$(document).on('click', '.containerer', function() {
        $tweet_id = $(this).data('tweet');
        $coun = $(this).find('.formClass');
        $($coun).attr('id', 'comment_form');
        $cous = $(this).find('.commentInput');
        $($cous).attr('id', 'comment_content');

        $couse = $(this).find('.hidClass');
        $($couse).attr('id', 'comment_id');
        $couser = $(this).find('.oldCommentShow');
        $($couser).attr('id', 'oldCommentShowRemove');


        $cousen = $(this).find('.postComment');
        $($cousen).attr('id', 'submit');

        $couset = $(this).find('.dispplay_commen');
        $($couset).attr('id', 'display_comment');

        $cousettt = $(this).find('.replyTextarea');
        $($cousettt).attr('id', 'replyAppear');


//        $('#replyAppear').remove();
      


        //    var tweet_id  = $(this).data('tweet');

        //     var bar = '' + tweet_id;

        //alert($comment);

       

        //        $.post('http://localhost/socialbd/core/ajax/pop.php', {showpopup:$tweet_id}, function(data){
        //            $("#display_comment").html(data);
        //        });

    });
$(document).on('click', '.postComment', function() {
        $('#oldCommentShowRemove').remove();
        $comment = $('#comment_content').val();
        var tweet_id = $(this).data('tweet');
        var comment_idd = $('#comment_id').val();
        //     var bar = '' + tweet_id;

        //alert($comment);
        if ($comment != "") {
            $.post('http://localhost/socialbd/core/ajax/comment.php', {
                comment: $comment,
                comment_id: comment_idd,
                tweet_id: tweet_id
            }, function (data) {
                $("#display_comment").html(data);
                $('#comment_content').val("");
                $('#comment_id').val('0');

                //        load_comment();


            });
        }
    });
    //    load_comment();
    //    function load_comment(){
    //	$.ajax({
    //		url:"http://localhost/socialbd/core/ajax/pop.php",
    //		method: "POST",
    //		success:function(data)
    //		{
    //			$('#display_comment').html(data);
    //		}
    //	})
    //}


    //    $('#comment_form').on('submit', function(event){
    //  event.preventDefault();
    //  var form_data = $(this).serialize();
    //        var tweetID = $(this).data('tweet');
    //  $.ajax({
    //   url:"popInsert.php",
    //   method:"POST",
    //   data:'form_data=' + form_data + '&tweetID=' + tweetID,
    //   dataType:"JSON",
    //   success:function(data)
    //   {
    //    if(data.error != '')
    //    {
    ////     $('#comment_form')[0].reset();
    ////     $('#comment_message').html(data.error);
    //      $('#comment_id').val('0');
    //     load_comment();
    //    }
    //   }
    //  })
    // });


    //    $(submit).click( function() {
    // 
    //    $comment = $('#comment_content').val();
    //    $tweet_id  = $(this).data('tweet');
    //    $comment_id = $('#comment_id').val();
    ////     var bar = '' + tweet_id;
    //
    ////alert($comment);
    //	if($comment != ""){
    //		$.post('http://localhost/socialbd/core/ajax/popInsert.php', {comment:$comment, tweet_id:$tweet_id, comment_idd:$comment_id}, function(data){
    //			  {
    //   
    ////     $('#comment_form')[0].reset();
    ////     $('#comment_message').html(data.error);
    //      $('#comment_id').val('0');
    //     load_comment();
    //      }
    //            
    //		
    //	});
    //	}
    //});
    //      function load_comment(){
    //	$.ajax({
    //		url:"pop.php",
    //		method: "POST",
    //		success:function(data)
    //		{
    //			$('#display_comment').html(data);
    //		}
    //	})
    //}
    //   $(document).on('click', '.reply', function(){
    //	var comment_id = $(this).attr("id");
    //	$('#comment_id').val(comment_id);
    //	$('#comment_name').focus();
    //}); 
    // $('#comment_form').on('submit', function(event){
    //  event.preventDefault();
    //  var form_data = $(this).serialize();
    //  $.ajax({
    //   url:"add_comment.php",
    //   method:"POST",
    //   data:form_data,
    //   dataType:"JSON",
    //   success:function(data)
    //   {
    //    if(data.error != '')
    //    {
    //     $('#comment_form')[0].reset();
    //     $('#comment_message').html(data.error);
    //      $('#comment_id').val('0');
    //     load_comment();
    //    }
    //   }
    //  })
    // });
    //load_comment();
    //function load_comment(){
    //	$.ajax({
    //		url:"fetch_comment.php",
    //		method: "POST",
    //		success:function(data)
    //		{
    //			$('#display_comment').html(data);
    //		}
    //	})
    //}
});
