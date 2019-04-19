<?php
// include'class/DB.php';
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
 DB::query('INSERT INTO users VALUES (0,:username,:email,:password,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0)', array(':username'=>$username,':password'=>password_hash($password,PASSWORD_BCRYPT), ':email'=>$email));
 // mail::sendMail('Welcome to our social site','Your account has been created', $email);
 $cstrong = true;
                $token=bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                //select userid from databse
                $user_id=DB::query('SELECT user_id FROM users WHERE email=:email', array(':email'=>$email))[0]['user_id'];
                //put token and userid in databse
            DB::query('INSERT INTO login_tokens VALUES(0, :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
            // set cookies to computer for logged in snid=cookies name, $token = cookie token, time=how much time cookie active for login, 2nd NULL = cause we dont have ssl, if have then use true, true=for crose site scripting.

            //set cookie valid for 7 days
            setcookie('SNID', $token, time()+60*60*24*7,'/',NULL, NULL, true);
            //set cookie valid for 3 days and goto index page for config
            setcookie('SNID_', $token, time()+60*60*24*3,'/',NULL, NULL, true);
            
                header('Location: home.php');

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
<div id="sign-up">

                <form method="POST">
                    <!--             <span id="signup">Sign Up</span>-->

                    <i class="material-icons" style="font-size:60px;">assignment_ind</i> <br>
                    <input type="text" name="username" value="" placeholder="Username">
                    <input type="email" name="email" value="" placeholder="Email">
                    <input type="password" name="password" placeholder="Password">
                    <br>
                   <!--  <input type="checkbox" value="Remember me">Remember me <br> -->
                    <input type="submit" name="createaccount" value="SignUp">
                </form>
                

               <?php
                    if(isset($errorb)){
                        echo '<div class="error">
                        '.$errorb.'
                        </div>';
                    }
                    ?>
               
            </div>