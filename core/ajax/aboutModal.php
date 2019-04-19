<?php
include 'class/login.php';
$showTimeline=False;
if(login::isLoggedIn()){
     $userid =login::isLoggedIn();
//    echo $userid;
     $showTimeline=True;
} else {
	header('Location: index.php');
}

include 'core/init.php';
$username = $getFromU->checkInput($_GET['username']);
$profileId = $getFromU->userIdByUsername($username);
$profileData = $getFromU->userData($profileId);
$user_id = login::isLoggedIn();

$user = $getFromU->userData($user_id);
echo'
    <form method="post" class="register">
        <h1>About You . . .</h1>
        <p>
            <fieldset class="row2">
                <legend>Personal Details
                </legend>

                <p>
                    <label>Home Address 
                    </label>
                    <input type="text" class="long" name="country" value="'.$user->country.'" onchange="this.form.submit();" />
                </p>
                <p>
                    <label>Present Address 
                    </label>
                    <input type="text" class="long" />
                </p>
                <p>
                    <label>School 
                    </label>
                    <input type="text" class="long" />
                </p>
                <p>
                    <label>College
                    </label>
                    <input type="text" class="long" />
                </p>
                <p>
                    <label>Graduated from
                    </label>
                    <input type="text" class="long" />
                </p>
                <p>
                    <label>Relationship Status</label>

                    <input type="radio" name="gender" value="male">
                    <label class="gender">Single</label>

                    <input type="radio" name="gender" value="female">
                    <label class="gender">Maried</label>
                    <input type="radio" name="gender" value="female">
                    <label class="gender">Complicated</label>

                </p>
                <p>
                    <label>Company
                    </label>
                    <input type="text" class="long" />
                </p>
                <p>
                    <label>About you
                    </label>
                    <textarea rows="4" cols="40" placeholder="Tell about yourself in brief">

</textarea>
                </p>


            </fieldset>
    </form>
' ?>
    <script>
        $(function() {
            $(".long").focusout(function() {

            })
        })

    </script>
