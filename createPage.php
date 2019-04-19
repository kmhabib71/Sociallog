<?php

 include 'core/init.php';

include 'class/login.php';
$showTimeline=False;
if(login::isLoggedIn()){
     $userid =login::isLoggedIn();
    
     $showTimeline=True;
} else {
	header('Location: index.php');
}
$user_id =login::isLoggedIn();

if(isset($_POST['pageLocalGo'])){
    $pageType = 'localBussiness';
    $pageName = $getFromU->checkInput($_POST['typeTextName']);
    $pageCategory = $_POST['mylocalselect'];
     $user_id =login::isLoggedIn();
    $fileRoot = $getFromU->uploadImage($_FILES['localFiles']);
      
    $getFromU->create('page', array('userID' => $user_id, 'pageName' => $pageName, 'profilePic' => $fileRoot,'pageType' => $pageType, 'pageCategory' => $pageCategory, 'createdOn' => date('Y-m-d H:i:s'))); 
    header('Location: /socialbd/page.php?userId='.$userid.'');
    
}

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <!--        <link rel="stylesheet" href="/mon.css">-->
        <!--        <link rel="stylesheet" href="/assets/css/home.css">-->
        <link type="text/css" rel="stylesheet" href="/socialbd/assets/css/home.css">
        <!--    <link rel="stylesheet" href="assets/css/home.css">-->

    </head>

    <body>
        <h3> Create Page</h3>
        <div class="typeHeader">Select type</div>
        <div class="pageType">

            <div class="typeItems1">
                <div class=" localBuss">
                    <div class=" typeItem localBusshead">Local Business Or place</div>
                    <div class="localBussDetails">
                        <form method="post" enctype="multipart/form-data">
                            <div class="pageName">
                                Page Name <br> <input type="text" name="typeTextName" class="typeTextName">
                            </div><br>
                            <div class="typeCat">Choose a category</div> <br>

                            <select class="myselect" name="mylocalselect">
                        <option value="Hotel">Hotel</option>
                        <option value="CarWash">Car wash</option>
                        <option value="Barber">Barber</option> </select><br> Upload a Profile Photo <br>
                            <div class="pageProWrap">
                                <span>Upload</span>
                                <input type="file" name="localFiles" class="pageProfilePhoto" />
                            </div><br>
                            <input type="submit" name="pageLocalGo" class="pageLocalGo" value="Enter">
                        </form>
                    </div>
                </div>
                <div class=" Company">
                    <div class=" typeItem localCompHead">Company, Organisation or Institution</div>
                    <div class="compDetails">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="pageName">
                                Page Name <br> <input type="text" name="typeName" class="typeTextName">
                            </div><br>
                            <div class="typeCat">Choose a category</div> <br>

                            <select class="myselect">
                        <option value="1">Hotel</option>
                        <option value="2">Car wash</option>
                        <option value="3">Barber</option> </select><br> Upload a Profile Photo <br>
                            <div class="pageProWrap">
                                <span>Upload</span>
                                <input type="file" name="files" class="pageProfilePhoto" />
                            </div><br>
                            <input type="submit" name="pagePhoto" class="pageGo" value="Enter">
                        </form>
                    </div>
                </div>
            </div>
            <div class="typeItems2">
                <div class=" Artist">
                    <div class=" typeItem localArtHead">Artist, Band Or Public Figure</div>
                    <div class="artDetails">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="pageName">
                                Page Name <br> <input type="text" name="typeName" class="typeTextName">
                            </div><br>
                            <div class="typeCat">Choose a category</div> <br>

                            <select class="myselect">
                        <option value="1">Hotel</option>
                        <option value="2">Car wash</option>
                        <option value="3">Barber</option> </select><br> Upload a Profile Photo <br>
                            <div class="pageProWrap">
                                <span>Upload</span>
                                <input type="file" name="files" class="pageProfilePhoto" />
                            </div><br>
                            <input type="submit" name="pagePhoto" class="pageGo" value="Enter">
                        </form>
                    </div>
                </div>
                <div class="Intertainment">
                    <div class=" typeItem localEntHead">Intertainment</div>
                </div>
                <div class="entertainmentDetails">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="pageName">
                            Page Name <br> <input type="text" name="typeName" class="typeTextName">
                        </div><br>
                        <div class="typeCat">Choose a category</div> <br>

                        <select class="myselect">
                        <option value="1">Hotel</option>
                        <option value="2">Car wash</option>
                        <option value="3">Barber</option> </select><br> Upload a Profile Photo <br>
                        <div class="pageProWrap">
                            <span>Upload</span>
                            <input type="file" name="files" class="pageProfilePhoto" />
                        </div><br>
                        <input type="submit" name="pagePhoto" class="pageGo" value="Enter">
                    </form>
                </div>
            </div>
        </div>
        <script src="/socialbd/assets/js/jquery.js">


        </script>
        <script>
            $(function() {
                $(document).on('click', '.localBusshead', function() {
                    $('.localBussDetails').slideToggle();
                });
                $(document).on('click', '.localEntHead', function() {
                    $('.entertainmentDetails').slideToggle();
                });
                $(document).on('click', '.localArtHead', function() {
                    $('.artDetails').slideToggle();
                });
                $(document).on('click', '.localCompHead', function() {
                    $('.compDetails').slideToggle();
                });


            });

        </script>
    </body>

    </html>
