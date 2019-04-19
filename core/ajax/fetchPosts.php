<?php
include '../init.php';
    include '../../class/login.php';
    $user_id = login::isLoggedIn();
if(isset($_POST['fetchPosts']) && !empty($_POST['fetchPosts'])){
    $user_id = login::isLoggedIn();
	$limit = (int) trim($_POST['fetchPosts']);
	$getFromT->tweetss($user_id, $limit);
}

?>
