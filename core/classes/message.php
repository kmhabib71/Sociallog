<?php
class Message extends User{
	function __construct($pdo){
		$this->pdo = $pdo;

	}
//         public function recentMess($user_id){
//		$stmt = $this->pdo->prepare("SELECT *,
//IF(messages.messageTo = :user_id, messages.messageFrom, messages.messageTo ) as masse
//FROM messages WHERE  messageID IN ( SELECT max(messageID) FROM messages WHERE `messageFrom` = :user_id OR `messageTo` = :user_id  GROUP By `messageTo` 
//   ) ORDER by messageOn DESC; ");
//		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
//		$stmt->execute();
//		return $stmt->fetchAll(PDO::FETCH_OBJ);
//	}
	public function recentMessages($user_id){
//        $messages = $this->recentMess($user_id);
//foreach ($messages as $mess){
//echo json_encode($mess->masse);
//}
//        $mes = $messages->masse;
		$stmt = $this->pdo->prepare("SELECT * FROM messages INNER JOIN users ON (if(messages.messageTo = :user_id, messages.messageFrom = users.user_id, messages.messageTo = users.user_id ))  WHERE  messageID  IN ( SELECT max(messageID) FROM messages WHERE `messageFrom` = :user_id OR `messageTo` = :user_id  GROUP By `messageTo` 
   ) GROUP By users.user_id  ORDER by messageOn DESC; ");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
   
    	public function recentMessagess($user_id){
		$stmt = $this->pdo->prepare("SELECT * FROM `messages` LEFT JOIN `users` ON `messageTo` = `user_id` WHERE `messageTo` = :user_id  OR `messageFrom` = :user_id  GROUP BY  `messageTo` ORDER BY `messageOn` DESC ");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
    
	public function getMessages($messageFrom, $user_id){
		$stmt = $this->pdo->prepare("SELECT * FROM  `messages` LEFT JOIN `users` ON `messageFrom` = `user_id` WHERE `messageFrom` = :messageFrom AND `messageTo` = :user_id OR `messageTo` = :messageFrom AND `messageFrom` = :user_id");
		$stmt->bindParam(":messageFrom",$messageFrom, PDO::PARAM_INT );
		$stmt->bindParam(":user_id",$user_id, PDO::PARAM_INT);
		$stmt->execute();
		$messages = $stmt->fetchAll(PDO::FETCH_OBJ);
		foreach($messages as $message){
			if($message->messageFrom === $user_id){
				echo '<!-- Main message BODY RIGHT START -->
<div class="main-msg-body-right">
		<div class="main-msg">
			<div class="msg-img">
				<a href="#"><img src="'.BASE_URL.$message->profileImage.'"/></a>
			</div>
			<div class="msg">'.$message->message.'
				<div class="msg-time">
				  '.$this->timeAgo($message->messageOn).'
				</div>
			</div>
			<div class="msg-btn">
				<a><i class="fa fa-ban" aria-hidden="true"></i></a>
				<a class="deleteMsg" data-message="'.$message->messageID.'"><i class="fa fa-trash" aria-hidden="true"></i></a>
			</div>
		</div>
	</div>';
			}else {
				echo '<!--Main message BODY LEFT START-->
		<div class="main-msg-body-left">
			<div class="main-msg-l">
				<div class="msg-img-l">
					<a href="#"><img src="'.BASE_URL.$message->profileImage.'"/></a>
				</div>
				<div class="msg-l">'.$message->message.'
					<div class="msg-time-l">
					    '.$this->timeAgo($message->message).'
					</div>	
				</div>
				<div class="msg-btn-l">	
					<a><i class="fa fa-ban" aria-hidden="true"></i></a>
					<a class="deleteMsg"  data-message="'.$message->messageID.'"><i class="fa fa-trash" aria-hidden="true"></i></a>
				</div>
			</div>
		</div> 
	<!--Main message BODY LEFT END-->';
			}
		}

	}
	public function deleteMsg($messageID, $user_id){
		$stmt = $this->pdo->prepare("DELETE FROM `messages` WHERE `messageID` = :messageID AND `messageFrom` = :user_id OR `messageID` = :messageID AND `messageTo` = :user_id ");
		$stmt->bindParam(":messageID", $messageID, PDO::PARAM_INT);
		$stmt->bindParam(":user_id", $user_id,  PDO::PARAM_INT);
		$stmt->execute();
	}

	public function getNotificationCount($user_id){
 $stmt= $this->pdo->prepare("SELECT COUNT(`messageID`) AS `totalM`, (SELECT COUNT(`ID`)FROM `notification` WHERE `notificationFor` = :user_id AND `status` = '0') AS `totalN` FROM `messages` WHERE `messageTo` = :user_id AND `status` = '0'");
 $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
 $stmt->execute();
 return $stmt->fetch(PDO::FETCH_OBJ);
	}

	public function messagesViewed($user_id){
		$stmt = $this->pdo->prepare("UPDATE `messages` SET `status` = '1' where `messageTo` = :user_id AND `status` = '0'");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->execute();
	}
	public function notificationViewed($user_id){
		$stmt = $this->pdo->prepare("UPDATE `notification` SET `status` = '1' WHERE `notificationFor` = :user_id");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->execute();
	}
	public function notification($user_id){
		$stmt = $this->pdo->prepare("SELECT * FROM `notification` N 
					LEFT JOIN `users` U on N.`notificationFrom` = U.`user_id`
					LEFT JOIN `tweets` T ON N.`target` = T.`tweetID`
					LEFT JOIN `likes` L ON N.`target` = L.`likeOn`
					LEFT JOIN `follow` F ON N.`notificationFrom` = F.`sender` AND N.`notificationFor` = F.`receiver` 
					WHERE N.`notificationFor` = :user_id AND N.`notificationFrom` != :user_id ");
		$stmt->execute(array("user_id" => $user_id));
		return $stmt->fetchAll(PDO::FETCH_OBJ
	);
	}
	public function sendNotification($get_id, $user_id, $target, $type){
		$this->create('notification', array('notificationFor' => $get_id, 'notificationFrom' => $user_id, 'target' => $target, 'type' => $type, 'time' => date('Y-m-d H:i:s')));
	}
}

?>
