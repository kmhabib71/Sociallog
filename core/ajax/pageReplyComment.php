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
    $pageid = $_POST['pageid']; 
    
     $getFromU->create('pagecomments', array('commentPageID' => $pageid,'comment_parent_id' => $commentID,'commentReplyID' => $commentReplyID, 'comment' => $comment, 'commentOn'=> $tweetID, 'commentBy' => $user_id, 'commentAt' => date('Y-m-d H:i:s')));
//Ekhan thake reply fetch thik korte hobe........19/4--2:00pm
    
    
    $replyTotal = $getFromP->totalReply($commentID, $pageid);
//     $replyRow = mysql_num_rows($replyTotal);
     $replyTota = count($replyTotal);
     if($replyTota >= 1){
        $replyFetch = $getFromP->replyDetails($pageid, $commentID);
    
    foreach ($replyFetch as $fetchReply){
        $mainLike = 'mainLike';
            $lovee = 'love';
            $happy = 'happy';
            $angryy = 'angry';
            $sadd = 'sad';
            $secrete = 'secrete';
            $unhealthy = 'unhealthy';
            $bedSick = 'bedSick';
// $replyLikesCheck = $getFromP->replyLikes($user_id,$fetchReply->commentPageID, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID,$fetchReply->commentPageID);  
           
$replyLikeReact = $getFromP->replyReact($user_id,$fetchReply->commentPageID, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID, $mainLike); 
$replySmileReact = $getFromP->replyReact($user_id,$fetchReply->commentPageID, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID, $happy );
$replySadReact = $getFromP->replyReact($user_id,$fetchReply->commentPageID, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID,$sadd ); 
$replyAngryReact = $getFromP->replyReact($user_id,$fetchReply->commentPageID, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID,$angryy ); 
        
            
        
  $replyReactLCount = $getFromP->replyReactCount( $fetchReply->commentOn, $fetchReply->commentID, $fetchReply->commentID, $fetchReply->commentPageID, $mainLike);
  $replyReactSCount = $getFromP->replyReactCount( $fetchReply->commentOn, $fetchReply->commentID, $fetchReply->commentID, $fetchReply->commentPageID, $happy);
  $replyReactSACount = $getFromP->replyReactCount( $fetchReply->commentOn, $fetchReply->commentID, $fetchReply->commentID, $fetchReply->commentPageID,$sadd);
  $replyReactRCount = $getFromP->replyReactCount( $fetchReply->commentOn, $fetchReply->commentID, $fetchReply->commentID, $fetchReply->commentPageID, $angryy);
// if($replyLikesCheck['likeBy'] === $user_id){ echo 'found'; }else { echo 'not found'; } // $mou = COUNT($replyLikesCou); // echo $mou; // echo $fetchReply->commentID;
        echo '
      <li><div class="mainCommen">
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
                <div class="reactReplyLike">';?>
    <!--
                     <li>
                        <?php echo 
               (($replyLikesCheck['likeBy'] === $user_id) ?
               '<button class="replyUnlike-btn" data-tweet="'.$fetchReply->commentPageID.'" data-user="'.$fetchReply->userID.'" data-comment="'.$fetchReply->commentID.'" data-reply="'.$fetchReply->commentID.'"
               data-replyed="'.$fetchReply->commentID.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="replyLikesCounter">'.COUNT($replyReactLCount).'</span></button>
               ' : '
                <button class="replyLike-btn" data-tweet="'.$fetchReply->pagePostID.'" data-user="'.$fetchReply->userID.'" data-comment="'.$fetchReply->commentID.'" data-reply="'.$fetchReply->commentID.'" data-replyed="'.$fetchReply->commentID.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="replyLikesCounter">'.((COUNT($replyReactLCount) > 0) ? COUNT($replyReactLCount) : '').'</span></button>
                ');?></li>
-->

    <ul>
        <li>
            <?php echo  (($replyLikeReact['reactBy'] === $user_id) ?  '<button class="Unliker-btn" data-pageid="'.$fetchReply->commentPageID.'" data-tweet="'.$fetchReply->commentOn.'" data-comment="'.$fetchReply->commentID.'" data-user="'.$fetchReply->commentBy.'" data-type="mainLike" data-reply="'.$fetchReply->commentID.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter">'.COUNT($replyReactLCount).'</span></button>' : '
                            <button class="Liker-btn" data-pageid="'.$fetchReply->commentPageID.'" data-tweet="'.$fetchReply->commentOn.'" data-user="'.$fetchReply->commentBy.'" data-comment="'.$fetchReply->commentID.'" data-type="mainLike" data-reply="'.$fetchReply->commentID.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($replyReactLCount) > 0) ? COUNT($replyReactLCount) : '').'</span></button>'); ?>
        </li>

        <li>
            <?php echo (($replySmileReact['reactBy'] === $user_id ) ?  '<button class="unSmiler-btn" data-pageid="'.$fetchReply->commentPageID.'" data-tweet="'.$fetchReply->commentOn.'" data-user="'.$fetchReply->commentBy.'" data-type="happy" data-comment="'.$fetchReply->commentID.'" data-reply="'.$fetchReply->commentID.'"><i class="fa fa-smile-o" aria-hidden="true"></i><span class="likesCounter">'.COUNT($replyReactSCount).'</span></button>' 
    : 
    '<button class="smiler-btn" data-pageid="'.$fetchReply->commentPageID.'" data-tweet="'.$fetchReply->commentOn.'" data-user="'.$fetchReply->commentBy.'" data-type="happy" data-comment="'.$fetchReply->commentID.'" data-reply="'.$fetchReply->commentID.'"><i class="fa fa-smile-o gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($replyReactSCount) > 0) ? COUNT($replyReactSCount) : '').'</span></button>'); ?>

        </li>
        <li>
            <?php echo (($replySadReact['reactBy'] === $user_id ) ?  '<button class="unSadr-btn" data-pageid="'.$fetchReply->commentPageID.'" data-tweet="'.$fetchReply->commentOn.'" data-user="'.$fetchReply->commentBy.'" data-type="sad" data-comment="'.$fetchReply->commentID.'" data-reply="'.$fetchReply->commentID.'"><i class="fa fa-frown-o" aria-hidden="true"></i><span class="likesCounter">'.COUNT($replyReactSACount).'</span></button>' 
    : 
    '<button class="sadr-btn" data-pageid="'.$fetchReply->commentPageID.'" data-tweet="'.$fetchReply->commentOn.'" data-user="'.$fetchReply->commentBy.'" data-type="sad" data-comment="'.$fetchReply->commentID.'" data-reply="'.$fetchReply->commentID.'"><i class="fa fa-frown-o gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($replyReactSACount) > 0) ? COUNT($replyReactSACount) : '').'</span></button>'); ?>

        </li>
        <li>
            <?php echo (($replyAngryReact['reactBy'] === $user_id ) ?  '<button class="unAngryr-btn" data-pageid="'.$fetchReply->commentPageID.'" data-tweet="'.$fetchReply->commentOn.'" data-user="'.$fetchReply->commentBy.'" data-type="angry" data-comment="'.$fetchReply->commentID.'" data-reply="'.$fetchReply->commentID.'"><i class="fa fa-drupal" aria-hidden="true"></i><span class="likesCounter">'.COUNT($replyReactRCount).'</span></button>' 
    : 
    '<button class="angryr-btn" data-pageid="'.$fetchReply->commentPageID.'" data-tweet="'.$fetchReply->commentOn.'" data-user="'.$fetchReply->commentBy.'" data-type="angry" data-comment="'.$fetchReply->commentID.'" data-reply="'.$fetchReply->commentID.'"><i class="fa fa-drupal gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($replyReactRCount) > 0) ? COUNT($replyReactRCount) : '').'</span></button>'); ?>

        </li>
    </ul>




    <?php echo '
                
                </div>
               '?>
    <div class="replyButtonReply" data-comment="<?php echo $fetchReply->commentID; ?>" data-tweet="<?php echo $fetchReply->commentOn; ?>">
        <button type="button" class="reply" id="<?php echo $fetchReply->commentID; ?>" data-tweet="<?php echo $fetchReply->commentOn; ?>" data-comment="<?php echo $fetchReply->commentID; ?>">Reply</button>
        <div class="replyInput">
            <textarea data-autoresize name="replyInpu" class="replyIn" placeholder="Enter Comment" rows="2" data-tweet="<?php echo $fetchReply->commentOn; ?>" data-pageid="<?php echo $fetchReply->commentPageID; ?>" data-comment="<?php echo $fetchReply->commentID; ?>">
<?php echo '@'.$fetchReply->username; ?></textarea> <input type="submit" name="replySubmit" class="replyPostReply" value="POST" data-tweet="<?php echo $fetchReply->commentOn; ?>" data-comment="<?php echo $fetchReply->commentID; ?>" data-reply="<?php echo $fetchReply->commentID; ?>" data-pageid="<?php echo $fetchReply->commentPageID; ?>" />
        </div>
    </div>


    <?php
       
        if($fetchReply->user_id === $user_id || $user_id === $profileId ){
        
        
        echo '
        <div class="deleComment" data-tweet="'.$fetchReply->commentOn.'" data-comment="'.$fetchReply->commentID.'">Delete</div>
                 <div class="deleteCommentt">
                   
                </div>';
               }?>
        <?php if($fetchReply->user_id === $user_id || $fetchReply->commentBy === $user_id ){  ?>
        <div class="editReply" data-tweet="<?php echo $fetchReply->commentOn; ?>" data-comment="<?php echo $fetchReply->commentID; ?>" data-commentData="<?php echo $fetchReply->comment; ?>" data-reply="<?php echo $fetchReply->commentID; ?>">Edit</div>


        <div class="editReplyy">


        </div>
        <?php  } ?>


        <?php
                 
               echo'  
                 
                 
                 </div>
                 </div>
                 </div>
                 </div></li>
                 ';
    
    

}  
     }
    
    
    
    
    
    
    
    
    
    
    
    
     }else {echo '<div class="replyCountSyle" data-tweet="'.$fetchReply->commentOn.'" data-comment="'.$fetchReply->commentID.'">'.$replyTota.' replys on the comment</div>'; }
     
      ?>
            <?php  

    
//   echo 'found' ;
    

if(isset($_POST['parent_comment_idd']) && !empty($_POST['parent_comment_idd'])){ 
    
   $replyCommentID = $_POST['parent_comment_idd']; 
   $replyTweetID = $_POST['commented_Onn']; 

    $replyFetc = $getFromP->replyDetails($replyCommentID,$replyTweetID);
    foreach ($replyFetc as $fetchReply){
        echo ' 
               <li><div class="mainCommen">
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
                 </div></li>
                 <br>';  
}
}

?>
