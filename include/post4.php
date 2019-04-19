<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/home.css">
    <link rel="stylesheet" href="../assets/css/fw/css/font-awesome.css">
</head>
<body>
     <div class="mainCommen">
                <div class="user-comment">
                <div class="user"><img src="../assets/img/me.jpg"/></div>
                  </div>
                  <div class="commentText">
                <div class="comments"><strong class="username">Km Habib</strong>What's going on?</div>
                <div class="replyReact">
                <div class="replyLike">Like</div>
                <div class="replyLike">React</div>
                <div class="replyButton">
                 <button type="button" class="reply" id="'.$comment->commentID.'">Reply</button></div></div>
                 </div>
                </div>
                 <div class="post-option">
           <ul> <li>
					<i class="fa fa-ellipsis-h iconn"></i>
					<ul> 
					  <li><label class="deleteTweet" >Delete Tweet</label></li>
					</ul>
        </li>
        </ul>  
        </div>
        
        <div class="dropdown" data-tweet="<?php echo $tweet->tweetID; ?>" data-user="<?php echo $tweet->tweetBy; ?>">
<button class="dropbtn post-option-detail" data-tweet="<?php echo $tweet->tweetID; ?>" data-user="<?php echo $tweet->tweetBy; ?>"><i class="fa fa-ellipsis-h iconn" aria-hidden="true" ></i></button>
         <div class="dropdown-content">
         
    <div class="dro">
    <div class="delConf">
    <a href="#home" class="deleteTweet" data-tweet="'.$tweet_id.'" data-writter="'.$get_id.'" data-user="'.$user_id.'">Delete Post</a>
    <div class="delBack">
    <div class="delConfer">
        <div class="delHead">Do You want to delete the Post?</div>
        <div class="yesNo">
            <button class="deletePost">Delete Post</button>
            <button class="deleteCancel">Cancel</button>
            
        </div>
    </div>
    </div>
    </div>
    <a href="#about">Hide Post</a>
    <a href="#contact">Block User</a>
    <a href="#contact">Report</a>
    </div>
        </div>
        </div>
         <script src="../assets/js/jquery-3.1.1.js"></script>
         <script>
//    $(function(){
//        $('.deleteTweet').click(function(){
//            $('.delBack').toggle();
//        });
//    })
    
    </script>
         
         
</body>
</html>