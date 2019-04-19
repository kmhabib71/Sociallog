<?php
include '../init.php';
    include '../../class/login.php';
    $user_id = login::isLoggedIn();
if(isset($_POST['retweet']) && !empty($_POST['retweet'])){
	$tweet_id = $_POST['retweet'];
	$get_id = $_POST['user_id'];
	$comment = $getFromU->checkInput($_POST['comment']);
	$getFromT->retweet($tweet_id, $user_id, $get_id, $comment);
}
if(isset($_POST['showPopup']) && !empty($_POST['showPopup'])){
	$tweet_id = $_POST['showPopup'];
	$get_id  = $_POST['user_id'];
	$tweet   = $getFromT->getPopupTweet($tweet_id);

	?>
<div class="wrap5">
        <div class="modalArea">
           
            <div class="share-it">
            <div class="upL"> <div class="modHeading"><h3>Share this post...</h3></div><div class="modIcon">  <i class="fa fa-times"></i></div> </div>
   
    <textarea data-autoresize rows="5" columns="5" placeholder="write something about the post..." name="textStatus" class="retweetMsg"></textarea>
    <div class="proImgName">
        <div class="proImg"><div class="user"><img src="<?php echo $tweet->profileImage; ?>"; alt=""></div></div>
        <div class="proName"><span class="username"><?php echo $tweet->username; ?></span><?php echo $tweet->postedOn; ?></div>
    </div>
    <div class="textImgStatus">
        <div class="main-status-text"><?php echo $getFromT->getTweetLinks($tweet->status); ?>...<span class="readMore">Read More</span>
        </div>
        <?php echo' '.((!empty($tweet->tweetImage)) ? '
        <div class="share-main-status-image">
            <img src="'.BASE_URL.$tweet->tweetImage.'">
        </div>' : '').'
        ' ?>
    </div>
    
    <div class="share-post">
        <button class="retweet-it">Share</button>
    </div>
</div>
        </div>
    </div>
    
	<?php } ?>
	
<!--
 <script src="../../assets/js/jquery-3.1.1.js"></script>
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
<!--
</body>
</html>
-->
