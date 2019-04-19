<?php
include '../init.php';
    include '../../class/login.php';
    $user_id = login::isLoggedIn();
//if(isset($_POST['showImage']) && !empty($_POST['showImage'])){
//	$tweet_id = $_POST['showImage'];
//	$user_id = $_SESSION['user_id'];
//	$tweet = $getFromT->getPopupTweet($tweet_id);
//	$likes = $getFromT->likes($user_id, $tweet_id);
//	$retweet = $getFromT->checkRetweet($tweet_id, $user_id);
	?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="../../assets/css/home.css">
        <link rel="stylesheet" href="../../assets/css/fw/css/font-awesome.css">
    </head>

    <body>


        <div class="popupImageWrapper">
            <div class="img-size">
                <img src="../../assets/img/me.jpg" />
            </div>
        </div>



    </body>

    </html>
