<?php

class Tweet extends User {
	
	function __construct($pdo){
		$this->pdo = $pdo;
	}
         public function  replyText($commentID){
     $replyFetch = $getFromT->replyDetails($commentID);
    foreach ($replyFetch as $fetchReply){
        echo ' <div class="user"><img src="'.$fetchReply->profileImage.'"/></div>
                  </div>
                  '.$fetchReply->username.' And
                  '.$fetchReply->comment.'';
    
    

} 
  }
    public function homeTweetss($user_id){
   $stmt = $this->pdo->prepare("SELECT * FROM `tweets`,`users` WHERE `tweetBy` = `user_id` ORDER BY postedOn DESC");
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $tweets = $stmt->fetchAll(PDO::FETCH_OBJ);
    foreach($tweets as $tweet){
        ?>
    <?php 
        $profileId = $tweet->tweetBy;
        $hm = 'happy';
        $likess = $this->mainLikes($user_id, $tweet->tweetID);
        $mainLikeCheck = $this->mainLikeCheck($user_id, $tweet->tweetID);
        $smile = $this->smileCheck($user_id, $tweet->tweetID, $hm); 
        $angry = $this->angryCheck($user_id, $tweet->tweetID); 
        $sad = $this->sadCheck($user_id, $tweet->tweetID); 
        $secret = $this->secretCheck($user_id, $tweet->tweetID); 
        $love = $this->loveCheck($user_id, $tweet->tweetID); 
        $md = $this->mdCheck($user_id, $tweet->tweetID); 
        $bed = $this->bedCheck($user_id, $tweet->tweetID); 
        
         $retweet = $this->checkRetweet($tweet->tweetID, $profileId); 
        
        
         $retweetText = $this->checkRetweetText($tweet->tweetID); 
        $tweetId=$tweet->tweetID;
        $comments = $this->commentsLimits($tweetId);
//        $profileId
//        include 'core/init.php';
        $user = $this->userData($tweet->tweetBy);
        $likesCount = $this->likeCount($tweet->tweetID);
        $smileCount  = $this->smileCount($tweet->tweetID);
        $mainLikeCount  = $this->mainLikeCount($tweet->tweetID);
        $angryCount  = $this->angryCount($tweet->tweetID);
        $sadCount  = $this->sadCount($tweet->tweetID);
        $secretCount  = $this->secretCount($tweet->tweetID);
        $loveCount  = $this->loveCount($tweet->tweetID);
        $mdCount  = $this->mdCount($tweet->tweetID);
        $bedCount   = $this->bedCount($tweet->tweetID);
           $blockList = $this->blockUser($user_id, $profileId);
        $blockI = COUNT($blockList);
        if($blockI>0 ){
            echo ' ';
        }else{
?>
    <!--             $comments = $this->commentss($tweet->tweetID);-->
    <div class="post-area">
        <div class="user-info">
            <div class="post-user">
                <div class="user"><label class="drop-label" for="drop-wrap1"><div class="user-comment">
                <div class="user"><img src="<?php echo $tweet->profileImage; ?>"/></div>
                  </div></label>
                </div>
                <div class="user-name">
                    <a href="<?php echo BASE_URL.$tweet->username ; ?>">
                        <?php echo $tweet->username ;?>
                    </a>

                </div>
            </div>

            <div class="status-type">
                <?php  if ($user->profileCover == $tweet->tweetImage ){?>
                <h3>Cover Photo updated</h3>


                <?php } else if($user->profileImage == $tweet->tweetImage ) {
            echo '<h3>Profile Photo updated</h3>';
        }else if ($retweet['retweetID'] === $tweet->retweetID OR $tweet->retweetID > 0){
            echo '<div class="t-show-banner">
		<div class="t-show-banner-inner">
			<span><i class="fa fa-retweet" aria-hidden="true"></i></span><span>'.$user->screenName.' shared '.$tweet->username.'\'s post</span>
            <br>'.$tweet->retweetMsg.'
		</div>
	</div>';
        }else if($tweet->tweetImage == true){
            echo '<h3>Uploaded image</h3>';
        }else{
            echo '<h3>Updated his status</h3>';
        } ?>
                <!--
                <?php echo
 (($retweet['retweetID'] === $tweet->retweetID OR $tweet->retweetID > 0) ? '

	<div class="t-show-banner">
		<div class="t-show-banner-inner">
			<span><i class="fa fa-retweet" aria-hidden="true"></i></span><span>'.$user->screenName.' shared '.$tweet->username.'\'s post</span>
            <br>'.$tweet->retweetMsg.'
		</div>
	</div> 
    ' 
	: 'Updated his status') ; ?>
-->
                <br>
            </div>
            <div class="post-optionn">
                <!--
        <li class="post-option-detail" data-tweet="<?php echo $tweet->tweetID; ?>" data-user="<?php echo $tweet->tweetBy; ?>">
					<i class="fa fa-ellipsis-h iconn" aria-hidden="true" ></i>
					<ul class="post-option-detai"> 
					  
					</ul>
    </li>
-->
                <div class="monDrop">
                    <div class="dropdown" data-tweet="<?php echo $tweet->tweetID; ?>" data-user="<?php echo $tweet->tweetBy; ?>">
                        <button class="dropbtn post-option-detail" data-tweet="<?php echo $tweet->tweetID; ?>" data-user="<?php echo $tweet->tweetBy; ?>" data-profileID="<?php echo $profileId; ?>"><i class="fa fa-ellipsis-h iconn" aria-hidden="true" ></i></button>
                        <div class="dropdown-content">


                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="time-ago">
            <?php echo $this->timeAgo($tweet->postedOn); ?>
        </div>
        <div class="main-status">
            <div class="main-status-text">
                <?php echo $this->getTweetLinks($tweet->status); ?>

            </div>
            <?php echo ((!empty($tweet->tweetImage)) ? ' 
        <div class="main-status-image">
            <img src="' .BASE_URL.$tweet->tweetImage.'" class="imagePopup" data-tweet= "'.$tweet->tweetID.'">
        </div> ' : ''); ?>




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
     $commentLikes = $this->commentLikes($user_id, $comment->commentOn, $comment->commentID );
     $commentReactLike = $this->commentReactLike($user_id, $comment->commentOn, $comment->commentID );
     $commentReactSmile = $this->commentReactSmile($user_id, $comment->commentOn, $comment->commentID );
     $commentReactSad = $this->commentReactSad($user_id, $comment->commentOn, $comment->commentID );
     $commentReactAngry = $this->commentReactAngry($user_id, $comment->commentOn, $comment->commentID );
      $commentLikesCou = $this->CommentLikeCount( $comment->commentOn, $comment->commentID );
      $CommentReactLikeCount = $this->CommentReactLikeCount( $comment->commentOn, $comment->commentID );
      $CommentReactSmileCount = $this->CommentReactSmileCount( $comment->commentOn, $comment->commentID );
      $CommentReactSadCount = $this->CommentReactSadCount( $comment->commentOn, $comment->commentID );
      $CommentReactAngryCount = $this->CommentReactAngryCount( $comment->commentOn, $comment->commentID );
         
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
                        <?php $blockList = $this->blockUser($user_id, $comment->commentBy);
        $blockI = COUNT($blockList);
        if($blockI>0 ){
            echo ' ';
        }else{ ?>
                        <div class="replyButton" data-comment="<?php echo $comment->commentID; ?>" data-tweet="<?php echo $comment->commentOn; ?>">
                            <button type="button" class="reply" id="<?php echo $comment->commentID; ?>" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>">Reply</button>
                            <div class="replyInput">
                                <textarea data-autoresize name="replyInpu" class="replyIn" placeholder="Enter Comment" rows="2" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>"></textarea><input type="submit" name="replySubmit" class="postReply" value="POST" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>" data-reply="<?php echo $comment->commentID; ?>" />
                            </div>
                        </div>

                        <?php
             }
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
     
     $replyTotal = $this->totalReply($commentID);
//     $replyRow = mysql_num_rows($replyTotal);
     $replyTota = count($replyTotal);
     if($replyTota > 1){
        $replyFetch = $this->replyDetails($commentID);
     
    foreach ($replyFetch as $fetchReply){
 $replyLikesCheck = $this->replyLikes($user_id, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID);  
$replyLikeReact = $this->replyLikeReact($user_id, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID); 
$replySmileReact = $this->replySmileReact($user_id, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID);
$replySadReact = $this->replySadReact($user_id, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID); 
$replyAngryReact = $this->replyAngryReact($user_id, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID); 
        
        
        
        
  $replyLikesCou = $this->replyLikeCount( $fetchReply->commentOn, $comment->commentID, $fetchReply->commentID  );
        
  $replyReactLCount = $this->replyReactLCount( $fetchReply->commentOn, $comment->commentID, $fetchReply->commentID  );
  $replyReactSCount = $this->replyReactSCount( $fetchReply->commentOn, $comment->commentID, $fetchReply->commentID  );
  $replyReactSACount = $this->replyReactSACount( $fetchReply->commentOn, $comment->commentID, $fetchReply->commentID  );
  $replyReactRCount = $this->replyReactRCount( $fetchReply->commentOn, $comment->commentID, $fetchReply->commentID  );
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
                        <?php $blockList = $this->blockUser($user_id, $comment->commentBy);
        $blockI = COUNT($blockList);
        if($blockI>0 ){
            echo ' ';
        }else{ ?>
                        <div class="replyButtonReply" data-comment="<?php echo $comment->commentID; ?>" data-tweet="<?php echo $comment->commentOn; ?>">
                            <button type="button" class="reply" id="<?php echo $comment->commentID; ?>" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>">Reply</button>
                            <div class="replyInput">
                                <textarea data-autoresize name="replyInpu" class="replyIn" placeholder="Enter Comment" rows="2" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>">
<?php echo '@'.$fetchReply->username; ?></textarea> <input type="submit" name="replySubmit" class="replyPostReply" value="POST" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>" data-reply="<?php echo $comment->commentID; ?>" />
                            </div>
                        </div>


                        <?php
             }
        if($fetchReply->user_id === $user_id || $user_id === $profileId ){
        
        
        echo '
                        <div class="deleComment" data-tweet="'.$fetchReply->commentOn.'" data-comment="'.$fetchReply->commentID.'">Delete</div>
                 <div class="deleteCommentt" >
                   
                </div>';
               }
                        
                        $blockList = $this->blockUser($user_id, $comment->commentBy);
        $blockI = COUNT($blockList);
        if($blockI>0 ){
            echo ' ';
        }else{?>
                            <?php if($fetchReply->user_id === $user_id || $fetchReply->commentBy === $user_id ){  ?>
                            <div class="editReply" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>" data-commentData="<?php echo $fetchReply->comment; ?>" data-reply="<?php echo $fetchReply->commentID; ?>">Edit</div>


                            <div class="editReplyy">
                                <!--                        <div class="replyInputt">-->

                                <!--                            </div>-->

                            </div>
                            <?php }  } ?>


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
    </div>



    <?php
             }
    }
     }

    
    public function profileTweetss($profileId, $user_id){
        
   $stmt = $this->pdo->prepare("SELECT
    tweets.*, users.*
    FROM
        tweets
    LEFT JOIN users ON users.user_id = tweets.tweetBy
    WHERE
        imageID != 0 AND tweetBy = :profileId GROUP BY imageID
UNION
SELECT
    tweets.*, users.*
    FROM
        tweets
    LEFT JOIN users ON users.user_id = tweets.tweetBy
    WHERE
        imageID = 0 AND tweetBy = :profileId
   ORDER BY postedOn DESC
   ");
    $stmt->bindParam(":profileId", $profileId, PDO::PARAM_INT);
    $stmt->execute();
    $tweets = $stmt->fetchAll(PDO::FETCH_OBJ);
    foreach($tweets as $tweet){
        ?>
        <?php 
        $hm = 'happy';
        $likess = $this->mainLikes($user_id, $tweet->tweetID);
        $mainLikeCheck = $this->mainLikeCheck($user_id, $tweet->tweetID);
        $smile = $this->smileCheck($user_id, $tweet->tweetID, $hm); 
        $angry = $this->angryCheck($user_id, $tweet->tweetID); 
        $sad = $this->sadCheck($user_id, $tweet->tweetID); 
        $secret = $this->secretCheck($user_id, $tweet->tweetID); 
        $love = $this->loveCheck($user_id, $tweet->tweetID); 
        $md = $this->mdCheck($user_id, $tweet->tweetID); 
        $bed = $this->bedCheck($user_id, $tweet->tweetID); 
        
         $retweet = $this->checkRetweet($tweet->tweetID, $profileId); 
        
        
         $retweetText = $this->checkRetweetText($tweet->tweetID); 
        $tweetId=$tweet->tweetID;
        $comments = $this->commentsLimits($tweetId);
//        $profileId
//        include 'core/init.php';
        $user = $this->userData($tweet->tweetBy);
        $likesCount = $this->likeCount($tweet->tweetID);
        $smileCount  = $this->smileCount($tweet->tweetID);
        $mainLikeCount  = $this->mainLikeCount($tweet->tweetID);
        $angryCount  = $this->angryCount($tweet->tweetID);
        $sadCount  = $this->sadCount($tweet->tweetID);
        $secretCount  = $this->secretCount($tweet->tweetID);
        $loveCount  = $this->loveCount($tweet->tweetID);
        $mdCount  = $this->mdCount($tweet->tweetID);
        $bedCount   = $this->bedCount($tweet->tweetID);
        $imageFetch = $this->imagesFetch($tweet->imageID);
        
?>
        <!--             $comments = $this->commentss($tweet->tweetID);-->
        <div class="post-area">
            <div class="user-info">
                <div class="post-user">
                    <div class="user"><label class="drop-label" for="drop-wrap1"><div class="user-comment">
                <div class="user"><img src="<?php echo $tweet->profileImage; ?>"/></div>
                  </div></label>
                    </div>
                    <div class="user-name">
                        <a href="<?php echo BASE_URL.$tweet->username ; ?>">
                            <?php echo $tweet->username ;?>
                        </a>

                    </div>
                </div>

                <div class="status-type">
                    <?php  if ($user->profileCover == $tweet->tweetImage ){?>
                    <h3>Cover Photo updated</h3>


                    <?php } else if($user->profileImage == $tweet->tweetImage && $tweet->proPhoto == '1' ) {
            echo '<h3>Profile Photo updated</h3>';
        }else if($tweet->proPhoto == '1'){echo '<h3>Profile Photo updated</h3>'; }else if ($retweet['retweetID'] === $tweet->retweetID OR $tweet->retweetID > 0){
            echo '<div class="t-show-banner">
		<div class="t-show-banner-inner">
			<span><i class="fa fa-retweet" aria-hidden="true"></i></span><span>'.$user->screenName.' shared '.$tweet->username.'\'s post</span>
            <br>'.$tweet->retweetMsg.'
		</div>
	</div>';
        }else if($tweet->tweetImage == true){
            echo '<h3>Uploaded image</h3>';
        }else{
            echo '<h3>Updated his status</h3>';
        } ?>
                    <!--
                <?php echo
 (($retweet['retweetID'] === $tweet->retweetID OR $tweet->retweetID > 0) ? '

	<div class="t-show-banner">
		<div class="t-show-banner-inner">
			<span><i class="fa fa-retweet" aria-hidden="true"></i></span><span>'.$user->screenName.' shared '.$tweet->username.'\'s post</span>
            <br>'.$tweet->retweetMsg.'
		</div>
	</div> 
    ' 
	: 'Updated his status') ; ?>
-->
                    <br>
                </div>
                <div class="post-optionn">
                    <!--
        <li class="post-option-detail" data-tweet="<?php echo $tweet->tweetID; ?>" data-user="<?php echo $tweet->tweetBy; ?>">
					<i class="fa fa-ellipsis-h iconn" aria-hidden="true" ></i>
					<ul class="post-option-detai"> 
					  
					</ul>
    </li>
-->
                    <div class="monDrop">
                        <div class="dropdown" data-tweet="<?php echo $tweet->tweetID; ?>" data-user="<?php echo $tweet->tweetBy; ?>" data-imageid="<?php echo $tweet->imageID; ?>">
                            <button class="dropbtn post-option-detail" data-tweet="<?php echo $tweet->tweetID; ?>" data-user="<?php echo $tweet->tweetBy; ?>" data-profileID="<?php echo $profileId; ?>" data-imageid="<?php echo $tweet->imageID; ?>"><i class="fa fa-ellipsis-h iconn" aria-hidden="true" ></i></button>
                            <div class="dropdown-content">


                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="time-ago">
                <?php echo $this->timeAgo($tweet->postedOn); ?>
            </div>
            <div class="main-status">
                <?php if ($tweet->imageID == 0) {  ?>
                <div class="main-status-text">
                    <?php echo $this->getTweetLinks($tweet->status); ?>

                </div>
                <?php echo ((!empty($tweet->tweetImage)) ? ' 
        <div class="main-status-image">
            <img src="' .BASE_URL.$tweet->tweetImage.'" class="imagePopup" data-tweet= "'.$tweet->tweetID.'">
        </div> ' : ''); ?>


                <?php } else { ?>
                <div class="main-status-text">
                    <?php echo $this->getTweetLinks($tweet->status); ?>

                </div>

                <?php  foreach ($imageFetch as $multiImage){ ?>


                <div class="main-status-image">
                    <img src="http://localhost/socialbd/<?php echo $multiImage->tweetImage;?>" class="imagePopup" data-tweet="<?php echo $multiImage->tweetID;?>">
                </div>

                <?php }  } ?>

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
     $commentLikes = $this->commentLikes($user_id, $comment->commentOn, $comment->commentID );
     $commentReactLike = $this->commentReactLike($user_id, $comment->commentOn, $comment->commentID );
     $commentReactSmile = $this->commentReactSmile($user_id, $comment->commentOn, $comment->commentID );
     $commentReactSad = $this->commentReactSad($user_id, $comment->commentOn, $comment->commentID );
     $commentReactAngry = $this->commentReactAngry($user_id, $comment->commentOn, $comment->commentID );
      $commentLikesCou = $this->CommentLikeCount( $comment->commentOn, $comment->commentID );
      $CommentReactLikeCount = $this->CommentReactLikeCount( $comment->commentOn, $comment->commentID );
      $CommentReactSmileCount = $this->CommentReactSmileCount( $comment->commentOn, $comment->commentID );
      $CommentReactSadCount = $this->CommentReactSadCount( $comment->commentOn, $comment->commentID );
      $CommentReactAngryCount = $this->CommentReactAngryCount( $comment->commentOn, $comment->commentID );
         
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
     
     $replyTotal = $this->totalReply($commentID);
//     $replyRow = mysql_num_rows($replyTotal);
     $replyTota = count($replyTotal);
     if($replyTota > 1){
        $replyFetch = $this->replyDetails($commentID);
     
    foreach ($replyFetch as $fetchReply){
 $replyLikesCheck = $this->replyLikes($user_id, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID);  
$replyLikeReact = $this->replyLikeReact($user_id, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID); 
$replySmileReact = $this->replySmileReact($user_id, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID);
$replySadReact = $this->replySadReact($user_id, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID); 
$replyAngryReact = $this->replyAngryReact($user_id, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID); 
        
        
        
        
  $replyLikesCou = $this->replyLikeCount( $fetchReply->commentOn, $comment->commentID, $fetchReply->commentID  );
        
  $replyReactLCount = $this->replyReactLCount( $fetchReply->commentOn, $comment->commentID, $fetchReply->commentID  );
  $replyReactSCount = $this->replyReactSCount( $fetchReply->commentOn, $comment->commentID, $fetchReply->commentID  );
  $replyReactSACount = $this->replyReactSACount( $fetchReply->commentOn, $comment->commentID, $fetchReply->commentID  );
  $replyReactRCount = $this->replyReactRCount( $fetchReply->commentOn, $comment->commentID, $fetchReply->commentID  );
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
                 <div class="deleteCommentt">
                   
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
        </div>



        <?php
    
    }
    
    
    
    }

     
//    public function tweeitIdData($user_id){
//        	$stmt = $this->pdo->prepare(" SELECT tweetID FROM `tweets` WHERE imageID = 0 AND tweetBy = :profileId
//UNION
//SELECT tweetID FROM `tweets` WHERE imageID != 0 AND tweetBy = :profileId GROUP BY imageID 
// LEFT JOIN users ON tweetBy = user_id WHERE tweetBy = :profileId ORDER BY postedOn DESC ");
//		$stmt->bindParam(":profileId", $user_id, PDO::PARAM_INT);
//		$stmt->execute();
//		return $stmt->fetch(PDO::FETCH_OBJ);
//    }   
    
    public function imagesFetch($imageId){
        $stmt = $this->pdo->prepare("SELECT * FROM tweets WHERE imageID = :imageId ORDER BY tweetID DESC");
		$stmt->bindParam(":imageId", $imageId, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
    }   
//             public function smileCountCheck($tweet_id, $user_id, $react_type ){
//	$stmt = $this->pdo->prepare("SELECT reactID from `react` WHERE `reactOn`= :tweet_id AND `reactBy` = :user_id AND `reactType` = :react_type AND `reactCommentOn` = '0' AND `reactReplyOn` = '0'");
//             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
//             $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
//             $stmt->bindParam(":react_type", $react_type, PDO::PARAM_STR);
//			$stmt->execute();
//			return $stmt->fetchAll(PDO::FETCH_OBJ);
//		}  
    public function userData($user_id){
        	$stmt = $this->pdo->prepare("SELECT * FROM users WHERE user_id = :user_id");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
    } 
    public function multiImg($tweetID){
        	$stmt = $this->pdo->prepare("SELECT *, GROUP_CONCAT(imageID) AS id 
FROM tweets WHERE imageID != 0 AND tweetID = tweetID;");
		$stmt->bindParam(":tweetID", $tweetID, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
    }  
    
    public function singlePostFromMultiImage($user_id){
        	$stmt = $this->pdo->prepare("SELECT  a.tweetID
FROM    tweets a
        INNER JOIN
        (
            SELECT tweetID, MIN(imageID) minID
            FROM tweets 
            GROUP BY imageID
        ) b
            ON a.tweetID = b.tweetID AND
                a.imageID = b.minID
                WHERE imageID != 0 AND tweetBy = :user_id;");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
    }
    
    
    public function profileID($user_id){
        $stmt = $this->pdo->prepare("SELECT tweetID FROM tweets WHERE tweetBy = :userid");
        $stmt->bindParam(":userid", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    
       public function editPost($tweet_id, $user_id, $status){
        $stmt = $this->pdo->prepare("UPDATE `tweets` SET `status` = :status WHERE `tweetID` = :tweet_id AND `tweetBY` = :user_id");
			$stmt->bindParam(":status", $status, PDO::PARAM_INT);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->execute();
    }  
    public function editReply($editReplyComment, $tweetId, $editReplId, $editReplData){
        $stmt = $this->pdo->prepare("UPDATE `comments` SET `comment` = :comment WHERE `commentOn` = :tweetId AND `commentID` = :editReplId AND `commentReplyID` = :editReplyComment ");
			$stmt->bindParam(":comment", $editReplData, PDO::PARAM_INT);
			$stmt->bindParam(":tweetId", $tweetId, PDO::PARAM_INT);
			$stmt->bindParam(":editReplId", $editReplId, PDO::PARAM_INT);
			$stmt->bindParam(":editReplyComment", $editReplyComment, PDO::PARAM_INT);
			$stmt->execute();
    } 
    public function editComment($editComment, $tweetId, $editCommlData){
        $stmt = $this->pdo->prepare("UPDATE `comments` SET `comment` = :comment WHERE `commentOn` = :tweetId AND `commentID` = :editReplId AND `commentReplyID` = '0' ");
			$stmt->bindParam(":comment", $editCommlData, PDO::PARAM_INT);
			$stmt->bindParam(":tweetId", $tweetId, PDO::PARAM_INT);
			$stmt->bindParam(":editReplId", $editComment, PDO::PARAM_INT);
			
			$stmt->execute();
    }

       public function likeCount($tweet_id){
	$stmt = $this->pdo->prepare("SELECT likeID from `likes` WHERE `likeOn`= :tweet_id AND `likeCommentOn` = '0' ");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
    public function smileCount($tweet_id){
	$stmt = $this->pdo->prepare("SELECT reactID from `react` WHERE `reactOn`= :tweet_id AND reactType='happy' AND `reactCommentOn` = '0' AND `reactReplyOn` = '0'");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}  
    public function mainLikeCount($tweet_id){
	$stmt = $this->pdo->prepare("SELECT reactID from `react` WHERE `reactOn`= :tweet_id AND reactType='mainLike' AND `reactCommentOn` = '0' AND `reactReplyOn` = '0'");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} 
    public function angryCount($tweet_id){
	$stmt = $this->pdo->prepare("SELECT reactID from `react` WHERE `reactOn`= :tweet_id AND reactType='angry' AND `reactCommentOn` = '0' AND `reactReplyOn` = '0'");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} public function sadCount($tweet_id){
	$stmt = $this->pdo->prepare("SELECT reactID from `react` WHERE `reactOn`= :tweet_id AND reactType='sad' AND `reactCommentOn` = '0' AND `reactReplyOn` = '0'");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} public function secretCount($tweet_id){
	$stmt = $this->pdo->prepare("SELECT reactID from `react` WHERE `reactOn`= :tweet_id AND reactType='secrete' AND `reactCommentOn` = '0' AND `reactReplyOn` = '0'");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} public function loveCount($tweet_id){
	$stmt = $this->pdo->prepare("SELECT reactID from `react` WHERE `reactOn`= :tweet_id AND reactType='love' AND `reactCommentOn` = '0' AND `reactReplyOn` = '0'");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} public function mdCount($tweet_id){
	$stmt = $this->pdo->prepare("SELECT reactID from `react` WHERE `reactOn`= :tweet_id AND reactType='unhealthy' AND `reactCommentOn` = '0' AND `reactReplyOn` = '0'");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} public function bedCount($tweet_id){
	$stmt = $this->pdo->prepare("SELECT reactID from `react` WHERE `reactOn`= :tweet_id AND reactType='bedSick' AND `reactCommentOn` = '0' AND `reactReplyOn` = '0'");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}  
    public function CommentLikeCount($tweet_id, $commentID){
	$stmt = $this->pdo->prepare("SELECT likeID from `likes` WHERE `likeOn`= :tweet_id AND `likeCommentOn` = :commentID AND `likeReplyOn` = '0' ");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
             $stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}  
    public function CommentReactLikeCount($tweet_id, $commentID){
	$stmt = $this->pdo->prepare("SELECT reactID from `react` WHERE `reactOn`= :tweet_id AND `reactCommentOn` = :commentID AND `reactReplyOn` = '0' AND `reactType` = 'mainLike' ");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
             $stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}  
    public function CommentReactSmileCount($tweet_id, $commentID){
	$stmt = $this->pdo->prepare("SELECT reactID from `react` WHERE `reactOn`= :tweet_id AND `reactCommentOn` = :commentID AND `reactReplyOn` = '0' AND `reactType` = 'happy' ");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
             $stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}  
    public function CommentReactSadCount($tweet_id, $commentID){
	$stmt = $this->pdo->prepare("SELECT reactID from `react` WHERE `reactOn`= :tweet_id AND `reactCommentOn` = :commentID AND `reactReplyOn` = '0' AND `reactType` = 'sad' ");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
             $stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}  
    public function CommentReactAngryCount($tweet_id, $commentID){
	$stmt = $this->pdo->prepare("SELECT reactID from `react` WHERE `reactOn`= :tweet_id AND `reactCommentOn` = :commentID AND `reactReplyOn` = '0' AND `reactType` = 'angry' ");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
             $stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} 
    public function tweetCheck($tweetId){
        $stmt = $this->pdo->prepare("SELECT * FROM `tweets` WHERE `tweetID` = :tweetID");
             $stmt->bindParam(":tweetID", $tweetId, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
       
    }
    public function replyLikeCount($tweet_id, $commentID,$replyID){
	$stmt = $this->pdo->prepare("SELECT likeID from `likes` WHERE `likeOn`= :tweet_id AND `likeCommentOn` = :commentID AND `likeReplyOn` = :replyID ");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
             $stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
             $stmt->bindParam(":replyID", $replyID, PDO::PARAM_INT);
             
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} 
    public function replyReactLCount($tweet_id, $commentID,$replyID){
	$stmt = $this->pdo->prepare("SELECT reactID from `react` WHERE `reactOn`= :tweet_id AND `reactCommentOn` = :commentID AND `reactReplyOn` = :replyID AND `reactType` ='mainLike' ");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
             $stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
             $stmt->bindParam(":replyID", $replyID, PDO::PARAM_INT);
             
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}  
    public function replyReactSCount($tweet_id, $commentID,$replyID){
	$stmt = $this->pdo->prepare("SELECT reactID from `react` WHERE `reactOn`= :tweet_id AND `reactCommentOn` = :commentID AND `reactReplyOn` = :replyID AND `reactType` ='happy' ");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
             $stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
             $stmt->bindParam(":replyID", $replyID, PDO::PARAM_INT);
             
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} 
    public function replyReactSACount($tweet_id, $commentID,$replyID){
	$stmt = $this->pdo->prepare("SELECT reactID from `react` WHERE `reactOn`= :tweet_id AND `reactCommentOn` = :commentID AND `reactReplyOn` = :replyID AND `reactType` ='sad' ");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
             $stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
             $stmt->bindParam(":replyID", $replyID, PDO::PARAM_INT);
             
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}  
    public function replyReactRCount($tweet_id, $commentID,$replyID){
	$stmt = $this->pdo->prepare("SELECT reactID from `react` WHERE `reactOn`= :tweet_id AND `reactCommentOn` = :commentID AND `reactReplyOn` = :replyID AND `reactType` ='angry' ");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
             $stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
             $stmt->bindParam(":replyID", $replyID, PDO::PARAM_INT);
             
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
        public function likeCheck($tweet_id, $user_id ){
	$stmt = $this->pdo->prepare("SELECT likeID from `likes` WHERE `likeOn`= :tweet_id AND `likeBy` = :user_id AND `likeCommentOn` = '0'");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
             $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}   
    public function commentLikeCheck($tweet_id, $user_id,$commentID ){
	$stmt = $this->pdo->prepare("SELECT likeID from `likes` WHERE `likeOn`= :tweet_id AND `likeBy` = :user_id AND `likeCommentOn` = :commentID AND `likeReplyOn` ='0' ");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
             $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
             $stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}  

    public function replyLikeCheck($tweet_id, $user_id,$commentID, $replyID ){
	$stmt = $this->pdo->prepare("SELECT likeID from `likes` WHERE `likeOn`= :tweet_id AND `likeBy` = :user_id AND `likeCommentOn` = :commentID AND `likeReplyOn` = :replyID ");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
             $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
             $stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
             $stmt->bindParam(":replyID", $replyID, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}

    public function addLike($user_id, $tweet_id, $get_id){

       
			$this->create('likes', array('likeBy' => $user_id, 'likeOn' =>$tweet_id));
			if($get_id != $user_id){
				Message::sendNotification($get_id, $user_id, $tweet_id, 'like');
			
            }
		}  
    public function addReact($user_id, $tweet_id, $get_id, $reactType){

       
			$this->create('react', array('reactBy' => $user_id, 'reactOn' =>$tweet_id, 'reactType' =>$reactType ));
			if($get_id != $user_id){
				Message::sendNotification($get_id, $user_id, $tweet_id, 'like');
			
            }
		}  
    public function addCommentReact($user_id, $tweet_id, $get_id, $reactType, $commentID){

       
			$this->create('react', array('reactBy' => $user_id, 'reactOn' =>$tweet_id, 'reactType' =>$reactType, 'reactCommentOn' => $commentID ));
			if($get_id != $user_id){
				Message::sendNotification($get_id, $user_id, $tweet_id, 'like');
			
            }
		}
    public function addReplyReact($user_id, $tweet_id, $get_id, $reactType, $commentID, $replyID){

       
			$this->create('react', array('reactBy' => $user_id, 'reactOn' =>$tweet_id, 'reactType' =>$reactType, 'reactCommentOn' => $commentID, 'reactReplyOn' => $replyID ));
			if($get_id != $user_id){
				Message::sendNotification($get_id, $user_id, $tweet_id, 'like');
			
            }
		}
    public function addCommentLike($user_id, $tweet_id, $commentID, $get_id){

			$this->create('likes', array('likeBy' => $user_id, 'likeOn' =>$tweet_id, 'likeCommentOn' => $commentID));
			if($get_id != $user_id){
				Message::sendNotification($get_id, $user_id, $tweet_id, 'like');
			}
		}    
    public function addReplyLike($user_id, $tweet_id, $commentID, $get_id, $replyed_id){

			$this->create('likes', array('likeBy' => $user_id, 'likeOn' =>$tweet_id, 'likeCommentOn' => $commentID,'likeReplyOn' => $replyed_id ));
			if($get_id != $user_id){
				Message::sendNotification($get_id, $user_id, $tweet_id, 'like');
			}
		}
    
		public function unLike($user_id, $tweet_id, $get_id){
//			$stmt = $this->pdo->prepare("UPDATE `tweets` SET `likesCount` = `likesCount` -1 WHERE `tweetID` = :tweet_id"); // $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT); // $stmt->execute();

			$stmt = $this->pdo->prepare("DELETE FROM `likes` WHERE `likeBy` = :user_id AND `likeOn` = :tweet_id AND `likeCommentOn` = '0'");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
		}		
    public function unReact($user_id, $tweet_id, $get_id, $react_type){
//			$stmt = $this->pdo->prepare("UPDATE `tweets` SET `likesCount` = `likesCount` -1 WHERE `tweetID` = :tweet_id"); // $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT); // $stmt->execute();

			$stmt = $this->pdo->prepare("DELETE FROM `react` WHERE `reactBy` = :user_id AND `reactOn` = :tweet_id AND `reactType` = :react_type AND `reactCommentOn` = '0' AND `reactReplyOn` = '0'");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->bindParam(":react_type", $react_type, PDO::PARAM_STR);
			$stmt->execute();
		} 
    public function blockUser($user_id, $profileID){
    $stmt = $this->pdo->prepare("SELECT blockID FROM block WHERE (`blockerID` = :user_id AND `blockedID` =:profileID) OR (`blockedID` = :user_id AND `blockerID` =:profileID)");
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->bindParam(":profileID", $profileID, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchALL(PDO::FETCH_OBJ);

}
    public function commentUnReact($user_id, $tweet_id, $get_id, $react_type,$commentID){
//			$stmt = $this->pdo->prepare("UPDATE `tweets` SET `likesCount` = `likesCount` -1 WHERE `tweetID` = :tweet_id"); // $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT); // $stmt->execute();

			$stmt = $this->pdo->prepare("DELETE FROM `react` WHERE `reactBy` = :user_id AND `reactOn` = :tweet_id AND `reactType` = :react_type AND `reactCommentOn` = :commentID");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
			$stmt->bindParam(":react_type", $react_type, PDO::PARAM_STR);
			$stmt->execute();
		}
    public function ReplyUnReact($user_id, $tweet_id, $get_id, $react_type,$commentID, $replyID){
//			$stmt = $this->pdo->prepare("UPDATE `tweets` SET `likesCount` = `likesCount` -1 WHERE `tweetID` = :tweet_id"); // $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT); // $stmt->execute();

			$stmt = $this->pdo->prepare("DELETE FROM `react` WHERE `reactBy` = :user_id AND `reactOn` = :tweet_id AND `reactType` = :react_type AND `reactCommentOn` = :commentID AND `reactReplyOn` = :replyID");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
			$stmt->bindParam(":replyID", $replyID, PDO::PARAM_INT);
			$stmt->bindParam(":react_type", $react_type, PDO::PARAM_STR);
			$stmt->execute();
		}   
    public function unReactExist($user_id, $tweet_id, $get_id){
//			$stmt = $this->pdo->prepare("UPDATE `tweets` SET `likesCount` = `likesCount` -1 WHERE `tweetID` = :tweet_id"); // $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT); // $stmt->execute();

			$stmt = $this->pdo->prepare("DELETE FROM `react` WHERE `reactBy` = :user_id AND `reactOn` = :tweet_id AND `reactCommentOn` = '0' AND `reactReplyOn` = '0'");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
		} 
    public function commentUnReactExist($user_id, $tweet_id, $get_id, $commentID){
//			$stmt = $this->pdo->prepare("UPDATE `tweets` SET `likesCount` = `likesCount` -1 WHERE `tweetID` = :tweet_id"); // $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT); // $stmt->execute();

			$stmt = $this->pdo->prepare("DELETE FROM `react` WHERE `reactBy` = :user_id AND `reactOn` = :tweet_id AND `reactCommentOn`=:commentID AND `reactReplyOn` = '0' ");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
			$stmt->execute();
		} 
    public function reactUnReactExist($user_id, $tweet_id, $get_id, $commentID, $replyId ){
//			$stmt = $this->pdo->prepare("UPDATE `tweets` SET `likesCount` = `likesCount` -1 WHERE `tweetID` = :tweet_id"); // $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT); // $stmt->execute();

			$stmt = $this->pdo->prepare("DELETE FROM `react` WHERE `reactBy` = :user_id AND `reactOn` = :tweet_id AND `reactCommentOn`= :commentID AND `reactReplyOn` = :replyId ");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
			$stmt->bindParam(":replyId", $replyId, PDO::PARAM_INT);
			$stmt->execute();
		}
 
    public function commentUnLike($user_id, $tweet_id,$comment_id, $get_id){
//			$stmt = $this->pdo->prepare("UPDATE `comments` SET `commentLike` = `commentLike` -1 WHERE `commentID` = :comment_id"); // $stmt->bindParam(":comment_id", $comment_id, PDO::PARAM_INT); // $stmt->execute();

			$stmt = $this->pdo->prepare("DELETE FROM `likes` WHERE `likeBy` = :user_id AND `likeOn` = :tweet_id AND `likeCommentOn` = :comment_id AND `likeReplyOn` = '0'");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->bindParam(":comment_id", $comment_id, PDO::PARAM_INT);
			$stmt->execute();
		}  
    public function replyUnLike($user_id, $tweet_id,$comment_id, $get_id,$replyed_id){
//			$stmt = $this->pdo->prepare("UPDATE `comments` SET `commentLike` = `commentLike` -1 WHERE `commentID` = :comment_id"); // $stmt->bindParam(":comment_id", $comment_id, PDO::PARAM_INT); // $stmt->execute();

			$stmt = $this->pdo->prepare("DELETE FROM `likes` WHERE `likeBy` = :user_id AND `likeOn` = :tweet_id AND `likeCommentOn` = :comment_id AND `likeReplyOn` = :replyed_id");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->bindParam(":comment_id", $comment_id, PDO::PARAM_INT);
			$stmt->bindParam(":replyed_id", $replyed_id, PDO::PARAM_INT);
			$stmt->execute();
		}

		public function mainLikes($user_id, $tweet_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `likes` WHERE `likeBy` = :user_id AND `likeOn` = :tweet_id AND likeCommentOn = '0'  ");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);

		}	

    
           public function smileCountCheck($tweet_id, $user_id, $react_type ){
	$stmt = $this->pdo->prepare("SELECT reactID from `react` WHERE `reactOn`= :tweet_id AND `reactBy` = :user_id AND `reactType` = :react_type AND `reactCommentOn` = '0' AND `reactReplyOn` = '0'");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
             $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
             $stmt->bindParam(":react_type", $react_type, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}   
    public function reactExistingCheck($tweet_id, $user_id ){
	$stmt = $this->pdo->prepare("SELECT reactID from `react` WHERE `reactOn`= :tweet_id AND `reactBy` = :user_id ");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
             $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} 
    public function CommentReactExistingCheck($tweet_id, $user_id,$commentID ){
	$stmt = $this->pdo->prepare("SELECT reactID from `react` WHERE `reactOn`= :tweet_id AND `reactBy` = :user_id AND `reactCommentOn`= :commentID AND `reactReplyOn` = '0' ");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
             $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
             $stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
    public function replyReactExistingCheck($tweet_id, $user_id,$commentID, $replyID ){
	$stmt = $this->pdo->prepare("SELECT reactID from `react` WHERE `reactOn`= :tweet_id AND `reactBy` = :user_id AND `reactCommentOn`= :commentID AND `reactReplyOn` = :replyID ");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
             $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
             $stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
             $stmt->bindParam(":replyID", $replyID, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}  
 
    public function smileCheck($user_id, $tweet_id,$react_type){
			$stmt = $this->pdo->prepare("SELECT * FROM `react` WHERE `reactBy` = :user_id AND `reactOn` = :tweet_id AND reactType = :react_type AND `reactCommentOn` = '0' AND `reactReplyOn` = '0'");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->bindParam(":react_type", $react_type, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);

		}  public function angryCheck($user_id, $tweet_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `react` WHERE `reactBy` = :user_id AND `reactOn` = :tweet_id AND reactType = 'angry' AND `reactCommentOn` = '0' AND `reactReplyOn` = '0'");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);

		}
    public function mainLikeCheck($user_id, $tweet_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `react` WHERE `reactBy` = :user_id AND `reactOn` = :tweet_id AND reactType = 'mainLike' AND `reactCommentOn` = '0' AND `reactReplyOn` = '0' ");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);

		}  public function sadCheck($user_id, $tweet_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `react` WHERE `reactBy` = :user_id AND `reactOn` = :tweet_id AND reactType = 'sad' AND `reactCommentOn` = '0' AND `reactReplyOn` = '0'");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);

		}  public function secretCheck($user_id, $tweet_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `react` WHERE `reactBy` = :user_id AND `reactOn` = :tweet_id AND reactType = 'secrete' AND `reactCommentOn` = '0' AND `reactReplyOn` = '0' ");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);

		}  public function mdCheck($user_id, $tweet_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `react` WHERE `reactBy` = :user_id AND `reactOn` = :tweet_id AND reactType = 'unhealthy' AND `reactCommentOn` = '0' AND `reactReplyOn` = '0'");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);

		}  public function bedCheck($user_id, $tweet_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `react` WHERE `reactBy` = :user_id AND `reactOn` = :tweet_id AND reactType = 'bedSick' AND `reactCommentOn` = '0' AND `reactReplyOn` = '0'");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);

		}  public function loveCheck($user_id, $tweet_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `react` WHERE `reactBy` = :user_id AND `reactOn` = :tweet_id AND reactType = 'love' AND `reactCommentOn` = '0' AND `reactReplyOn` = '0' ");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);

		}	
    public function likes($user_id, $tweet_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `likes` WHERE `likeBy` = :user_id AND `likeOn` = :tweet_id  ");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);

		}
    public function commentLikes($user_id, $commentOn, $likeCommentOn){
			$stmt = $this->pdo->prepare("SELECT * FROM `likes` WHERE `likeBy` = :user_id AND `likeOn` = :commentOn AND `likeCommentOn` = :likeCommentOn AND likeReplyOn ='0' ");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":commentOn", $commentOn, PDO::PARAM_INT);
            $stmt->bindParam(":likeCommentOn", $likeCommentOn, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);

		}  
    public function commentReactLike($user_id, $commentOn, $reactCommentOn){
			$stmt = $this->pdo->prepare("SELECT * FROM `react` WHERE `reactBy` = :user_id AND `reactOn` = :commentOn AND `reactCommentOn` = :reactCommentOn AND reactReplyOn ='0' AND `reactType` = 'mainLike' ");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":commentOn", $commentOn, PDO::PARAM_INT);
            $stmt->bindParam(":reactCommentOn", $reactCommentOn, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);

		} 
    public function commentReactSmile($user_id, $commentOn, $reactCommentOn){
			$stmt = $this->pdo->prepare("SELECT * FROM `react` WHERE `reactBy` = :user_id AND `reactOn` = :commentOn AND `reactCommentOn` = :reactCommentOn AND reactReplyOn ='0' AND `reactType` = 'happy' ");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":commentOn", $commentOn, PDO::PARAM_INT);
            $stmt->bindParam(":reactCommentOn", $reactCommentOn, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);

		}  
    public function commentReactSad($user_id, $commentOn, $reactCommentOn){
			$stmt = $this->pdo->prepare("SELECT * FROM `react` WHERE `reactBy` = :user_id AND `reactOn` = :commentOn AND `reactCommentOn` = :reactCommentOn AND reactReplyOn ='0' AND `reactType` = 'sad' ");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":commentOn", $commentOn, PDO::PARAM_INT);
            $stmt->bindParam(":reactCommentOn", $reactCommentOn, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);

		}
    public function commentReactAngry($user_id, $commentOn, $reactCommentOn){
			$stmt = $this->pdo->prepare("SELECT * FROM `react` WHERE `reactBy` = :user_id AND `reactOn` = :commentOn AND `reactCommentOn` = :reactCommentOn AND reactReplyOn ='0' AND `reactType` = 'angry' ");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":commentOn", $commentOn, PDO::PARAM_INT);
            $stmt->bindParam(":reactCommentOn", $reactCommentOn, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);

		}   
    public function replyLikes($user_id, $commentOn, $likeCommentOn, $likeReplyOn){
			$stmt = $this->pdo->prepare("SELECT * FROM `likes` WHERE `likeBy` = :user_id AND `likeOn` = :commentOn AND `likeCommentOn` = :likeCommentOn AND `likeReplyOn` = :likeReplyOn");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":commentOn", $commentOn, PDO::PARAM_INT);
            $stmt->bindParam(":likeCommentOn", $likeCommentOn, PDO::PARAM_INT);
            $stmt->bindParam(":likeReplyOn", $likeReplyOn, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);

		} 
    public function replyLikeReact($user_id, $commentOn, $likeCommentOn, $likeReplyOn){
			$stmt = $this->pdo->prepare("SELECT * FROM `react` WHERE `reactBy` = :user_id AND `reactOn` = :commentOn AND `reactCommentOn` = :likeCommentOn AND `reactReplyOn` = :likeReplyOn AND `reactType` = 'mainLike'" );
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":commentOn", $commentOn, PDO::PARAM_INT);
            $stmt->bindParam(":likeCommentOn", $likeCommentOn, PDO::PARAM_INT);
            $stmt->bindParam(":likeReplyOn", $likeReplyOn, PDO::PARAM_INT);
           
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}  
    public function replySmileReact($user_id, $commentOn, $likeCommentOn, $likeReplyOn){
			$stmt = $this->pdo->prepare("SELECT * FROM `react` WHERE `reactBy` = :user_id AND `reactOn` = :commentOn AND `reactCommentOn` = :likeCommentOn AND `reactReplyOn` = :likeReplyOn AND `reactType` = 'happy'" );
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":commentOn", $commentOn, PDO::PARAM_INT);
            $stmt->bindParam(":likeCommentOn", $likeCommentOn, PDO::PARAM_INT);
            $stmt->bindParam(":likeReplyOn", $likeReplyOn, PDO::PARAM_INT);
           
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);
		} 
    public function replySadReact($user_id, $commentOn, $likeCommentOn, $likeReplyOn){
			$stmt = $this->pdo->prepare("SELECT * FROM `react` WHERE `reactBy` = :user_id AND `reactOn` = :commentOn AND `reactCommentOn` = :likeCommentOn AND `reactReplyOn` = :likeReplyOn AND `reactType` = 'sad'" );
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":commentOn", $commentOn, PDO::PARAM_INT);
            $stmt->bindParam(":likeCommentOn", $likeCommentOn, PDO::PARAM_INT);
            $stmt->bindParam(":likeReplyOn", $likeReplyOn, PDO::PARAM_INT);
           
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}  
    public function replyAngryReact($user_id, $commentOn, $likeCommentOn, $likeReplyOn){
			$stmt = $this->pdo->prepare("SELECT * FROM `react` WHERE `reactBy` = :user_id AND `reactOn` = :commentOn AND `reactCommentOn` = :likeCommentOn AND `reactReplyOn` = :likeReplyOn AND `reactType` = 'angry'" );
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":commentOn", $commentOn, PDO::PARAM_INT);
            $stmt->bindParam(":likeCommentOn", $likeCommentOn, PDO::PARAM_INT);
            $stmt->bindParam(":likeReplyOn", $likeReplyOn, PDO::PARAM_INT);
           
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
 
    public function retweet($tweet_id, $user_id, $get_id, $comment){
			$stmt = $this->pdo->prepare("UPDATE `tweets` SET `retweetCount` = `retweetCount`+1 WHERE `tweetID` = :tweet_id");
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();

			$stmt = $this->pdo->prepare("INSERT INTO `tweets` (`status`,`tweetBy`,`tweetImage`, `retweetID`,`retweetBy`,`postedOn`,`likesCount`,`retweetCount`,`retweetMsg`) SELECT `status`,`tweetBy`,`tweetImage`,`tweetId`, :user_id, `postedOn`,`likesCount`,`retweetCount`, :retweetMsg FROM `tweets` WHERE `tweetID` = :tweet_id ");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":retweetMsg", $comment, PDO::PARAM_STR);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			Message::sendNotification($get_id, $user_id, $tweet_id, 'retweet');

		}
    public function getPopupTweet($tweet_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `tweets`, `users` WHERE `tweetID` = :tweet_id AND `tweetBy` = `user_id`");
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);

} 
    public function getPopupTwee($profileImageID){
			$stmt = $this->pdo->prepare("SELECT tweetID FROM `tweets` WHERE `tweetImage` = :profileImageID");
			$stmt->bindParam(":profileImageID", $profileImageID, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);

}
    public function checkRetweet($tweet_id, $user_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `tweets` WHERE `retweetID` = :tweet_id AND `retweetBy` = :user_id OR `tweetID` = :tweet_id AND `retweetBy` = :user_id");
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);
		} 
//    public function checkRetweet($tweet_id, $user_id){
//			$stmt = $this->pdo->prepare("SELECT * FROM `tweets` WHERE `retweetID` = :tweet_id AND `retweetBy` = :user_id OR `tweetID` = :tweet_id AND `retweetBy` = :user_id");
//			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
//			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
//			$stmt->execute();
//			return $stmt->fetch(PDO::FETCH_ASSOC);
//		}  
    public function checkRetweetText($tweet_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `tweets` WHERE `retweetID` = :tweet_id");
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}  
    public function comm($tweet_id, $user_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `comments` WHERE `commentOn` = :tweet_id AND `commentBy` = :user_id ");
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
    public function comments($tweet_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `comments` LEFT JOIN `users` ON `commentBy` = `user_id` WHERE `commentOn` = :tweet_id AND comment_parent_id ='0' ORDER BY commentAt DESC");
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}     
    public function totalReply($commentID){
			$stmt = $this->pdo->prepare("SELECT comment_parent_id FROM `comments` WHERE `comment_parent_id` = :commentID");
			$stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} 
    public function reply($commentID){
			$stmt = $this->pdo->prepare("SELECT * FROM `comments`  WHERE comment_parent_id = :commentID ORDER BY `commentAt` DESC");
			$stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}      
    public function replyDetails($commentID){
			$stmt = $this->pdo->prepare("SELECT * FROM `comments` LEFT JOIN `users` ON `commentBy` = `user_id` WHERE comment_parent_id = :commentID ORDER BY `commentAt` ASC");
            
			$stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}   
    
    public function commentsLimits($tweet_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `comments` LEFT JOIN `users` ON `commentBy` = `user_id` WHERE `commentOn` = :tweet_id and comment_parent_id ='0' ORDER BY commentAt DESC LIMIT 3 ");
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} 
    public function commentsWithoutLimits($tweet_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `comments` LEFT JOIN `users` ON `commentBy` = `user_id` WHERE `commentOn` = :tweet_id and comment_parent_id ='0' ORDER BY commentAt DESC ");
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}   
    public function commentsss($tweet_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `comments` LEFT JOIN `users` ON `commentBy` = `user_id` WHERE `commentOn` = :tweet_id ORDER BY commentAt DESC ");
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}    
    
    public function commentShow($tweet_id){
			$stmt = $this->pdo->prepare(" SELECT * FROM `comments` LEFT JOIN `users` ON `commentBy` = `user_id` WHERE `commentOn` = :tweet_id AND comment_parent_id = '0'");
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} 
    
    public function replyShow($tweet_id, $parent_id){
			$stmt = $this->pdo->prepare(" SELECT * FROM `comments` LEFT JOIN `users` ON `commentBy` = `user_id` WHERE `commentOn` = :tweet_id AND comment_parent_id = :parent_id");
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->bindParam(":parent_id", $parent_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}   
   public function trends(){
			$stmt = $this->pdo->prepare("SELECT *, COUNT(`tweetID`) AS `tweetsCount` FROM `trends` INNER JOIN `tweets` ON `status` LIKE CONCAT('%#',`hashtag`,'%') OR `retweetMsg` LIKE CONCAT('%#',`hashtag`,'%') GROUP BY `hashtag` ORDER BY `tweetID`");
			$stmt->execute(); 
			$trends = $stmt->fetchAll(PDO::FETCH_OBJ);
			echo '<div class="trend-wrapper"><div class="trend-inner"><div class="trend-title"><h3>Trends</h3></div><!-- trend title end-->
';
			foreach($trends as $trend){
				echo '<div class="trend-body">
	<div class="trend-body-content">
		<div class="trend-link">
			<a href="'.BASE_URL.'hashtag/'.$trend->hashtag.'">#'.$trend->hashtag.'</a>
		</div>
		<div class="trend-tweets">
			'.$trend->tweetsCount.' <span>tweets</span>
		</div>
	</div>
</div>';
			}
			echo '</div></div>';
		}
    		public function getTweetsByHash($hashtag){
			$stmt = $this->pdo->prepare("SELECT * FROM `tweets` LEFT JOIN `users` on `tweetBy` = `user_id` WHERE `status` LIKE :hashtag OR `retweetMsg` LIKE  :hashtag ");
			$stmt->bindValue(":hashtag", '%#'.$hashtag.'%', PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);

		}
		public function getUsersByHash($hashtag){
			$stmt = $this->pdo->prepare("SELECT DISTINCT * FROM `tweets` INNER JOIN `users` ON `tweetBy` = `user_id` WHERE `status` LIKE :hashtag OR `retweetMsg` LIKE :hashtag GROUP BY `user_id`");
			$stmt->bindValue(":hashtag", '%#'.$hashtag.'%', PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
    public function getTrendByHash($hashtag){
    $stmt=$this->pdo->prepare("SELECT * FROM `trends` WHERE `hashtag` LIKE :hashtag");
    $stmt->bindValue(':hashtag', $hashtag.'%');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}
	public function getMention($mention){
			$stmt = $this->pdo->prepare("SELECT `user_id`, `username`, `screenName`, `profileImage` FROM `users` WHERE `username` LIKE :mention or `screenName` LIKE :mention LIMIT 5");
			$stmt->bindValue(':mention', $mention.'%');
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
    public function addTrend($hashtag){
        preg_match_all("/#+([a-zA-Z0-9_]+)/i", $hashtag, $matches);
        if($matches){
            $result=array_values($matches[1]);
        }
        $sql = "INSERT INTO `trends` (`hashtag`, `createdOn`) VALUES (:hashtag, CURRENT_TIMESTAMP)";
        foreach ($result as $trend) {
           if($stmt = $this->pdo->prepare($sql)){
               $stmt->execute(array(':hashtag'=>$trend));
           } 
        }
    }
public function getTweetLinks($tweet){
//    $tweet = preg_replace("/([\w\.]+)/", "<a href='$0' target='_blank'>$0</a>", $tweet);
    $tweet = preg_replace("/(https?:\/\/)([\w]+.)([\w\.]+)/", "<a href='$0' target='_blank'>$0</a>", $tweet);
   
    
//    $tweet = preg_replace(pattern, replacement, subject)
    $tweet = preg_replace("/#([\w]+)/", "<a href='".BASE_URL."hashtag/$1'>$0</a>", $tweet);
    $tweet = preg_replace("/@([\w]+)/", "<a href='".BASE_URL."hashtag/$1'>$0</a>", $tweet);
//     $tweet = preg_replace("/(www?.)([\w\.]+)/", "<a href='$0' target='_blank'>$0</a>", $tweet);
    return $tweet;
}
    
}?>
