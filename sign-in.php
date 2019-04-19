<?php
include 'class/login.php';
$showTimeline=False;
if(login::isLoggedIn()){
     $userid =login::isLoggedIn();
    
     $showTimeline=True;
    header('Location: home.php');
}
include 'core/init.php';
//include'class/DB.php';

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>



        <title>Socialbd</title>
<!--        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" />-->
        <!--    <i class="fa fa-linode" aria-hidden="true"></i>-->
<!--        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
        <!--      <i class="material-icons" style="font-size:60px;color:red;">cloud</i>-->
        <!--      <i class="material-icons">face</i>-->
        <link rel="stylesheet" href="assets/css/style.css">
    </head>

    <body>
        <div id="body-container">
            <div id="header-cover">
                <!--    menu-start-->
                <div id="header">
                    <div id="rightside">
                        <h3><a href="#">Socialbd</a></h3>
                        <!--
                    <nav id="nav">
                        <li>
                            <a href=""></a>Home</li>
                        <li>
                            <a href=""></a>Notification</li>
                        <li>
                            <a href=""></a>Messages</li>
                    </nav>
-->
                    </div>
                    <div id="leftside">
                        <?php include 'include/logins.php';  ?>



                    </div>
                </div>
                <!--       menu end-->
                <!--
            <div id="sign-in-cover">
               <form action="sign-in.php">
                   <input type="email" name="email" value="" placeholder="Enter your Email..." >
                   <input type="password" name="password" placeholder="Password..." >
                   <input type="submit" name="sign-in-submit">
               </form>
            </div>
-->



            </div>
            <div id="section-content">
                <div id="opening-display"><img src="assets/img/Legend%20Art%20(35).JPG" alt=""></div>
                <?php include 'include/creat-accounts.php'; ?>
            </div>
        </div>
    </body>

    </html>
