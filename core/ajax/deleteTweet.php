

<!--    <p>Hello world</p>-->
<?php  
include '../init.php';
    include '../../class/login.php';
    $user_id = login::isLoggedIn();


if(isset($_POST['deleteTweet']) && !empty($_POST['deleteTweet'])){
	$tweet_id = $_POST['deleteTweet'];
    $user_id = login::isLoggedIn();
//	$user_id = $_SESSION['user_id'];
	$getFromT->delete('tweets', array('tweetID' => $tweet_id, 'tweetBy' => $user_id));
    
}
if(isset($_POST['imageDeleteTweet']) && !empty($_POST['imageDeleteTweet'])){
	$tweet_id = $_POST['imageDeleteTweet'];
	$image_id = $_POST['imageId'];
    $user_id = login::isLoggedIn();
//	$user_id = $_SESSION['user_id'];
	$getFromT->delete('tweets', array('tweetBy' => $user_id, 'imageID' => $image_id));
    
}
if(isset($_POST['deleteTweet']) && !empty($_POST['deleteTweet'])){
	$tweet_id = $_POST['deleteTweet'];
    $user_id = login::isLoggedIn();
//	$user_id = $_SESSION['user_id'];
	$getFromT->delete('tweets', array('tweetID' => $tweet_id, 'retweetBy'=>$user_id, 'proPhoto' => '1'));
}
if(isset($_POST['showPopup']) && !empty($_POST['showPopup'])){
	$tweet_id = $_POST['showPopup'];
	$image_id = $_POST['image_id'];
//	$user_id = $_SESSION['user_id'];
	$tweet  = $getFromT->getPopupTweet($tweet_id);
	?>
	<div class="retweet-popup">
  <div class="wrap5">
   <button class="close-retweet-popup"><i class="fa fa-times" aria-hidden="true"></i></button>
    <div class="retweet-popup-body-wrap">
      
       <div class="delBack">
    <div class="delConfer">
        <div class="delHead">Do You want to delete the Post?</div>
        <div class="yesNo">
            <button class="delete-it" data-tweet="<?php echo $tweet_id; ?>" data-user="<?php echo $tweet->tweetBy; ?>" data-imageid="<?php if($image_id != '0'){ echo $image_id;} ?>">Delete Post</button>
            <button class="cancel-it">Cancel</button>
            
        </div>
    </div>
    </div>
<!--
      <div class="retweet-popup-footer"> 
        <div class="retweet-popup-footer-right">
          <button class="cancel-it f-btn">Cancel</button><button class="delete-it" type="submit">Delete</button>
        </div>
      </div>
-->
    </div>
  </div>
</div>

	<?php
}