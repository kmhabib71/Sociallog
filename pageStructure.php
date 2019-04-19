<?php
// include 'core/init.php';
// echo $_SESSION['user_id'];
 
if(isset($_GET['userId']) === true && empty($_GET['userId']) === false){
include 'class/login.php'; include 'core/init.php';
$userID = $username = $getFromU->checkInput($_GET['userId']);
//    include 'class/login.php';
//include 'core/init.php';

$user_id = login::isLoggedIn();
//    echo $user_id;
 $showTimeline=False;
if(login::isLoggedIn()){
//     $userid =login::isLoggedIn();
//    echo $userid;
     $showTimeline=True;
} else {
	header('Location: index.php');
}   
$user = $getFromU->userData($userID);
$pageInfo = $getFromP->lastPageInfo($userID);
//echo $pageInfo->coverPhoto;
    
    
}




?>

    <!doctype html>
    <html lang="en">
    <title>SOCIALBD</title>
    <link rel="stylesheet" href="/socialbd/assets/css/fw/css/font-awesome.css">
    <!--    <i class="fa fa-linode" aria-hidden="true"></i>-->
    <!--    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
    <!--      <i class="material-icons" style="font-size:60px;color:red;">cloud</i>-->
    <!--      <i class="material-icons">face</i>-->
    <link rel="stylesheet" href="/socialbd/assets/css/home.css">
    <link rel="stylesheet" href="/socialbd/assets/css/page.css">
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
                    <li><a href="<?php BASE_URL ?>home.php">Home</a></li>
                    <li>Inside</li>
                    <li>Message</li>
                    <li>Notification</li>
                </ul>
                <div class="user-cover">
                    <div class="user user-click"><img src="<?php echo BASE_URL. $user->profileImage; ?>" alt="">
                        <div class="user-details">
                            <a href="<?php echo $user->username; ?>"><?php echo $user->username; ?></a>
                            <br/> Settings<br/> <a href="logout.php">logout</a>
                        </div>
                    </div>

                </div>

            </div>
        </header>
        <main class="pageCont">
            <div class="pageContainer">
                <div class="pageCoverPhoto">
                    <div class="pageCovPhHolder">

                        <img src="<?php echo  $pageInfo->coverPhoto;  ?>" alt="">
                    </div>
                </div>
                <div class="pageProfilePic">
                    <div class="pageProfileHolder">
                        <img src="<?php echo $pageInfo->profilePic;  ?>" alt="">
                    </div>
                </div>
                <div class="pageProfileBar">
                    <div>About</div>
                    <div>Action</div>
                </div>
                <div class="pageBody">

                </div>

            </div>
            <div class="pageMainBody">
                <div class="pageNavigation">bvb Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque, in. Quam, assumenda dolore voluptatem veritatis eos vel unde exercitationem dolores placeat atque porro qui nobis, soluta architecto explicabo tempora ipsum eaque obcaecati debitis veniam itaque facilis voluptatum vero. Repudiandae omnis ducimus accusamus excepturi, esse. Libero porro reiciendis dolores aspernatur laborum.</div>
                <div class="pagePost">gfg</div>
                <div class="pageRightPost">gfg</div>
            </div>

        </main>
    </body>

    </html>
