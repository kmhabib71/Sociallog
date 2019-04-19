<?php
include '../init.php';
    include '../../class/login.php';
    $user_id = login::isLoggedIn();
$tweetID = 7;

?>
    <!--
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="../../assets/css/home.css">
</head>

<body>
    <div class="wrap5">

        <div class="editText"> <textarea rows="5" columns="5" name="textStatus" class="editStatuss"><?php echo $tweet->status; ?></textarea><i class="fa fa-times"></i>
            <input type="submit" class="editSubmit">
        </div>-->


    <?php
//Onekta like.php er moto kore korte hobe.

if(isset($_POST['editSatus']) && !empty($_POST['editSatus'])){
    $user_id = login::isLoggedIn();
    $editSatus = $_POST['editSatus'];
    $tweet_id = $_POST['tweet_idmmm'];
    $get_id = $_POST['user_idr'];
    $writter = $_POST['writter'];
 $getFromT->editPost($tweet_id, $get_id, $editSatus);   
    
}
if(isset($_POST['tweet_idm']) && !empty($_POST['tweet_idm'])){
    $user_id = login::isLoggedIn();
    $tweet_id = $_POST['tweet_idm']; $get_id = $_POST['user_idr'];
    $profile = $_POST['profileID'];
    $image = $_POST['imageID'];
    
  
//    <li><label class="deleteTweet" data-tweet="'.$tweet_id.'" data-writter="'.$get_id.'" data-user="'.$user_id.'" >Delete Post</label></li>
    echo '
    <div class="dro"> ';?>

        <?php if($get_id == $user_id){
        ?>

        <div class="edit">
            <div class="editTweet" data-tweet="<?php echo $tweet_id; ?>" data-writter="<?php echo $get_id; ?>" data-user="<?php echo $user_id; ?>"><a href="#home">Edit</a></div>
            <div class="editShow">


            </div>
        </div>
        <?php }  ?>
        <?php if($get_id == $user_id){?>
        <div class="delConf">
            <a href="#home" class=<?php if($image != '0'){echo '"imageDeleteTweet" data-imageid="'.$image.'"'; }else{ echo '"deleteTweet"'; }  ?> data-tweet = "<?php echo $tweet_id; ?>" data-writter="<?php echo $get_id; ?>" data-user="<?php echo $user_id; ?>">Delete Post</a>
            <div class="delshow">


            </div>
        </div>
        <?php   } ?>



        <?php echo'
    <a href="#myPostHide">Hide Post</a>
    <a href="#contact">Block User</a>
    <a href="#contact">Report</a>
    </div>
    
    
    ';
    
    
}

if(isset($_POST['tweet_idmm']) && !empty($_POST['tweet_idmm'])){
    $user_id = login::isLoggedIn();
    $tweet_id = $_POST['tweet_idmm']; 
    $get_id = $_POST['user_idr'];
    $writterID = $_POST['writterID'];
  $tweet = $getFromT->getPopupTweet($tweet_id);
//    <li><label class="deleteTweet" data-tweet="'.$tweet_id.'" data-writter="'.$get_id.'" data-user="'.$user_id.'" >Delete Post</label></li>
    echo ' <div class="wrap5">
                <div class="editText"> 
                    <textarea data-autoresize rows="5" columns="5" name="textStatus" class="editStatuss">'.$tweet->status.'  </textarea><i class="fa fa-times editCancelOption  ">
                    <div class="CancelOption">
                    <div class="editCancel">Edit cancel</div><hr>
                    <div ="notCancel">No</div>
                    </div>
                    </i>
                    <input type="submit" class="editSubmit" data-tweet="'.$tweet_id.'" data-writter="'.$writterID.'" data-user="'.$user_id.'" >
                </div>
            </div>';
    
    
}

?>
        <!--
</div>
</body>

</html>
-->
        <script src="assets/js/jquery-3.1.1.js"></script>


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
