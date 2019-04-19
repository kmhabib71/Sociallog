<?php
// include 'core/init.php';
// echo $_SESSION['user_id'];

if(isset($_GET['username']) === true && empty($_GET['username']) === false){
    include 'class/login.php';
include 'core/init.php';
$username = $getFromU->checkInput($_GET['username']);
$profileId = $getFromU->userIdByUsername($username);
//    echo $profileId;
$profileData = $getFromU->userData($profileId);
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
$user = $getFromU->userData($user_id);
    	if(!$profileData){
		header('Location: index.php');
	}


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
                    <div class="user user-click"><img src="<?php echo $user->profileImage; ?>" alt="">
                        <div class="user-details">
                            <a href="<?php echo $user->username; ?>"><?php echo $user->username; ?></a>
                            <br/> Settings<br/> <a href="logout.php">logout</a>
                        </div>
                    </div>

                </div>

            </div>
        </header>

        <?php      
        
//	include 'core/init.php';
//include 'class/login.php';
	$user_id =login::isLoggedIn();
//echo $user_id;
//$user_id = $_SESSION['user_id'];
$user = $getFromU->userData($user_id);
//if(isset($_POST['screenName'])){
//if(!empty($_POST['screenName'])){
//	$screenName = $getFromU->checkInput($_POST['screenName']);
//	$profileBio = $getFromU->checkInput($_POST['bio']);
//	$country = $getFromU->checkInput($_POST['country']);
//	$website = $getFromU->checkInput($_POST['website']);
//	if(strlen($screenName) > 20 ){
//		$error = "Name must be between in 6-20 characters";
//	}else if (strlen($profileBio) > 120){
//		$error = "Description is too long";
//	} else if (strlen($country) > 80) {
//		$error = "Country name is too long";
//	} else{
//		$getFromU->update('users', $user_id, array('screenName' => $screenName, 'bio' =>$profileBio, 'country' => $country, 'website' => $website));
//		header('Location: '.$user->username);
//	}
//}else{
//	$error = "Name field can't be blank";
//}
//}
//image upload
if(isset($_FILES['profileImage'])){
	//nicher line a name = filer naam and [0] error message.
	if(!empty($_FILES['profileImage']['name'][0])){
		$fileRoot = $getFromU->uploadImage($_FILES['profileImage']);
		$getFromU->update('users', $user_id, array('profileImage' => $fileRoot));
//		header('Location:'.$user->username);
//        header("Refresh:0");
	}
}
	if(isset($_FILES['profileCover'])){
		//nicher line a name = filer naam and [0] error message.
	if(!empty($_FILES['profileCover']['name'][0])){
		$fileRoot = $getFromU->uploadImage($_FILES['profileCover']);
		$getFromU->update('users', $user_id, array('profileCover' => $fileRoot));
//		header('Location:'.$user->username);

	}
};
if(isset($_POST['post-status'])){
	$status = $getFromU->checkInput($_POST['textStatus']);
	$tweetImage = '';

	if(!empty($status) OR !empty($_FILES['file']['name'][0])){
		if(!empty($_FILES['file']['name'][0])){
			$tweetImage = $getFromU->uploadImage($_FILES['file']);
		}
		if(strlen($status) > 1040){
			$error = "The tweet text is too long";
			header('Location: '.BASE_URL.'home.php');
		}else{
		$tweet_id = $getFromU->create('tweets', array('status' => $status, 'tweetBy' => $user_id, 'tweetImage' => $tweetImage, 'postedOn' => date('Y-m-d H:i:s')));
		preg_match_all("/#+([a-zA-Z0-9_]+)/i",$status, $hashtag);
            if(!empty($hashtag)){
                $getFromT->addTrend($status);
            }
//			preg_match_all("/#+([a-zA-Z0-9_]+)/i", $status, $hashtag); // if(!empty($hashtag)){ // $getFromT->addTrend($status); // } // $getFromT->addMention($status, $user_id, $tweet_id);

		}
	} else {
		$error = "Type or choose image to tweet";
	}
}
?>

        <!--   profile photo upload-->
        <div class="upload-container">
            <div class="bd-container">
                <div class="upload-bg-container"></div>
                <form method="post" enctype="multipart/form-data">
                    <ul>
                        <li>
                            <div class="upload-bg">
                                <label for="profileImage">
									Upload photo
								</label><br>
                                <input id="profileImage" type="file" name="profileImage" /><br>
                                <button type="submit" class="profile-submit">DONE</button>
                                <button class="cclose">Close</button>
                            </div>

                        </li>
                    </ul>
                </form>
            </div>
        </div>

        <!--    Cover photo upload-->
        <div class="upload-container-cover">
            <div class="bd-container">
                <div class="upload-bg-container"></div>
                <form method="post" enctype="multipart/form-data">
                    <ul>
                        <li>
                            <div class="upload-bg">
                                <label for="profileCover">
									Upload photo
								</label><br>
                                <input id="profileCover" type="file" name="profileCover" /><br>
                                <button type="submit" class="profile-submit">DONE</button>
                                <button class="cclose">Close</button>
                            </div>

                        </li>
                    </ul>
                </form>
            </div>
        </div>
        <!--main body container-->
        <div class="container-body">
            <!--..........prof cover pic.........-->
            <div class="img_cont">
                <div class="cover_img">
                    <img src="<?php echo BASE_URL.$profileData->profileCover; ?>" alt="">
                </div>

                <div class="cover-container">
                    <!--............edit pic..............-->
                    <?php  if($profileId == $user_id) { ?>
                    <div class="edit_pic"><i class="fa fa-pencil"></i>
                        <div class="edit_upload_pic">
                            <div class="upload-box-cover change_cover">Change Cover Photo</div>
                            <hr>
                            <div class="upload-box">Change Profile Photo</div>

                        </div>
                    </div>
                    <?php } ?>
                    <!--............edit pic..............-->
                    <div class="profile_cover">
                        <div class="img_box">
                            <img src="<?php echo BASE_URL.$profileData->profileImage; ?>" alt="">
                            <div class="gender_icon" title="Male">
                                <i class="fa fa-mars"></i>
                            </div>
                        </div>
                        <div class="profile_username">
                            <?php echo $profileData->username; ?>
                        </div>
                        <div class="job_hints">
                            PHP System Analyzer, RONO
                        </div>
                        <div class="action">
                            <?php echo $getFromF->requestBtn($profileId, $user_id, $profileData->user_id); ?>
                            <?php if($profileId != $user_id){ ?>
                            <div class="Letter"> Private Letter</div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profile-bar">
                <div class="ProfileImageArea"></div>
                <div class="activities">Activities</div>
                <div class="About">About</div>
                <div class="Photo">Photos</div>
            </div>
            <div class="society_member">
                <div class="memberByHim">
                    <?php $getFromF->memberListByhim($profileId, $user_id, $profileData->user_id); ?>
                </div>Member By Other->
                <div class="memberByOther">
                    <?php $getFromF->memberListByOthers($profileId, $user_id, $profileData->user_id); ?>
                </div>
            </div>







        </div>

        <!--For post option-->
        <script src="assets/js/jquery-3.1.1.js"></script>

        <link rel="stylesheet" type="text/css" href="assets/css/picedit.min.css" />

        <script type="text/javascript" src="assets/js/picedit.min.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="assets/js/about.js"></script>
        <script src="assets/js/search.js"></script>
        <script src="assets/js/hashtag.js"></script>
        <script src="assets/js/like.js"></script>
        <script src="assets/js/retweet.js"></script>
        <!--    <script src="assets/js/comment.js"></script>-->
        <script src="assets/js/com.js"></script>
        <script src="assets/js/postOption.js"></script>
        <script src="assets/js/delete.js"></script>
        <script src="assets/js/popupImage.js"></script>
        <script src="assets/js/reply.js"></script>
        <script src="assets/js/replyComplex.js"></script>
        <script src="assets/js/member.js"></script>
        <!--    <script src="assets/js/jquery.shorten.js"></script>-->

        <script>
            jQuery.each(jQuery('textarea[data-autoresize]'), function() {
                var offset = this.offsetHeight - this.clientHeight;

                var resizeTextarea = function(el) {
                    jQuery(el).css('height', 'auto').css('height', el.scrollHeight + offset);
                };
                jQuery(this).on('keyup input', function() {
                    resizeTextarea(this);
                }).removeAttr('data-autoresize');
            });

        </script>
        <script>
            $(function() {
                $('#profileImage').picEdit();
            });
            $(function() {
                $('#profileCover').picEdit();
            });

        </script>




    </body>

    </html>
