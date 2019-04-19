<?php
include '../init.php';
    include '../../class/login.php';
    $user_id = login::isLoggedIn();

if(isset($_POST['unfollow']) && !empty($_POST['unfollow'])){
	$user_id = login::isLoggedIn();
	$followID = $_POST['unfollow'];
	$profileID = $_POST['profile'];
	// $result['following'] = 1;
	// echo json_encode($result);
	$getFromF->member($followID, $user_id, $profileID);
}

if(isset($_POST['unfolloww']) && !empty($_POST['unfolloww'])){
	$user_id = login::isLoggedIn();
	$followID = $_POST['unfolloww'];
	$profileID = $_POST['profilee'];
	// $result['following'] = 1;
	// echo json_encode($result);
	$getFromF->disMembership($followID, $user_id, $profileID);
}
if(isset($_POST['unfollowww']) && !empty($_POST['unfollowww'])){
	$user_id = login::isLoggedIn();
	$followID = $_POST['unfollowww'];
	$profileID = $_POST['profileee'];
	// $result['following'] = 1;
	// echo json_encode($result);
	$getFromF->cancelRequest($followID, $user_id, $profileID);
}
if(isset($_POST['unfollowwww']) && !empty($_POST['unfollowwww'])){
	$user_id = login::isLoggedIn();
	$followID = $_POST['unfollowwww'];
	$profileID = $_POST['profileeee'];
	// $result['following'] = 1;
	// echo json_encode($result);
	$getFromF->memberAdd($followID, $user_id);
}
if(isset($_POST['societyOut']) && !empty($_POST['societyOut'])){
	$user_id = login::isLoggedIn();
	$followID = $_POST['societyOut'];
	$profileID = $_POST['profileeee'];
	// $result['following'] = 1;
	// echo json_encode($result);
	$getFromF->cancelRequest($followID, $user_id, $profileID);
}
if(isset($_POST['follow']) && !empty($_POST['follow'])){
	$user_id = login::isLoggedIn();
	$followID = $_POST['follow'];
	$profileID = $_POST['profile'];

	// $result['following'] = 0;
	// echo json_encode($result);
	$getFromF->follow($followID, $user_id, $profileID);
}
if(isset($_POST['blockedID']) && !empty($_POST['blockerID'])){
    $blockedID= $_POST['blockedID'];
    $blockerID= $_POST['blockerID'];
    $getFromU->create('block', array('blockedID' => $blockedID, 'blockerID' => $blockerID, 'postedOn' => date('Y-m-d H:i:s')));
}
if(isset($_POST['userBlock']) && !empty($_POST['userBlock'])){
    $blockerID= $_POST['userBlock'];
    $blockedID= $_POST['profileBlock'];

    $getFromU->delete('block', array('blockerID' => $blockerID, 'blockedID' => $blockedID));
    
//    $getFromU->create('block', array('blockedID' => $blockedID, 'blockerID' => $blockerID, 'postedOn' => date('Y-m-d H:i:s')));
}

?>
