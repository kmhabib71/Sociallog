<?php
class Post extends User {
	
	function __construct($pdo){
		$this->pdo = $pdo;
	}

public function Posts(){
	$stmt = $this->pdo->prepare("SELECT * FROM `bhara` ORDER BY `date_time` DESC");
    // $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $Posts = $stmt->fetchAll(PDO::FETCH_OBJ);
    foreach($Posts as $Post){
    	
}}}
?>