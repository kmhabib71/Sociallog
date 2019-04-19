<?php  
include '../init.php';
if(isset($_POST['hashtag'])){
    $hashtag = $getFromU->checkInput($_POST['hashtag']);
    $mention = $getFromU->checkInput($_POST['hashtag']);
    if(substr($hashtag,0,1) === '#'){
       $trend = str_replace('#','',$hashtag);
        $trends = $getFromT->getTrendByhash($trend);
        //ekhane str_replace a # tag ka replace kore empty '' place thara $hashtag variabler
       foreach($trends as $hashtag){
           echo '<li><span class="getValue">#'.$hashtag->hashtag.'</span></li>';
       }
    }
    	if(substr($mention,0,1) === '@'){
		$mention = str_replace('@', '', $mention);
		$mentions = $getFromT->getMention($mention); 
            echo '<div class="search-result-details">'; 
	foreach($mentions as $mentio){
		echo '
        <li>
        <a href="#">
            <div class="search-people">
                <div class="search-image"><img src="'.$mentio->profileImage.'" alt=""></div>
<div class="getValue">
   '.$mentio->username.'
</div>
</div>
</a><br>'; } echo '</div> </li>'; 
	}
}
//echo '
//<li class="hashdesign">'.$_POST['hashtag'].'</li>';

?>
