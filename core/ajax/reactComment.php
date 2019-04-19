<?php
include '../init.php';
    include '../../class/login.php';
    $user_id = login::isLoggedIn();

if(isset($_POST['commentIDD']) && !empty($_POST['commentIDD'])){
    $comment_id = $_POST['commentIDD'];
    $react_type = $_POST['happyReactt'];
    $user_id = login::isLoggedIn();
    $tweet_id = $_POST['smileIdD'];
    $get_id = $_POST['user_idD'];
    $getFromT->commentUnReactExist($user_id, $tweet_id, $get_id, $comment_id);
  $reactExist=$getFromT->CommentReactExistingCheck( $tweet_id, $user_id, $comment_id); 
    $rex = COUNT($reactExist);
  $smileI=$getFromT->smileCountCheck( $tweet_id, $user_id, $react_type); 
$sl = COUNT($reactExist); 
   
// if($rex >0 ){
     
      if($sl < 1 ){ 


    $getFromT->addCommentReact($user_id, $tweet_id, $get_id,$react_type,$comment_id);
// }
     

     } 
}

if(isset($_POST['replyIdD']) && !empty($_POST['replyIdD'])){
    $replyIdD = $_POST['replyIdD'];
    $comment_id = $_POST['rcommentIDD'];
    $react_type = $_POST['rhappyReactt'];
    $user_id = login::isLoggedIn();
    $tweet_id = $_POST['rsmileIdD'];
    $get_id = $_POST['ruser_idD'];
    $getFromT->reactUnReactExist($user_id, $tweet_id, $get_id, $comment_id, $replyIdD);
  $reactExis=$getFromT->replyReactExistingCheck( $tweet_id, $user_id, $comment_id, $replyIdD); 
    $rex = COUNT($reactExis);
//  $smileI=$getFromT->smileCountCheck( $tweet_id, $user_id, $react_type); 
$sl = COUNT($reactExist); 
   
// if($rex >0 ){
     
      if($sl < 1 ){ 


    $getFromT->addReplyReact($user_id, $tweet_id, $get_id,$react_type,$comment_id, $replyIdD);
// }
     

     } 
}

//if(isset($_POST['commentIDD']) && !empty($_POST['commentIDD'])){
//    $comment_id = $_POST['commentIDD'];
//    $react_type = $_POST['happyReactt'];
//    $user_id = login::isLoggedIn();
//    $tweet_id = $_POST['smileIdD'];
//    $get_id = $_POST['user_idD'];
//    $getFromT->commentUnReactExist($user_id, $tweet_id, $get_id, $comment_id);
//  $reactExist=$getFromT->CommentReactExistingCheck( $tweet_id, $user_id, $comment_id); 
//    $rex = COUNT($reactExist);
//  $smileI=$getFromT->smileCountCheck( $tweet_id, $user_id, $react_type); 
//$sl = COUNT($reactExist); 
//   
//// if($rex >0 ){
//     
//      if($sl < 1 ){ 
//
//
//    $getFromT->addCommentReact($user_id, $tweet_id, $get_id,$react_type,$comment_id);
//// }
//     
//
//     } 
//}

if(isset($_POST['unComment_id']) && !empty($_POST['unComment_id'])){
    $comment_id = $_POST['unComment_id'];
    $react_type = $_POST['unHappyReact'];
    $user_id = login::isLoggedIn();
    $tweet_id = $_POST['smileId'];
    $get_id = $_POST['user_id'];
    $getFromT->commentUnReact($user_id, $tweet_id, $get_id, $react_type,$comment_id);
    
}
if(isset($_POST['unReplyIdD']) && !empty($_POST['unReplyIdD'])){
    $unReplyIdD = $_POST['unReplyIdD'];
    $comment_id = $_POST['runComment_id'];
    $react_type = $_POST['runHappyReact'];
    $user_id = login::isLoggedIn();
    $tweet_id = $_POST['rsmileId'];
    $get_id = $_POST['ruser_id'];
    $getFromT->commentUnReact($user_id, $tweet_id, $get_id, $react_type,$comment_id, $unReplyIdD);
    
}



?>