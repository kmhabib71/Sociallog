<?Php
class Follow extends User {
	

	function __construct($pdo){
		$this->pdo = $pdo;
	}

    ///////////// Request//////////////
    	public function checkRequest($reqReceiver, $user_id){
		$stmt = $this->pdo->prepare("
        SELECT * FROM `society_memb` WHERE (`reqSender` = :user_id AND `reqReceiver` = :reqReceiver) OR (`reqSender` = :reqReceiver AND `reqReceiver` = :user_id)
        ");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->bindParam(":reqReceiver", $reqReceiver, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
    public function requestBtn($profileID, $user_id, $followID){
        $data = $this->checkRequest($profileID, $user_id);
//     echo $data['reqSender']; // echo $data['reqReceiver'];
        
        if($profileID != $user_id){
      if($data['reqSender'] == $user_id ){      
            if($data['reqStatus'] == 1 ){
                echo '<button class="memberReq-btn" data-follow = "'.$profileID.'" data-profile="'.$followID.'">Society Request has sent</button>';
            }elseif($data['reqStatus'] == 2){
                echo '<div class="memberAction"><button class="member-btn" data-follow = "'.$profileID.'" data-profile="'.$followID.'"><i class="fa fa-check" style="color:lightgreen;font-size=20px;"></i>Society Member</button>
                
<div class="memberActionList">
<div class="maList societyOut" data-follow = "'.$profileID.'" data-profile="'.$followID.'">Society Out</div>

<div class="blockUser" data-profile="'.$profileID.'" data-user="'.$user_id.'">Block</div>

<div class="maList">Report</div>
</div>

</div>';
            }elseif($data['reqStatus'] == 0){
                echo '<button class="memReq-btn" data-follow = "'.$profileID.'" data-profile="'.$followID.'">Add in society</button>';
            }
          
         
      }elseif($data['reqSender'] == $profileID){
          if($data['reqStatus'] == 2){
                echo '<div class="memberAction"><button class="member-btn" data-follow = "'.$profileID.'" data-profile="'.$followID.'"><i class="fa fa-check" style="color:lightgreen;font-size=20px;"></i>Society Member</button>
                
<div class="memberActionList">
<div class="maList societyOut" data-follow = "'.$profileID.'" data-profile="'.$followID.'">Society Out</div>

<div data-profile="'.$profileID.'" data-user="'.$user_id.'" class="blockUser" >Block</div>

<div class="maList">Report</div>
</div>

</div>';
            }else{
                    echo '<button class="acceReq-btn" data-follow = "'.$profileID.'" data-profile="'.$followID.'">Accept Society Request</button><button class="cancReq-btn" data-follow = "'.$profileID.'" data-profile="'.$followID.'">Cancel</button>';
            }
          
          
          
          
      
      }else {
          echo '<button class="memReq-btn" data-follow = "'.$profileID.'" data-profile="'.$followID.'">Add in society</button>';
      }

    }
}
    
  public function addSocietyCount($followID, $user_id){
		$stmt= $this->pdo->prepare("UPDATE `users` SET `following` = `following` + 1 WHERE `user_id` = :user_id; UPDATE `users` SET `followers` = `followers` + 1 WHERE `user_id` = :followID");
		$stmt->execute(array("user_id" => $user_id, "followID" => $followID));

	}  
    public function memberAdd($followID, $user_id){
		$stmt= $this->pdo->prepare("UPDATE `society_memb` SET `reqStatus` = '2' WHERE `reqSender` = :reqReceiver; AND `reqReceiver` =:user_id");
		$stmt->execute(array("user_id" => $user_id, "reqReceiver" => $followID));

	}  
    public function member($followID, $user_id, $profileID){
		$this->create('society_memb', array('reqSender' => $user_id, 'reqReceiver' =>$followID, 'reqOn' =>date("Y-M-D H:i:s"), 'reqStatus' => '1'));
		$this->addSocietyCount($followID, $user_id);
		$stmt = $this->pdo->prepare('SELECT `user_id`, `following`, `followers` FROM `users` LEFT JOIN `society_memb` ON `reqSender` = :user_id AND CASE WHEN `reqReceiver` = :user_id THEN `reqSender` = `user_id` END WHERE `user_id` = :profileID');
		$stmt->execute(array("user_id" => $user_id, "profileID" => $profileID));
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		echo json_encode($data);
	Message::sendNotification($followID, $user_id, $followID, 'society_memb');
	}
    
    	public function disMembership($followID, $user_id, $profileID){
		$this->delete('society_memb', array('reqSender' => $user_id, 'reqReceiver' => $followID));
		$this->removeMemberCount($followID, $user_id);
		$stmt = $this->pdo->prepare('SELECT `user_id`, `following`, `followers` FROM `users` LEFT JOIN `follow` ON `sender` = :user_id AND CASE WHEN `receiver` = :user_id THEN `sender` = `user_id` END WHERE `user_id` = :profileID');
		$stmt->execute(array("user_id" => $user_id, "profileID" => $profileID));
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		echo json_encode($data);

	} 
//    public function unBlockMember($user_id, $profileID){
//		$this->delete('block', array('blockerID' => $user_id, 'blockedID' => $profileID));
//		$this->removeMemberCount($followID, $user_id);
//		$stmt = $this->pdo->prepare('SELECT `user_id`, `following`, `followers` FROM `users` LEFT JOIN `follow` ON `sender` = :user_id AND CASE WHEN `receiver` = :user_id THEN `sender` = `user_id` END WHERE `user_id` = :profileID');
//		$stmt->execute(array("user_id" => $user_id, "profileID" => $profileID));
//		$data = $stmt->fetch(PDO::FETCH_ASSOC);
//		echo json_encode($data);
//
//	}
    public function cancelRequest($followID, $user_id, $profileID){
		$this->delete('society_memb', array('reqReceiver' => $user_id, 'reqSender' => $followID));
		$this->removeMemberCount($followID, $user_id);
		$stmt = $this->pdo->prepare('SELECT `user_id`, `following`, `followers` FROM `users` LEFT JOIN `follow` ON `sender` = :user_id AND CASE WHEN `receiver` = :user_id THEN `sender` = `user_id` END WHERE `user_id` = :profileID');
		$stmt->execute(array("user_id" => $user_id, "profileID" => $profileID));
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		echo json_encode($data);

	}
    	public function removeMemberCount($followID, $user_id){
		$stmt=$this->pdo->prepare("UPDATE `users` SET `following` = `following` - 1 WHERE `user_id` = :user_id; UPDATE `users` SET `followers` = `followers` - 1 WHERE `user_id` = :followID");
		$stmt->execute(array("user_id" => $user_id, "followID" => $followID));

	}
    
    public function memberListByhim($profileID, $user_id, $followID){
		$stmt=$this->pdo->prepare("SELECT * FROM `users` LEFT JOIN `society_memb` ON  reqSender = user_id WHERE reqReceiver = :profileID AND reqStatus = 2 ; ");
		$stmt->bindParam(":profileID", $profileID, PDO::PARAM_INT);
		$stmt->execute();
		$members = $stmt->fetchAll(PDO::FETCH_OBJ);
		foreach ($members as $member){
			echo '
            
            <div class="profile_coverss">
                <div class="img_boxss">
                    <img src="'.$member->profileImage.'" alt="">
                    
                    <div class="profile_usernamess">
                        '.$member->username.'
                    </div>
                      <div class="actionsss">

                    <div class="attentionss">'.$this->requestBtn($member->user_id, $user_id, $profileID, $followID).'</div>
                    
                </div>
                </div>

              
            </div>
            
            
            ';
		}

	}
    public function memberListByOthers($profileID, $user_id, $followID){
		$stmt=$this->pdo->prepare("SELECT * FROM `users` LEFT JOIN `society_memb` ON  reqReceiver = user_id WHERE reqSender = :profileID AND reqStatus = 2;; ");
		$stmt->bindParam(":profileID", $profileID, PDO::PARAM_INT);
		$stmt->execute();
		$members = $stmt->fetchAll(PDO::FETCH_OBJ);
		foreach ($members as $member){
			echo '
            
            <div class="profile_coverss">
                <div class="img_boxss">
                    <img src="'.$member->profileImage.'" alt="">
                    
                    <div class="profile_usernamess">
                        '.$member->username.'
                    </div>
                      <div class="actionsss">

                    <div class="attentionss">'.$this->requestBtn($member->user_id, $user_id, $profileID, $followID).'</div>
                    
                </div>
                </div>

              
            </div>
            
            
            ';
		}

	}
    
    
    
}

?>
