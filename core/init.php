<?php
include 'database/connection.php';
// include 'database/DB.php';
include 'classes/user.php';
include 'classes/tweet.php';
include 'classes/follow.php';
include 'classes/message.php';
include 'classes/page.php';
///
include 'classes/post.php';

global $pdo;

session_start();

$getFromU = new User($pdo);
$getFromT = new Tweet($pdo);
$getFromF = new Follow($pdo);
$getFromM = new message($pdo);
$getFromP = new Page($pdo);
//
$getFromPo = new Post($pdo);


define("BASE_URL", "http://localhost/socialbd/");
?>
