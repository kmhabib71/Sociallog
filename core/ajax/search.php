<?php 
include '../init.php';

if(isset($_POST['searchh']) && !empty($_POST['searchh'])){
	$search = $getFromU->checkInput($_POST['searchh']);
	$result = $getFromU->search($search);
 if(!empty($result)){
  echo '<div class="search-result-details">'; 
	foreach($result as $user){
		echo '
        <a href="#">
            <div class="search-people">
                <div class="search-image"><img src="'.BASE_URL.$user->profileImage.'" alt=""></div>
<div class="search-name">
   '.$user->username.'
</div>
</div>
</a><br>'; } echo '</div>'; } }?>
