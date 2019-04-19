<!--
<!DOCTYPE html>
<html>

<head>
    <title>Webslesson Tutorial | Multiple Image Upload</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>

<body>
    <br /><br />
    <div class="container">
        <form id="uploadForm" action="upload.php" method="post">
            <div id="gallery"></div>
            <div style="clear:both;"></div><br /><br />
            <div class="col-md-4" align="right">
                <label>Upload Multiple Image</label>
            </div>
            <div class="col-md-4">
                <input name="files[]" type="file" multiple />
            </div>
            <div class="col-md-4">
                <input type="submit" value="Submit" />
            </div>
            <div style="clear:both"></div>
        </form>
    </div>
</body>

</html>
<script>
    $(document).ready(function() {
        $('#uploadForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: "uploadphp.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#gallery").html(data);
                    alert("Image Uploaded");
                }
            });
        });
    });

</script>
-->
<!DOCTYPE html>
<html>

<head>
    <title>Upload Multiple Images Using jquery and PHP</title>
    <!-------Including jQuery from Google ------>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="script.js"></script>
    <!------- Including CSS File ------>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div id="maindiv">
        <div id="formdiv">
            <h2>Multiple Image Upload Form</h2>
            <form enctype="multipart/form-data" action="" method="post">
                First Field is Compulsory. Only JPEG,PNG,JPG Type Image Uploaded. Image Size Should Be Less Than 100KB.
                <div id="filediv"><input name="file[]" type="file" id="file" /></div>
                <input type="button" id="add_more" class="upload" value="Add More Files" />
                <input type="submit" value="Upload File" name="submit" id="upload" class="upload" />
            </form>
            <!------- Including PHP Script here ------>
            <?php include "uploadphp.php"; ?>
        </div>
    </div>
</body>

</html>
