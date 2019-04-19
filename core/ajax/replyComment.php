<?php
include '../init.php';
    include '../../class/login.php';
    $user_id = login::isLoggedIn();

if(isset($_POST['reply']) && !empty($_POST['reply'])){
   $user_id = login::isLoggedIn();

   $comment = $getFromU->checkInput($_POST['reply']);
	
	$commentID = $_POST['parent_comment_id'];
    $tweetID =$_POST['commented_On']; 
    $commentReplyID = $_POST['commentReplyID']; 
    
     $getFromU->create('comments', array('comment_parent_id' => $commentID,'commentReplyID' => $commentReplyID, 'comment' => $comment, 'commentOn'=> $tweetID, 'commentBy' => $user_id, 'commentAt' => date('Y-m-d H:i:s')));

    $replyFetch = $getFromT->replyDetails($commentID);
    foreach ($replyFetch as $fetchReply){
        $replyLikesCheck = $getFromT->replyLikes($user_id, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID);
          $replyLikesCou = $getFromT->replyLikeCount( $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID  );
        echo ' 
<div class="mainCommen">
    <div class="user-comment">
        <div class="user"><a href="'.BASE_URL.$fetchReply->username.'" class="user"><img src="'.$fetchReply->profileImage.'"/></a></div>
    </div>
    <div class="commentText">
        <div class="comments"><strong class="username"><a href="'.BASE_URL.$fetchReply->username.'">'.$fetchReply->username.'
                    </a></strong>'.$fetchReply->comment.'</div>
        <div class="replyReact_wrapper">
            <div class="replyReact">
                <div class="replyLike">';?>
    <?php echo 
               (($replyLikesCheck['likeBy'] === $user_id) ?
               '<button class="replyUnlike-btn" data-tweet="'.$fetchReply->commentOn.'" data-user="'.$fetchReply->commentBy.'" data-comment="'.$fetchReply->comment_parent_id.'" data-reply="'.$fetchReply->commentID.'"
               data-replyed="'.$fetchReply->commentID.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="replyLikesCounter">'.COUNT($replyLikesCou).'</span></button>
               ' : '
                <button class="replyLike-btn" data-tweet="'.$fetchReply->commentOn.'" data-user="'.$fetchReply->commentBy.'" data-comment="'.$fetchReply->comment_parent_id.'" data-reply="'.$fetchReply->commentID.'" data-replyed="'.$fetchReply->commentID.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="replyLikesCounter">'.((COUNT($replyLikesCou) > 0) ? COUNT($replyLikesCou) : '').'</span></button>
                ');?>
    <?php echo '
                
                </div>
                <div class="replyLike">React</div> '?>
    <div class="replyButtonReply" data-comment="<?php echo $fetchReply->comment_parent_id; ?>" data-tweet="<?php echo $fetchReply->commentOn; ?>">
        <button type="button" class="reply" id="<?php echo $fetchReply->comment_parent_id; ?>" data-tweet="<?php echo $fetchReply->commentOn; ?>" data-comment="<?php echo $fetchReply->comment_parent_id; ?>">Reply</button>
        <div class="replyInput">
            <textarea data-autoresize name="replyInpu" class="replyIn" placeholder="Enter Comment" rows="2" data-tweet="<?php echo $fetchReply->commentOn; ?>" data-comment="<?php echo $fetchReply->comment_parent_id; ?>">
<?php echo '@'.$fetchReply->username; ?></textarea> <input type="submit" name="replySubmit" class="replyPostReply" value="POST" data-tweet="<?php echo $fetchReply->commentOn; ?>" data-comment="<?php echo $fetchReply->comment_parent_id; ?>" data-reply="<?php echo $fetchReply->comment_parent_id; ?>" />
        </div>
    </div>


    <?php echo '
                    <div class="deleComment" data-tweet="'.$fetchReply->commentOn.'" data-comment="'.$fetchReply->commentID.'">Delete</div>
                 <div class="deleteCommentt" >
                   
                </div>
                 
                 
                 </div>
                 </div>
                 </div>
                 </div>
                 <br>';
    
    

}  
     }else {echo '<div class="replyCountSyle" data-tweet="'.$comment->commentOn.'" data-comment="'.$comment->commentID.'">'.$replyTota.' replys on the comment</div>'; }
     
      ?>
    <?php  

    
//   echo 'found' ;
    

if(isset($_POST['parent_comment_idd']) && !empty($_POST['parent_comment_idd'])){ 
    
   $replyCommentID = $_POST['parent_comment_idd']; 
   $replyTweetID = $_POST['commented_Onn']; 

    $replyFetc = $getFromT->replyDetails($replyCommentID,$replyTweetID);
    foreach ($replyFetc as $fetchReply){
        echo ' 
               <div class="mainCommen">
        <div class="user-comment">
                <div class="user"><img src="'.$fetchReply->profileImage.'"/></div>
                  </div>
      <div class="commentText">
        <div class="comments"><strong class="username">'.$fetchReply->username.'</strong>'.$fetchReply->comment.'</div>
        <div class="replyReact_wrapper">
        <div class="replyReact">
                <div class="replyLike">Like</div>
                <div class="replyLike">React</div>
                <div class="replyButton" data-comment="'.$fetchReply->commentID.'" data-tweet="'.$fetchReply->commentOn.'">
                 <button type="button" class="reply" id="'.$fetchReply->commentID.'" data-tweet="'.$fetchReply->commentOn.'" data-comment="'.$fetchReply->commentID.'">Reply</button>
                 <div class="replyInput"> 
               <textarea data-autoresize name="replyInpu" class="replyIn" placeholder="Enter Comment" rows="2"  data-tweet="'.$fetchReply->commentOn.'" data-comment="'.$fetchReply->commentID.'"></textarea><input type="submit" name="replySubmit" class="postReply" value="POST" data-tweet="'.$fetchReply->commentOn.'" data-comment="'.$fetchReply->commentID.'"/>
                 </div>
                 </div>
                 
                 <div class="deleteComment" data-tweet="'.$fetchReply->commentOn.'" data-comment="'.$fetchReply->commentID.'">Delete</div>
                 
                 </div>
                 </div>
                 </div>
                 </div>
                 <br>';  
}
}

?>
