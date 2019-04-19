$(function() {
//     $('.commentInput').focusin(function(){
//        $('#mainComments').removeAttr('id');
//        $('#comIn').removeAttr('id');
//    }); 
//$('.comment').focusin( function() {
//    $cou = $(this).find('.instComme');
//    $($cou).attr('id', 'mainComments');
//    $cous = $(this).find('.commentInput');
//    $($cous).attr('id', 'comIn');
//});
//   
$('.postComment').click( function() {
    $counter    = 
    $comment = $('#comment_content').val();
    var tweet_id  = $(this).data('tweet');
    var comment_idd = $('#comment_id').val();
//     var bar = '' + tweet_id;

//alert($comment);
	if($comment != ""){
		$.post('http://localhost/socialbd/core/ajax/comment.php', {comment:$comment, comment_id:comment_idd, tweet_id:tweet_id}, function(data){
           $('#comment_content').val("");
		$('#comment_id').val('0');
        load_comment();
            
		
	});
	}
});
    function load_comment(){
	$.ajax({
		url:"http://localhost/socialbd/core/ajax/pop.php",
		method: "POST",
		success:function(data)
		{
			$('#display_comment').html(data);
		}
	})
}

//    $('.comment').keyup( function() {
//        var tweet_idd  = $(this).data('tweet');
//        $counter    = $(this).find('.commentInput');
//       
//      $comIns = $counter.val();  $.post('http://localhost/socialbd/core/ajax/comment.php', {instComm:$comIns, tweet_idd:tweet_idd}, function(data){
//        $('#mainComments').html(data);
//    });
//    });
    });
