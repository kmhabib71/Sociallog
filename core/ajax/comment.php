<?php
include '../init.php';
    include '../../class/login.php';
    $user_id = login::isLoggedIn();
if(isset($_POST['comment']) && !empty($_POST['comment'])){
	$comment = $getFromU->checkInput($_POST['comment']);
	
	$tweetID = $_POST['tweet_id'];
    $comment_id =$_POST['comment_id']; 
    
    if(!empty($comment)){ 
    
    $getFromU->create('comments', array('comment_parent_id' => $comment_id, 'comment' => $comment, 'commentOn'=> $tweetID, 'commentBy' => $user_id, 'commentAt' => date('Y-m-d H:i:s')));
		$comments = $getFromT->comments($tweetID);
		$tweet = $getFromT->getPopupTweet($tweetID);?>



    <span class="oldCommentShow">
          <?php foreach($comments as $comment){
             $commentLikes = $getFromT->commentLikes($user_id, $comment->commentOn, $comment->commentID );
             $commentLikesCou = $getFromT->CommentLikeCount( $comment->commentOn, $comment->commentID );
       ?>
       
               <div class="mainCommen">
                <div class="user-comment">
                    <div class="user"><a href="<?php echo BASE_URL.$tweet->username ; ?>" class="user"><img src="<?php echo $comment->profileImage; ?>"/></a></div>
                  </div>
                  <div class="commentText">
                <div class="comments"><strong class="username"><a href="<?php echo BASE_URL.$tweet->username ; ?>">
                        <?php echo $tweet->username ;?>
                    </a></strong><?php echo $comment->comment; ?></div>
                <div class="replyReact_wrapper">
                <div class="replyReact">
                <div class="replyLike">
                    <?php echo  (($commentLikes['likeCommentOn'] === $comment->commentID) ?  '<button class="commentUnlike-btn" data-tweet="'.$comment->commentOn.'" data-comment="'.$comment->commentID.'" data-user="'.$comment->commentBy.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="commentLikesCounter">'.COUNT($commentLikesCou).'</span></button>' : '
    <button class="commentLike-btn" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-comment="'.$comment->commentID.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="commentLikesCounter">'.((COUNT($commentLikesCou) > 0) ? COUNT($commentLikesCou) : '').'</span></button>'); ?>



    </div>
    <div class="replyLike">React</div>
    <div class="replyButton" data-comment="<?php echo $comment->commentID; ?>" data-tweet="<?php echo $comment->commentOn; ?>">
        <button type="button" class="reply" id="<?php echo $comment->commentID; ?>" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>">Reply</button>
        <div class="replyInput">
            <textarea data-autoresize name="replyInpu" class="replyIn" placeholder="Enter Comment" rows="2" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>"></textarea><input type="submit" name="replySubmit" class="postReply" value="POST" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>" data-reply="<?php echo $comment->commentID; ?>" />
        </div>
    </div>
    <?php  
                        if($comment->user_id === $user_id ){  ?>
    <div class="deleComment" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>">Delete</div>
    <div class="deleteCommentt">

    </div>
    <?php  } ?>
    <!--                        <div class="deleteComment" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>">Delete</div>-->

    </div>


    <div class="oldReplyShow">


        <?php     
     $commentID = $comment->commentID;
     
     $replyTotal = $getFromT->totalReply($commentID);
//     $replyRow = mysql_num_rows($replyTotal);
     $replyTota = count($replyTotal);
     if($replyTota > 1){
        $replyFetch = $getFromT->replyDetails($commentID);
     
    foreach ($replyFetch as $fetchReply){
 $replyLikesCheck = $getFromT->replyLikes($user_id, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID); 
  $replyLikesCou = $getFromT->replyLikeCount( $fetchReply->commentOn, $comment->commentID, $fetchReply->commentID  );
// if($replyLikesCheck['likeBy'] === $user_id){ echo 'found'; }else { echo 'not found'; } // $mou = COUNT($replyLikesCou); // echo $mou; // echo $fetchReply->commentID;
        echo '
      <div class="mainCommen">
        <div class="user-comment">
                <div class="user">
                <a href="'.BASE_URL.$fetchReply->username.'" class="user"><img src="'.$fetchReply->profileImage.'"/></a>
                
               </div>
                  </div>
      <div class="commentText">
        <div class="comments"><strong class="username"><a href="'.BASE_URL.$fetchReply->username.'">'.$fetchReply->username.'
                    </a>  </strong>'.$fetchReply->comment.'</div>
        <div class="replyReact_wrapper">
        <div class="replyReact">
                <div class="replyLike">';?>
        <?php echo 
               (($replyLikesCheck['likeBy'] === $user_id) ?
               '<button class="replyUnlike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'" data-comment="'.$comment->commentID.'" data-reply="'.$fetchReply->commentID.'"
               data-replyed="'.$fetchReply->commentID.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="replyLikesCounter">'.COUNT($replyLikesCou).'</span></button>
               ' : '
                <button class="replyLike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'" data-comment="'.$comment->commentID.'" data-reply="'.$fetchReply->commentID.'" data-replyed="'.$fetchReply->commentID.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="replyLikesCounter">'.((COUNT($replyLikesCou) > 0) ? COUNT($replyLikesCou) : '').'</span></button>
                ');?>
        <?php echo '
                
                </div>
                <div class="replyLike">React</div> '?>
        <div class="replyButtonReply" data-comment="<?php echo $comment->commentID; ?>" data-tweet="<?php echo $comment->commentOn; ?>">
            <button type="button" class="reply" id="<?php echo $comment->commentID; ?>" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>">Reply</button>
            <div class="replyInput">
                <textarea data-autoresize name="replyInpu" class="replyIn" placeholder="Enter Comment" rows="2" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>">
<?php echo '@'.$fetchReply->username; ?></textarea> <input type="submit" name="replySubmit" class="replyPostReply" value="POST" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>" data-reply="<?php echo $comment->commentID; ?>" />
            </div>
        </div>


        <?php
       
        if($fetchReply->user_id === $user_id ){
        
        
        echo '
                        <div class="deleComment" data-tweet="'.$fetchReply->commentOn.'" data-comment="'.$fetchReply->commentID.'">Delete</div>
                 <div class="deleteCommentt" >
                   
                </div>';
               }
                 
               echo'  
                 
                 
                 </div>
                 </div>
                 </div>
                 </div>
                 <br>';
    
    

}  
     }else {echo '<div class="replyCountSyle" data-tweet="'.$comment->commentOn.'" data-comment="'.$comment->commentID.'">'.$replyTota.' replys on the comment</div>'; }
     
      ?>

    </div>
    <div class="replyShow">

    </div>
    </div>
    <!--
<div class="replyReact">
    <div class="replyLike">Like</div>
    <div class="replyLike">React</div>

    <div class="replyButton">
        <button type="button" class="reply" id="'.$comment->commentID.'">Reply</button></div>
    <div class="deleteComment" data-tweet="<?php $tweet->tweetID  ?>" data-comment="<?php $tweet->tweetID  ?>">Delete</div>
</div>
-->
    </div>
    </div>

    <?php }  ?>
    </span>
    <?php }
  
  
    }
    

?>
    <?php
if(isset($_POST['tweet_idg']) && !empty($_POST['tweet_idg'])){
    $tweetIDG = $_POST['tweet_idg'];
    $comments = $getFromT->comments($tweetIDG);
    
      foreach ($comments as $comment){
            echo '
                <div class="mainCommen">
                <div class="user-comment">
                <div class="user"><img src="'.$comment->profileImage.'"/></div>
                  </div>
                  <div class="commentText">
                <div class="comments"><strong class="username">'.$comment->username.'</strong>'.$comment->comment.'</div>
                <div class="replyReact">
                <div class="replyLike">Like</div>
                <div class="replyLike">React</div>
              <div class="replyButton">
                 <button type="button"  class="reply" id="'.$comment->commentID.'" data-tweet="'.$comment->commentOn.'" data-comment="'.$comment->commentID.'">Reply</button>
                 <div class="replyInput"> <textarea data-autoresize name="replyInpu" class="replyIn" placeholder="Enter Comment" rows="2"  data-tweet="'.$comment->commentOn.'"></textarea><input type="submit" name="replySubmit" class="postReply" value="POST" data-tweet="'.$comment->commentOn.'"/>
                 </div>
                 </div>
                 <div class="deleteComment" data-tweet="'.$comment->commentOn.'" data-comment="'.$comment->commentID.'">Delete</div>
                 
                 </div>
            
           
             </div>
                 </div>
                 
                </div>
                <div> 
               </div>
           '
                ;
            
        }
}
//if(isset($_POST['instComm']) && !empty($_POST['instComm'])){
//    $instCom = $getFromU->checkInput($_POST['instComm']);
//    $tweetIDD = $_POST['tweet_idd'];
//     if(!empty($instCom)){
//         $getFromU->create('comments', array('comment' => $instCom, 'commentOn'=> $tweetIDD, 'commentBy' => $user_id, 'commentAt' => date('Y-m-d H:i:s')));
//		$instCo = $getFromT->comments($tweetIDD);
//		$tweet = $getFromT->getPopupTweet($tweetIDD);
//             foreach ($instCo as $instC){
//            echo '
//               <div class="user-comment">
//                <div class="user"><img src="'.$instC->profileImage.'"/></div>
//                  </div>
//      
//           <div class="commentShow">
//        <div class="comments"><strong class="username">'.$instC->username.'</strong><span class="commentStatus">'.$instC->comment.'</span></div>
//          </div>
//              
//           ' ;
//            
//        }
//     }
//}
