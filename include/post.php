
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="../assets/css/home.css">
    <link rel="stylesheet" href="../assets/css/fw/css/font-awesome.css">
        <link rel="stylesheet" href="../assets/css/mon.css">
<!--        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
<!--        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
<!--  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>-->
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />-->
<script>
  $( function() {
      $(".hala").click(function(){
    $( "#dialog" ).dialog();
  } );
       });
  </script>
</head>
<body>
    <div class="post-area">
    <div class="user-info">
        <div class="post-user">
            <div class="user"><label class="drop-label" for="drop-wrap1"><img src="../assets/img/me.jpg"/></label>
</div>
<div class="user-name">Km Habib

</div>
</div>

<div class="status-type">
    Updated his profile picture <br>
</div>
<div class="post-option">
    v
</div>

</div>
<div class="time-ago">
    36 m ago
</div>
<div class="main-status">
    <div class="main-status-text">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit excepturi officiis amet non quas ex cumque maxime, quod fugiat assumenda...<span class="readMore">Read More</span>
    </div>
    <div class="main-status-image">
        <img src="../assets/img/me.jpg" alt="">
    </div>


<hr>
    <div class="lower-section">
        <div class="reaction"></div>
        <div class="comment"></div>
        <div class="share"></div>
        <div class="shareX"> </div>

    </div>
    <div class="lower-section-wrapper">

        <div class="lower-section-details">
            <div class="react-section">
                <div class="like"><i class="fa fa-thumbs-up"></i></div>
                <div class="heart"> <i class="fa fa-heart" aria-hidden="true" style="color:red"></i></div>
                <div class="smile"><i class="fa fa-smile-o" aria-hidden="true" style="color:#be074c;font-size:19px;background-color:beige;"></i> 
                </div>
                <div class="angry"><i class="fa fa-frown-o" aria-hidden="true" style="color:#be074c;font-size:20px;background-color:beige;"></i> 
                </div>
            </div>
            <hr>
            <div class="comment-holder">
            <div class="lower-section">
                <div class="reaction"><i class="fa fa-frown-o" aria-hidden="true" style="color:#be074c;font-size:20px;background-color:beige;"></i><span style="color:#be074c">30 Reactions</span></div>
                <div class="comment"><i class="fa fa-comment" aria-hidden="true" style="color:#be074c;font-size:20px;background-color:beige;"></i><span style="color:#803">23 comments</span></div>
                <div class="share"><i class="fa fa-share" aria-hidden="true" style="color:#be074c;font-size:20px;background-color:beige;"></i><span style="color:#503">16 shares</span></div>
                <div class="text"><i class="fa fa-envelope" aria-hidden="true" style="color:#be074c;font-size:20px;background-color:beige;"></i><span style="color:#313">Message</span></div>

            </div>
            <div class="comment-section">
                <div class="user-comment">
                <div class="user"><img src="../assets/img/me.jpg"/></div>
                <div class="comments"><strong>Km Habib</strong> dolor sit amet, consectetur adipisicing elit. Asperiores, omnis!consectetur adipisicing elit. Asperiores, omnis!</div>
                </div><div class="user-comment">
                <div class="user"><img src="../assets/img/me.jpg"/></div>
                <div class="comments"><strong>Km Habib</strong> dolor sit amet, consectetur adipisicing elit. Asperiores, omnis!</div>
                </div>
            </div>
            </div>
            
        </div>
    </div>
  
<!--
<ul class="listItemo">
    <li>
				<button class="unlike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a><span class="likesCounter"></span></button><button class="like-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a><span class="likesCounter"></span></button>
				 </li>
				
					<li>
    <li><button class="unlike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a><span class="likesCounter"></span></button><button class="like-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a><span class="likesCounter"></span></button>
				 </li>
				<li>
    <li>Banana</li>
</ul>
-->
<div class="t-show-footer">
<!--
		<div class="t-s-f-right">
			<ul> 
				<li><button><a href="#"><i class="fa fa-share" aria-hidden="true"></i></a></button></li>	
				<li><button class="retweeted" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount"></span></button><button class="retweet" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-retweet" aria-hidden="true"></i><span class="retweetsCount"></span></button></li>
				<li><button class="unlike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a><span class="likesCounter"></span></button><button class="like-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a><span class="likesCounter"></span></button>
				 </li>
				
					<li>
					<a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
					<ul> 
					  <li><label class="deleteTweet" data-tweet="'.$tweet->tweetID.'"></label></li>
					</ul>
				</li> 
			</ul>
		</div>
-->
	</div>
	
</div>
<div class="reactionn">
<ul>
     <li><button class="unlike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter"></span></button><button class="like-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter"></span></button>
     </li>
    </ul>
    <ul>
     <li>'.(($tweet->tweetID === $retweet['retweetID']) ? '<button class="retweeted" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-share" aria-hidden="true"></i><span class="retweetsCount"></span>'.$tweet->retweetCount.'</button>' 
     : 
     '<button class="retweet" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-share" aria-hidden="true"></i><span class="retweetsCount"></span>'.(($tweet->retweetCount > 0) ? $tweet->retweetCount : '').'</button>' ).'
    
    </li>
    
</ul>
   
<!--
    <li>'.(($likes['likeOn'] === $tweet->tweetID) ? '<button class="unlike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter">'.$tweet->likesCount.'</span></button>' 
    : 
    '<button class="like-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter">'.(($tweet->likesCount > 0) ? $tweet->likesCount : '').'</span></button>').'
    
    </li>
    
     <li><button class="unlike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter"></span></button><button class="like-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter"></span></button>
    
    </li>
-->
    
    
<!--    <li><button class="unlike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-heart" aria-hidden="true"></i><span class="likesCounter">'.$tweet->likesCount.'</span></button></li>-->

</div>
</div>
<div class="share-it">
    <h3>Share this post...</h3>
    <textarea data-autoresize rows="5" columns="5" placeholder="what's going in your mind?" name="textStatus" class="statuss"></textarea>
    
</div>

<div id="ex1" class="modal">
  <p>Thanks for clicking. That felt good.</p>
  <a href="#" rel="modal:close">Close</a>
</div>

<!-- Link to open the modal -->
<p><a href="#ex1" rel="modal:open">Open Modal</a></p>
<div class="retweets">Retweets</div>
<div id="shareModal" class="modall">
                            <div class="modal-contentt">
                                <span class="close">&times;</span>
                                <div class="popupTweet">
Hello! how are you?
                                </div>
                                <!-- Modal content -->

                            </div>
                        </div>
<script>
       var modall = document.getElementById('shareModal');
        var btnn = document.getElementsByClassName("retweets");
        var spann = document.getElementsByClassName("close")[0];
        btnn.onclick = function() {
            modall.style.display = "block";
        }
        spann.onclick = function() {
            modall.style.display = "none";
        }
        if (event.target == modall) {
                        modall.style.display = "none";
                    }
                }

    </script>
</body>
</html>
