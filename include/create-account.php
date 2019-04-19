<?php

// include 'class/DB.php';
if(isset($_POST['signup'])){
    $screenName = $_POST['screenName'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $errorb = '';

    if(empty($screenName) or empty($password) or empty($email)){
        $errorb = 'All feilds are required';
    }else {
        $email = $getFromU->checkInput($email);
        $screenName = $getFromU->checkInput($screenName);
        $password = $getFromU->checkInput($password);
        if(!filter_var($email)){
            $errorb = 'Invalid email format';
        } else if(strlen($screenName) > 20){
            $errorb = 'Name must be between in 6-20 character';
        }else if (strlen($password) < 5 && strlen($password) <=60){
            $errorb = 'Password is too short';
        } else {

            if((filter_var($email,FILTER_VALIDATE_EMAIL)) && $getFromU->checkEmail($email) === true){
                $errorb = 'Email is already in use!';
            }else{
                if(DB::query('SELECT username FROM users where username=:username', array(':username'=>$screenName))){
                    $errorb = 'Username is already in use!';
                } else {
                // $getFromU->register($email, $screenName, $password);
                // header('Location: home.php');
                $user_id = $getFromU->create('users', array('email' => $email, 'password' =>password_hash($password,PASSWORD_BCRYPT), 'username'=>$screenName, 'profileImage' =>'assets/images/defaultProfileImage.png','profileCover' =>'assets/images/defaultCoverImage.png'));
                $_SESSION['user_id'] = $user_id;
                // header('Location: includes/signup.php?step=1');
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
            }
        }
    }
}

?>


<div id="sign-up">

                <form method="POST">
                    <!--             <span id="signup">Sign Up</span>-->

                    <i class="material-icons" style="font-size:60px;">assignment_ind</i> <br>
                    <input type="text" name="screenName" value="" placeholder="Username">
                    <input type="email" name="email" value="" placeholder="Email">
                    <input type="password" name="password" placeholder="Password">
                    <br>
                   <!--  <input type="checkbox" value="Remember me">Remember me <br> -->
                    <input type="submit" name="signup" value="SignUp">
                </form>
                

               <?php
                    if(isset($errorb)){
                        echo '<div class="error">
                        '.$errorb.'
                        </div>';
                    }
                    ?>
               
            </div>