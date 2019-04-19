<?php 

	include 'core/init.php';
include 'class/login.php';
	$user_id =login::isLoggedIn();
//echo $user_id;
//$user_id = $_SESSION['user_id'];
$user = $getFromU->userData($user_id);
 

echo '<div class="profile-container">


                <div class="profile-info">


                    <div class="fan-info">
                        <div class="Attention">456 <br><strong>Attention</strong></div>
                        <div class="Fan">4500<br><strong>Fans</strong></div>
                        <div class="Post">55<br><strong>Posts</strong></div>
                    </div>
                    <div class="about-summary">

                        <h2 id="myBtn"><i class="fa fa-edit" aria-hidden="true" style="font-size:24px;margin:5px;"></i></h2>

                        <!-- Trigger/Open The Modal -->

                        <p></p>
                        <!-- The Modal -->
                        <div id="myModal" class="modal">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <div class="modal-content-details">

                                </div>
                                <!-- Modal content -->

                            </div>
                        </div>

                        <form action="">
                            <div class="intro">Tell me about yourself, that mean what is going on. How is happening everything.</div>
                            <div class="intro-input"><input type="text" class="about-editt" value="'.$user->username.'">

</div>
<div class="from"><i class="fa fa-map-marker" aria-hidden="true" style="color:black"></i> From <strong>Chittagong, Bangladesh</strong></div>
<div class="gender"><i class="fa fa-mars-stroke" aria-hidden="true" style="color:black"></i> Gender<strong> Male</strong></div>
<div class="relationship-status"><i class="fa  fa-heartbeat" aria-hidden="true" style="color:black"></i> Relationship Status<strong> Single</strong></div>
</form>

</div>



<div class="friends-info">

</div>
</div>
<div class="status">
    <div class="status-border">
        <div class="staus-box">
            <div class="status-area">
                <div class="user"><label class="drop-label" for="drop-wrap1"><img src="'.$user->profileImage.'"/></label></div>
                <div class="type-status">
                    <textarea data-autoresize rows="5" columns="5" placeholder="whats going in your mind?"></textarea>
                    <input type="submit" name="post-status" class="post-button" value="post">
                </div>
            </div>
        </div>
    </div>
    <div class="post">
        <div class="post-area">
            <div class="user-info">
                <div class="post-user">
                    <div class="user"><label class="drop-label" for="drop-wrap1"><img src="'.$user->profileImage.'"/></label></div>
                    <div class="user-name">
                        '.$user->username.'

                    </div>
                </div>

                <div class="status-type">
                    Updated his profile picture <br>
                </div>
                <div class="post-option">
                    v
                </div>

            </div>
            <div class="time-ago">
                36 m ago
            </div>
            <div class="main-status">
                <div class="main-status-text">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit excepturi officiis amet non quas ex cumque maxime, quod fugiat assumenda...<span class="readMore">Read More</span>
                </div>
                <div class="main-status-image">
                    <img src="assets/img/me.jpg" alt="">
                </div>



                <div class="lower-section">
                    <div class="reaction"></div>
                    <div class="comment"></div>
                    <div class="share"></div>
                    <div class="shareX"> </div>

                </div>
                <div class="lower-section-wrapper">
                    jhjjkj
                    <div class="lower-section-details">
                        <div class="react-section">
                            <div class="like"><i class="fa fa-thumbs-up"></i>45</div>
                            <div class="heart"> <i class="fa fa-heart" aria-hidden="true" style="color:red"></i>33</div>
                            <div class="smile"><i class="fa fa-smile-o" aria-hidden="true" style="color:#be074c;font-size:19px;background-color:beige;"></i> 20
                            </div>
                            <div class="angry"><i class="fa fa-frown-o" aria-hidden="true" style="color:#be074c;font-size:20px;background-color:beige;"></i> 44
                            </div>
                        </div>
                        <div class="lower-section">
                            <div class="reaction"><i class="fa fa-frown-o" aria-hidden="true" style="color:#be074c;font-size:20px;background-color:beige;"></i><span style="color:#be074c">30 Reactions</span></div>
                            <div class="comment"><i class="fa fa-comment" aria-hidden="true" style="color:#be074c;font-size:20px;background-color:beige;"></i><span style="color:#803">23 comments</span></div>
                            <div class="share"><i class="fa fa-share" aria-hidden="true" style="color:#be074c;font-size:20px;background-color:beige;"></i><span style="color:#503">16 shares</span></div>
                            <div class="text"><i class="fa fa-envelope" aria-hidden="true" style="color:#be074c;font-size:20px;background-color:beige;"></i><span style="color:#313">Message</span></div>

                        </div>
                        <div class="comment-section">
                            <div class="user">user</div>
                            <div class="comments"><strong>Km Habib</strong> dolor sit amet, consectetur adipisicing elit. Asperiores, omnis!</div>
                        </div>
                    </div>
                </div>

            </div>


        </div>



    </div>


</div>
<!--
<div class="trends">



</div>
-->
</div>'; ?>
