<?php

//fetch_comment.php

// $connect = new PDO('mysql:host=localhost;dbname=comment', 'root', '');

// $query = "SELECT * FROM tbl_comment WHERE parent_comment_id='0' ORDER BY `date` DESC";

// $statement = $connect->prepare($query);
// $statement->execute();
// $result = $statement->fetchAll();
// $output = '';
// foreach($result as $row){
//   $output.='
//   <div class="panel panel-default">
//      <div class="panel-heading">By<b>'.$row["comment_sender_name"].'
//      </b> on <i>'.$row["date"].'</i></div>
//     <div class="panel-body">'.$row["comment"].' </div>
//     <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">
//     Reply</button></div>
//      </div>';
//      $output .= get_reply_comment($connect, $row["comment_id"]);
// }
// echo $output;

// function get_reply_comment($connect, $parent_id = 0, $marginleft = 0){
//   $query ="SELECT * FROM tbl_comment WHERE parent_comment_id ='".$parent_id."'";
//   $statement = $connect->prepare($query);
//   $statement->execute();
//   $result = $statement->fetchAll();
//   $count = $statement->rowCount();
//   if($parent_id == 0){
//     $marginleft = 0;
//   }else{
//     $marginleft = $marginleft + 48;
//   };
//    $output = '';
//   if($count > 0){
//     foreach ($result as $row){
//       $output .='<div class="panel panel-default" style="margin-left:'.$marginleft.'px">
//         <div class="panel-heading">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
//         <div class="panel-body">'.$row["comment"].'</div>
//         <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">
//     Reply</button></div>
//       </div>';
//       $output .= get_reply_comment($connect, $row["comment_id"], $marginleft);
//     }
//   }
//   return $output;
// }
//include '../init.php';
//    include '../../class/login.php';
//    $user_id = login::isLoggedIn();
$connect = new PDO('mysql:host=localhost;dbname=socialbd', 'root', '');
if(isset($_POST['showpopup']) && !empty($_POST['showpopup'])){
//    echo' hello';
$tweetID = $_POST['showpopup'];
  $output = '';  


/////////////
 


//echo $output;

function get_reply_comment($connect, $tweetID, $parent_id = 0, $marginleft = 0)
{
 $query = " SELECT * FROM `comments` LEFT JOIN `users` ON `commentBy` = `user_id` WHERE `commentOn` = '".$tweetID."' AND comment_parent_id = '".$parent_id."'";
 $output = '';
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $count = $statement->rowCount();
 if($parent_id == 0)
 {
  $marginleft = 0;
 }
 else
 {
  $marginleft = $marginleft + 48;
 }
 if($count > 0)
 {
  foreach($result as $row)
  {
   $output .='
   <div class="panel panel-default" style="margin-left:'.$marginleft.'px">
    <div class="panel-heading">By <b>'.$row["username"].'</b> on </div>
    <div class="panel-body">'.$row["comment"].'</div>
    <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["commentID"].'">Reply</button></div>
   </div>
   ';
   $output .= get_reply_comment($connect, $row["commentID"], $marginleft);
      

  }
 }
 return $output;
}
    
    $query = "SELECT * FROM `comments` LEFT JOIN `users` ON `commentBy` = `user_id` WHERE `commentOn` = '".$tweetID."' AND comment_parent_id = '0'";

 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $output = '';
 foreach($result as $row){
   $output.='
   <div class="panel panel-default" >
    <div class="panel-heading">By <b>'.$row["username"].'</b> on </div>
    <div class="panel-body">'.$row["comment"].'</div>
    <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["commentID"].'">Reply</button></div>
   </div>
   ';
      $output .= get_reply_comment($connect, $row["commentID"]);
 }
 echo $output;
//      $output .= get_reply_comment($connect,$tweetID);
//    echo $output;
    
}
?>
