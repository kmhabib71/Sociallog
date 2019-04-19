<?php
// include 'core/init.php';
// echo $_SESSION['user_id'];
include 'class/login.php';
$showTimeline=False;
if(login::isLoggedIn()){
     $userid =login::isLoggedIn();
//    echo $userid;
     $showTimeline=True;
} else {
	header('Location: index.php');
}
if(isset($_GET['username']) === true && empty($_GET['username']) === false ){
include 'core/init.php';
$username = $getFromU->checkInput($_GET['username']);
$profileId = $getFromU->userIdByUsername($username);
$profileData = $getFromU->userData($profileId);
$user_id = login::isLoggedIn();

$user = $getFromU->userData($user_id);
    

}
?>

    <!doctype html>
    <html lang="en">
    <title>SOCIALBD</title>
    <link rel="stylesheet" href="assets/css/fw/css/font-awesome.css">
    <!--    <i class="fa fa-linode" aria-hidden="true"></i>-->
    <!--    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
    <!--      <i class="material-icons" style="font-size:60px;color:red;">cloud</i>-->
    <!--      <i class="material-icons">face</i>-->
    <link rel="stylesheet" href="assets/css/home.css">
    <!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />-->

    <style>


    </style>

    <body>

        <header id="pageHeader">

            <div id="brand-search">
                <div class="brand">
                    <h2>Socialbd</h2>
                </div>

                <div class="search">
                    <!--                    <img src="assets/img/searchicon.png" alt="">-->

                    <input class="searchh" type="text" placeholder="Search..." />

                    <div class="search-result">



                    </div>

                </div>



            </div>
            <div class="rightside">
                <div class="menu"></div>
                <ul>
                     <li><a href="<?php BASE_URL  ?>home.php">Home</a></li>
                    <li>Inside</li>
                    <li>Message</li>
                    <li>Notification</li>
                </ul>
                <div class="user-cover">
                    <div class="user user-click"><img src="<?php echo $user->profileImage; ?>" alt="" > <div class="user-details">
                        <a href="<?php echo $user->username; ?>"><?php echo $user->username; ?></a>
                        <br/> Settings<br/> <a href="logout.php">logout</a>
                    </div></div>
                   
                </div>

            </div>
        </header>
