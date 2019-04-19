$(function () {
    $(document).on('click', '.dropbtn', function () {
        $('.dro').remove();
        $countemj = $(this).siblings('.dropdown-content');
        $($countemj).attr('id', 'myRopdown');
        $tweet_id = $(this).data('tweet');
        $user_id = $(this).data('user');
        $profileID = $(this).data('profileid');
        $imageID = $(this).data('imageid');
//                alert($imageID);
        $('.dropdown-content').toggle();

        $.post('http://localhost/socialbd/core/ajax/postOption.php', {
            tweet_idm: $tweet_id,
            user_idr: $user_id,
            profileID: $profileID,
            imageID: $imageID
        }, function (data) {
            $("#myRopdown").html(data);
            $('#myRopdown').removeAttr('id');

        });  });  

    $(document).on('click', '.editTweet', function () {
        $countem = $(this).siblings('.editShow');
        $($countem).attr('id', 'editShoww');
        $tweet_id = $(this).data('tweet');
        $user_id = $(this).data('user');
        $writterID = $(this).data('writter');
        //        alert($profileID);

        $.post('http://localhost/socialbd/core/ajax/postOption.php', {
            tweet_idmm: $tweet_id,
            user_idr: $user_id,
            writterID: $writterID
        }, function (data) {
            $("#editShoww").html(data);

            $('#editShoww').removeAttr('id');

        });


    });

    $(document).on('click', '.editCancelOption', function () {
        $('.CancelOption').toggle();
    });
    $(document).on('click', '.notCancel', function () {
        $('.CancelOption').hide();
    });

    $(document).on('click', '.editCancel', function () {

        $('.wrap5').remove();
        $('.dropdown-content').hide();
    });
    //Editing submition.............
    $(document).on('click', '.editSubmit', function () {
        $tweet_id = $(this).data('tweet');
        $user_id = $(this).data('user');
        $writterID = $(this).data('writter');
        $status = $('.editStatuss').val();
        //        alert($profileID);

        $.post('http://localhost/socialbd/core/ajax/postOption.php', {
            editSatus: $status,
            tweet_idmmm: $tweet_id,
            user_idr: $user_id,
            writterID: $writterID
        }, function (data) {
            location.reload();

        });


    });
    $(document).on('click', '#myPostHide', function () {
        
        
    });


});
