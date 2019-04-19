<?php
include '../init.php';
    include '../../class/login.php';
    $user_id = login::isLoggedIn();
if(isset($_POST['comment']) && !empty($_POST['comment'])){
	$comment = $getFromU->checkInput($_POST['comment']);
	
	$tweetID = $_POST['tweet_id'];
    $comment_id =$_POST['comment_id']; 
    $page_id =$_POST['page_id']; 
//    echo $page_id;
    
    if(!empty($comment)){ 
    
    $getFromU->create('pagecomments', array('commentPageID' => $page_id,'comment_parent_id' => $comment_id, 'comment' => $comment, 'commentOn'=> $tweetID, 'commentBy' => $user_id, 'commentAt' => date('Y-m-d H:i:s')));
		$comments = $getFromP->comments($page_id,$tweetID);
		$tweet = $getFromP->getPopupTweet($page_id,$tweetID);
        $pagePosta =  $getFromP->lastPagePostt($page_id);
?>



    <span class="oldCommentShow">
         
          <?php foreach($pagePosta as $pagePost){
            
            
            foreach($comments as $comment){
//                echo $comment->comment;
            $mainLike = 'mainLike';
            $lovee = 'love';
            $happy = 'happy';
            $angryy = 'angry';
            $sadd = 'sad';
            $secrete = 'secrete';
            $unhealthy = 'unhealthy';
            $bedSick = 'bedSick';
            
              $commentReactLike = $getFromP->mainCommentReact($user_id, $comment->commentOn, $comment->commentID,$comment->commentPageID,$mainLike);
     $commentReactSmile = $getFromP->mainCommentReact($user_id, $comment->commentOn, $comment->commentID,$comment->commentPageID,$happy);
     $commentReactSad = $getFromP->mainCommentReact($user_id, $comment->commentOn, $comment->commentID,$comment->commentPageID,$sadd);
     $commentReactAngry = $getFromP->mainCommentReact($user_id, $comment->commentOn, $comment->commentID,$comment->commentPageID,$angryy);
    
      
      $CommentReactLikeCount = $getFromP->CommentReactCount( $comment->commentOn, $comment->commentID,$comment->commentPageID,$mainLike);
      $CommentReactSmileCount = $getFromP->CommentReactCount( $comment->commentOn, $comment->commentID,$comment->commentPageID,$happy);
      $CommentReactSadCount = $getFromP->CommentReactCount( $comment->commentOn, $comment->commentID,$comment->commentPageID,$sadd);
      $CommentReactAngryCount = $getFromP->CommentReactCount( $comment->commentOn, $comment->commentID,$comment->commentPageID,$angryy);
            
            
//             $commentLikes = $getFromP->commentLikes($user_id, $comment->commentOn, $comment->commentID );
//             $commentLikesCou = $getFromP->CommentLikeCount($user_id, $comment->commentOn, $comment->commentID );
       ?>
       
  
       <div class="mainCommen">
                <div class="user-comment">
                    <div class="user"><a href="<?php echo BASE_URL.$comment->username ; ?>" class="user"><img src="<?php echo $comment->profileImage; ?>"/></a></div>
                  </div>
                  <div class="commentText">
                <div class="comments"><strong class="username"><a href="<?php echo BASE_URL.$comment->username ; ?>">
                        <?php echo $comment->username ;?>
                    </a></strong><?php echo $comment->comment; ?></div>
                <div class="replyReact_wrapper">
                <div class="replyReact">
                <div class="replyLike">
                  <ul>
                   <li>
                    <?php echo  (($commentReactLike['reactBy'] === $user_id) ?  '<button class="Unlikec-btn" data-pageid="'.$comment->commentPageID.'" data-tweet="'.$comment->commentOn.'" data-comment="'.$comment->commentID.'" data-user="'.$comment->commentBy.'" data-type="mainLike"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter">'.COUNT($CommentReactLikeCount).'</span></button>' : '
    <button class="Likec-btn" data-pageid="'.$comment->commentPageID.'" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-comment="'.$comment->commentID.'" data-type="mainLike"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($CommentReactLikeCount) > 0) ? COUNT($CommentReactLikeCount) : '').'</span></button>'); ?>
    </li>

    <li>
        <?php echo (($commentReactSmile['reactBy'] === $user_id ) ?  '<button class="unSmilec-btn" data-pageid="'.$comment->commentPageID.'" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-type="happy" data-comment="'.$comment->commentID.'"><i class="fa fa-smile-o" aria-hidden="true"></i><span class="likesCounter">'.COUNT($CommentReactSmileCount).'</span></button>' 
    : 
    '<button class="smilec-btn" data-pageid="'.$comment->commentPageID.'" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-type="happy" data-comment="'.$comment->commentID.'"><i class="fa fa-smile-o gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($CommentReactSmileCount) > 0) ? COUNT($CommentReactSmileCount) : '').'</span></button>'); ?>

    </li>
    <li>
        <?php echo (($commentReactSad['reactBy'] === $user_id ) ?  '<button class="unSadc-btn" data-pageid="'.$comment->commentPageID.'" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-type="sad" data-comment="'.$comment->commentID.'"><i class="fa fa-frown-o" aria-hidden="true"></i><span class="likesCounter">'.COUNT($CommentReactSadCount).'</span></button>' 
    : 
    '<button class="sadc-btn" data-pageid="'.$comment->commentPageID.'" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-type="sad" data-comment="'.$comment->commentID.'"><i class="fa fa-frown-o gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($CommentReactSadCount) > 0) ? COUNT($CommentReactSadCount) : '').'</span></button>'); ?>

    </li>
    <li>
        <?php echo (($commentReactAngry['reactBy'] === $user_id ) ?  '<button class="unAngryc-btn" data-pageid="'.$comment->commentPageID.'" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-type="angry" data-comment="'.$comment->commentID.'"><i class="fa fa-drupal" aria-hidden="true"></i><span class="likesCounter">'.COUNT($CommentReactAngryCount).'</span></button>' 
    : 
    '<button class="angryc-btn" data-pageid="'.$comment->commentPageID.'" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-type="angry" data-comment="'.$comment->commentID.'"><i class="fa fa-drupal gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($CommentReactAngryCount) > 0) ? COUNT($CommentReactAngryCount) : '').'</span></button>'); ?>

    </li>
    </ul>

    </div>
    <!--
                        <div class="commentReact">
                          <div class="reactButton">
                          
                          </div>
                           <div class="reactTitle" data-comment="<?php echo $comment->commentID; ?>" data-tweet="<?php echo $comment->commentOn; ?>">React</div>
                            
                            
                        </div>
-->
    <div class="replyButton" data-comment="<?php echo $comment->commentID; ?>" data-tweet="<?php echo $comment->commentOn; ?>">
        <button type="button" class="reply" id="<?php echo $comment->commentID; ?>" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>">Reply</button>
        <div class="replyInput">
            <textarea data-autoresize name="replyInpu" class="replyIn" placeholder="Enter Comment" rows="2" data-tweet="<?php echo $comment->commentOn; ?>" data-pageid="<?php echo $comment->commentPageID; ?>" data-comment="<?php echo $comment->commentID; ?>"></textarea><input type="submit" name="replySubmit" class="postReply" value="POST" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>" data-reply="<?php echo $comment->commentID; ?>" data-pageid="<?php echo $comment->commentPageID; ?>" />
        </div>
    </div>

    <?php  
                        if($comment->user_id === $user_id || $user_id === $profileId ){  ?>
    <div class="deleComment" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>">Delete</div>
    <div class="deleteCommentt">

    </div>
    <?php  } ?>
    <?php  
                        if($comment->user_id === $user_id ){  ?>
    <div class="editComment" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>" data-commentData="<?php echo $comment->comment; ?>">Edit</div>

    <div class="editCommentt">
        <!--                        <div class="replyInputt">-->

        <!--                            </div>-->

    </div>
    <?php  } ?>
    <!--                        <div class="deleteComment" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>">Delete</div>-->

    </div>


    <div class="oldReplyShow">


        <?php     
     $commentID = $comment->commentID;
     
     $replyTotal = $getFromP->totalReply($commentID);
//     $replyRow = mysql_num_rows($replyTotal);
     $replyTota = count($replyTotal);
     if($replyTota > 1){
        $replyFetch = $getFromP->replyDetails($commentID);
     
    foreach ($replyFetch as $fetchReply){
// $replyLikesCheck = $getFromP->replyLikes($user_id,$fetchReply->commentPageID, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID,$fetchReply->commentPageID);  
           
$replyLikeReact = $getFromP->replyReact($user_id,$fetchReply->commentPageID, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID, $mainLike); 
$replySmileReact = $getFromP->replyReact($user_id,$fetchReply->commentPageID, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID, $happy );
$replySadReact = $getFromP->replyReact($user_id,$fetchReply->commentPageID, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID,$sadd ); 
$replyAngryReact = $getFromP->replyReact($user_id,$fetchReply->commentPageID, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID,$angryy ); 
        
            $mainLike = 'mainLike';
            $lovee = 'love';
            $happy = 'happy';
            $angryy = 'angry';
            $sadd = 'sad';
            $secrete = 'secrete';
            $unhealthy = 'unhealthy';
            $bedSick = 'bedSick';
        
  $replyReactLCount = $getFromP->replyReactCount( $fetchReply->commentOn, $comment->commentID, $fetchReply->commentID, $fetchReply->commentPageID, $mainLike);
  $replyReactSCount = $getFromP->replyReactCount( $fetchReply->commentOn, $comment->commentID, $fetchReply->commentID, $fetchReply->commentPageID, $happy);
  $replyReactSACount = $getFromP->replyReactCount( $fetchReply->commentOn, $comment->commentID, $fetchReply->commentID, $fetchReply->commentPageID,$sadd);
  $replyReactRCount = $getFromP->replyReactCount( $fetchReply->commentOn, $comment->commentID, $fetchReply->commentID, $fetchReply->commentPageID, $angryy);
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
                <div class="reactReplyLike">';?>
        <!--
                     <li>
                        <?php echo 
               (($replyLikesCheck['likeBy'] === $user_id) ?
               '<button class="replyUnlike-btn" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-comment="'.$comment->commentID.'" data-reply="'.$fetchReply->commentID.'"
               data-replyed="'.$fetchReply->commentID.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="replyLikesCounter">'.COUNT($replyReactLCount).'</span></button>
               ' : '
                <button class="replyLike-btn" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-comment="'.$comment->commentID.'" data-reply="'.$fetchReply->commentID.'" data-replyed="'.$fetchReply->commentID.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="replyLikesCounter">'.((COUNT($replyReactLCount) > 0) ? COUNT($replyReactLCount) : '').'</span></button>
                ');?></li>
-->

        <ul>
            <li>
                <?php echo  (($replyLikeReact['reactBy'] === $user_id) ?  '<button class="Unliker-btn" data-pageid="'.$comment->commentPageID.'" data-tweet="'.$comment->commentOn.'" data-comment="'.$comment->commentID.'" data-user="'.$comment->commentBy.'" data-type="mainLike" data-reply="'.$fetchReply->commentID.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter">'.COUNT($replyReactLCount).'</span></button>' : '
                            <button class="Liker-btn" data-pageid="'.$comment->commentPageID.'" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-comment="'.$comment->commentID.'" data-type="mainLike" data-reply="'.$fetchReply->commentID.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($replyReactLCount) > 0) ? COUNT($replyReactLCount) : '').'</span></button>'); ?>
            </li>

            <li>
                <?php echo (($replySmileReact['reactBy'] === $user_id ) ?  '<button class="unSmiler-btn" data-pageid="'.$comment->commentPageID.'" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-type="happy" data-comment="'.$comment->commentID.'" data-reply="'.$fetchReply->commentID.'"><i class="fa fa-smile-o" aria-hidden="true"></i><span class="likesCounter">'.COUNT($replyReactSCount).'</span></button>' 
    : 
    '<button class="smiler-btn" data-pageid="'.$comment->commentPageID.'" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-type="happy" data-comment="'.$comment->commentID.'" data-reply="'.$fetchReply->commentID.'"><i class="fa fa-smile-o gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($replyReactSCount) > 0) ? COUNT($replyReactSCount) : '').'</span></button>'); ?>

            </li>
            <li>
                <?php echo (($replySadReact['reactBy'] === $user_id ) ?  '<button class="unSadr-btn" data-pageid="'.$comment->commentPageID.'" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-type="sad" data-comment="'.$comment->commentID.'" data-reply="'.$fetchReply->commentID.'"><i class="fa fa-frown-o" aria-hidden="true"></i><span class="likesCounter">'.COUNT($replyReactSACount).'</span></button>' 
    : 
    '<button class="sadr-btn" data-pageid="'.$comment->commentPageID.'" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-type="sad" data-comment="'.$comment->commentID.'" data-reply="'.$fetchReply->commentID.'"><i class="fa fa-frown-o gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($replyReactSACount) > 0) ? COUNT($replyReactSACount) : '').'</span></button>'); ?>

            </li>
            <li>
                <?php echo (($replyAngryReact['reactBy'] === $user_id ) ?  '<button class="unAngryr-btn" data-pageid="'.$comment->commentPageID.'" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-type="angry" data-comment="'.$comment->commentID.'" data-reply="'.$fetchReply->commentID.'"><i class="fa fa-drupal" aria-hidden="true"></i><span class="likesCounter">'.COUNT($replyReactRCount).'</span></button>' 
    : 
    '<button class="angryr-btn" data-pageid="'.$comment->commentPageID.'" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-type="angry" data-comment="'.$comment->commentID.'" data-reply="'.$fetchReply->commentID.'"><i class="fa fa-drupal gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($replyReactRCount) > 0) ? COUNT($replyReactRCount) : '').'</span></button>'); ?>

            </li>
        </ul>




        <?php echo '
                
                </div>
               '?>
        <div class="replyButtonReply" data-comment="<?php echo $comment->commentID; ?>" data-tweet="<?php echo $comment->commentOn; ?>">
            <button type="button" class="reply" id="<?php echo $comment->commentID; ?>" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>">Reply</button>
            <div class="replyInput">
                <textarea data-autoresize name="replyInpu" class="replyIn" placeholder="Enter Comment" rows="2" data-tweet="<?php echo $comment->commentOn; ?>" data-pageid="<?php echo $fetchReply->commentPageID; ?>" data-comment="<?php echo $comment->commentID; ?>">
<?php echo '@'.$fetchReply->username; ?></textarea> <input type="submit" name="replySubmit" class="replyPostReply" value="POST" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>" data-reply="<?php echo $comment->commentID; ?>" data-pageid="<?php echo $fetchReply->commentPageID; ?>" />
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
            <div class="editReply" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>" data-commentData="<?php echo $fetchReply->comment; ?>" data-reply="<?php echo $fetchReply->commentID; ?>">Edit</div>


            <div class="editReplyy">


            </div>
            <?php  } ?>


            <?php
                 
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

    </div>
    </div>






    <?php }}  ?>
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
