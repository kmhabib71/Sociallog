

<!--    <p>Hello world</p>-->
<?php  
include '../init.php';
if(isset($_POST['deleteTweet']) && !empty($_POST['deleteTweet'])){
	$tweet_id = $_POST['deleteTweet'];
	$user_id = $_SESSION['user_id'];
	$getFromT->delete('tweets', array('tweetID' => $tweet_id, 'tweetBy' => $user_id ));
}
if(isset($_POST['showPopup']) && !empty($_POST['showPopup'])){
	$tweet_id = $_POST['showPopup'];
	$user_id = $_SESSION['user_id'];
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
            <button class="deletePost">Delete Post</button>
            <button class="deleteCancel">Cancel</button>
            
        </div>
    </div>
    </div>
      <div class="retweet-popup-footer"> 
        <div class="retweet-popup-footer-right">
          <button class="cancel-it f-btn">Cancel</button><button class="delete-it" type="submit">Delete</button>
        </div>
      </div>
    </div>
  </div>
</div>

	<?php
}