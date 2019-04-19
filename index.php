<?php

// include 'core/database/DB.php';

include 'class/login.php';
$showTimeline=False;
if(login::isLoggedIn()){
     $userid =login::isLoggedIn();
    
     $showTimeline=True;
     header('location: home.php');
} else {
    header('location: sign-in.php');
 }

?>




