<?php
if(isset($_POST['login']) && !empty($_POST['login'])){
	$email = $_POST['email'];
	$password = $_POST['password'];

	if(!empty($email) or !empty($password)){
		$email = $getFromU->checkInput($email);
		$password = $getFromU->checkInput($password);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$error = "Invalid formate";
		} else {
			If($getFromU->login($email, $password) === false){
				$error = "The email or password is incorrect";
			}
		}
	}else {
		$error = "Enter username and password!";
	
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
