<?php
include '../init.php';
    include '../../class/login.php';
    $user_id = login::isLoggedIn();
//$tweet_id = 7; //$likeIdnt=$getFromT->likeCheck( $tweet_id, $user_id); //$lk = COUNT($likeIdnt); // //if($lk
//< 1 ){ // $getFromT->addLike($user_id, $tweet_id, $get_id); //}
//$tweet_id = 7; 
//$react_type = 'happy'; 
// $smileIdnt=$getFromT->smileCountCheck( $tweet_id, $user_id, $react_type); 
//$sl = COUNT($smileIdnt); 
//echo $sl;
// if($sl > 1 ){ 
// echo 'found'; 
//}else { 
// echo 'not found'; 
//}
if(isset($_POST['happyReact']) && !empty($_POST['happyReact'])){
    $react_type = $_POST['happyReact'];
    $user_id = login::isLoggedIn();
    $tweet_id = $_POST['smileId'];
    $get_id = $_POST['user_id'];
  $reactExist=$getFromT->reactExistingCheck( $tweet_id, $user_id); 
    $rex = COUNT($reactExist);
  $smileI=$getFromT->smileCountCheck( $tweet_id, $user_id, $react_type); 
$sl = COUNT($smileI); 
   
// if($rex >0 ){
     $getFromT->unReactExist($user_id, $tweet_id, $get_id);
      if($sl < 1 ){ 


    $getFromT->addReact($user_id, $tweet_id, $get_id,$react_type);
 }
     

//     } 
}
/////////////////// duita isset a problem...


//////////////////////

if(isset($_POST['unHappyReact']) && !empty($_POST['unHappyReact'])){
    $react_type = $_POST['unHappyReact'];
    $user_id = login::isLoggedIn();
    $tweet_id = $_POST['smileId'];
    $get_id = $_POST['user_id'];
    $getFromT->unReact($user_id, $tweet_id, $get_id, $react_type);
    
}
if(isset($_POST['reactComment']) && !empty($_POST['reactComment'])){
    $reactComment = $_POST['reactComment'];
    $user_id = login::isLoggedIn();
    $reactTweetId = $_POST['reactTweetId'];
    $hm = 'happy';
    $likess = $getFromT->mainLikes($user_id, $reactTweetId);
        $mainLikeCheck = $getFromT->mainLikeCheck($user_id, $reactTweetId);
        $smile = $getFromT->smileCheck($user_id, $reactTweetId, $hm); 
        $angry = $getFromT->angryCheck($user_id, $reactTweetId); 
        $sad = $getFromT->sadCheck($user_id, $reactTweetId); 
        $secret = $getFromT->secretCheck($user_id, $reactTweetId); 
        $love = $getFromT->loveCheck($user_id, $reactTweetId); 
        $md = $getFromT->mdCheck($user_id, $reactTweetId); 
        $bed = $getFromT->bedCheck($user_id, $reactTweetId); 
        
       
       
        
     
        $likesCount = $getFromT->likeCount($reactTweetId);
        $smileCount  = $getFromT->smileCount($reactTweetId);
        $mainLikeCount  = $getFromT->mainLikeCount($reactTweetId);
        $angryCount  = $getFromT->angryCount($reactTweetId);
        $sadCount  = $getFromT->sadCount($reactTweetId);
        $secretCount  = $getFromT->secretCount($reactTweetId);
        $loveCount  = $getFromT->loveCount($reactTweetId);
        $mdCount  = $getFromT->mdCount($reactTweetId);
        $bedCount   = $getFromT->bedCount($reactTweetId);
    ?>
  
    <div class="reactWrap">
    
    <ul>
        <li>
                                    <?php echo (($smile['reactBy'] === $user_id ) ?  '<button class="unSmile-btn" data-tweet="'.$reactTweetId.'" data-user="'.$user_id.'" data-type="happy" data-comment="'.$reactComment.'"><i class="fa fa-smile-o grayy" aria-hidden="true"></i><span class="likesCounter">'.COUNT($smileCount).'</span></button>' 
    : 
    '<button class="smile-btn" data-tweet="'.$reactTweetId.'" data-user="'.$user_id.'" data-type="happy" data-comment="'.$reactComment.'"><i class="fa fa-smile-o grayy" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($smileCount) > 0) ? COUNT($smileCount) : '').'</span></button>'); ?>

                                </li>
                                <li>
                                    <?php echo (($angry['reactBy'] === $user_id ) ?  '<button class="unAngry-btn" data-tweet="'.$reactTweetId.'" data-user="'.$user_id.'" data-type="angry" data-comment="'.$reactComment.'"><i class="fa fa-drupal grayy" aria-hidden="true"></i><span class="likesCounter">'.COUNT($angryCount).'</span></button>' 
    : 
    '<button class="angry-btn" data-tweet="'.$reactTweetId.'" data-comment="'.$reactComment.'" data-user="'.$user_id.'" data-type="angry"><i class="fa fa-drupal grayy" aria-hidden="true"></i><span class="likesCounter">'.((COUNT($angryCount) > 0) ? COUNT($angryCount) : '').'</span></button>'); ?>

                                </li>
                                   
        
    </ul>
    <i class="fa fa-times commentReactClose"></i>
  </div>
    
   <?php 
}  ?>