<?php
class Tweet extends User {
	
	function __construct($pdo){
		$this->pdo = $pdo;
	}
    public function tweetss($user_id){
   $stmt = $this->pdo->prepare("SELECT * FROM `tweets`,`users` WHERE `tweetBy` = `user_id` ORDER BY postedOn DESC ");
    $stmt->execute();
    $tweets = $stmt->fetchAll(PDO::FETCH_OBJ);
    
    foreach($tweets as $tweet){
        $likes = $this->likes($user_id, $tweet->tweetID);
        
        $retweet = $this->checkRetweet($tweet->tweetID, $user_id);
        $comme = $this->comm($tweet->tweetID, $user_id);
//        $comments = $this->commentss($tweet->tweetID);
        echo '<div class="post-area">
    <div class="user-info">
        <div class="post-user">
            <div class="user"><label class="drop-label" for="drop-wrap1"><div class="user-comment">
                <div class="user"><img src="'.$tweet->profileImage.'"/></div>
                  </div></label>
    </div>
    <div class="user-name">'.$tweet->username.'

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
            '.$this->getTweetLinks($tweet->status).'
        </div>
        '.((!empty($tweet->tweetImage)) ? '
        <div class="main-status-image">
            <img src="'.BASE_URL.$tweet->tweetImage.'">
        </div>' : '').'



     
        <div class="lower-section-wrapper">

        <div class="lower-section-details">
            <div class="reactionn">
            
<div class="likeSection">         
<ul>
    
     <li>'.(($likes['likeOn'] === $tweet->tweetID) ? '<button class="unlike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter">'.$tweet->likesCount.'</span></button>' 
    : 
    '<button class="like-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter">'.(($tweet->likesCount > 0) ? $tweet->likesCount : '').'</span></button>').'
    
    </li>
    </ul>
    </div> 
    <div class="commentShareSection">
    <ul>
     <li><button class="commentIcon"><i class="fa fa-comment" aria-hidden="true"></i> </button>
    
    </li>
    
</ul>
             
    <ul>
     <li>'.(($tweet->tweetID === $retweet['retweetID']) ? '<button class="retweeted" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-share" aria-hidden="true"></i><span class="retweetsCount"></span>'.$tweet->retweetCount.'</button>' : '<button class="retweet" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-share" aria-hidden="true"></i><span class="retweetsCount"></span>'.(($tweet->retweetCount > 0) ? $tweet->retweetCount : $retweet['retweetID']).'</button>' ).'
    
    </li>
    
</ul>
</div>
</div>

            
  <div class="comment-holder">

           <div class="comment">
               <textarea data-autoresize rows="2" columns="1" placeholder="write a comment to @ '.$tweet->username.'" name="textStatus" class="commentInput" data-tweet="'.$tweet->tweetID.'"></textarea>
               
              <div class="commentButton"><button class="postComment">POST</button></div> 
           </div>
           
          <!-- '.(($tweet->tweetID === $comme['commentOn']) ? 'fdfdf':'').'

        -->
            
           <div class="commentShow'.$tweet->tweetID.'">
          
           
           </div>
              </div>
        </div>
    </div>

    </div>


    </div>'; } } 

public function getTrendByHash($hashtag){
    $stmt=$this->pdo->prepare("SELECT * FROM `trends` WHERE `hashtag` LIKE :hashtag");
    $stmt->bindValue(':hashtag', $hashtag.'%');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}
	public function getMention($mention){
			$stmt = $this->pdo->prepare("SELECT `user_id`, `username`, `screenName`, `profileImage` FROM `users` WHERE `username` LIKE :mention or `screenName` LIKE :mention LIMIT 5");
			$stmt->bindValue(':mention', $mention.'%');
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
    public function addTrend($hashtag){
        preg_match_all("/#+([a-zA-Z0-9_]+)/i", $hashtag, $matches);
        if($matches){
            $result=array_values($matches[1]);
        }
        $sql = "INSERT INTO `trends` (`hashtag`, `createdOn`) VALUES (:hashtag, CURRENT_TIMESTAMP)";
        foreach ($result as $trend) {
           if($stmt = $this->pdo->prepare($sql)){
               $stmt->execute(array(':hashtag'=>$trend));
           } 
        }
    }
public function getTweetLinks($tweet){
//    $tweet = preg_replace("/([\w\.]+)/", "<a href='$0' target='_blank'>$0</a>", $tweet);
    $tweet = preg_replace("/(https?:\/\/)([\w]+.)([\w\.]+)/", "<a href='$0' target='_blank'>$0</a>", $tweet);
   
    
//    $tweet = preg_replace(pattern, replacement, subject)
    $tweet = preg_replace("/#([\w]+)/", "<a href='".BASE_URL."hashtag/$1'>$0</a>", $tweet);
    $tweet = preg_replace("/@([\w]+)/", "<a href='".BASE_URL."hashtag/$1'>$0</a>", $tweet);
//     $tweet = preg_replace("/(www?.)([\w\.]+)/", "<a href='$0' target='_blank'>$0</a>", $tweet);
    return $tweet;
}
public function addLike($user_id, $tweet_id, $get_id){
			$stmt = $this->pdo->prepare("UPDATE `tweets` SET `likesCount` = `likesCount` +1 WHERE `tweetID` = :tweet_id");
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();

			$this->create('likes', array('likeBy' => $user_id, 'likeOn' =>$tweet_id));
			if($get_id != $user_id){
				Message::sendNotification($get_id, $user_id, $tweet_id, 'like');
			}
		}
		public function unLike($user_id, $tweet_id, $get_id){
			$stmt = $this->pdo->prepare("UPDATE `tweets` SET `likesCount` = `likesCount` -1 WHERE `tweetID` = :tweet_id");
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();

			$stmt = $this->pdo->prepare("DELETE FROM `likes` WHERE `likeBy` = :user_id AND `likeOn` = :tweet_id");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
		}

		public function likes($user_id, $tweet_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `likes` WHERE `likeBy` = :user_id AND `likeOn` = :tweet_id ");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);

		}
    public function retweet($tweet_id, $user_id, $get_id, $comment){
			$stmt = $this->pdo->prepare("UPDATE `tweets` SET `retweetCount` = `retweetCount`+1 WHERE `tweetID` = :tweet_id");
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();

			$stmt = $this->pdo->prepare("INSERT INTO `tweets` (`status`,`tweetBy`,`tweetImage`, `retweetID`,`retweetBy`,`postedOn`,`likesCount`,`retweetCount`,`retweetMsg`) SELECT `status`,`tweetBy`,`tweetImage`,`tweetId`, :user_id, `postedOn`,`likesCount`,`retweetCount`, :retweetMsg FROM `tweets` WHERE `tweetID` = :tweet_id ");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":retweetMsg", $comment, PDO::PARAM_STR);
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			Message::sendNotification($get_id, $user_id, $tweet_id, 'retweet');

		}
    public function getPopupTweet($tweet_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `tweets`, `users` WHERE `tweetID` = :tweet_id AND `tweetBy` = `user_id`");
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);

}
    public function checkRetweet($tweet_id, $user_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `tweets` WHERE `retweetID` = :tweet_id AND `retweetBy` = :user_id OR `tweetID` = :tweet_id AND `retweetBy` = :user_id");
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}  
    public function comm($tweet_id, $user_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `comments` WHERE `commentOn` = :tweet_id AND `commentBy` = :user_id ");
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
    public function comments($tweet_id){
			$stmt = $this->pdo->prepare("SELECT * FROM `comments` LEFT JOIN `users` ON `commentBy` = `user_id` WHERE `commentOn` = :tweet_id");
			$stmt->bindParam(":tweet_id", $tweet_id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}   
   
    
}?>
