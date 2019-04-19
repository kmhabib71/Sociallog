<?php
include'class/DB.php';
// include'classes/mail.php';




//data colloect from from
if(isset($_POST['createaccount'])){
$username =$_POST['username'];
$password =$_POST['password'];
$email =$_POST['email'];
//usename not exist
if(!DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))){
	// usename character limitation
   if(strlen($username) >=3 && strlen($username) <=32){
   	if(preg_match('/[a-zA-Z0-9_]+/', $username)){
   		//password validation
   		if(strlen($password) >=6 && strlen($password) <=60){
   			//email validation
   		if(filter_var($email,FILTER_VALIDATE_EMAIL)){
   			//If email exist in database
   			if(!DB::query('SELECT email FROM users WHERE email=:email', array(':email'=>$email))){
   			//when everything is fine follwoing query have to execute
 DB::query('INSERT INTO users VALUES (0,:username, :password, :email,0,0)', array(':username'=>$username,':password'=>password_hash($password,PASSWORD_BCRYPT), ':email'=>$email));
 // mail::sendMail('Welcome to our social site','Your account has been created', $email);
 echo 'Success';
}else{
	echo 'Email in use!';
}
 }
 else{
 	echo 'Email is invalid';
 } 
}else{
 	echo'Incorrect password';
 }
} 
else{
	echo 'invalid username';
}
}else{
	echo 'Invalied username';
}
 	
 }
 else {
 	echo 'Username is already exist';
 }
}
?>


<h1>Register</h1>
<form action="create-account.php" method="post">
	<input type="text" name="username" value="" placeholder="Username..."><p/>
	<input type="password" name="password" value="" placeholder="Password...."><p/>
	<input type="email" name="email" value="" placeholder="someone@somesites.com"><p/>
	<input type="submit" name="createaccount" value="Create Account"> 
</form>