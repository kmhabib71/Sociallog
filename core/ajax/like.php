<?php
include '../init.php';
    include '../../class/login.php';
    $user_id = login::isLoggedIn();
//$tweet_id = 7; //$likeIdnt=$getFromT->likeCheck( $tweet_id, $user_id); //$lk = COUNT($likeIdnt); // //if($lk
//< 1 ){ // $getFromT->addLike($user_id, $tweet_id, $get_id); //}
//$tweet_id = 7; 
//$commentID = 2; 
// $likeIdntt=$getFromT->commentLikeCheck( $tweet_id, $user_id, $commentID); 
//$clk = COUNT($likeIdntt); 
// 
//if($clk < 1 ){ 
// echo 'found'; 
//}else { // echo 'not found'; //}
if(isset($_POST['like']) && !empty($_POST['like'])){
    $user_id = login::isLoggedIn();
    $tweet_id = $_POST['like'];
    $get_id = $_POST['user_id'];
 $likeIdnt=$getFromT->likeCheck( $tweet_id, $user_id);
$lk = COUNT($likeIdnt);

if($lk < 1 ){
    $getFromT->addLike($user_id, $tweet_id, $get_id);
}
}
if(isset($_POST['commentLike']) && !empty($_POST['commentLike'])){
    $user_id = login::isLoggedIn();
    $tweet_id = $_POST['commentLike'];
    $comment_id = $_POST['commentID'];
    $get_id = $_POST['user_id'];
    
     $likeIdntt=$getFromT->commentLikeCheck( $tweet_id, $user_id, $comment_id);
$clk = COUNT($likeIdntt);

if($clk < 1 ){
    $getFromT->addCommentLike($user_id, $tweet_id,$comment_id, $get_id);
}  
}
if(isset($_POST['unlike']) && !empty($_POST['unlike'])){
    $user_id = login::isLoggedIn();
    $tweet_id = $_POST['unlike'];
    $get_id = $_POST['user_id'];
    $getFromT->unlike($user_id, $tweet_id, $get_id);
    
}
if(isset($_POST['commentUnlike']) && !empty($_POST['commentUnlike'])){
    $user_id = login::isLoggedIn();
    $tweet_id = $_POST['commentUnlike'];
    $comment_id = $_POST['commentID'];
    $get_id = $_POST['user_id'];
    $getFromT->commentUnLike($user_id, $tweet_id,$comment_id, $get_id);
    
}
if(isset($_POST['replyLike']) && !empty($_POST['replyLike'])){
    $user_id = login::isLoggedIn();
    $tweet_id = $_POST['replyLike'];
    $comment_id = $_POST['replyID'];
    $replyed_id = $_POST['replyedID'];
    $get_id = $_POST['user_id'];
    
     $replyIdntt=$getFromT->replyLikeCheck( $tweet_id, $user_id, $comment_id, $replyed_id);
$rlk = COUNT($replyIdntt);

if($rlk < 1 ){
    $getFromT->addReplyLike($user_id, $tweet_id,$comment_id, $get_id, $replyed_id);
}  
}
if(isset($_POST['replyUnLike']) && !empty($_POST['replyUnLike'])){
    $user_id = login::isLoggedIn();
    $tweet_id = $_POST['replyUnLike'];
    $comment_id = $_POST['replyID'];
    $replyed_id = $_POST['replyedID'];
    $get_id = $_POST['user_id'];
    $getFromT->replyUnLike($user_id, $tweet_id,$comment_id, $get_id, $replyed_id);
    
}



?>
