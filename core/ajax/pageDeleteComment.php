<?php
include '../init.php';
    include '../../class/login.php';
    $user_id = login::isLoggedIn();
if(isset($_POST['deleteComment']) && !empty($_POST['deleteComment'])){
    $user_id = login::isLoggedIn();

	$commentID = $_POST['deleteComment'];
	$getFromU->delete('pagecomments', array('commentID' => $commentID));

}
if(isset($_POST['deletePopupShow']) && !empty($_POST['deletePopupShow'])){
    $deletePopupShow = $_POST['deletePopupShow'];
    $tweetId = $_POST['tweetId'];
    
 echo '<div class="deleteWrape">
 
                <div class="deleteComment" data-tweet="'.$tweetId.'" data-comment="'.$deletePopupShow.'">Delete Comment</div>
                <div id="cancelDeleteComment">Cancel</div>
            </div>';

}
if(isset($_POST['editPopupShow']) && !empty($_POST['editPopupShow'])){
    $editPopupShow = $_POST['editPopupShow'];
    $tweetId = $_POST['editTweetId'];
    $editcommen = $_POST['editcommen'];
   
 echo '
 <div class="editWrap"><textarea data-autoresize name="replyInpu" class="replyInpo" placeholder="Enter Comment" rows="2" data-tweet="'.$tweetId.'" data-comment="'.$editPopupShow.'">'.$editcommen.'</textarea>
 <input type="submit" name="replySubmit" class="editCom" value="POST" data-tweet="'.$tweetId.'" data-comment="'.$editPopupShow.'" data-reply="'.$editPopupShow.'" /></div>';

}
if(isset($_POST['editReplyShow']) && !empty($_POST['editReplyShow'])){
    $editReplyShow = $_POST['editReplyShow'];
    $tweetId = $_POST['editRTweetId'];
    $editReplId = $_POST['editReplId'];
    $editRepl = $_POST['editRepl'];
   
 echo '<div class="editWrap">
 
 <textarea data-autoresize name="replyInpu" class="replyInp" placeholder="Enter Comment" rows="2" data-tweet="'.$tweetId.'" data-comment="'.$editReplyShow.'" data-reply="'.$editReplId.'" >'.$editRepl.'</textarea>
 <input type="submit" name="replySubmit" class="postReplyy" value="POST" data-tweet="'.$tweetId.'" data-comment="'.$editReplyShow.'" data-reply="'.$editReplId.'" /></div>';
    

}
if(isset($_POST['editReplySho']) && !empty($_POST['editReplySho'])){
    $editReplyComment = $_POST['editReplySho'];
    $tweetId = $_POST['editRTweetI'];
    $editReplId = $_POST['editReplI'];
    $editReplData = $_POST['editRep'];
   
$getFromP->editReply($editReplyComment, $tweetId, $editReplId, $editReplData);
 
    

}
if(isset($_POST['editCommSho']) && !empty($_POST['editCommSho'])){
    $editComment = $_POST['editCommSho'];
    $tweetId = $_POST['editCommTweetI'];
    $editCommlData = $_POST['editCommData'];
   
$getFromP->editComment($editComment, $tweetId, $editCommlData);

}

?>
