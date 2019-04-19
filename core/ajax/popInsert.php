<?php
include '../init.php';
    include '../../class/login.php';
    $user_id = login::isLoggedIn();
//add_comment.php
//$connect = new PDO('mysql:host=localhost;dbname=socialbd', 'root', '');
if(isset($_POST['comment']) && !empty($_POST['comment'])){
//$comment_content = $getFromU->checkInput($_POST['comment']);
//$commentID = $_POST["comment_id"];
	$comment_content = $_POST['comment'];


$commentID = $_POST["comment_idd"];
 $tweetID = $_POST['tweet_id'];
//    $tweetID = $_POST['tweetID'];
    
//$error = '';
//$comment_name = '';
//$comment_content = '';
//if(empty($_POST["comment_name"]))
//{
//	$error .= '<p class ="text-danger"> Name is requered</p>';
//}
//else 
//{
//	$comment_name = $_POST["comment_name"];
//}


    $getFromU->create('comments', array('comment_parent_id' => $commentID,'comment' => $comment_content, 'commentOn'=> '243', 'commentBy' => $user_id, 'commentAt' => date('Y-m-d H:i:s')));
    
    
    
    
//	$query = " INSERT INTO comments (parent_comment_id, comment, comment_sender_name) VALUES (:parent_comment_id, :comment, :comment_sender_name)";
//	$statement = $connect->prepare($query);
//	$statement->execute(array(
//		':parent_comment_id' => $_POST["comment_id"],
//		':comment'   => $comment_content,
//		':comment_sender_name' => $comment_name
//	)
//);


}else {
    echo 'paowa jaini';
}
// $connect = new PDO('mysql:host=localhost;dbname=comment', 'root', '');

// $error = '';
// $comment_name = '';
// $comment_content = '';

// if(empty($_POST["comment_name"]))
// {
//  $error .= '<p class="text-danger">Name is required</p>';
// }
// else
// {
//  $comment_name = $_POST["comment_name"];
// }

// if(empty($_POST["comment_content"]))
// {
//  $error .= '<p class="text-danger">Comment is required</p>';
// }
// else
// {
//  $comment_content = $_POST["comment_content"];
// }

// if($error == '')
// {
//  $query = "
//  INSERT INTO tbl_comment 
//  (parent_comment_id, comment, comment_sender_name) 
//  VALUES (:parent_comment_id, :comment, :comment_sender_name)
//  ";
//  $statement = $connect->prepare($query);
//  $statement->execute(
//   array(
//    ':parent_comment_id' => $_POST["comment_id"],
//    ':comment'    => $comment_content,
//    ':comment_sender_name' => $comment_name
//   )
//  );
//  $error = '<label class="text-success">Comment Added</label>';
// }

// $data = array(
//  'error'  => $error
// );

// echo json_encode($data);

?>
