<?php  
include 'core/init.php';

    include 'class/login.php';
    $user_id = login::isLoggedIn();
if(isset($_GET['hashtag']) && !empty($_GET['hashtag'])){
	$hashtag = $getFromU->checkInput($_GET['hashtag']);
    $user_id = login::isLoggedIn();
	$user = $getFromU->userData($user_id);
	$tweets = $getFromT->getTweetsByHash($hashtag);
	$accounts = $getFromT->getUsersByHash($hashtag);
} else {
	header('Location: '.BASE_URL.' index.php');
}

?>
<!doctype html>
<html>

<head>
    <title>
        <?php echo '#'.$hashtag . ' hashtag on tweety';?>
    </title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style-complete.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" />
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <!-- <script src="assets/js/jquery.js"></script>  -->

</head>
<!--Helvetica Neue-->

<body>
    <div class="wrapper">
        <!-- header wrapper -->
        <div class="header-wrapper">
            <div class="nav-container">
                <div class="nav">
                    <div class="nav-left">
                        <ul>
                            <li><a href="<?php echo BASE_URL; ?>home.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li>
                            <?php  if($getFromU->loggedIn() === true){; ?>
                            <li><a href="<?php echo BASE_URL; ?>i/notifications"><i class="fa fa-bell" aria-hidden="true"></i>Notification</a></li>
                            <li><i class="fa fa-envelope" aria-hidden="true"></i>Messages</li>
                            <?php  }  ?>

                        </ul>
                    </div>
                    <!-- nav left ends-->
                    <div class="nav-right">
                        <ul>
                            <li><input type="text" placeholder="Search" class="search" /><i class="fa fa-search" aria-hidden="true"></i>
                                <div class="search-result">
                                </div>
                            </li>
                            <?php  if($getFromU->loggedIn() === true){; ?>
                            <li class="hover"><label class="drop-label" for="drop-wrap1"><img src="<?php echo BASE_URL.$user->profileImage; ?>"/></label>
                                <input type="checkbox" id="drop-wrap1">
                                <div class="drop-wrap">
                                    <div class="drop-inner">
                                        <ul>
                                            <li><a href="<?php echo BASE_URL.$user->username; ?>"><?php echo $user->username; ?></a></li>
                                            <li><a href="<?php echo BASE_URL; ?>settings/account">Settings</a></li>
                                            <li><a href="<?php echo BASE_URL; ?>includes/logout.php">Log out</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li><label for="pop-up-tweet" class="addTweetBtn">Tweet</label></li>
                            <?php }else{
					echo '<li><a href="'.BASE_URL.'index.php">Have an account? Log in!</a>   </li>';
				} ?>
                        </ul>
                    </div>
                    <!-- nav right ends-->

                </div>
                <!-- nav ends -->
            </div>
            <!-- nav container ends -->
        </div>
        <!-- header wrapper end -->

        <!--#hash-header-->
        <div class="hash-header">
            <div class="hash-inner">
                <h1>#
                    <?php echo $hashtag; ?>
                </h1>
            </div>
        </div>
        <!--#hash-header end-->

        <!--hash-menu-->
        <div class="hash-menu">
            <div class="hash-menu-inner">
                <ul>
                    <li><a href="<?php echo BASE_URL.'hashtag/'.$hashtag;?>">Latest</a></li>
                    <li><a href="<?php echo BASE_URL.'hashtag/'.$hashtag.'?f=users'; ?>">Accounts</a></li>
                    <li><a href="<?php echo BASE_URL.'hashtag/'.$hashtag.'?f=photos'; ?>">Photos</a></li>
                </ul>
            </div>
        </div>
        <!--hash-menu-->
        <!---Inner wrapper-->

        <div class="in-wrapper">
            <div class="in-full-wrap">

                <div class="in-left">
                    <div class="in-left-wrap">

                        <!-- Who TO Follow -->
                        <?php $getFromF->whoToFollow($user_id, $user_id );  ?>
                        <!--TRENDS-->
                        <?php $getFromT->trends();  ?>

                    </div>
                    <!-- in left wrap-->
                </div>
                <!-- in left end-->
                <?php if(strpos($_SERVER['REQUEST_URI'], '?f=photos'))  :?>
                <!-- TWEETS IMAGES  -->
                <div class="hash-img-wrapper">
                    <div class="hash-img-inner">
                        <?php  
 		foreach ($tweets as $tweet){
 			$likes = $getFromT->likes($user_id, $tweet->tweetID);
			$retweet = $getFromT->checkRetweet($tweet->tweetID, $user_id);
			$user = $getFromU->userData($tweet->retweetBy);
 			if(!empty($tweet->tweetImage)){
 				echo '<div class="hash-img-flex">
		 	<img src="'.BASE_URL.$tweet->tweetImage.'" class="imagePopup" data-tweet="'.$tweet->tweetID.'"/>
		 	<div class="hash-img-flex-footer">
		 		<ul>
		 			'.(($getFromU->loggedIn() === true) ? '
				<li><button><a href="#"><i class="fa fa-share" aria-hidden="true"></i></a></button></li>	
				<li>'.(($tweet->tweetID === $retweet['retweetID'] OR $user_id == $retweet['retweetBy']) ? '<button class="retweeted" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount"></span>'.$tweet->retweetCount.'</button>' : '<button class="retweet" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount"></span>'.(($tweet->retweetCount > 0) ? $tweet->retweetCount : '').'</button>' ).'</li>
				<li>'.(($likes['likeOn'] === $tweet->tweetID) ? '<button class="unlike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a><span class="likesCounter">'.$tweet->likesCount.'</span></button>' : '<button class="like-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a><span class="likesCounter"></span>'.(($tweet->likesCount > 0) ? $tweet->likesCount : '').'</button>' ).'</li>
				'.(($tweet->tweetBy === $user_id) ? '
					<li>
					<a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
					<ul> 
					  <li><label class="deleteTweet" data-tweet="'.$tweet->tweetID.'">Delete Tweet</label></li>
					</ul>
				</li> ' : '').'
				' : '<li><button><a href="#"><i class="fa fa-share" aria-hidden="true"></i></a></button></li>
				<li><button><a href="#"><i class="fa fa-retweet" aria-hidden="true"></i></a></button></li>
				<li><button><a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a></button></li>').'
		 		</ul>
		 	</div>
		</div>';
 			}
 		}

 		?>

                    </div>
                </div>
                <!-- TWEETS IMAGES -->
                <?php  elseif(strpos($_SERVER['REQUEST_URI'], '?f=users')) :?>

                <!--TWEETS ACCOUTS-->
                <div class="wrapper-following">
                    <div class="wrap-follow-inner">
                        <?php  foreach ($accounts AS $users) :?>
                        <div class="follow-unfollow-box">
                            <div class="follow-unfollow-inner">
                                <div class="follow-background">
                                    <img src="<?php echo BASE_URL.$users->profileCover;?>" />
                                </div>
                                <div class="follow-person-button-img">
                                    <div class="follow-person-img">
                                        <img src="<?php echo BASE_URL.$users->profileImage;?>" />
                                    </div>
                                    <div class="follow-person-button">
                                        <?php echo $getFromF->followBtn($users->user_id, $user_id, $user_id);?>
                                    </div>
                                </div>
                                <div class="follow-person-bio">
                                    <div class="follow-person-name">
                                        <a href="<?php echo BASE_URL.$users->username;?>"><?php echo $users->screenName;?></a>
                                    </div>
                                    <div class="follow-person-tname">
                                        <a href="<?php echo BASE_URL.$users->username;?>">@<?php echo BASE_URL.$users->username;?></a>
                                    </div>
                                    <div class="follow-person-dis">
                                        <?php echo $getFromT->getTweetLinks($users->bio);?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php  endforeach; ?>
                    </div>
                </div>
                <!-- TWEETS ACCOUNTS -->
                <?php else :?>
                <div class="in-center">
                    <div class="in-center-wrap">
                        <!-- TWEETS -->
                        <?php  
		foreach($tweets as $tweet){
			$likes = $getFromT->likes($user_id, $tweet->tweetID);
			$retweet = $getFromT->checkRetweet($tweet->tweetID, $user_id);
			$user = $getFromU->userData($tweet->retweetBy);
			echo '<div class="all-tweet">
<div class="t-show-wrap">	
 <div class="t-show-inner">
 '.(($retweet['retweetID'] === $tweet->retweetID OR $tweet->retweetID > 0) ? '

	<div class="t-show-banner">
		<div class="t-show-banner-inner">
			<span><i class="fa fa-retweet" aria-hidden="true"></i></span><span>'.$user->screenName.' Retweeted</span>
		</div>
	</div> ' 
	: '').'
	'.((!empty($tweet->retweetMsg) && $tweet->tweetID === $retweet['tweetID'] or $tweet->retweetID > 0) ? '
<div class="t-show-popup" data-tweet="'.$tweet->tweetID.'">
	<div class="t-show-head">
	<div class="t-show-img">
		<img src="'.BASE_URL.$user->profileImage.'"/>
	</div>
	<div class="t-s-head-content">
		<div class="t-h-c-name">
			<span><a href="'.BASE_URL.$user->username.'">'.$user->screenName.'</a></span>
			<span>@'.$user->username.'</span>
			<span>'.$getFromU->timeAgo($tweet->postedOn).'</span>
		</div>
		<div class="t-h-c-dis">
			'.$getFromT->getTweetLinks($tweet->retweetMsg).'
		</div>
	</div>
</div>
<div class="t-s-b-inner">
	<div class="t-s-b-inner-in">
	'.((!empty($tweet->tweetImage)) ? '
		<div class="retweet-t-s-b-inner">
			<div class="retweet-t-s-b-inner-left">
				<img src="'.BASE_URL.$tweet->tweetImage.'" class="imagePopup" data-tweet= "'.$tweet->tweetID.'"/>	
			</div>' : '').'
			<div >
				<div class="t-h-c-name">
					<span><a href="'.BASE_URL.$tweet->username.'">'.$tweet->screenName.'</a></span>
					<span>@'.$tweet->username.'</span>
					<span>'.$getFromU->timeAgo($tweet->postedOn).'</span>
				</div>
				<div class="retweet-t-s-b-inner-right-text">		
					'.$getFromT->getTweetLinks($tweet->status).'
				</div>
			</div>
		</div>
	</div>
</div>
</div>' : ' 
	<div class="t-show-popup" data-tweet="'.$tweet->tweetID.'">
		<div class="t-show-head">
			<div class="t-show-img">
				<img src="'.$tweet->profileImage.'"/>
			</div>
			<div class="t-s-head-content">
				<div class="t-h-c-name">
					<span><a href="'.$tweet->username.'">'.$tweet->screenName.'</a></span>
					<span>@'.$tweet->username.'</span>
					<span>'.$getFromU->timeAgo($tweet->postedOn).'</span>
				</div>
				<div class="t-h-c-dis">
					'.$getFromT->getTweetLinks($tweet->status).'
				</div>
			</div>
		</div>'.
		((!empty($tweet->tweetImage)) ? 
		'<!--tweet show head end-->
		<div class="t-show-body">
		  <div class="t-s-b-inner">
		   <div class="t-s-b-inner-in">
		     <img src="'.BASE_URL.$tweet->tweetImage.'" class="imagePopup" data-tweet= "'.$tweet->tweetID.'"/>
		   </div>
		  </div>
		</div>
		<!--tweet show body end-->
		' : ''). '
		
	 </div>').'
	<div class="t-show-footer">
		<div class="t-s-f-right">
			<ul> 
			'.(($getFromU->loggedIn() === true) ? '
				<li><button><a href="#"><i class="fa fa-share" aria-hidden="true"></i></a></button></li>	
				<li>'.(($tweet->tweetID === $retweet['retweetID'] OR $user_id == $retweet['retweetBy']) ? '<button class="retweeted" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount"></span>'.$tweet->retweetCount.'</button>' : '<button class="retweet" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount"></span>'.(($tweet->retweetCount > 0) ? $tweet->retweetCount : '').'</button>' ).'</li>
				<li>'.(($likes['likeOn'] === $tweet->tweetID) ? '<button class="unlike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a><span class="likesCounter">'.$tweet->likesCount.'</span></button>' : '<button class="like-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a><span class="likesCounter"></span>'.(($tweet->likesCount > 0) ? $tweet->likesCount : '').'</button>' ).'</li>
				'.(($tweet->tweetBy === $user_id) ? '
					<li>
					<a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
					<ul> 
					  <li><label class="deleteTweet" data-tweet="'.$tweet->tweetID.'">Delete Tweet</label></li>
					</ul>
				</li> ' : '').'
				' : '<li><button><a href="#"><i class="fa fa-share" aria-hidden="true"></i></a></button></li>
				<li><button><a href="#"><i class="fa fa-retweet" aria-hidden="true"></i></a></button></li>
				<li><button><a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a></button></li>').'
			</ul>
		</div>
	</div>
</div>
</div>
</div>';
		}
		?>
                    </div>
                </div>
                <?php endif; ?>

            </div>
            <!--in full wrap end-->
            <div class="popupTweet"></div>
            <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/like.js">


            </script>
            <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/retweet.js">


            </script>
            <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/popuptweets.js">


            </script>
            <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/delete.js">


            </script>
            <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/comment.js">


            </script>
            <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/popupForm.js">


            </script>
            <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/fetch.js">


            </script>
            <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/search.js">


            </script>
            <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/hashtag.js">


            </script>

            <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/messages.js">


            </script>
            <script type="text/javascript" src="assets/js/postMessage.js">


            </script>
            <script type="text/javascript" src="assets/js/notification.js">


            </script>
        </div>
        <!-- in center end -->

    </div>
    <!-- in wrappper ends-->

    </div>
    <!-- ends wrapper -->

</body>

</html>
