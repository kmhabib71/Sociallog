<?php
include '../init.php';
    include '../../class/login.php';
    $user_id = login::isLoggedIn();
if(isset($_POST['showImage']) && !empty($_POST['showImage'])){
	$tweetId = $_POST['showImage'];
    $user_id = login::isLoggedIn();
//    $likes = $getFromT->likes($user_id, $tweetId); 
//        
//         $retweet = $getFromT->checkRetweet($tweetId, $user_id);  
//         $retweetText = $getFromT->checkRetweetText($tweetId); 
//        $tweetId=$tweet->tweetID;
//        $comments = $getFromT->commentsLimits($tweetId);
//        $user = $this->userData($tweet->retweetBy);
    
    
    
    
    
    
//	$user_id = $_SESSION['user_id'];
	$tweet = $getFromT->getPopupTweet($tweetId);
    
    $profileId = $getFromU->userIdByUsername($tweet->username);
//	$likes = $getFromT->likes($user_id, $tweet_id);
//     $comments = $getFromT->commentsLimits($tweet_id);
//        $user = $this->userData($tweet->retweetBy);
//	$retweet = $getFromT->checkRetweet($tweetId, $user_id);
    $hm = 'happy';
        $likess = $getFromT->mainLikes($user_id, $tweet->tweetID);
        $mainLikeCheck = $getFromT->mainLikeCheck($user_id, $tweet->tweetID);
        $smile = $getFromT->smileCheck($user_id, $tweet->tweetID, $hm); 
        $angry = $getFromT->angryCheck($user_id, $tweet->tweetID); 
        $sad = $getFromT->sadCheck($user_id, $tweet->tweetID); 
        $secret = $getFromT->secretCheck($user_id, $tweet->tweetID); 
        $love = $getFromT->loveCheck($user_id, $tweet->tweetID); 
        $md = $getFromT->mdCheck($user_id, $tweet->tweetID); 
        $bed = $getFromT->bedCheck($user_id, $tweet->tweetID); 
        
         $retweet = $getFromT->checkRetweet($tweet->tweetID, $profileId); 
        
        
         $retweetText = $getFromT->checkRetweetText($tweet->tweetID); 
        $tweetId=$tweet->tweetID;
        $comments = $getFromT->commentsLimits($tweetId);
//        $profileId
//        include 'core/init.php';
        $user = $getFromT->userData($tweet->tweetBy);
        $likesCount = $getFromT->likeCount($tweet->tweetID);
        $smileCount  = $getFromT->smileCount($tweet->tweetID);
        $mainLikeCount  = $getFromT->mainLikeCount($tweet->tweetID);
        $angryCount  = $getFromT->angryCount($tweet->tweetID);
        $sadCount  = $getFromT->sadCount($tweet->tweetID);
        $secretCount  = $getFromT->secretCount($tweet->tweetID);
        $loveCount  = $getFromT->loveCount($tweet->tweetID);
        $mdCount  = $getFromT->mdCount($tweet->tweetID);
        $bedCount   = $getFromT->bedCount($tweet->tweetID);
	?>
    <div class="retweet-popup">
        <div class="wrap55">
            <div class="img-popup-wrapper">

                <div class="footerWrapper">
                    <span class="Photo-title">
                    <?php echo $tweet->username;  ?>'s Photo
                    </span>
                    <div class="lower-section-wrapper">

                <div class="lower-section-details">
                    <div class="reactionn">

                        <div class="likeSection">
                            <ul>

<!--
                                <li>
                                    <?php echo (($likess['likeBy'] === $user_id ) ?  '<button class="unlike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter">'.COUNT($likesCount).'</span></button>' 
    : 
    '<button class="like-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-thumbs-up gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($likesCount) > 0) ? COUNT($likesCount) : '').'</span></button>'); ?>

                                </li>    
-->
                                   
                                     <li>
                                    <?php echo (($mainLikeCheck['reactBy'] === $user_id ) ?  '<button class="unMainLike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'" data-type="mainLike"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter">'.COUNT($mainLikeCount).'</span></button>' 
    : 
    '<button class="mainLike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'" data-type="mainLike"><i class="fa fa-thumbs-up gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($mainLikeCount) > 0) ? COUNT($mainLikeCount) : '').'</span></button>'); ?>

                                </li>

                                <li>
                                    <?php echo (($smile['reactBy'] === $user_id ) ?  '<button class="unSmile-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'" data-type="happy"><i class="fa fa-smile-o" aria-hidden="true"></i><span class="likesCounter">'.COUNT($smileCount).'</span></button>' 
    : 
    '<button class="smile-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'" data-type="happy"><i class="fa fa-smile-o gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($smileCount) > 0) ? COUNT($smileCount) : '').'</span></button>'); ?>

                                </li>

                                <li>
                                    <?php echo (($angry['reactBy'] === $user_id ) ?  '<button class="unAngry-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'" data-type="angry"><i class="fa fa-drupal" aria-hidden="true"></i><span class="likesCounter">'.COUNT($angryCount).'</span></button>' 
    : 
    '<button class="angry-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'" data-type="angry"><i class="fa fa-drupal gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($angryCount) > 0) ? COUNT($angryCount) : '').'</span></button>'); ?>

                                </li>
                                <li>
                                    <?php echo (($sad['reactBy'] === $user_id ) ?  '<button class="unSad-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'" data-type="sad"><i class="fa fa-frown-o" aria-hidden="true"></i><span class="likesCounter">'.COUNT($sadCount).'</span></button>' 
    : 
    '<button class="sad-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'" data-type="sad"><i class="fa fa-frown-o gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($sadCount) > 0) ? COUNT($sadCount) : '').'</span></button>'); ?>

                                </li>
                                <li>
                                    <?php echo (($secret['reactBy'] === $user_id ) ?  '<button class="unSecret-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'" data-type="secrete"><i class="fa fa-user-secret" aria-hidden="true"></i><span class="likesCounter">'.COUNT($secretCount).'</span></button>' 
    : 
    '<button class="secret-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'" data-type="secrete"><i class="fa fa-user-secret gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($secretCount) > 0) ? COUNT($secretCount) : '').'</span></button>'); ?>

                                </li>
                                <li>
                                    <?php echo (($love['reactBy'] === $user_id ) ?  '<button class="unLove-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'" data-type="love"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="likesCounter">'.COUNT($loveCount).'</span></button>' 
    : 
    '<button class="love-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'" data-type="love"><i class="fa fa-heart-o gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($loveCount) > 0) ? COUNT($loveCount) : '').'</span></button>'); ?>

                                </li>
                                <li>
                                    <?php echo (($md['reactBy'] === $user_id ) ?  '<button class="unMd-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'" data-type="unhealthy"><i class="fa fa-user-md" aria-hidden="true"></i><span class="likesCounter">'.COUNT($mdCount).'</span></button>' 
    : 
    '<button class="md-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'" data-type="unhealthy"><i class="fa fa-user-md gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($mdCount) > 0) ? COUNT($mdCount) : '').'</span></button>'); ?>

                                </li>
                                <li>
                                    <?php echo (($bed['reactBy'] === $user_id ) ?  '<button class="unBed-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'" data-type="bedSick"><i class="fa fa-bed" aria-hidden="true"></i><span class="likesCounter">'.COUNT($bedCount).'</span></button>' 
    : 
    '<button class="bed-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'" data-type="bedSick"><i class="fa fa-bed gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($bedCount) > 0) ? COUNT($bedCount) : '').'</span></button>'); ?>

                                </li>
                                <li>
                                    <div class="emoReact">

                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="commentShareSection">
                            <ul>
                                <li><button class="commentIcon"><i class="fa fa-comment" aria-hidden="true"></i> </button>

                                </li>

                            </ul>

                            <ul>
                                <li>
                                    <?php echo (($tweet->tweetID === $retweet['retweetID']) ? '<button class="retweeted" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-share" aria-hidden="true"></i><span class="retweetsCount"></span>'.$tweet->retweetCount.'</button>' : '<button class="retweet" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-share" aria-hidden="true"></i><span class="retweetsCount"></span>'.(($tweet->retweetCount > 0) ? $tweet->retweetCount : $retweet['retweetID']).'</button>' ); ?>

                                </li>

                            </ul>
                        </div>
                    </div>


                    <div class="comment-holder" data-tweet="<?php echo $tweet->tweetID; ?>">


                        <div class="containerer" data-tweet="<?php echo $tweet->tweetID; ?>">
                            <!--   <form method="POST" class="formClass" data-tweet="<?php echo $tweet->tweetID; ?>">-->

                            <div class="dispplay_commen">

                            </div>

                            <span class="oldCommentShow">
          <?php foreach($comments as $comment){
     $commentLikes = $getFromT->commentLikes($user_id, $comment->commentOn, $comment->commentID );
     $commentReactLike = $getFromT->commentReactLike($user_id, $comment->commentOn, $comment->commentID );
     $commentReactSmile = $getFromT->commentReactSmile($user_id, $comment->commentOn, $comment->commentID );
     $commentReactSad = $getFromT->commentReactSad($user_id, $comment->commentOn, $comment->commentID );
     $commentReactAngry = $getFromT->commentReactAngry($user_id, $comment->commentOn, $comment->commentID );
      $commentLikesCou = $getFromT->CommentLikeCount( $comment->commentOn, $comment->commentID );
      $CommentReactLikeCount = $getFromT->CommentReactLikeCount( $comment->commentOn, $comment->commentID );
      $CommentReactSmileCount = $getFromT->CommentReactSmileCount( $comment->commentOn, $comment->commentID );
      $CommentReactSadCount = $getFromT->CommentReactSadCount( $comment->commentOn, $comment->commentID );
      $CommentReactAngryCount = $getFromT->CommentReactAngryCount( $comment->commentOn, $comment->commentID );
         
//      $replyLikesCou = $this->replyLikeCount( $comment->commentOn, $comment->commentID, $comment->commentReplyID  );
     
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
                    <?php echo  (($commentReactLike['reactBy'] === $user_id) ?  '<button class="Unlikec-btn" data-tweet="'.$comment->commentOn.'" data-comment="'.$comment->commentID.'" data-user="'.$comment->commentBy.'" data-type="mainLike"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter">'.COUNT($CommentReactLikeCount).'</span></button>' : '
                            <button class="Likec-btn" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-comment="'.$comment->commentID.'" data-type="mainLike"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($CommentReactLikeCount) > 0) ? COUNT($CommentReactLikeCount) : '').'</span></button>'); ?>
                            </li>

    <li>
                                    <?php echo (($commentReactSmile['reactBy'] === $user_id ) ?  '<button class="unSmilec-btn" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-type="happy" data-comment="'.$comment->commentID.'"><i class="fa fa-smile-o" aria-hidden="true"></i><span class="likesCounter">'.COUNT($CommentReactSmileCount).'</span></button>' 
    : 
    '<button class="smilec-btn" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-type="happy" data-comment="'.$comment->commentID.'"><i class="fa fa-smile-o gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($CommentReactSmileCount) > 0) ? COUNT($CommentReactSmileCount) : '').'</span></button>'); ?>

                                </li>
                                <li>
                                    <?php echo (($commentReactSad['reactBy'] === $user_id ) ?  '<button class="unSadc-btn" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-type="sad" data-comment="'.$comment->commentID.'"><i class="fa fa-frown-o" aria-hidden="true"></i><span class="likesCounter">'.COUNT($CommentReactSadCount).'</span></button>' 
    : 
    '<button class="sadc-btn" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-type="sad" data-comment="'.$comment->commentID.'"><i class="fa fa-frown-o gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($CommentReactSadCount) > 0) ? COUNT($CommentReactSadCount) : '').'</span></button>'); ?>

                                </li>
                                <li>
                                    <?php echo (($commentReactAngry['reactBy'] === $user_id ) ?  '<button class="unAngryc-btn" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-type="angry" data-comment="'.$comment->commentID.'"><i class="fa fa-drupal" aria-hidden="true"></i><span class="likesCounter">'.COUNT($CommentReactAngryCount).'</span></button>' 
    : 
    '<button class="angryc-btn" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-type="angry" data-comment="'.$comment->commentID.'"><i class="fa fa-drupal gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($CommentReactAngryCount) > 0) ? COUNT($CommentReactAngryCount) : '').'</span></button>'); ?>

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
                                <textarea data-autoresize name="replyInpu" class="replyIn" placeholder="Enter Comment" rows="2" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>"></textarea><input type="submit" name="replySubmit" class="postReply" value="POST" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>" data-reply="<?php echo $comment->commentID; ?>" />
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
     
     $replyTotal = $getFromT->totalReply($commentID);
//     $replyRow = mysql_num_rows($replyTotal);
     $replyTota = count($replyTotal);
     if($replyTota > 1){
        $replyFetch = $getFromT->replyDetails($commentID);
     
    foreach ($replyFetch as $fetchReply){
 $replyLikesCheck = $getFromT->replyLikes($user_id, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID);  
$replyLikeReact = $getFromT->replyLikeReact($user_id, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID); 
$replySmileReact = $getFromT->replySmileReact($user_id, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID);
$replySadReact = $getFromT->replySadReact($user_id, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID); 
$replyAngryReact = $getFromT->replyAngryReact($user_id, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID); 
        
        
        
        
  $replyLikesCou = $getFromT->replyLikeCount( $fetchReply->commentOn, $comment->commentID, $fetchReply->commentID  );
        
  $replyReactLCount = $getFromT->replyReactLCount( $fetchReply->commentOn, $comment->commentID, $fetchReply->commentID  );
  $replyReactSCount = $getFromT->replyReactSCount( $fetchReply->commentOn, $comment->commentID, $fetchReply->commentID  );
  $replyReactSACount = $getFromT->replyReactSACount( $fetchReply->commentOn, $comment->commentID, $fetchReply->commentID  );
  $replyReactRCount = $getFromT->replyReactRCount( $fetchReply->commentOn, $comment->commentID, $fetchReply->commentID  );
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
               '<button class="replyUnlike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'" data-comment="'.$comment->commentID.'" data-reply="'.$fetchReply->commentID.'"
               data-replyed="'.$fetchReply->commentID.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="replyLikesCounter">'.COUNT($replyReactLCount).'</span></button>
               ' : '
                <button class="replyLike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'" data-comment="'.$comment->commentID.'" data-reply="'.$fetchReply->commentID.'" data-replyed="'.$fetchReply->commentID.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="replyLikesCounter">'.((COUNT($replyReactLCount) > 0) ? COUNT($replyReactLCount) : '').'</span></button>
                ');?></li>
-->
               
                  <ul>
                   <li>
                    <?php echo  (($replyLikeReact['reactBy'] === $user_id) ?  '<button class="Unliker-btn" data-tweet="'.$comment->commentOn.'" data-comment="'.$comment->commentID.'" data-user="'.$comment->commentBy.'" data-type="mainLike" data-reply="'.$fetchReply->commentID.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter">'.COUNT($replyReactLCount).'</span></button>' : '
                            <button class="Liker-btn" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-comment="'.$comment->commentID.'" data-type="mainLike" data-reply="'.$fetchReply->commentID.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($replyReactLCount) > 0) ? COUNT($replyReactLCount) : '').'</span></button>'); ?>
                            </li>

    <li>
                                    <?php echo (($replySmileReact['reactBy'] === $user_id ) ?  '<button class="unSmiler-btn" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-type="happy" data-comment="'.$comment->commentID.'" data-reply="'.$fetchReply->commentID.'"><i class="fa fa-smile-o" aria-hidden="true"></i><span class="likesCounter">'.COUNT($replyReactSCount).'</span></button>' 
    : 
    '<button class="smiler-btn" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-type="happy" data-comment="'.$comment->commentID.'" data-reply="'.$fetchReply->commentID.'"><i class="fa fa-smile-o gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($replyReactSCount) > 0) ? COUNT($replyReactSCount) : '').'</span></button>'); ?>

                                </li>
                                <li>
                                    <?php echo (($replySadReact['reactBy'] === $user_id ) ?  '<button class="unSadr-btn" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-type="sad" data-comment="'.$comment->commentID.'" data-reply="'.$fetchReply->commentID.'"><i class="fa fa-frown-o" aria-hidden="true"></i><span class="likesCounter">'.COUNT($replyReactSACount).'</span></button>' 
    : 
    '<button class="sadr-btn" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-type="sad" data-comment="'.$comment->commentID.'" data-reply="'.$fetchReply->commentID.'"><i class="fa fa-frown-o gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($replyReactSACount) > 0) ? COUNT($replyReactSACount) : '').'</span></button>'); ?>

                                </li>
                                <li>
                                    <?php echo (($replyAngryReact['reactBy'] === $user_id ) ?  '<button class="unAngryr-btn" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-type="angry" data-comment="'.$comment->commentID.'" data-reply="'.$fetchReply->commentID.'"><i class="fa fa-drupal" aria-hidden="true"></i><span class="likesCounter">'.COUNT($replyReactRCount).'</span></button>' 
    : 
    '<button class="angryr-btn" data-tweet="'.$comment->commentOn.'" data-user="'.$comment->commentBy.'" data-type="angry" data-comment="'.$comment->commentID.'" data-reply="'.$fetchReply->commentID.'"><i class="fa fa-drupal gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($replyReactRCount) > 0) ? COUNT($replyReactRCount) : '').'</span></button>'); ?>

                                </li>
                                </ul>

                       
                      
                       
                        <?php echo '
                
                </div>
               '?>
                        <div class="replyButtonReply" data-comment="<?php echo $comment->commentID; ?>" data-tweet="<?php echo $comment->commentOn; ?>">
                            <button type="button" class="reply" id="<?php echo $comment->commentID; ?>" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>">Reply</button>
                            <div class="replyInput">
                                <textarea data-autoresize name="replyInpu" class="replyIn" placeholder="Enter Comment" rows="2" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>">
<?php echo '@'.$fetchReply->username; ?></textarea> <input type="submit" name="replySubmit" class="replyPostReply" value="POST" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>" data-reply="<?php echo $comment->commentID; ?>" />
                            </div>
                        </div>


                        <?php
       
        if($fetchReply->user_id === $user_id || $user_id === $profileId ){
        
        
        echo '
                        <div class="deleComment" data-tweet="'.$fetchReply->commentOn.'" data-comment="'.$fetchReply->commentID.'">Delete</div>
                 <div class="deleteCommentt" >
                   
                </div>';
               }?>
                     <?php if($fetchReply->user_id === $user_id || $fetchReply->commentBy === $user_id ){  ?>
                        <div class="editReply" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>" data-commentData="<?php echo $fetchReply->comment; ?>" data-reply="<?php echo $fetchReply->commentID; ?>">Edit</div>
                        
                        
                        <div class="editReplyy">
<!--                        <div class="replyInputt">-->

<!--                            </div>-->
                       
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
        <div class="inputFormStyle">
            <div class="inputTextArea">
                <textarea data-autoresize name="comment_content" class="commentInput" placeholder="Enter Comment" rows="2" data-tweet="<?php echo $tweet->tweetID; ?>"></textarea>
                <input type="hidden" name="comment_id" class="hidClass" value="0" />
                <input type="submit" name="submit" class="postComment" value="POST" data-tweet="<?php echo $tweet->tweetID; ?>" />
            </div>
            <!--
                            <div class="inputSubmit">
                                <input type="hidden" name="comment_id" class="hidClass" value="0" />
                                <input type="submit" name="submit" class="postComment" value="POST" data-tweet="<?php echo $tweet->tweetID; ?>"/>
                            </div>
-->
        </div>
        <!--   </form>-->

        <span class="comment_message">
     

                            </span>
        <br />

        <div class="moreComment" data-tweet="<?php echo $tweet->tweetID; ?>">
            <i class="fa fa-angle-down"></i>
        </div>
    </div>
    </div>
    </div>
    </div>
                    
                    
                </div>
                <div class="img-size">
                    <img src="<?php echo BASE_URL.$tweet->tweetImage; ?>" />
                    <div class="closeImage">
                        <i class="fa fa-times"></i>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <?php } ?>
    <script>
        jQuery.each(jQuery('textarea[data-autoresize]'), function() {
            var offset = this.offsetHeight - this.clientHeight;

            var resizeTextarea = function(el) {
                jQuery(el).css('height', 'auto').css('height', el.scrollHeight + offset);
            };
            jQuery(this).on('keyup input', function() {
                resizeTextarea(this);
            }).removeAttr('data-autoresize');
        });

    </script>
<!--
    <script src="assets/js/main.js"></script>
    <script src="assets/js/hashtag.js"></script>
    <script src="assets/js/like.js"></script>
    <script src="assets/js/retweet.js"></script>
    <script src="assets/js/com.js"></script>
    <script src="assets/js/delete.js"></script>
-->
