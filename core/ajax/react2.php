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
if(isset($_POST['unHappyReact']) && !empty($_POST['unHappyReact'])){
    $react_type = $_POST['unHappyReact'];
    $user_id = login::isLoggedIn();
    $tweet_id = $_POST['smileId'];
    $get_id = $_POST['user_id'];
    $getFromT->unReact($user_id, $tweet_id, $get_id, $react_type);
    
}
  ?>