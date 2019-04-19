<?Php
class Page extends User {
	protected $pdo;

	function __construct($pdo){
		$this->pdo = $pdo;
	}

  public function lastPageInfo($userID){
		$stmt = $this->pdo->prepare("SELECT * FROM `page` WHERE `userID` = :userID ORDER BY pageID DESC LIMIT 1");
        $stmt->bindParam(":userID", $userID, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
         
         
         
//		$stmt->bindParam(":userID", $userID, PDO::PARAM_INT); // $stmt->execute(); // $user = $stmt->fetch(PDO::FETCH_OBJ); // return $user->user_id;
	} 
    
    public function existingPagePost($pageID, $user_id){
		$stmt = $this->pdo->prepare(" SELECT pagepost.*, users.*
    FROM
        pagepost
    LEFT JOIN users ON users.user_id = pagepost.userID
    WHERE
        pageImageID != 0 AND pageID = :pageID GROUP BY pageImageID
     UNION
SELECT
    pagepost.*, users.*
    FROM
        pagepost
    LEFT JOIN users ON users.user_id = pagepost.userID
    WHERE
        pageImageID = 0 AND pageID = :pageID
   ORDER BY postedOn DESC ");
        $stmt->bindParam(":pageID", $pageID, PDO::PARAM_INT);
		$stmt->execute();
        $ExisPagePost = $stmt->fetchAll(PDO::FETCH_OBJ);
        
      
        
        
		foreach($ExisPagePost as $pagePost){
//            echo $pagePost->pagePostID;
//            echo $pagePost->pageID;
            $mainLike = 'mainLike';
            $lovee = 'love';
            $happy = 'happy';
            $angryy = 'angry';
            $sadd = 'sad';
            $secrete = 'secrete';
            $unhealthy = 'unhealthy';
            $bedSick = 'bedSick';
//             $bedSickd = '15';
//            $likess = $this->mainLikes($user_id, $pagePost->pagePostID);
//          reactCheck($user_id,$pagePost->pageID, $pagePost->pagePostID, $mainLike)   
            
//         $lastPagePost=$this->lastPagePostt($bedSickd);  
//            foreach($lastPagePost as $lastPage){
//         echo $lastPage->username;
//            }
       
            
        $mainLikeCheck = $this->reactCheck($user_id,$pagePost->pageID, $pagePost->pagePostID,$mainLike);     
        $smile = $this->reactCheck($user_id,$pagePost->pageID, $pagePost->pagePostID,$happy); 
            
        $angry = $this->reactCheck($user_id,$pagePost->pageID, $pagePost->pagePostID,$angryy);
        $sad = $this->reactCheck($user_id,$pagePost->pageID, $pagePost->pagePostID,$sadd);
        $secret = $this->reactCheck($user_id,$pagePost->pageID, $pagePost->pagePostID,$secrete);
        $love = $this->reactCheck($user_id,$pagePost->pageID, $pagePost->pagePostID,$lovee);
        $md = $this->reactCheck($user_id,$pagePost->pageID, $pagePost->pagePostID,$unhealthy);
        $bed = $this->reactCheck($user_id,$pagePost->pageID, $pagePost->pagePostID,$bedSick);
        
         $retweet = $this->checkRetweet($pagePost->pageID, $pagePost->pagePostID,$user_id); 
        
        
         $retweetText = $this->checkRetweetText($pagePost->pageID, $pagePost->pagePostID); 
//        $tweetId=$pagePost->pagePostID;
        $tweetId=$pagePost->pageID;
        $comments = $this->commentsLimits($pagePost->pageID, $pagePost->pagePostID);
//        $profileId
//        include 'core/init.php';
        $user = $this->userData($pagePost->userID);
            
            
//        $likesCount = $this->likeCount($pagePost->pageID, $pagePost->pagePostID);
            
            
        $smileCount  = $this->reactCount($pagePost->pageID, $pagePost->pagePostID, $happy );
        $mainLikeCount  = $this->reactCount($pagePost->pageID, $pagePost->pagePostID,$mainLike);
        $angryCount  = $this->reactCount($pagePost->pageID, $pagePost->pagePostID, $angryy);
        $sadCount  = $this->reactCount($pagePost->pageID, $pagePost->pagePostID, $sadd);
        $secretCount  = $this->reactCount($pagePost->pageID, $pagePost->pagePostID, $secrete);
        $loveCount  = $this->reactCount($pagePost->pageID, $pagePost->pagePostID, $lovee);
        $mdCount  = $this->reactCount($pagePost->pageID, $pagePost->pagePostID, $unhealthy);
        $bedCount   = $this->reactCount($pagePost->pageID, $pagePost->pagePostID, $bedSick);
//        $imageFetch = $this->imagesFetch($tweet->imageID);
            
            
            
            
            
            $pageImgCount = $this->pageImagesCount($pagePost->pageImageID); 
            $pageImageFetch = $this->pageImageFetch($pagePost->pageImageID); 
//            echo COUNT($pageImgCount);
            echo '
            <li><div class="pagePostTopSec" style="display:flex; flex-direction:row; align-items: center; font-size:12px; justify-content: space-between;">
       <div class="user"><img src="'.BASE_URL. $pagePost->profileImage.'"  alt=""></div>
<div class="pageStatusHead">Update His page Status</div>
<div class="pageStatusOpt">...</div>
</div>
<div class="pagePostMidSec">
    <div class="pageTextStatus">'.$pagePost->pagePost.'</div> ';?>
    <?php  if(COUNT($pageImgCount) == 0){ echo 'More Image '; }else if(COUNT($pageImgCount) == 1){echo '<div class="pageImageStatus"><img src="'.BASE_URL. $pageImg->pageImage.' " width="150px" height="180px" alt=""></div>';}else{ ?>
    <div class="pageImageStatus">
        <?php  foreach ($pageImgCount as $pageImg){ ?>

        <img src="<?php echo BASE_URL. $pageImg->pageImage; ?>" width="150px" height="180px" alt="">




        <?php } ?> </div>
    <?php }?>

    <?php echo'</div>


</li>'; ?>

    <div class="lower-section-wrapper">

        <div class="lower-section-details">
            <div class="reactionn">

                <div class="likeSection">
                    <ul>

                        <!--
                                <li>
                                    <?php echo (($likess['likeBy'] === $user_id ) ?  '<button class="unlike-btn" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter">'.COUNT($likesCount).'</span></button>' 
    : 
    '<button class="like-btn" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'"><i class="fa fa-thumbs-up gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($likesCount) > 0) ? COUNT($likesCount) : '').'</span></button>'); ?>

                                </li>    
-->

                        <li>
                            <?php echo (($mainLikeCheck['reactBy'] === $user_id ) ?  '<button class="unMainLike-btn" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-pageid="'.$pagePost->pageID.'" data-type="mainLike"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter">'.COUNT($mainLikeCount).'</span></button>' 
    : 
    '<button class="mainLike-btn" data-pageid="'.$pagePost->pageID.'" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="mainLike"><i class="fa fa-thumbs-up gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($mainLikeCount) > 0) ? COUNT($mainLikeCount) : '').'</span></button>'); ?>

                        </li>

                        <li>
                            <?php echo (($smile['reactBy'] === $user_id ) ?  '<button class="unSmile-btn" data-pageid="'.$pagePost->pageID.'" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="happy"><i class="fa fa-smile-o" aria-hidden="true"></i><span class="likesCounter">'.COUNT($smileCount).'</span></button>' 
    : 
    '<button class="smile-btn" data-pageid="'.$pagePost->pageID.'" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="happy"><i class="fa fa-smile-o gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($smileCount) > 0) ? COUNT($smileCount) : '').'</span></button>'); ?>

                        </li>

                        <li>
                            <?php echo (($angry['reactBy'] === $user_id ) ?  '<button class="unAngry-btn" data-pageid="'.$pagePost->pageID.'" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="angry"><i class="fa fa-drupal" aria-hidden="true"></i><span class="likesCounter">'.COUNT($angryCount).'</span></button>' 
    : 
    '<button class="angry-btn" data-pageid="'.$pagePost->pageID.'" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="angry"><i class="fa fa-drupal gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($angryCount) > 0) ? COUNT($angryCount) : '').'</span></button>'); ?>

                        </li>
                        <li>
                            <?php echo (($sad['reactBy'] === $user_id ) ?  '<button class="unSad-btn" data-pageid="'.$pagePost->pageID.'" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="sad"><i class="fa fa-frown-o" aria-hidden="true"></i><span class="likesCounter">'.COUNT($sadCount).'</span></button>' 
    : 
    '<button class="sad-btn" data-pageid="'.$pagePost->pageID.'" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="sad"><i class="fa fa-frown-o gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($sadCount) > 0) ? COUNT($sadCount) : '').'</span></button>'); ?>

                        </li>
                        <li>
                            <?php echo (($secret['reactBy'] === $user_id ) ?  '<button class="unSecret-btn" data-pageid="'.$pagePost->pageID.'" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="secrete"><i class="fa fa-user-secret" aria-hidden="true"></i><span class="likesCounter">'.COUNT($secretCount).'</span></button>' 
    : 
    '<button class="secret-btn" data-pageid="'.$pagePost->pageID.'" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="secrete"><i class="fa fa-user-secret gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($secretCount) > 0) ? COUNT($secretCount) : '').'</span></button>'); ?>

                        </li>
                        <li>
                            <?php echo (($love['reactBy'] === $user_id ) ?  '<button class="unLove-btn" data-pageid="'.$pagePost->pageID.'" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="love"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="likesCounter">'.COUNT($loveCount).'</span></button>' 
    : 
    '<button class="love-btn" data-pageid="'.$pagePost->pageID.'" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="love"><i class="fa fa-heart-o gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($loveCount) > 0) ? COUNT($loveCount) : '').'</span></button>'); ?>

                        </li>
                        <li>
                            <?php echo (($md['reactBy'] === $user_id ) ?  '<button class="unMd-btn" data-pageid="'.$pagePost->pageID.'" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="unhealthy"><i class="fa fa-user-md" aria-hidden="true"></i><span class="likesCounter">'.COUNT($mdCount).'</span></button>' 
    : 
    '<button class="md-btn" data-pageid="'.$pagePost->pageID.'" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="unhealthy"><i class="fa fa-user-md gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($mdCount) > 0) ? COUNT($mdCount) : '').'</span></button>'); ?>

                        </li>
                        <li>
                            <?php echo (($bed['reactBy'] === $user_id ) ?  '<button class="unBed-btn" data-pageid="'.$pagePost->pageID.'" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="bedSick"><i class="fa fa-bed" aria-hidden="true"></i><span class="likesCounter">'.COUNT($bedCount).'</span></button>' 
    : 
    '<button class="bed-btn" data-pageid="'.$pagePost->pageID.'" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="bedSick"><i class="fa fa-bed gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($bedCount) > 0) ? COUNT($bedCount) : '').'</span></button>'); ?>

                        </li>
                        <li>
                            <div class="emoReact">

                            </div>
                        </li>
                    </ul>
                </div>

                <div class="commentShareSection">
                    <ul>
                        <li><a href="#<?php echo $pagePost->pagePostID; ?>"><button class="commentIcon"><i class="fa fa-comment" aria-hidden="true"></i> </button></a>

                        </li>

                    </ul>

                    <ul>
                        <li>
                            <?php echo (($pagePost->pagePostID === $retweet['retweetID']) ? '<button class="retweeted" data-pageid="'.$pagePost->pageID.'" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'"><i class="fa fa-share" aria-hidden="true"></i><span class="retweetsCount"></span>'.$pagePost->repostCount.'</button>' : '<button class="retweet" data-pageid="'.$pagePost->pageID.'" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'"><i class="fa fa-share" aria-hidden="true"></i><span class="retweetsCount"></span>'.(($pagePost->repostCount > 0) ? $pagePost->repostCount : $retweet['retweetID']).'</button>' ); ?>

                        </li>

                    </ul>
                </div>
            </div>


            <div class="comment-holder" data-tweet="<?php echo $pagePost->pagePostID; ?>">


                <div class="containerer" data-tweet="<?php echo $pagePost->pagePostID; ?>">
                    <!--   <form method="POST" class="formClass" data-tweet="<?php echo $pagePost->pagePostID; ?>">-->



                    <span class="oldCommentShow">
          <?php foreach($comments as $comment){
//     $commentLikes = $this->commentLikes($user_id, $comment->commentOn, $comment->commentID, $comment->commentPageID  );
            
    
     $commentReactLike = $this->mainCommentReact($user_id, $comment->commentOn, $comment->commentID,$comment->commentPageID,$mainLike);
     $commentReactSmile = $this->mainCommentReact($user_id, $comment->commentOn, $comment->commentID,$comment->commentPageID,$happy);
     $commentReactSad = $this->mainCommentReact($user_id, $comment->commentOn, $comment->commentID,$comment->commentPageID,$sadd);
     $commentReactAngry = $this->mainCommentReact($user_id, $comment->commentOn, $comment->commentID,$comment->commentPageID,$angryy);
    
      
      $CommentReactLikeCount = $this->CommentReactCount( $comment->commentOn, $comment->commentID,$comment->commentPageID,$mainLike);
      $CommentReactSmileCount = $this->CommentReactCount( $comment->commentOn, $comment->commentID,$comment->commentPageID,$happy);
      $CommentReactSadCount = $this->CommentReactCount( $comment->commentOn, $comment->commentID,$comment->commentPageID,$sadd);
      $CommentReactAngryCount = $this->CommentReactCount( $comment->commentOn, $comment->commentID,$comment->commentPageID,$angryy);
         
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
                        <textarea data-autoresize name="replyInpu" class="replyIn" placeholder="Enter Comment" rows="2" data-tweet="<?php echo $comment->commentOn; ?>" data-pageid="<?php echo $pagePost->pageID; ?>" data-comment="<?php echo $comment->commentID; ?>"></textarea><input type="submit" name="replySubmit" class="postReply" value="POST" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>" data-reply="<?php echo $comment->commentID; ?>" data-pageid="<?php echo $pagePost->pageID; ?>" />
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
    
     
     $replyTotal = $this->totalReply($commentID, $comment->commentPageID);
//     $replyRow = mysql_num_rows($replyTotal);
     $replyTota = count($replyTotal);
     if($replyTota >= 1){
        $replyFetch = $this->replyDetail($comment->commentPageID, $commentID);
    
    foreach ($replyFetch as $fetchReply){
// $replyLikesCheck = $this->replyLikes($user_id,$fetchReply->commentPageID, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID,$fetchReply->commentPageID);  
           
$replyLikeReact = $this->replyReact($user_id,$fetchReply->commentPageID, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID, $mainLike); 
$replySmileReact = $this->replyReact($user_id,$fetchReply->commentPageID, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID, $happy );
$replySadReact = $this->replyReact($user_id,$fetchReply->commentPageID, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID,$sadd ); 
$replyAngryReact = $this->replyReact($user_id,$fetchReply->commentPageID, $fetchReply->commentOn, $fetchReply->comment_parent_id, $fetchReply->commentID,$angryy ); 
        
            $mainLike = 'mainLike';
            $lovee = 'love';
            $happy = 'happy';
            $angryy = 'angry';
            $sadd = 'sad';
            $secrete = 'secrete';
            $unhealthy = 'unhealthy';
            $bedSick = 'bedSick';
        
  $replyReactLCount = $this->replyReactCount( $fetchReply->commentOn, $comment->commentID, $fetchReply->commentID, $fetchReply->commentPageID, $mainLike);
  $replyReactSCount = $this->replyReactCount( $fetchReply->commentOn, $comment->commentID, $fetchReply->commentID, $fetchReply->commentPageID, $happy);
  $replyReactSACount = $this->replyReactCount( $fetchReply->commentOn, $comment->commentID, $fetchReply->commentID, $fetchReply->commentPageID,$sadd);
  $replyReactRCount = $this->replyReactCount( $fetchReply->commentOn, $comment->commentID, $fetchReply->commentID, $fetchReply->commentPageID, $angryy);
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
                        <textarea data-autoresize name="replyInpu" class="replyIn" placeholder="Enter Comment" rows="2" data-tweet="<?php echo $comment->commentOn; ?>" data-pageid="<?php echo $pagePost->pageID; ?>" data-comment="<?php echo $comment->commentID; ?>">
<?php echo '@'.$fetchReply->username; ?></textarea> <input type="submit" name="replySubmit" class="replyPostReply" value="POST" data-tweet="<?php echo $comment->commentOn; ?>" data-comment="<?php echo $comment->commentID; ?>" data-reply="<?php echo $comment->commentID; ?>" data-pageid="<?php echo $pagePost->pageID; ?>" />
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
     }else {echo '';
//         echo '
//     <div class="replyCountSyle" data-tweet="'.$comment->commentOn.'" data-comment="'.$comment->commentID.'">'.$replyTota.' replys on the comment</div>
//     '; 
     }
     
      ?>

            </div>
            <div class="replyShow">
                <ul>

                </ul>
            </div>
        </div>

    </div>
    </div>

    <?php }  ?>
    </span>
    <div class="dispplay_commen">
        <ul>

        </ul>
    </div>
    <div class="inputFormStyle">
        <div class="inputTextArea">
            <textarea data-autoresize name="comment_content" class="commentInput" id="<?php echo $pagePost->pagePostID; ?>" placeholder="Enter Comment" rows="2" data-tweet="<?php echo $pagePost->pagePostID; ?>" data-pageid="<?php echo $pagePost->pageID; ?>"></textarea>
            <input type="hidden" name="comment_id" class="hidClass" value="0" />
            <input type="submit" name="submit" class="postComment" value="POST" data-tweet="<?php echo $pagePost->pagePostID; ?>" data-pageid="<?php echo $pagePost->pageID; ?>" />
        </div>

    </div>


    <span class="comment_message">
     

                            </span>
    <br />

    <div class="moreComment" data-tweet="<?php echo $pagePost->pagePostID; ?>">
        <i class="fa fa-angle-down"></i>
    </div>
    </div>
    </div>
    </div>
    </div>


    <?php
            
        }
        
        
         
         
         
//		$stmt->bindParam(":userID", $userID, PDO::PARAM_INT); // $stmt->execute(); // $user = $stmt->fetch(PDO::FETCH_OBJ); // return $user->user_id;
	}

 public function lastPagePostt($pageIDD){
        $stmt = $this->pdo->prepare("SELECT pagepost.*, users.*
    FROM
        pagepost
    LEFT JOIN users ON users.user_id = pagepost.userID
    WHERE
        pageImageID != 0 AND pageID = :pageID GROUP BY pageImageID
     UNION
SELECT
    pagepost.*, users.*
    FROM
        pagepost
    LEFT JOIN users ON users.user_id = pagepost.userID
    WHERE
        pageImageID = 0 AND pageID = :pageID
   ORDER BY postedOn DESC LIMIT 1");
		$stmt->bindParam(":pageID", $pageIDD, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
     public function pageImagesCount($pageImageID){
        $stmt = $this->pdo->prepare("SELECT * FROM pagePost WHERE pageImageID = :pageImageID ORDER BY pageID DESC");
		$stmt->bindParam(":pageImageID", $pageImageID, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
    }    
    
    public function pageImageFetch($pageImageID){
        $stmt = $this->pdo->prepare("SELECT * FROM pagePost WHERE pageImageID = :pageImageID ORDER BY pageImageID DESC");
		$stmt->bindParam(":pageImageID", $pageImageID, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
    } 

   public function editPost($tweet_id, $user_id, $status){
        $stmt = $this->pdo->prepare("UPDATE `tweets` SET `status` = :status WHERE `tweetID` = :tweet_id AND `tweetBY` = :user_id");
			$stmt->bindParam(":status", $status, PDO::PARAM_INT);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->execute();
    }  
    public function editReply($editReplyComment, $tweetId, $editReplId, $editReplData){
        $stmt = $this->pdo->prepare("UPDATE `pagecomments` SET `comment` = :comment WHERE `commentOn` = :tweetId AND `commentID` = :editReplId AND `commentReplyID` = :editReplyComment ");
			$stmt->bindParam(":comment", $editReplData, PDO::PARAM_INT);
			$stmt->bindParam(":tweetId", $tweetId, PDO::PARAM_INT);
			$stmt->bindParam(":editReplId", $editReplId, PDO::PARAM_INT);
			$stmt->bindParam(":editReplyComment", $editReplyComment, PDO::PARAM_INT);
			$stmt->execute();
    } 
    public function editComment($editComment, $tweetId, $editCommlData){
        $stmt = $this->pdo->prepare("UPDATE `pagecomments` SET `comment` = :comment WHERE `commentOn` = :tweetId AND `commentID` = :editReplId AND `commentReplyID` = '0' ");
			$stmt->bindParam(":comment", $editCommlData, PDO::PARAM_INT);
			$stmt->bindParam(":tweetId", $tweetId, PDO::PARAM_INT);
			$stmt->bindParam(":editReplId", $editComment, PDO::PARAM_INT);
			
			$stmt->execute();
    }


    public function reactCount($pageID, $tweet_id, $reactType){
	$stmt = $this->pdo->prepare("SELECT reactID from `pagereact` WHERE `reactOn`= :tweet_id AND `reactPageID` = :pageID AND reactType= :reactType AND `reactCommentOn` = '0' AND `reactReplyOn` = '0'");
        $stmt->bindParam(":pageID", $pageID, PDO::PARAM_INT);
        $stmt->bindParam(":reactType", $reactType, PDO::PARAM_INT);
        $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}  
     
    public function CommentReactCount($tweet_id,$commentID, $pageID, $reactType){
	$stmt = $this->pdo->prepare("SELECT reactID from `pagereact` WHERE `reactOn`= :tweet_id AND `reactPageID` = :pageID AND  `reactCommentOn` = :commentID AND `reactReplyOn` = '0' AND `reactType` = :reactType ");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
             $stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
             $stmt->bindParam(":pageID", $pageID, PDO::PARAM_INT);
             $stmt->bindParam(":reactType", $reactType, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} 
    
    
    public function tweetCheck($tweetId){
        $stmt = $this->pdo->prepare("SELECT * FROM `tweets` WHERE `tweetID` = :tweetID");
             $stmt->bindParam(":tweetID", $tweetId, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
       
    }
//    public function replyLikeCount($tweet_id, $commentID,$replyID){
//	$stmt = $this->pdo->prepare("SELECT likeID from `likes` WHERE `likeOn`= :tweet_id AND `likeCommentOn` = :commentID AND `likeReplyOn` = :replyID ");
//             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
//             $stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
//             $stmt->bindParam(":replyID", $replyID, PDO::PARAM_INT);
//             
//			$stmt->execute();
//			return $stmt->fetchAll(PDO::FETCH_OBJ);
//		} 
    public function replyReactCount($tweet_id, $commentID, $replyID, $pageID, $reactType){
	$stmt = $this->pdo->prepare("SELECT reactID from `pagereact` WHERE `reactOn`= :tweet_id AND `reactPageID` = :pageID AND `reactCommentOn` = :commentID AND `reactReplyOn` = :replyID AND `reactType` = :reactType ");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
             $stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
             $stmt->bindParam(":replyID", $replyID, PDO::PARAM_INT);
             $stmt->bindParam(":pageID", $pageID, PDO::PARAM_INT);
             $stmt->bindParam(":reactType", $reactType, PDO::PARAM_INT);
             
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}  
      


    public function addLike($user_id, $tweet_id, $get_id){

       
			$this->create('likes', array('likeBy' => $user_id, 'likeOn' =>$tweet_id));
			if($get_id != $user_id){
				Message::sendNotification($get_id, $user_id, $tweet_id, 'like');
			
            }
		}  
    public function addReact($pageID, $user_id, $tweet_id, $get_id, $reactType){

       
			$this->create('pagereact', array('reactPageID' => $pageID,'reactBy' => $user_id, 'reactOn' =>$tweet_id, 'reactType' =>$reactType ));
			if($get_id != $user_id){
				Message::sendNotification($get_id, $user_id, $tweet_id, 'like');
			
            }
		}  
    public function addCommentReact($pageID, $user_id, $tweet_id, $get_id, $reactType, $commentID){

       
			$this->create('pagereact', array('reactPageID' => $pageID,'reactBy' => $user_id, 'reactOn' =>$tweet_id, 'reactType' =>$reactType, 'reactCommentOn' => $commentID ));
			if($get_id != $user_id){
				Message::sendNotification($get_id, $user_id, $tweet_id, 'like');
			
            }
		}
    public function addReplyReact($pageID, $user_id, $tweet_id, $get_id, $reactType, $commentID, $replyID){

       
			$this->create('pagereact', array('reactPageID' => $pageID,'reactBy' => $user_id, 'reactOn' =>$tweet_id, 'reactType' =>$reactType, 'reactCommentOn' => $commentID, 'reactReplyOn' => $replyID ));
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
    public function unReact($pageID, $user_id, $tweet_id, $get_id, $react_type){
//			$stmt = $this->pdo->prepare("UPDATE `tweets` SET `likesCount` = `likesCount` -1 WHERE `tweetID` = :tweet_id"); // $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT); // $stmt->execute();

			$stmt = $this->pdo->prepare("DELETE FROM `pagereact` WHERE `reactBy` = :user_id AND `reactPageID` = :pageID AND `reactOn` = :tweet_id AND `reactType` = :react_type AND `reactCommentOn` = '0' AND `reactReplyOn` = '0'");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":pageID", $pageID, PDO::PARAM_INT);
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
    public function unReactExist($pageID, $user_id, $tweet_id, $get_id){
//			$stmt = $this->pdo->prepare("UPDATE `tweets` SET `likesCount` = `likesCount` -1 WHERE `tweetID` = :tweet_id"); // $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT); // $stmt->execute();

			$stmt = $this->pdo->prepare("DELETE FROM `pagereact` WHERE `reactBy` = :user_id AND `reactPageID` = :pageID AND `reactOn` = :tweet_id AND `reactCommentOn` = '0' AND `reactReplyOn` = '0'");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":pageID", $pageID, PDO::PARAM_INT);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
		} 
    public function commentUnReactExist($pageID, $user_id, $tweet_id, $get_id, $commentID){
//			$stmt = $this->pdo->prepare("UPDATE `tweets` SET `likesCount` = `likesCount` -1 WHERE `tweetID` = :tweet_id"); // $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT); // $stmt->execute();

			$stmt = $this->pdo->prepare("DELETE FROM `pagereact` WHERE `reactBy` = :user_id AND reactPageID = :pageID AND `reactOn` = :tweet_id AND `reactCommentOn`=:commentID AND `reactReplyOn` = '0' ");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":pageID", $pageID, PDO::PARAM_INT);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
			$stmt->execute();
		} 
    public function reactUnReactExist($pageID, $user_id, $tweet_id, $get_id, $commentID, $replyId ){
//			$stmt = $this->pdo->prepare("UPDATE `tweets` SET `likesCount` = `likesCount` -1 WHERE `tweetID` = :tweet_id"); // $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT); // $stmt->execute();

			$stmt = $this->pdo->prepare("DELETE FROM `pagereact` WHERE `reactBy` = :user_id AND reactPageID = :pageID AND `reactOn` = :tweet_id AND `reactCommentOn`= :commentID AND `reactReplyOn` = :replyId ");
			$stmt->bindParam(":pageID", $pageID, PDO::PARAM_INT);
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
           public function smileCountCheck($pageID, $tweet_id, $user_id, $react_type ){
	$stmt = $this->pdo->prepare("SELECT reactID from `pagereact` WHERE `reactOn`= :tweet_id AND `reactPageID` = :pageID AND `reactBy` = :user_id AND `reactType` = :react_type AND `reactCommentOn` = '0' AND `reactReplyOn` = '0'");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
             $stmt->bindParam(":pageID", $pageID, PDO::PARAM_INT);
             $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
             $stmt->bindParam(":react_type", $react_type, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}   
    public function reactExistingCheck($tweet_id, $user_id ){
	$stmt = $this->pdo->prepare("SELECT reactID from `pagereact` WHERE `reactOn`= :tweet_id AND `reactBy` = :user_id ");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
             $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} 
    public function CommentReactExistingCheck($pageID, $tweet_id, $user_id,$commentID ){
	$stmt = $this->pdo->prepare("SELECT reactID from `pagereact` WHERE `reactOn`= :tweet_id AND `reactPageID` = :pageID AND `reactBy` = :user_id AND `reactCommentOn`= :commentID AND `reactReplyOn` = '0' ");
             $stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
             $stmt->bindParam(":pageID", $pageID, PDO::PARAM_INT);
             $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
             $stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
    public function replyReactExistingCheck($pageID, $tweet_id, $user_id,$commentID, $replyID ){
	$stmt = $this->pdo->prepare("SELECT reactID from `pagereact` WHERE `reactOn`= :tweet_id AND `reactPageID` = :pageID AND  `reactBy` = :user_id AND `reactCommentOn`= :commentID AND `reactReplyOn` = :replyID ");
             $stmt->bindParam(":pageID", $pageID, PDO::PARAM_INT);
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

		} 
    
    
    public function reactCheck($user_id,$pageID, $tweet_id,$react_type){
			$stmt = $this->pdo->prepare("SELECT * FROM `pagereact` WHERE `reactBy` = :user_id AND `reactPageID` = :pageID AND `reactOn` = :pagePostID AND  reactType = :react_type AND `reactCommentOn` = '0' AND `reactReplyOn` = '0'");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->bindParam(":pageID", $pageID, PDO::PARAM_INT);
            $stmt->bindParam(":pagePostID", $tweet_id, PDO::PARAM_INT);
			$stmt->bindParam(":react_type", $react_type, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);

		}
    
     public function mainCommentReact($user_id, $commentOn, $reactCommentOn, $reactPageID, $reactType){
			$stmt = $this->pdo->prepare("SELECT * FROM `pagereact` WHERE `reactBy` = :user_id AND `reactPageID` = :reactPageID AND `reactOn` = :commentOn AND `reactCommentOn` = :reactCommentOn AND reactReplyOn ='0' AND `reactType` = :reactType ");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":commentOn", $commentOn, PDO::PARAM_INT);
            $stmt->bindParam(":reactCommentOn", $reactCommentOn, PDO::PARAM_INT);
            $stmt->bindParam(":reactPageID", $reactPageID, PDO::PARAM_INT);
            $stmt->bindParam(":reactType", $reactType, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);

		} 
    
    
    
    public function replyLikes($pageid, $user_id, $commentOn, $likeCommentOn, $likeReplyOn){
			$stmt = $this->pdo->prepare("SELECT * FROM `likes` WHERE `likeBy` = :user_id AND `likeOn` = :commentOn AND `likeCommentOn` = :likeCommentOn AND `likeReplyOn` = :likeReplyOn");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":commentOn", $commentOn, PDO::PARAM_INT);
            $stmt->bindParam(":likeCommentOn", $likeCommentOn, PDO::PARAM_INT);
            $stmt->bindParam(":likeReplyOn", $likeReplyOn, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);

		} 
    public function replyReact($user_id,$pageID, $commentOn, $likeCommentOn, $likeReplyOn, $reactType){
			$stmt = $this->pdo->prepare("SELECT * FROM `pagereact` WHERE `reactBy` = :user_id AND `reactPageID` = :pageID AND `reactOn` = :commentOn AND `reactCommentOn` = :likeCommentOn AND `reactReplyOn` = :likeReplyOn AND `reactType` = :reactType" );
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":pageID", $pageID, PDO::PARAM_INT);
			$stmt->bindParam(":commentOn", $commentOn, PDO::PARAM_INT);
            $stmt->bindParam(":likeCommentOn", $likeCommentOn, PDO::PARAM_INT);
            $stmt->bindParam(":likeReplyOn", $likeReplyOn, PDO::PARAM_INT);
            $stmt->bindParam(":reactType", $reactType, PDO::PARAM_INT);
           
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
    public function getPopupTweet($pageID, $tweet_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `pagepost`, `users` WHERE `pagePostID` = :tweet_id AND `pageID` = :pageID AND `tweetBy` = `user_id`");
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->bindParam(":pageID", $pageID, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);

} 
    public function getPopupTwee($profileImageID){
			$stmt = $this->pdo->prepare("SELECT tweetID FROM `tweets` WHERE `tweetImage` = :profileImageID");
			$stmt->bindParam(":profileImageID", $profileImageID, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);

}
    public function checkRetweet($pageID, $tweet_id, $user_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `pagePost` WHERE `repostID` = :tweet_id AND `pageID` = :pageID AND `repostBy` = :user_id OR `pagePostID` = :tweet_id AND `repostBy` = :user_id");
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":pageID", $pageID, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);
		} 
  
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
    public function comments($pageID, $tweet_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `pagecomments` LEFT JOIN `users` ON `commentBy` = `user_id` WHERE `commentOn` = :tweet_id AND comment_parent_id ='0' AND `commentPageID` = :pageID ORDER BY commentAt DESC ");
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->bindParam(":pageID", $pageID, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} 
    
      public function lastComments($pageID, $tweet_id, $userID){
			$stmt = $this->pdo->prepare("SELECT * FROM `pagecomments` LEFT JOIN `users` ON `commentBy` = `user_id` WHERE `commentOn` = :tweet_id AND `commentBy` = :userID AND comment_parent_id ='0' AND `commentPageID` = :pageID ORDER BY commentAt DESC LIMIT 1");
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->bindParam(":userID", $userID, PDO::PARAM_INT);
			$stmt->bindParam(":pageID", $pageID, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
    
    public function totalReply($commentID, $pageID){
			$stmt = $this->pdo->prepare("SELECT comment_parent_id FROM `pagecomments` WHERE `comment_parent_id` = :commentID AND `commentPageID` = :pageID");
			$stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
			$stmt->bindParam(":pageID", $pageID, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		} 
    public function reply($commentID){
			$stmt = $this->pdo->prepare("SELECT * FROM `comments`  WHERE comment_parent_id = :commentID ORDER BY `commentAt` DESC");
			$stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}      
    public function replyDetail($pagaID, $commentID){
			$stmt = $this->pdo->prepare("SELECT * FROM `pagecomments` LEFT JOIN `users` ON `commentBy` = `user_id` WHERE comment_parent_id = :commentID AND `commentPageID` = :pageID ORDER BY `commentAt` DESC LIMIT 3");
            
			$stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
			$stmt->bindParam(":pageID", $pagaID, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
    public function replyDetails($pagaID, $commentID){
			$stmt = $this->pdo->prepare("SELECT * FROM `pagecomments` LEFT JOIN `users` ON `commentBy` = `user_id` WHERE comment_parent_id = :commentID AND `commentPageID` = :pageID ORDER BY `commentAt` DESC LIMIT 1");
            
			$stmt->bindParam(":commentID", $commentID, PDO::PARAM_INT);
			$stmt->bindParam(":pageID", $pagaID, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}   
    
    public function commentsLimits($pageID, $tweet_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `pagecomments` LEFT JOIN `users` ON `commentBy` = `user_id` WHERE `commentOn` = :tweet_id AND `commentPageID` = :pageID AND comment_parent_id ='0' ORDER BY commentAt DESC LIMIT 3 ");
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->bindParam(":pageID", $pageID, PDO::PARAM_INT);
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
   
	}


?>
