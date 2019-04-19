<?php
// include './class/DB.php';
include './class/login.php';
////0 check if the users logged in or not
if(!login::isLoggedIn()){
   header('location:index.php');
}
$showTimeline=False;
if(login::isLoggedIn()){
     $userid =login::isLoggedIn();
    
     $showTimeline=True;

//1 check the confirm button is pressed or not
//if(isset($_POST['confirm'])){
//	//2 
//	if(isset($_POST['alldevices']))
//	{
		//5 if alldevices checkbox is checked then all token from same id will be deleted from database. 
//    DB::query('DELETE FROM login_tokens WHERE user_id=:userid',array(':userid'=>login::isLoggedIn()));
//	} else {
		//3 if cookies exist in computer then it will be deleted cause otherwise user can delete cookiew by himself
			if(isset($_COOKIE['SNID'])){
			DB::query('DELETE FROM login_tokens WHERE token=:token',array(':token'=>sha1($_COOKIE['SNID'])));
			}
			//4 time minus value will expired cookies
			setcookie('SNID', '1', time()-3600);
			setcookie('SNID_', '1', time()-3600);
			header('location:index.php');
    } else {
	header('Location: index.php');
}
// } // // //}
?>
    <!--
<h1>Logout of your Account</h1>
<p>Are you sure you'd like to logout?</p>
<form action="logout.php" method="post">
	<input type="checkbox" name="alldevices" value="alldevices">Logout of all devices?<br/>
	<input type="submit" name="confirm" value="confirm">


</form>
-->
