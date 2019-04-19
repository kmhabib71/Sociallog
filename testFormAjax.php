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

$user_id = login::isLoggedIn();

$user = $getFromU->userData($user_id);
//if(isset($_POST['currentCity'])){ // $currentCity = $getFromU->checkInput($_POST['currentCity']); // $getFromU->update('users', $user_id, array('currentCity' => $currentCity)); // //header('Location: Refresh:0'); // // //}
echo'
<div class="about-details">

            <div class="register">
                <h1>About you</h1>
            </div>
            <legend>Basic Info
            </legend>
            <form method="post">
           
                <div class="currentCity-bo">
            <div class="currentCity-details  about-box">
                <div class="about-label">
                    Current City:
                </div>

                <div class="currentCity  about-info">
                    '.$user->currentCity.'
                </div>
                
                <div class="currentCity-input about-form">

                    <input type="text" id="currentCityInput" name="currentCity" value="'.$user->currentCity.'" />
                </div>
                
            </div>
           
                <div class="currentiCity-changed">
                    <p>Current City Status Changed successfully</p>
                </div>
        </div>
                <hr>
                <div class="homeTown-bo">
                    <div class="currentCity-details  about-box">
                        <div class="about-label">
                            Home Town:
                        </div>
                        <div class="homeTown about-info">
                            '.$user->homeTown.'
                        </div>
                        <div class=" homeTown-input about-form">
                            <input type="text" id="homeTownInput" name="homeTown" value="'.$user->homeTown.'" />
                        </div>
                    </div>
                    <div class="homeTown-changed">
                        <p>Home Town Status Changed successfully</p>
                    </div>
                </div>

                <hr class="about-devider">
                <div class="Gender-bo">
                    <div class="currentCity-details  about-box">
                        <div class="about-label">
                            Gender:
                        </div>
                        <div class="Gender about-info">
                            '.$user->gender.'
                        </div>

                        <div class="Gender-input about-form">
                        <div id="genderInput">
                            <input type="radio" name="gender" value="male"> Male
                            <input type="radio" name="gender" value="female"> Female
                            <input type="radio" name="gender" value="other"> Other</div>
                            </div>
                    </div>
                    <div class="gender-changed">
                        <p>Gender Status Changed successfully</p>
                    </div>
                </div>
                <hr>
                <div class="Birthday-bo">
                    <div class="currentCity-details  about-box">
                        <div class="about-label">
                            Birthday:
                        </div>
                        <div class="birthday about-info">
                            '.$user->birthday.'

                        </div>
                        <div class="birthday-input about-form">
                            <input type="date" name="birthday" id="date-input" value="'.$user->birthday.'" />
                        </div>
                    </div>
                    <div class="birthday-changed">
                        <p>Birthday Status Changed successfully</p>
                    </div>
                </div>
                <hr>
                <div class="Language-bo">
                    <div class="currentCity-details  about-box">
                        <div class="about-label">
                            Language:
                        </div>
                        <div class="language about-info">
                            '.$user->language.'

                        </div>
                        <div class="language-input about-form">
                            <input type="text" name="language" id="languageInput" value="'.$user->language.'" />
                        </div>
                    </div>
                    <div class="language-changed">
                        <p>Current City Status Changed successfully</p>
                    </div>
                </div>
                <hr>
                <div class="Religion-bo">

                    <div class="currentCity-details  about-box">
                        <div class="about-label">
                            Releigion holding:
                        </div>
                        <div class="religion about-info">
                            '.$user->religion.'

                        </div>
                        <div class="religion-input about-form">
                            <input type="text" id="religionInput" name="religion" value="'.$user->religion.'" />
                        </div>

                    </div>
                    <div class="religion-changed">
                        <p>Current City Status Changed successfully</p>
                    </div>
                </div>
                <hr>
                <div class="currentCity-details  about-box">
                    <div class="about-label">
                        Relationship Status:
                    </div>
                    <div class="relationShipStatus about-info">
                        '.$user->relationShipStatus.'

                    </div>
                    <div class="relationShipStatus-input about-form">
                    <select id="myselect">
                        <option value="1">Single</option>
                        <option value="2">Married</option>
                        <option value="3">Complicated</option>
                        
                    </select>
                    </div>
                    <div class="relation-changed">
                        <p>Relation Status Changed successfully</p>
                    </div>
                </div>




                <hr class="about-devider">
            </form>
            <div class="about"></div>
        </div>
        
';
echo $user->currentCity;
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="assets/css/home.css">
        <link rel="stylesheet" href="mon.css">
    </head>

    <body>


        <script src="assets/js/jquery-3.1.1.js">


        </script>
        <script>
            $(function() {
                $(".currentCity").click(function() {
                    $(this).hide();
                    $(".currentCity-input").show();
                });
                $(".homeTown").click(function() {
                    $(this).hide();
                    $(".homeTown-input").show();
                });
                $(".Gender").click(function() {
                    $(this).hide();
                    $(".Gender-input").show();
                });
                $(".birthday").click(function() {
                    $(this).hide();
                    $(".birthday-input").show();
                });
                $(".language").click(function() {
                    $(this).hide();
                    $(".language-input").show();
                });
                $(".religion").click(function() {
                    $(this).hide();
                    $(".religion-input").show();
                });
                $(".relationShipStatus").click(function() {
                    $(this).hide();
                    $(".relationShipStatus-input").show();
                });
                $("#currentCityInput").focusout(function() {

                    $(".currentCity").hide()
                    var cityInput = $("#currentCityInput").val();
if(cityInput != <?php  echo $user->currentCity;  ?> ){
                    $.post('http://localhost/socialbd/core/ajax/aboutLiveEdit.php', {
                        cityInputt: cityInput
                    }, function(data) {
                        $(".currentCity-ajax").html(data);
                        $(".currentiCity-changed").show();
                    });
}
                });
                $("#homeTownInput").focusout(function() {

                    $(".homeTown").hide()
                    var homeTown = $("#homeTownInput").val();

                    $.post('http://localhost/socialbd/core/ajax/aboutLiveEdit.php', {
                        homeTownn: homeTown
                    }, function(data) {
                        $(".currentCity-ajax").html(data);
                        $(".homeTown-changed").show();
                    });
                });
                $("input[type='radio']").click(function() {
                    //                    $(".Gender").hide()
                    var radioValue = $("input[name='gender']:checked").val();
                    $.post('http://localhost/socialbd/core/ajax/aboutLiveEdit.php', {
                        radioValuee: radioValue
                    }, function(data) {

                        $(".GenderAjax").html(data);
                        $(".gender-changed").show();



                    });

                });
                $("#date-input").focusout(function() {
                    $(".birthday").hide()
                    var date = new Date($('#date-input').val());
                    day = date.getDate();
                    month = date.getMonth() + 1;
                    year = date.getFullYear();
                    var birthday = ([year, month, day].join('-'));
                    alert(birthday);
                    $.post('http://localhost/socialbd/core/ajax/aboutLiveEdit.php', {
                        birthdayy: birthday
                    }, function(data) {

                        $(".GenderrAjax").html(data);
                        $(".birthday-changed").show();



                    });

                });
                $("#languageInput").focusout(function() {

                    $(".language").hide()
                    var language = $("#languageInput").val();

                    $.post('http://localhost/socialbd/core/ajax/aboutLiveEdit.php', {
                        languagee: language
                    }, function(data) {
                        $(".currentCity-ajax").html(data);
                        $(".language-changed").show();
                    });
                });
                $("#religionInput").focusout(function() {

                    $(".religion").hide()
                    var religion = $("#religionInput").val();

                    $.post('http://localhost/socialbd/core/ajax/aboutLiveEdit.php', {
                        religionn: religion
                    }, function(data) {
                        $(".currentCity-ajax").html(data);
                        $(".religion-changed").show();
                    });
                });
                $(".relationShipStatus-input").focusout(function() {
                    //                    $(".Gender").hide()
                    var relation = $("#myselect option:selected").text();
                    //                    alert(relation);
                    $.post('http://localhost/socialbd/core/ajax/aboutLiveEdit.php', {
                        relationn: relation
                    }, function(data) {

                        $(".GendercsAjax").html(data);
                        $(".relation-changed").show();



                    });

                });
            });

        </script>
    
    </body>

    </html>
