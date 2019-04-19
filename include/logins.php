<?php
// include'class/DB.php';
//data colloect from from
if(isset($_POST['login'])){
$email=$_POST['email'];
$password=$_POST['password'];
//userid and password login part

if(DB::query('SELECT email FROM users WHERE email=:email', array(':email'=>$email))){
    
		if(password_verify($password, DB::query('SELECT password FROM users WHERE email=:email',array(':email'=>$email))[0]['password'])){
			echo'logged in!';
			// token part
			//creating or generate token
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
		}
		
		else{
			echo'Incorrect users';
		}

}else{
	echo'User not registered';
}
}


?>

<form method="POST">
                        <span id="signin">Sign in</span>
                        <input type="email" name="email" value="" placeholder="Enter Email...">
                        <input type="password" name="password" placeholder="Password...">
                        <input type="submit" name="login" value="Login">
                    </form>
                    <?php
                    if(isset($error)){
                    	echo '<div class="error">
                    	'.$error.'
                        </div>';
                    }
                    ?>
               
                   
                  