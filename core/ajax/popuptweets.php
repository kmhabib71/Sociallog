<?php
include '../init.php';
    include '../../class/login.php';
    $user_id = login::isLoggedIn();
if(isset($_POST['showpopup']) && !empty($_POST['showpopup'])){
//    echo' hello';
$tweetID = $_POST['showpopup'];
    $comments = $getFromT->commentShow($tweetID);
$output = '';
foreach($comments as $row)
{
 $output .= '
  <div class="mainCommen">
                <div class="user-comment">
                <div class="user"><img src="'.$row->profileImage.'"/></div>
                  </div>
                  
                <div class="comments"><strong class="username">'.$row->username.'</strong>'.$row->comment.'</div>
                </div>
  
  
  <button type="button" class="btn btn-default reply" id="'.$row->commentID.'">Reply</button></div>
 </div>
 ';
 $output .= get_reply_comment($row->commentID);
}

echo $output;
    
    function get_reply_comment($parent_id = 0, $marginleft = 0)
{
$output = '';
 $resultt = $getFromT->replyShow($tweetID, $parent_id);
// $count = $resultt->rowCount();
 if($parent_id == 0)
 {
  $marginleft = 0;
 }
 else
 {
  $marginleft = $marginleft + 10;
 }

  foreach($resultt as $row)
  {
   $output .= '
     <div class="mainCommen" style="margin-left:'.$marginleft.'px">
                <div class="user-comment">
                <div class="user"><img src="'.$row->profileImage.'"/></div>
                  </div>
                  
                <div class="comments"><strong class="username">'.$row->username.'</strong>'.$row->comment.'</div>
                </div>
    
    <button type="button" class="reply"   id="'.$row->commentID.'">Reply</button></div>
   </div>
   ';
   $output .= get_reply_comment($row->commentID, $marginleft);
  }

 return $output;
}
} else {
    echo 'Not found';
}
//if(isset($_POST['comment']) && !empty($_POST['comment'])){
//	$comment = $getFromU->checkInput($_POST['comment']);
//	
//	$tweetID = $_POST['tweet_id'];
//    
//    if(!empty($comment)){ 
//    
//    $getFromU->create('comments', array('comment' => $comment, 'commentOn'=> $tweetID, 'commentBy' => $user_id, 'commentAt' => date('Y-m-d H:i:s')));
//		$comments = $getFromT->comments($tweetID);
//		$tweet = $getFromT->getPopupTweet($tweetID);
//        foreach ($comments as $comment){
//            echo '
//               <div class="mainCommen">
//                <div class="user-comment">
//                <div class="user"><img src="'.$comment->profileImage.'"/></div>
//                  </div>
//                  
//                <div class="comments"><strong class="username">'.$comment->username.'</strong>'.$comment->comment.'</div>
//                </div>
//              
//           ';
//            
//        }
//    
//    
//    
//    }
//}   

?>