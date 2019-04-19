<?php 
include '../init.php';
    include '../../class/login.php';
    $user_id = login::isLoggedIn();

//.............Page POST.................//
$rand=rand();
      $rando=rand();
   $_SESSION['rand']=$rand;
   $_SESSION['rando']=$rando;
        $ImageId = $_SESSION['rand'];         
        $ImageIdo = $_SESSION['rando'];
//        echo ''.$ImageId+$ImageIdo.'<br>' ;
//        echo $ImageIdo;
if(isset($_POST['pageTextarea'])){ 
      $status = $getFromU->checkInput($_POST['pageTextarea']);
    $postUserImage = $_POST['hiddenProImage'];
    $pageID = $_POST['pageID'];
//    echo $status;
    
    echo '';
    
    
     $output = '';  
 if(is_array($_FILES) && !empty($_FILES) )   
 {
    
     
      foreach ($_FILES['files']['name'] as $name => $value)  
      {  
           $file_name = explode(".", $_FILES['files']['name'][$name]);  
          $fileCount = COUNT($file_name);
          if ($fileCount >1 ){
           $allowed_ext = array("jpg", "jpeg", "png", "gif", "JPG");  
           if(in_array($file_name[1], $allowed_ext))  
           {  
                $new_name = md5(rand()) . '.' . $file_name[1];  
                $sourcePath = $_FILES['files']['tmp_name'][$name];  
               $fileRoot = 'postUser/' . $new_name;
//                $targetPath = "socialbd/postUser/".$new_name;  
//                move_uploaded_file($sourcePath, $_SERVER['DOCUMENT_ROOT'].'/socialbd/'.$fileRoot);  
                if(move_uploaded_file($sourcePath, $_SERVER['DOCUMENT_ROOT'].'/socialbd/'.$fileRoot))  
                {  
                     $output .= '<img src="'.$fileRoot.'" width="150px" height="180px" />';  
//                    echo $output;
                    
                }  
               $getFromU->create('pagepost', array('pageID' => $pageID,'pagePost' => $status, 'userID' => $user_id, 'pageImage' => $fileRoot, 'pageImageID' => $ImageId, 'postedOn' => date('Y-m-d H:i:s'))); preg_match_all("/#+([a-zA-Z0-9_]+)/i",$status, $hashtag); if(!empty($hashtag)){
                $getFromT->addTrend($status);
              }
			preg_match_all("/#+([a-zA-Z0-9_]+)/i", $status, $hashtag); 
                if(!empty($hashtag)){ 
                $getFromT->addTrend($status); 
                } 
//                $getFromT->addMention($status, $user_id, $tweet_id);  
                    
           } 
          }else{
             $getFromU->create('pagepost', array('pageID' => $pageID,'pagePost' => $status, 'userID' => $user_id, 'postedOn' => date('Y-m-d H:i:s')));
		      preg_match_all("/#+([a-zA-Z0-9_]+)/i",$status, $hashtag);
            if(!empty($hashtag)){
                $getFromT->addTrend($status);
            };
           }
      }
  
//      echo $output;  
 }
       echo '<li><div class="pagePostTopSec" style="display:flex; flex-direction:row; align-items: center; font-size:12px; justify-content: space-between;">
       <div class="user"><img src="'.BASE_URL. $postUserImage.'" alt=""></div>
<div class="pageStatusHead">Update His page Status</div>
<div class="pageStatusOpt">...</div>
</div>
<div class="pagePostMidSec">
    <div class="pageTextStatus">'.$status.'</div>
    <div class="pageImageStatus">'.$output.'</div>

</div>
</li>
'; } 

           $mainLike = 'mainLike';
            $lovee = 'love';
            $happy = 'happy';
            $angryy = 'angry';
            $sadd = 'sad';
            $secrete = 'secrete';
            $unhealthy = 'unhealthy';
            $bedSick = 'bedSick';
//            $likess = $getFromP->mainLikes($user_id, $pagePost->pagePostID);
//          reactCheck($user_id,$pagePost->pageID, $pagePost->pagePostID, $mainLike)   
        
        $pagePosta =  $getFromP->lastPagePostt($pageID);
foreach($pagePosta as $pagePost){
        
        $mainLikeCheck = $getFromP->reactCheck($user_id,$pagePost->pageID, $pagePost->pagePostID,$mainLike);     
        $smile = $getFromP->reactCheck($user_id,$pagePost->pageID, $pagePost->pagePostID,$happy); 
            
        $angry = $getFromP->reactCheck($user_id,$pagePost->pageID, $pagePost->pagePostID,$angryy);
        $sad = $getFromP->reactCheck($user_id,$pagePost->pageID, $pagePost->pagePostID,$sadd);
        $secret = $getFromP->reactCheck($user_id,$pagePost->pageID, $pagePost->pagePostID,$secrete);
        $love = $getFromP->reactCheck($user_id,$pagePost->pageID, $pagePost->pagePostID,$lovee);
        $md = $getFromP->reactCheck($user_id,$pagePost->pageID, $pagePost->pagePostID,$unhealthy);
        $bed = $getFromP->reactCheck($user_id,$pagePost->pageID, $pagePost->pagePostID,$bedSick);
        
         $retweet = $getFromP->checkRetweet($pagePost->pageID, $pagePost->pagePostID,$user_id); 
        
        
         $retweetText = $getFromP->checkRetweetText($pagePost->pageID, $pagePost->pagePostID); 
//        $tweetId=$pagePost->pagePostID;
        $tweetId=$pagePost->pageID;
        $comments = $getFromP->commentsLimits($pagePost->pageID, $pagePost->pagePostID);
//        $profileId
//        include 'core/init.php';
        $user = $getFromP->userData($pagePost->userID);
            
            
//        $likesCount = $getFromP->likeCount($pagePost->pageID, $pagePost->pagePostID);
            
            
        $smileCount  = $getFromP->reactCount($pagePost->pageID, $pagePost->pagePostID, $happy );
        $mainLikeCount  = $getFromP->reactCount($pagePost->pageID, $pagePost->pagePostID,$mainLike);
        $angryCount  = $getFromP->reactCount($pagePost->pageID, $pagePost->pagePostID, $angryy);
        $sadCount  = $getFromP->reactCount($pagePost->pageID, $pagePost->pagePostID, $sadd);
        $secretCount  = $getFromP->reactCount($pagePost->pageID, $pagePost->pagePostID, $secrete);
        $loveCount  = $getFromP->reactCount($pagePost->pageID, $pagePost->pagePostID, $lovee);
        $mdCount  = $getFromP->reactCount($pagePost->pageID, $pagePost->pagePostID, $unhealthy);
        $bedCount   = $getFromP->reactCount($pagePost->pageID, $pagePost->pagePostID, $bedSick);




?>



<div class="lower-section-wrapper">

    <div class="lower-section-details">
        <div class="reactionn">

            <div class="likeSection">
                <ul>


                    <li>
                        <?php echo (($mainLikeCheck['reactBy'] === $user_id ) ?  '<button class="unMainLike-btn" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="mainLike"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter">'.COUNT($mainLikeCount).'</span></button>' 
    : 
    '<button class="mainLike-btn" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="mainLike"><i class="fa fa-thumbs-up gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($mainLikeCount) > 0) ? COUNT($mainLikeCount) : '').'</span></button>'); ?>

                    </li>

                    <li>
                        <?php echo (($smile['reactBy'] === $user_id ) ?  '<button class="unSmile-btn" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="happy"><i class="fa fa-smile-o" aria-hidden="true"></i><span class="likesCounter">'.COUNT($smileCount).'</span></button>' 
    : 
    '<button class="smile-btn" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="happy"><i class="fa fa-smile-o gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($smileCount) > 0) ? COUNT($smileCount) : '').'</span></button>'); ?>

                    </li>

                    <li>
                        <?php echo (($angry['reactBy'] === $user_id ) ?  '<button class="unAngry-btn" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="angry"><i class="fa fa-drupal" aria-hidden="true"></i><span class="likesCounter">'.COUNT($angryCount).'</span></button>' 
    : 
    '<button class="angry-btn" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="angry"><i class="fa fa-drupal gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($angryCount) > 0) ? COUNT($angryCount) : '').'</span></button>'); ?>

                    </li>
                    <li>
                        <?php echo (($sad['reactBy'] === $user_id ) ?  '<button class="unSad-btn" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="sad"><i class="fa fa-frown-o" aria-hidden="true"></i><span class="likesCounter">'.COUNT($sadCount).'</span></button>' 
    : 
    '<button class="sad-btn" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="sad"><i class="fa fa-frown-o gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($sadCount) > 0) ? COUNT($sadCount) : '').'</span></button>'); ?>

                    </li>
                    <li>
                        <?php echo (($secret['reactBy'] === $user_id ) ?  '<button class="unSecret-btn" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="secrete"><i class="fa fa-user-secret" aria-hidden="true"></i><span class="likesCounter">'.COUNT($secretCount).'</span></button>' 
    : 
    '<button class="secret-btn" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="secrete"><i class="fa fa-user-secret gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($secretCount) > 0) ? COUNT($secretCount) : '').'</span></button>'); ?>

                    </li>
                    <li>
                        <?php echo (($love['reactBy'] === $user_id ) ?  '<button class="unLove-btn" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="love"><i class="fa fa-heart-o" aria-hidden="true"></i><span class="likesCounter">'.COUNT($loveCount).'</span></button>' 
    : 
    '<button class="love-btn" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="love"><i class="fa fa-heart-o gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($loveCount) > 0) ? COUNT($loveCount) : '').'</span></button>'); ?>

                    </li>
                    <li>
                        <?php echo (($md['reactBy'] === $user_id ) ?  '<button class="unMd-btn" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="unhealthy"><i class="fa fa-user-md" aria-hidden="true"></i><span class="likesCounter">'.COUNT($mdCount).'</span></button>' 
    : 
    '<button class="md-btn" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="unhealthy"><i class="fa fa-user-md gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($mdCount) > 0) ? COUNT($mdCount) : '').'</span></button>'); ?>

                    </li>
                    <li>
                        <?php echo (($bed['reactBy'] === $user_id ) ?  '<button class="unBed-btn" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="bedSick"><i class="fa fa-bed" aria-hidden="true"></i><span class="likesCounter">'.COUNT($bedCount).'</span></button>' 
    : 
    '<button class="bed-btn" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'" data-type="bedSick"><i class="fa fa-bed gray" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($bedCount) > 0) ? COUNT($bedCount) : '').'</span></button>'); ?>

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
                        <?php echo (($pagePost->pagePostID === $retweet['retweetID']) ? '<button class="retweeted" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'"><i class="fa fa-share" aria-hidden="true"></i><span class="retweetsCount"></span>'.$pagePost->repostCount.'</button>' : '<button class="retweet" data-tweet="'.$pagePost->pagePostID.'" data-user="'.$pagePost->userID.'"><i class="fa fa-share" aria-hidden="true"></i><span class="retweetsCount"></span>'.(($pagePost->repostCount > 0) ? $pagePost->repostCount : $retweet['retweetID']).'</button>' ); ?>

                    </li>

                </ul>
            </div>
        </div>


        <div class="comment-holder" data-tweet="<?php echo $pagePost->pagePostID; ?>">


            <div class="containerer" data-tweet="<?php echo $pagePost->pagePostID; ?>">
                <!--   <form method="POST" class="formClass" data-tweet="<?php echo $pagePost->pagePostID; ?>">-->

                <div class="dispplay_commen">

                </div>

                <span class="oldCommentShow">
          <?php foreach($comments as $comment){
//     $commentLikes = $getFromP->commentLikes($user_id, $comment->commentOn, $comment->commentID, $comment->commentPageID  );
            
    
     $commentReactLike = $getFromP->mainCommentReact($user_id, $comment->commentOn, $comment->commentID,$comment->commentPageID,$mainLike);
     $commentReactSmile = $getFromP->mainCommentReact($user_id, $comment->commentOn, $comment->commentID,$comment->commentPageID,$happy);
     $commentReactSad = $getFromP->mainCommentReact($user_id, $comment->commentOn, $comment->commentID,$comment->commentPageID,$sadd);
     $commentReactAngry = $getFromP->mainCommentReact($user_id, $comment->commentOn, $comment->commentID,$comment->commentPageID,$angryy);
    
      
      $CommentReactLikeCount = $getFromP->CommentReactCount( $comment->commentOn, $comment->commentID,$comment->commentPageID,$mainLike);
      $CommentReactSmileCount = $getFromP->CommentReactCount( $comment->commentOn, $comment->commentID,$comment->commentPageID,$happy);
      $CommentReactSadCount = $getFromP->CommentReactCount( $comment->commentOn, $comment->commentID,$comment->commentPageID,$sadd);
      $CommentReactAngryCount = $getFromP->CommentReactCount( $comment->commentOn, $comment->commentID,$comment->commentPageID,$angryy);
         
//      $replyLikesCou = $getFromP->replyLikeCount( $comment->commentOn, $comment->commentID, $comment->commentReplyID  );
     
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

<?php }  ?>
</span>
<div class="inputFormStyle">
    <div class="inputTextArea">
        <textarea data-autoresize name="comment_content" class="commentInput" placeholder="Enter Comment" rows="2" data-tweet="<?php echo $pagePost->pagePostID; ?>"></textarea>
        <input type="hidden" name="comment_id" class="hidClass" value="0" />
        <input type="submit" name="submit" class="postComment" value="POST" data-tweet="<?php echo $pagePost->pagePostID; ?>" />
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
} ?>
