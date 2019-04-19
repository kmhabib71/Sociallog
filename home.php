<?php
 include 'core/init.php';

// echo $_SESSION['user_id'];
//include 'class/login.php';

//$showTimeline=False;
//if(login::isLoggedIn()){
//     $userid =login::isLoggedIn();
//    
//     $showTimeline=True;
//} else {
//	header('Location: index.php');
//}

// include 'core/init.php';
// echo $_SESSION['user_id'];
include 'class/login.php';
$showTimeline=False;
if(login::isLoggedIn()){
     $userid =login::isLoggedIn();
    
     $showTimeline=True;
} else {
	header('Location: index.php');
}
$user_id =login::isLoggedIn();
//echo $user_id;
if(isset($_GET['username']) === true && empty($_GET['username']) === false ){
include 'core/init.php';
$username = $getFromU->checkInput($_GET['username']);
$profileId = $getFromU->userIdByUsername($username);
$profileData = $getFromU->userData($profileId);
$user_id = login::isLoggedIn();
$user = $getFromU->userData($user_id);

}
$user = $getFromU->userData($user_id);
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

    <!doctype html>
    <html lang="en">
    <title>Socialbd</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" />
    <link rel="stylesheet" href="assets/css/fw/css/font-awesome.css">
    <!--    <i class="fa fa-linode" aria-hidden="true"></i>-->
    <!--    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
    <!--      <i class="material-icons" style="font-size:60px;color:red;">cloud</i>-->
    <!--      <i class="material-icons">face</i>-->
    <link rel="stylesheet" href="assets/css/home.css">
    <!--        <link rel="stylesheet" href="assets/css/style-complete.css">-->
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
                    <li id="messagePopup">Message</li>
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

        <div class="container">
            <div class="apps">
                <div class="app">
                    <ul>
                        <li>Wall</li>
                        <li>Messages</li>
                        <li><a href="pages/page">Pages</a></li>
                        <li>Groups</li>
                        <li>Event</li>
                        <li>Blood Donation</li>
                        <li>Dreamer Meet</li>
                        <li>Entrepreniur Meet</li>
                        <li>Study center</li>
                    </ul>
                </div>
                <div class="tagg">
                    <?php $getFromT->trends(); ?>

                </div>
                <div class="advv"></div>
            </div>

            <div class="status">
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
                                            <input type="file" name="file" id="file" data-multiple-caption="{count} files selected" multiple/>
                                            <input type="submit" name="post-status" class="post-button" value="post">
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--                <div class="status">-->
                <div class="status-hide">
                    <div class="post">


                        <?php $getFromT->homeTweetss($user_id); ?>


                    </div>
                    <div class="loading-div">
                        <img id="loader" src="assets/img/loading.svg" style="display: none;" />
                    </div>
                </div>
                <!--                </div>-->
                <div class="popupTweet"></div>


            </div>
            <div class="trends">
                <div class="app">
                    <ul>
                        <li>Wall</li>
                        <li>Messages</li>
                        <li>Pages</li>
                        <li>Groups</li>
                        <li>Event</li>
                        <li>Blood Donation</li>
                        <li>Dreamer Meet</li>
                        <li>Entrepreniur Meet</li>
                        <li>Study center</li>
                    </ul>
                </div>
                <div class="tagg">
                    <ul>
                        <li>
                            <div class="user"></div>Raihan</li>
                        <li>
                            <div class="user"></div>Kabir</li>
                        <li>
                            <div class="user"></div>Fharna</li>
                        <li>
                            <div class="user"></div>Shareef</li>
                        <li>
                            <div class="user"></div>Babor</li>
                        <li>
                            <div class="user"></div>Khann</li>
                        <li>
                            <div class="user"></div>mannat</li>
                        <li>
                            <div class="user"></div>Fahat</li>

                    </ul>
                </div>
                <div class="advv">trends</div>
            </div>

        </div>
        <!--        <footer id="pageFooter">Footer</footer>-->
        <!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
        <!--
        <script src="assets/js/jquery-3.1.1.js"></script>
        <script src="assets/js/main.js"></script>
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
-->
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
        <!--        <script src="assets/js/message.js"></script>-->
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
