<?php
// include 'core/init.php';
// echo $_SESSION['user_id'];
 
if(isset($_GET['userId']) === true && empty($_GET['userId']) === false){
include 'class/login.php'; include 'core/init.php';
$userID = $username = $getFromU->checkInput($_GET['userId']);
//    echo $userID;
//    include 'class/login.php';
//include 'core/init.php';

$user_id = login::isLoggedIn();
//    echo $user_id;
 $showTimeline=False;
if(login::isLoggedIn()){
//     $userid =login::isLoggedIn();
//    echo $userid;
     $showTimeline=True;
} else {
	header('Location: index.php');
}   
$user = $getFromU->userData($userID);
$postUser = $getFromU->userData($user_id);
$pageInfo = $getFromP->lastPageInfo($userID);
    $pageInformation = json_encode($pageInfo);
//    echo $pageInformation;
}
////.............Page POST.................//
//$rand=rand();
//      $rando=rand();
//   $_SESSION['rand']=$rand;
//   $_SESSION['rando']=$rando;
//        $ImageId = $_SESSION['rand'];         
//        $ImageIdo = $_SESSION['rando'];
////        echo ''.$ImageId+$ImageIdo.'<br>' ;
////        echo $ImageIdo;
//        
//if(isset($_POST['page_post'])){
//	$status = $getFromU->checkInput($_POST['pageTextarea']);
//	$tweetImage = '';
//
//	if(!empty($status) OR !empty($_FILES['files'])){
////		if(!empty($_FILES['files'])){
////			$tweetImage = $getFromU->multiImage($_FILES['files']);
//            
////		}
//        if(isset($_FILES["files"])){
//
//
//$errors = array();
//$uploadedFiles = array();
//$extension = array("jpeg","jpg","png","gif","JPG");
//$bytes = 1024;
//$KB = 1024;
//$totalBytes = $bytes * $KB;
//$UploadFolder = "postUser";
// 
//$counter = 0;
// 
//foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name){
//    $temp = $_FILES["files"]["tmp_name"][$key];
//    $name = $_FILES["files"]["name"][$key];
//     
//    if(empty($temp))
//    {
//        break;
//    }
//     
//    $counter++;
//    $UploadOk = true;
//     
//    if($_FILES["files"]["size"][$key] > $totalBytes)
//    {
//        $UploadOk = false;
//        array_push($errors, $name." file size is larger than the 1 MB.");
//    }
//     
//    $ext = pathinfo($name, PATHINFO_EXTENSION);
//    if(in_array($ext, $extension) == false){
//        $UploadOk = false;
//        array_push($errors, $name." is invalid file type.");
//    }
//     
////    if(file_exists($UploadFolder."/".$name) == true){
////        $UploadOk = false;
////        array_push($errors, $name." file is already exist.");
////    }
//     
//    if($UploadOk == true){
//        move_uploaded_file($temp,$UploadFolder."/".$name);
//        array_push($uploadedFiles, $name);
//        $fileRoot = 'postUser/' . $name;
////         $getFromU->create('tweets', array('tweetBy' => $user_id, 'tweetImage' => $fileRoot, 'postedOn' => date('Y-m-d H:i:s')));
//        $tweetImage =  $fileRoot;
//        
//        
//		if(strlen($status) > 1040){
//			$error = "The tweet text is too long";
//			header('Location: '.BASE_URL.'home.php');
//		}else{
//		$tweet_id = $getFromU->create('pagepost', array('pagePost' => $status, 'userID' => $user_id, 'pageImage' => $tweetImage, 'pageImageID' => $ImageId, 'postedOn' => date('Y-m-d H:i:s')));
//		preg_match_all("/#+([a-zA-Z0-9_]+)/i",$status, $hashtag);
//            if(!empty($hashtag)){
//                $getFromT->addTrend($status);
//            }
////			preg_match_all("/#+([a-zA-Z0-9_]+)/i", $status, $hashtag); // if(!empty($hashtag)){ // $getFromT->addTrend($status); // } // $getFromT->addMention($status, $user_id, $tweet_id);
//
//		}
//    }
//}
// 
//if($counter>0){
//    if(count($errors)>0)
//    {
//        echo "<b>Errors:</b>";
//        echo "<br/><ul>";
//        foreach($errors as $error)
//        {
//            echo "<li>".$error."</li>";
//        }
//        echo "</ul><br/>";
//    }
//     
//    if(count($uploadedFiles)>0){
//        echo "<b>Uploaded Files:</b>";
//        echo "<br/><ul>";
//        foreach($uploadedFiles as $fileName)
//        {
//            echo "<li>".$fileName."</li>";
//        }
//        echo "</ul><br/>";
//         
//        echo count($uploadedFiles)." file(s) are successfully uploaded.";
//    }
////    return $fileRoot;
//}
//else{
//    $tweet_id = $getFromU->create('pagepost', array('pagePost' => $status, 'userID' => $user_id, 'postedOn' => date('Y-m-d H:i:s')));
//		preg_match_all("/#+([a-zA-Z0-9_]+)/i",$status, $hashtag);
//            if(!empty($hashtag)){
//                $getFromT->addTrend($status);
//            };
//}
//}
//        
//    
//        
//	} else {
//		$error = "Type or choose image to tweet";
//	}
//}
//    
//}




?>

    <!doctype html>
    <html lang="en">
    <title>SOCIALBD</title>
    <link rel="stylesheet" href="/socialbd/assets/css/fw/css/font-awesome.css">
    <!--    <i class="fa fa-linode" aria-hidden="true"></i>-->
    <!--    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
    <!--      <i class="material-icons" style="font-size:60px;color:red;">cloud</i>-->
    <!--      <i class="material-icons">face</i>-->
    <link rel="stylesheet" href="/socialbd/assets/css/home.css">
    <link rel="stylesheet" href="/socialbd/assets/css/page.css">
    <!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />-->

    <style>


    </style>

    <body>

        <header id="pageHeader">

            <div id="brand-search">
                <div class="brand">
                    <h2>Socialbd</h2>
                </div>

                <div class="search">
                    <!--                    <img src="assets/img/searchicon.png" alt="">-->

                    <input class="searchh" type="text" placeholder="Search..." />

                    <div class="search-result">



                    </div>

                </div>



            </div>
            <div class="rightside">
                <div class="menu"></div>
                <ul>
                    <li><a href="<?php BASE_URL ?>home.php">Home</a></li>
                    <li>Inside</li>
                    <li>Message</li>
                    <li>Notification</li>
                </ul>
                <div class="user-cover">
                    <div class="user user-click"><img src="<?php echo BASE_URL. $user->profileImage; ?>" alt="">
                        <div class="user-details">
                            <a href="<?php echo $user->username; ?>"><?php echo $user->username; ?></a>
                            <br/> Settings<br/> <a href="logout.php">logout</a>
                        </div>
                    </div>

                </div>

            </div>
        </header>
        <main class="pageCont">
            <div class="pageContainer">
                <div class="pageCoverPhoto">
                    <div class="pageCovPhHolder">

                        <img src="<?php echo  $pageInfo->coverPhoto;  ?>" alt="">
                    </div>
                </div>
                <div class="pageProfilePic">
                    <div class="pageProfileHolder">
                        <img src="<?php echo $pageInfo->profilePic;  ?>" alt="">
                    </div>
                </div>
                <div class="pageProfileBar">
                    <div>About</div>
                    <div>Action</div>
                </div>
                <div class="pageBody">

                </div>

            </div>
            <div class="pageMainBody">
                <div class="pageNavigation">bvb Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque, in. Quam, assumenda dolore voluptatem veritatis eos vel unde exercitationem dolores placeat atque porro qui nobis, soluta architecto explicabo tempora ipsum eaque obcaecati debitis veniam itaque facilis voluptatum vero. Repudiandae omnis ducimus accusamus excepturi, esse. Libero porro reiciendis dolores aspernatur laborum.</div>
                <div class="pagePost">
                    <div class="pagePosta">
                        <div class="textInput">
                            <form id="postFormSubmit" method="post" enctype="multipart/form-data">
                                <div class="pageTextBox">

                                    <textarea name="pageTextarea" id="pageTextarea" cols="10" rows="8"></textarea>
                                </div>
                                <div class="pageImage">
                                    <input type="file" name="files[]" multiple="multiple" id="pageImgUp" />
                                    <input type="hidden" name="hiddenProImage" id="hiddenProImage" value="<?php echo $postUser->profileImage ?>">
                                    <input type="hidden" name="pageID" id="pageID" value="<?php echo $pageInfo->pageID; ?>">
                                    <input type="submit" name="page_post" value="POST" class="pageTextPost" id="pageSubmit" style="padding: 5px 10px; box-shadow: 0px 0px 5px green; background-color: lightgray;border: none; ">
                                </div>

                            </form>
                        </div>
                        <!--                        <hr>-->
                    </div>
                    <ul>
                        <div class="pagePostAre">

                        </div>
                        <div class="existingPagePost">
                            <?php $getFromP->existingPagePost($pageInfo->pageID, $user_id);  ?>

                        </div>
                    </ul>
                </div>
                <div class="pageRightPost">gfg</div>
            </div>

        </main>
        <?php $name = $user->username;
        ?>
    </body>
    <script src="assets/js/jquery-3.1.1.js"></script>
    <script src="assets/js/search.js"></script>
    <script src="assets/js/hashtag.js"></script>
    <script src="assets/js/like.js"></script>
    <script src="assets/js/retweet.js"></script>
    <!--    <script src="assets/js/comment.js"></script>-->
    <script src="assets/js/pageCom2.js"></script>
    <script src="assets/js/postOption.js"></script>
    <script src="assets/js/pageDelete.js"></script>
    <script src="assets/js/popupImage.js"></script>
    <script src="assets/js/pageReply.js"></script>
    <script src="assets/js/replyComplex.js"></script>
    <script src="assets/js/member.js"></script>
    <script src="assets/js/pageReact.js"></script>
    <script src="assets/js/message.js"></script>
    <script>
        class HTTP {
            async post(url, datA, file) {
                const response = await fetch(url, {
                    method: 'POST',
                    //                    headers: {
                    //                        'Content-type': 'application/json'
                    //                    },
                    body: {
                        dataa: datA,
                        datbb: file
                    }
                });

                //                const resData = await response.json();
                //                return resData;

            }
        }
        const ItemCtrl = (function() {
            const Item = function(text, image) {

            }
        })();
        const UICtrl = (function() {
            const UISelectors = {
                postText: '#pageTextarea',
                pageImgUp: '#pageImgUp',
                pageSubmit: '#pageSubmit',
                finalPost: '.pagePostAre',
                postForm: '#postFormSubmit'
            }
            return {
                populatePost: function(input) {
                    let html = '';
                    html += `${input.pagePostTextVal}`;
                    document.querySelector(UISelectors.finalPost).innerHTML = html;
                },
                addPost: function(post) {
                    const li = document.createElement('li');
                    li.className = 'single_post';
                    li.innerHTML = `<div class="pagePostTopSec" style="
    display:  flex; flex-direction:row;    align-items: center; font-size:12px; justify-content: space-between;
">
                            <div class="user"><img src="<?php echo $user->profileImage; ?>" alt=""></div>
                            <div class="pageStatusHead">Update His page Status</div>
                            <div class="pageStatusOpt">...</div>
                        </div>
                        <div class="pagePostMidSec">
                        ${post.pagePostTextVal}
                        </div>
                        <hr>
                        <div class="pagePostBottomSec">
                            Smile..Angry...Shy
                        </div></br>`;
                    document.querySelector(UISelectors.finalPost).insertAdjacentElement('afterbegin', li)
                },

                getPostInput: function() {
                    return {
                        pagePostTextVal: document.querySelector(UISelectors.postText).value,
                        pageImageVal: document.querySelector(UISelectors.pageImgUp).value,
                    }
                },

                getSelectors: function() {
                    return UISelectors;
                }
            }
        })();
        const App = (function(ItemCtrl, UICtrl) {
            const loadEventListeners = function() {
                const UISelectors = UICtrl.getSelectors();

                //                document.querySelector(UISelectors.postForm).addEventListener('click', postAjaxSubmit);
            }
            const postSubmit = function(e) {
                e.preventDefault();
                //                alert('Hello world');

                const input = UICtrl.getPostInput();
                //                console.log(input.serialize());
                //                console.log(input.pagePostTextVal, input.pageImageVal);
                const datA = input.pagePostTextVal;
                const file = input.pageImageVal;
                console.log(datA, file);
                UICtrl.addPost(input);

                const http = new HTTP();
                $.post('http://localhost/socialbd/core/ajax/page.php', {
                    datA: datA,
                    file: file,
                }, function(data) {
                    $('.pageStatusOpt').html(data);
                    //           $('#comment_content').val("");
                    //		$('#comment_id').val('0');
                    //        load_comment();


                });

                //                        http.post('http://localhost/socialbd/core/ajax/page.php', datA, datB).then(data => { // // ui.showAlert('Post added', 'alert alert-success'); // ui.clearFields(); // getPosts(); }) .catch(err => console.log(err)); // // // 
            }
            return {
                init: function() {
                    loadEventListeners();

                }
            }

        })(ItemCtrl, UICtrl);
        App.init();

        //
        //
        //        $('#pageImgUp').change(function() {
        //            var error_images = '';
        //
        //            var form_data = new FormData(this);
        //
        //            var files = $('#pageImgUp')[0].files;
        //            console.log(files);
        //            if (files.length > 10) {
        //                error_images += 'You can not select more than 10 files';
        //            } else {
        //                for (var i = 0; i < files.length; i++) {
        //                    var name = document.getElementById("pageImgUp").files[i].name;
        //
        //                    //                    console.log(name);
        //
        //                    var ext = name.split('.').pop().toLowerCase();
        //
        //                    if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
        //                        error_images += '<p>Invalid ' + i + ' File</p>';
        //                    }
        //
        //                    var oFReader = new FileReader();
        //
        //                    oFReader.readAsDataURL(document.getElementById("pageImgUp").files[i]);
        //                    var f = document.getElementById("pageImgUp").files[i];
        //
        //                    var fsize = f.size || f.fileSize;
        //                    if (fsize > 2000000) {
        //                        error_images += '<p>' + i + ' File Size is very big</p>';
        //                    } else {
        //                        form_data.append("file[]", document.getElementById('pageImgUp').files[i]);
        //
        //
        //                    }
        //                }
        //            }
        //        });



        function sendPost() {
            $('#postFormSubmit').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "http://localhost/socialbd/core/ajax/page.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,

                    success: function(data) {
                        $(".pagePostAre").prepend(data);
                        $("#pageTextarea").val("");
                        $("#pageImgUp").val("");

                        //                    alert("Image Uploaded");
                    }


                });
            });
        };
        sendPost();


        //      $('#postFormSubmit').on('submit', function(e) { // e.preventDefault(); // sendPost(); // });

    </script>

    </html>
