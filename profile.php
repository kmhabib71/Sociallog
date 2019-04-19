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
        $getFromU->create('tweets', array('tweetBy' => $user_id, 'tweetImage' => $fileRoot, 'postedOn' => date('Y-m-d H:i:s')));
//		header('Location:'.$user->username);
//        header("Refresh:0");
	}
}
	if(isset($_FILES['profileCover'])){
		//nicher line a name = filer naam and [0] error message.
	if(!empty($_FILES['profileCover']['name'][0])){
		$fileRoot = $getFromU->uploadImage($_FILES['profileCover']);
		$getFromU->update('users', $user_id, array('profileCover' => $fileRoot));
        $getFromU->create('tweets', array('tweetBy' => $user_id, 'tweetImage' => $fileRoot, 'postedOn' => date('Y-m-d H:i:s')));
//		header('Location:'.$user->username);

	}
};
        
      $rand=rand();
      $rando=rand();
   $_SESSION['rand']=$rand;
   $_SESSION['rando']=$rando;
        $ImageId = $_SESSION['rand'];         
        $ImageIdo = $_SESSION['rando'];
//        echo ''.$ImageId+$ImageIdo.'<br>' ;
//        echo $ImageIdo;
        

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
            <?php
         $allPhoto = $getFromU->allPhoto($profileId);
            foreach ($allPhoto as $allPhot ){?>
<!--                <a href="<?php echo BASE_URL.$allPhot->tweetImage; ?>"><img src="<?php echo BASE_URL.$allPhot->tweetImage; ?>"  class="allProPic" alt="" target="_blank"></a>-->
                <?php
            }
            
                $profileImageID = $profileData->profileImage;
                    $coverImageID = $profileData->profileCover;
                    
                    $pImageId=$getFromT->getPopupTwee($profileImageID); 
                    $CImageId=$getFromT->getPopupTwee($coverImageID);
//                    echo $pImageId->tweetID;
            $totalPost = $getFromU->totalPost($profileId);
//            echo $totalPost->totalPost;
//            $totalPos = COUNT($totalPost);
            ?>
            <div class="img_cont">
                <div class="cover_img" data-tweet="<?php echo $CImageId->tweetID;  ?>">
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
                    <?php }
                    
                
                    
//                    $tweet = $getFromT->getPopupTwee($user_id);
//                    if($user->profileImage == $tweet['tweetImage'] ) {
//                        echo 'hello';
//                        
//                    }else{
//                        echo $tweet->tweetImage;
//                    }
                    ?>
                    <!--............edit pic..............-->
                    <div class="profile_cover">
                        <div class="img_box" data-tweet= "<?php echo $pImageId->tweetID;  ?>">
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

            <!--//////////////prof cover pic/////////////-->

            <!--
        <div class="cover-photo">
        
            <div class="conver-photo-container">
                <div class="cover-photo-holder">

                    <div class="upload">

                        <div class="upload-box-cover">

                            <i class="fa fa-edit" aria-hidden="true" style="color:white;font-size:24px;margin:5px;box-shadow: 1px 1px 5px black;background-color:black"></i>
                        </div>
                        <div class="image-box  imagePopup" data-tweet="<?php  $tweet->tweetID;?>">
                            <img src="<?php echo BASE_URL.$user->profileCover; ?>" />
                        </div>
                    </div>



                </div>
            </div>
            <div class="profile-picture-holder">
                <div class="upload">

                    <div class="upload-box">

                        <i class="fa fa-edit" aria-hidden="true" style="color:white;font-size:24px;margin:5px;box-shadow: 1px 1px 5px black;background-color:black"></i>
                    </div>
                    <div class="image-box">
                        <img src="<?php echo BASE_URL.$user->profileImage; ?>" />
                    </div>
                </div>
            </div>


        </div>
-->

            <!--/////////////prof cover pic//////////////-->
            <div class="profile-bar">
                <div class="ProfileImageArea"></div>
                <a href="<?php echo ''.BASE_URL.''.$profileData->username.''; ?>"><div class="activitiess">Activities</div></a>
                <div class="activities"><?php if($user->gender == 'male'){ echo 'His ';}else if($user->gender == 'female'){echo 'Her ';}else{echo 'His ';}  ?>Society</div>
                <div class="About">About</div>
                <div class="profilePhoto" data-profile="<?php echo $profileId; ?>">Photos</div>
            </div>
            <?php
if(isset($_POST['post-status'])){
    $status = $getFromU->checkInput($_POST['textStatus']);
    $tweetImage = '';

    if(!empty($status) OR !empty($_FILES['files'])){
//      if(!empty($_FILES['files'])){
//          $tweetImage = $getFromU->multiImage($_FILES['files']);
            
//      }
        if(isset($_FILES["files"])){


$errors = array();
$uploadedFiles = array();
$extension = array("jpeg","jpg","png","gif","JPG","PNG");
$bytes = 1024;
$KB = 5024;
$totalBytes = $bytes * $KB;
$UploadFolder = "user";
 
$counter = 0;
 
foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name){
    $temp = $_FILES["files"]["tmp_name"][$key];
    $name = $_FILES["files"]["name"][$key];
     
    if(empty($temp))
    {
        break;
    }
     
    $counter++;
    $UploadOk = true;
     
    if($_FILES["files"]["size"][$key] > $totalBytes)
    {
        $UploadOk = false;
        array_push($errors, $name." file size is larger than the 1 MB.");
    }
     
    $ext = pathinfo($name, PATHINFO_EXTENSION);
    if(in_array($ext, $extension) == false){
        $UploadOk = false;
        array_push($errors, $name." is invalid file type.");
    }
     
//    if(file_exists($UploadFolder."/".$name) == true){
//        $UploadOk = false;
//        array_push($errors, $name." file is already exist.");
//    }
     
    if($UploadOk == true){
        if($counter>2){
    echo ' Maximum 3 photo can be uploaded. ';
    exit();

}else{
        move_uploaded_file($temp,$UploadFolder."/".$name);
        array_push($uploadedFiles, $name);
        $fileRoot = 'user/' . $name;
//         $getFromU->create('tweets', array('tweetBy' => $user_id, 'tweetImage' => $fileRoot, 'postedOn' => date('Y-m-d H:i:s')));
        $tweetImage =  $fileRoot;
        
        
        if(strlen($status) > 1040){
            $error = "The tweet text is too long";
            header('Location: '.BASE_URL.'home.php');
        }else{


        $tweet_id = $getFromU->create('tweets', array('status' => $status, 'tweetBy' => $user_id, 'tweetImage' => $tweetImage, 'imageID' => $ImageId, 'postedOn' => date('Y-m-d H:i:s')));
        preg_match_all("/#+([a-zA-Z0-9_]+)/i",$status, $hashtag);
            if(!empty($hashtag)){
                $getFromT->addTrend($status);
            }
//          preg_match_all("/#+([a-zA-Z0-9_]+)/i", $status, $hashtag); // if(!empty($hashtag)){ // $getFromT->addTrend($status); // } // $getFromT->addMention($status, $user_id, $tweet_id);

        }
    }
    }
}
 
if($counter>0){
    if(count($errors)>0)
    {
        echo "<b>Errors:</b>";
        echo "<br/><ul>";
        foreach($errors as $error)
        {
            echo "<li>".$error."</li>";
        }
        echo "</ul><br/>";
    }
     
    if(count($uploadedFiles)>0){
        echo "<b>Uploaded Files:</b>";
        echo "<br/><ul>";
        foreach($uploadedFiles as $fileName)
        {
            echo "<li>".$fileName."</li>";
        }
        echo "</ul><br/>";
         
        echo count($uploadedFiles)." file(s) are successfully uploaded.";
    }
//    return $fileRoot;
}
else{
    $tweet_id = $getFromU->create('tweets', array('status' => $status, 'tweetBy' => $user_id, 'postedOn' => date('Y-m-d H:i:s')));
        preg_match_all("/#+([a-zA-Z0-9_]+)/i",$status, $hashtag);
            if(!empty($hashtag)){
                $getFromT->addTrend($status);
            };
}
}
        
    
        
    } else {
        $error = "Type or choose image to tweet";
    }
} unset($_POST); ?>

            <div class="hide-profile">
                <div class="profile-container">


                    <div class="profile-info">


                        <div class="fan-info">
                            <div class="Attention">456 <br><strong>Attention</strong></div>
                            <div class="Fan">4500<br><strong>Fans</strong></div>
                            <div class="Post"><?php echo $totalPost->totalPost; ?><br><strong>Posts</strong></div>
                        </div>
                        <div class="about-summary">
                        <?php if($profileId === $user_id){ ?>
                            <h2 class="myBtn"><i class="fa fa-edit" aria-hidden="true" style="font-size:24px;margin:5px;"></i></h2>
                            <?php } ?>
                            <!-- Trigger/Open The Modal -->

                            <p></p>
                            <!-- The Modal -->
                            <div id="myModal" class="modal">
                                <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <div class="modal-content-details">

                                    </div>
                                    <!-- Modal content -->

                                </div>
                            </div>

                            <form action="">
                                <div class="intro"><?php echo $profileData->bio;  ?></div>
                                <div class="intro-input"><input type="text" class="about-editt" value="<?php ?>">

                                </div>
                                <div class="from"><i class="fa fa-map-marker" aria-hidden="true" style="color:black"></i> From <strong><?php echo''.$profileData->currentCity.', '.$profileData->country.''   ;  ?></strong></div>
                                <div class="gender"><i class="fa fa-mars-stroke" aria-hidden="true" style="color:black"></i> Gender<strong> <?php echo $profileData->gender; ?></strong></div>
                                <div class="relationship-status"><i class="fa  fa-heartbeat" aria-hidden="true" style="color:black"></i> Relationship Status<strong> <?php echo $profileData->relationShipStatus; ?></strong></div>
                            </form>

                        </div>





                        <div class="friends-info">

                        </div>
                    </div>

                    <div class="status">
                        <div class="status-hide">
                            <div class="status-border">
                                <div class="staus-box">
                                    <div class="status-area">
                                        <div class="user"><label class="drop-label" for="drop-wrap1"><div class="user-comment">
                <div class="user"><img src="<?php echo BASE_URL.$user->profileImage; ?>"/></div>
                  </div></label></div>
                                        <div class="type-status">
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="post-elaka">

                                                    <textarea data-autoresize rows="5" columns="5" placeholder="what's going in your mind?" name="textStatus" class="statuss"></textarea>
                                                    <div class="hash-box">
                                                        <ul>

                                                        </ul>
                                                    </div>
                                                    <br>
                                                    <div class="file-post">
<!--                                                        <input type="file" name="file" id="file" data-multiple-caption="{count} files selected" multiple/>-->
                                                       <form method="post" enctype="multipart/form-data" name="formUploadFile"> 
                                                        <input type="file" name="files[]" multiple="multiple" />
                                                        <input type="submit" name="post-status" class="post-button" value="post">
                                                        </form>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="post">


                            
                            <?php $getFromT->profileTweetss($profileId, $user_id) ?>


                            </div>
                            <div class="loading-div">
                                <img id="loader" src="assets/img/loading.svg" style="display: none;" />
                            </div>
                        </div>
                    </div>
                    <div class="popupTweet"></div>
                    <!--
<div class="trends">



</div>
-->
                </div>
            </div>
        </div>


        <!--        <footer id="pageFooter">Footer</footer>-->
        <!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
        <script>
            //        // When the user clicks on div, open the popup
            //        function myFunction() {
            //            var popup = document.getElementById("editt");
            //            popup.classList.toggle("showww");
            //        }
            // Get the modal
            var modal = document.getElementById('myModal');

            // Get the button that opens the modal
            var btn = document.getElementsByClassName("myBtn")[0];

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks the button, open the modal 
            btn.onclick = function() {
                modal.style.display = "block";
            }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

        </script>
        <!--For post option-->

        <script>
            //           var dropHide = document.getElementById('myRopdown');
            //      window.onclick = function(event) {
            //                    if (!event.target == dropHide) {
            //                        dropHide.style.display = "none";
            //                    }
            //                }

        </script>
        <!--For post option-->
        <script src="assets/js/jquery-3.1.1.js"></script>

        <link rel="stylesheet" type="text/css" href="assets/css/picedit.min.css" />
        <!--    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
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
        <script src="assets/js/react.js"></script>
                <script src="assets/js/message.js"></script>

<!--        <script src="assets/js/react2.js"></script>-->
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

        <!--
    <script>
$(function(){
       $(".main-status-text").shorten(); 

    });
        $(".main-status-text").shorten({
	moreText: 'read more'
});
        $(".main-status-text").shorten({
	showChars: 20,
});
</script>
-->
        <script>
            $(document).ready(function() {
                // Configure/customize these variables.
                var showChar = 200; // How many characters are shown by default
                var ellipsestext = "...";
                var moretext = "Show more >";
                var lesstext = "Show less";


                $('.main-status-text').each(function() {
                    var content = $(this).html();

                    if (content.length > showChar) {

                        var c = content.substr(0, showChar);
                        var h = content.substr(showChar, content.length - showChar);

                        var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

                        $(this).html(html);
                    }

                });

                $(".morelink").click(function() {
                    if ($(this).hasClass("less")) {
                        $(this).removeClass("less");
                        $(this).html(moretext);
                    } else {
                        $(this).addClass("less");
                        $(this).html(lesstext);
                    }
                    $(this).parent().prev().toggle();
                    $(this).prev().toggle();
                    return false;
                });
            });

        </script>


    </body>

    </html>
