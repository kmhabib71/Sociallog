<?Php
class Request extends User {
		

	function __construct($pdo){
		$this->pdo = $pdo;
	}
    
    public function loggedIn(){
         $showTimeline=False;
if(login::isLoggedIn()){
//     $userid =login::isLoggedIn();
//    echo $userid;
     $showTimeline=True;
}  
    }
    	public function checkRequest($req_senderID, $user_id){
		$stmt = $this->pdo->prepare("SELECT * FROM `society_mem` WHERE `req_sender` = :user_id AND `req_receiver` = :req_senderID");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->bindParam(":req_senderID", $req_senderID, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
    public function requestBtn($profileID, $user_id, $followID){
        $data = $this->checkRequest($profileID, $user_id);
        if($this->loggedIn() === true){
            
            echo 'found';
        }
    }
    
}