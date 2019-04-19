<?php 
include '../../core/init.php';
include '../../class/login.php';
$showTimeline=False;
if(login::isLoggedIn()){
     $userid =login::isLoggedIn();
//    echo $userid;
     $showTimeline=True;
} else {
	header('Location: index.php');
}



$user_id = login::isLoggedIn();


if(isset($_POST['cityInputt'])){
    if(!empty($_POST['cityInputt'])){
    $currentCity = $getFromU->checkInput($_POST['cityInputt']);
    $getFromU->update('users', $user_id, array('currentCity' => $currentCity));
        $user = $getFromU->userData($user_id);
  echo $user->currentCity;
}else{
   echo 'not done';
 }
}else if(isset($_POST['homeTownn'])){
        if(!empty($_POST['homeTownn'])){
    $homeTownn = $getFromU->checkInput($_POST['homeTownn']);
    $getFromU->update('users', $user_id, array('homeTown' => $homeTownn));
  echo $user->homeTown;
}else{
    die('No connection');
}
    }else if(isset($_POST['radioValuee'])){
        if(!empty($_POST['radioValuee'])){
    $radioValuee = $getFromU->checkInput($_POST['radioValuee']);
    $getFromU->update('users', $user_id, array('gender' => $radioValuee));
  echo $user->gender;
}else{
    die('No connection');
}
    }else if(isset($_POST['birthdayy'])){
        if(!empty($_POST['birthdayy'])){
    $birthdayy = $getFromU->checkInput($_POST['birthdayy']);
    $getFromU->update('users', $user_id, array('birthday' => $birthdayy));
  echo $user->birthday;
}else{
    die('No connection');
}
    }else if(isset($_POST['languagee'])){
        if(!empty($_POST['languagee'])){
    $languagee = $getFromU->checkInput($_POST['languagee']);
    $getFromU->update('users', $user_id, array('language' => $languagee));
  echo $user->language;
}else{
    die('No connection');
}
    }else if(isset($_POST['religionn'])){
        if(!empty($_POST['religionn'])){
    $religionn = $getFromU->checkInput($_POST['religionn']);
    $getFromU->update('users', $user_id, array('religion' => $religionn));
  echo $user->religion;
}else{
    die('No connection');
}
    }else if(isset($_POST['relationn'])){
        if(!empty($_POST['relationn'])){
    $relationn = $getFromU->checkInput($_POST['relationn']);
    $getFromU->update('users', $user_id, array('relationShipStatus' => $relationn));
  echo $user->relationShipStatus;
}else{
    die('No connection');
}
    }


?>
