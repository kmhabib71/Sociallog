<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="../assets/css/home.css">
    <link rel="stylesheet" href="../assets/css/fw/css/font-awesome.css">
    
    <style>
    
/*
    body{
font-family: ‘Segoe UI’;
font-size: 12pt;
}

header h1{
font-size:12pt;
color: #fff;
background-color: #1BA1E2;
padding: 20px;

}
article
{
width: 80%;
margin:auto;
margin-top:10px;
}

.thumbnail{

height: 100px;
margin: 10px;
}
*/
    </style>
</head>
<body>
    <div class="lower-section-wrapper">

        <div class="lower-section-details">
            <div class="reactionn">
  <div class="likeSection">         
<ul>
    
     <li>'.(($likes['likeOn'] === $tweet->tweetID) ? '<button class="unlike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter">'.$tweet->likesCount.'</span></button>' 
    : 
    '<button class="like-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter">'.(($tweet->likesCount > 0) ? $tweet->likesCount : '').'</span></button>').'
    
    </li>
    </ul>
    </div> 
    <div class="commentShareSection">
    <ul>
     <li><button class="commentIcon"><i class="fa fa-comment" aria-hidden="true"></i> </button>
    
    </li>
    
</ul>
             
    <ul>
     <li>'.(($tweet->tweetID === $retweet['retweetID']) ? '<button class="retweeted" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-share" aria-hidden="true"></i><span class="retweetsCount"></span>'.$tweet->retweetCount.'</button>' : '<button class="retweet" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-share" aria-hidden="true"></i><span class="retweetsCount"></span>'.(($tweet->retweetCount > 0) ? $tweet->retweetCount : '').'</button>' ).'
    
    </li>
    
</ul>
</div>
</div>

            <div class="comment-holder">
<!--
            <div class="lower-section">
                <div class="reaction"><i class="fa fa-frown-o" aria-hidden="true" style="color:#be074c;font-size:20px;background-color:beige;"></i><span style="color:#be074c">30 Reactions</span></div>
                <div class="comment"><i class="fa fa-comment" aria-hidden="true" style="color:#be074c;font-size:20px;background-color:beige;"></i><span style="color:#803">23 comments</span></div>
                <div class="share"><i class="fa fa-share" aria-hidden="true" style="color:#be074c;font-size:20px;background-color:beige;"></i><span style="color:#503">16 shares</span></div>
                <div class="text"><i class="fa fa-envelope" aria-hidden="true" style="color:#be074c;font-size:20px;background-color:beige;"></i><span style="color:#313">Message</span></div>

            </div>
-->
           
        <div class="comment">
           <form method="post">
               <textarea data-autoresize rows="2" columns="1" placeholder="write a comment to @ '.$tweet->username.'" name="textStatus" class="commentInput" data-tweet="'.$tweet->tweetID.'"></textarea>
               
               <input type="submit" class="postComment" value="POST" />
               </form>
           </div>
           
            <div class="comment-section">
                <div class="user-comment">
                <div class="user-comment">
                <div class="user"><img src="'.$tweet->profileImage.'"/></div>
                  </div>
                <div class="comments"><strong class="username">Km Habib</strong> dolor sit amet, consectetur adipisicing elit. Asperiores, omnis!</div>
              
            </div>
            </div> <div class="comment-section">
                <div class="user-comment">
                <div class="user-comment">
                <div class="user"><img src="'.$tweet->profileImage.'"/></div>
                  </div>
                <div class="comments"><strong class="username">Km Habib</strong> dolor sit amet, consectetur adipisicing elit. Asperioredolor sit amet, consectetur adipisicing elit. Asperioredolor sit amet, consectetur adipisicing elit. Asperiores, omnis!</div>
              
            </div>
            </div>
            
        </div>
    </div>

    </div>

<div class="post-area">
    <div class="user-info">
        <div class="post-user">
            <div class="user"><label class="drop-label" for="drop-wrap1"><img src="'.BASE_URL.$tweet->profileImage.' ?>"/></label>
    </div>
    <div class="user-name">'.$tweet->username.'

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
            '.$this->getTweetLinks($tweet->status).'
        </div>
        '.((!empty($tweet->tweetImage)) ? '
        <div class="main-status-image">
            <img src="'.BASE_URL.$tweet->tweetImage.'">
        </div>' : '').'



     
        <div class="lower-section-wrapper">

        <div class="lower-section-details">
            <div class="reactionn">
            
<div class="likeSection">         
<ul>
    
     <li>'.(($likes['likeOn'] === $tweet->tweetID) ? '<button class="unlike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter">'.$tweet->likesCount.'</span></button>' 
    : 
    '<button class="like-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter">'.(($tweet->likesCount > 0) ? $tweet->likesCount : '').'</span></button>').'
    
    </li>
    </ul>
    </div> 
    <div class="commentShareSection">
    <ul>
     <li><button class="commentIcon"><i class="fa fa-comment" aria-hidden="true"></i> </button>
    
    </li>
    
</ul>
             
    <ul>
     <li>'.(($tweet->tweetID === $retweet['retweetID']) ? '<button class="retweeted" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-share" aria-hidden="true"></i><span class="retweetsCount"></span>'.$tweet->retweetCount.'</button>' : '<button class="retweet" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-share" aria-hidden="true"></i><span class="retweetsCount"></span>'.(($tweet->retweetCount > 0) ? $tweet->retweetCount : '').'</button>' ).'
    
    </li>
    
</ul>
</div>
</div>

            
  <div class="comment-holder">
<!--
            <div class="lower-section">
                <div class="reaction"><i class="fa fa-frown-o" aria-hidden="true" style="color:#be074c;font-size:20px;background-color:beige;"></i><span style="color:#be074c">30 Reactions</span></div>
                <div class="comment"><i class="fa fa-comment" aria-hidden="true" style="color:#be074c;font-size:20px;background-color:beige;"></i><span style="color:#803">23 comments</span></div>
                <div class="share"><i class="fa fa-share" aria-hidden="true" style="color:#be074c;font-size:20px;background-color:beige;"></i><span style="color:#503">16 shares</span></div>
                <div class="text"><i class="fa fa-envelope" aria-hidden="true" style="color:#be074c;font-size:20px;background-color:beige;"></i><span style="color:#313">Message</span></div>

            </div>
-->
           <div class="comment">
               <textarea data-autoresize rows="2" columns="1" placeholder="what's going in your mind?" name="textStatus" class="statuss"></textarea>
              <div class="commentButton"><button>POST</button></div> 
           </div>
            <div class="comment-section">
                <div class="user-comment">
                
                <div class="user"><img src="../assets/img/me.jpg"/></div>
                <div class="comments"><strong class="username">Km Habib</strong> dolor sit amet, consectetur adipisicing elit. Asperiores, omnis!</div>
                </div>
          
            </div>
            
        </div>
            
        </div>
    </div>

    </div>


    </div>
   <div class="post-area">
    <div class="user-info">
        <div class="post-user">
            <div class="user"><label class="drop-label" for="drop-wrap1"><div class="user-comment">
                <div class="user"><img src="'.$tweet->profileImage.'"/></div>
                  </div></label>
    </div>
    <div class="user-name">'.$tweet->username.'

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
            '.$this->getTweetLinks($tweet->status).'
        </div>
        '.((!empty($tweet->tweetImage)) ? '
        <div class="main-status-image">
            <img src="'.BASE_URL.$tweet->tweetImage.'">
        </div>' : '').'



     
        <div class="lower-section-wrapper">

        <div class="lower-section-details">
            <div class="reactionn">
            
<div class="likeSection">         
<ul>
    
     <li>'.(($likes['likeOn'] === $tweet->tweetID) ? '<button class="unlike-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter">'.$tweet->likesCount.'</span></button>' 
    : 
    '<button class="like-btn" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likesCounter">'.(($tweet->likesCount > 0) ? $tweet->likesCount : '').'</span></button>').'
    
    </li>
    </ul>
    </div> 
    <div class="commentShareSection">
    <ul>
     <li><button class="commentIcon"><i class="fa fa-comment" aria-hidden="true"></i> </button>
    
    </li>
    
</ul>
             
    <ul>
     <li>'.(($tweet->tweetID === $retweet['retweetID']) ? '<button class="retweeted" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-share" aria-hidden="true"></i><span class="retweetsCount"></span>'.$tweet->retweetCount.'</button>' : '<button class="retweet" data-tweet="'.$tweet->tweetID.'" data-user="'.$tweet->tweetBy.'"><i class="fa fa-share" aria-hidden="true"></i><span class="retweetsCount"></span>'.(($tweet->retweetCount > 0) ? $tweet->retweetCount : '').'</button>' ).'
    
    </li>
    
</ul>
</div>
</div>

            
  <div class="comment-holder">
<!--
            <div class="lower-section">
                <div class="reaction"><i class="fa fa-frown-o" aria-hidden="true" style="color:#be074c;font-size:20px;background-color:beige;"></i><span style="color:#be074c">30 Reactions</span></div>
                <div class="comment"><i class="fa fa-comment" aria-hidden="true" style="color:#be074c;font-size:20px;background-color:beige;"></i><span style="color:#803">23 comments</span></div>
                <div class="share"><i class="fa fa-share" aria-hidden="true" style="color:#be074c;font-size:20px;background-color:beige;"></i><span style="color:#503">16 shares</span></div>
                <div class="text"><i class="fa fa-envelope" aria-hidden="true" style="color:#be074c;font-size:20px;background-color:beige;"></i><span style="color:#313">Message</span></div>

            </div>
-->
           <div class="comment">
               <textarea data-autoresize rows="2" columns="1" placeholder="whats going in your mind?" name="textStatus" class="statuss"></textarea>
              <div class="commentButton"><button>POST</button></div> 
           </div>
             
            <div class="comment-section">
               
                <div class="user-comment">
                <div class="user"><img src="'.$tweet->profileImage.'"/></div>
                  </div>
                <div class="comments"><strong class="username">Km Habib</strong> dolor sit amet, consectetur adipisicing elit. Asperioredolor sit amet</div>
              
            </div>
           
             </div>
        </div>
    </div>

    </div>
   

    </div>
<!--
    <script>
    window.onload = function () {
    var fileUpload = document.getElementById("fileupload");
    fileUpload.onchange = function () {
        if (typeof (FileReader) != "undefined") {
            var dvPreview = document.getElementById("dvPreview");
            dvPreview.innerHTML = "";
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            for (var i = 0; i < fileUpload.files.length; i++) {
                var file = fileUpload.files[i];
                if (regex.test(file.name.toLowerCase())) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var img = document.createElement("IMG");
                        var textbox = document.createElement('input');
                        textbox.type = 'text';
                        textbox.name = 'tag_line[]';
                        textbox.placeholder = 'Enter image tag line';
                        img.height = "100";
                        img.width = "100";
                        img.src = e.target.result;
                        dvPreview.appendChild(img);
                        dvPreview.appendChild(textbox);
                    }
                    reader.readAsDataURL(file);
                } else {
                    alert(file.name + " is not a valid image file.");
                    dvPreview.innerHTML = "";
                    return false;
                }
            }
        } else {
            alert("This browser does not support HTML5 FileReader.");
        }
    }
};

</script>
-->
<!--
<div class="row">
<div class="form-group col-sm-6">
<input id="fileupload" type="file" multiple="multiple" />
<hr />
<b>Preview</b><br />
</div>
</div>
<div id="Preview">
</div>
-->
<!--2nd upload images-->
<label for=”files”>Select multiple files: </label>
<input id=”files” type=”file” multiple/>
<output id=”result” />
<script>
    window.onload = function(){
//Check File API support
if(window.File && window.FileList && window.FileReader)
{
var filesInput = document.getElementById(“files”);
filesInput.addEventListener(“change”, function(event){
var files = event.target.files; //FileList object
var output = document.getElementById(“result”);
for(var i = 0; i< files.length; i++)
{
var file = files[i];
//Only pics
if(!file.type.match(‘image’))
continue;
var picReader = new FileReader();
picReader.addEventListener(“load”,function(event){
var picFile = event.target;
var div = document.createElement(“div”);
div.innerHTML = “<img class=’thumbnail’ src=’” + picFile.result + “‘” +
“title=’” + picFile.name + “‘/>”;
output.insertBefore(div,null);
});
//Read the image
picReader.readAsDataURL(file);
}
});
}
else
{
console.log(“Your browser does not support File API”);
}
}
    </script>
    <div class="file-post">
                                                   <span>Upload Image</span>
                                                    <input type="file" name="file" id="file" data-multiple-caption="{count} files selected" multiple/>
                                                    <input type="submit" name="post-status" class="post-button" value="post">
                                                </div>
</body>
</html>