<?php
include '../init.php';
    include '../../class/login.php';
    $user_id = login::isLoggedIn();
echo '<div class="proPicWrap">';
if(isset($_POST['profileId'])){
    $profileID = $_POST['profileId'];
    $allPhoto = $getFromU->allPhoto($profileID);
    foreach ( $allPhoto as $proPic){ ?>
      <?php if($proPic->tweetImage == '') {?><?php }else{?> <div class="proPicAll" data-tweet="<?php echo $proPic->tweetID; ?>">
        <img src="<?php echo BASE_URL.$proPic->tweetImage; ?>"  class="allProPic" alt="" target="_blank" data-tweet="<?php echo $proPic->tweetID; ?>"></div>
        <div class="popupTweet"></div> <?php } ?>
       
        
        <?php
    }
} echo '</div>';



?>