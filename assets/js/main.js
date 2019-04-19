//$(document).ready(function () {
//    $(".profile-picture-holder").click(function () {
//        $(".upload-profile-pic").css("display": "block");
//    });
//
//
//    $("button").click(function () {
//        $(".va").slideToggle();
//    });
//});
$(document).ready(function () {
    //    $('.replyCountSyle').click(function(){
    //alert('hello wold');
    //})

    //    photo change toggle

    var topFixed = $('.profile-info').offset();
    $(window).scroll(function () {
        if ($(window).scrollTop() > topFixed.top) {
            $('.profile-info').css('position', 'fixed').css('top', '0');
        } else {
            $('.profile-info').css('position', 'static');
        }
    });


    $(document).on('click', '.edit_pic', function () {
        $('.edit_upload_pic').toggle();
    });

    $("#ita").click(function () {
        $(".photo-container").show();
    });
    $(".bg").click(function () {
        $(".photo-container").hide();
    });
    $("#ita").click(function () {
        $(this).hide();
    });
    $(".bg").click(function () {
        $("#ita").show();
    });

    $(".upload-box").click(function () {
        $(".upload-container").show();
    });
    $(".profile-submit").click(function () {
        $(this).hide();
        //        location.reload(true);
    });
    $(".profile-submit").click(function () {
        $(".cclose").show();
        //        location.reload(true);
    });
    $("#cover-submit").click(function () {
        $(this).hide();
        //        location.reload(true);
    });
    $("#cover-submit").click(function () {
        $(".cclose").show();
        //        location.reload(true);
    });


    $(".cclose").click(function () {
        location.reload(true);
    });
    $(".cover-close").click(function () {
        location.reload(true);
    });
    $(".upload-box-cover").click(function () {
        $(".upload-container-cover").show();
    });
    $(".edit-click").click(function () {
        $(".about-edit-form").toggle();
        //        location.reload(true);
    });
    $('#profileImage').picEdit();
    //about edit portion
    $(".About").click(function () {
        $(".status-hide").slideUp();
        $.post('http://localhost/socialbd/about.php', function (data) {
            $(".status").html(data);
        });

    });
    $(".activities").click(function () {
        $(".olle").slideUp();
        $.post('http://localhost/socialbd/activities.php', function (data) {
            $(".hide-profile").html(data);
        });


    });
    $(document).on('click', '.profilePhoto', function () {
        $profileId = $(this).data('profile');
        $(".olle").slideUp();
        $.post('http://localhost/socialbd/core/ajax/profilePhoto.php', {
            profileId: $profileId
        }, function (data) {
            $(".hide-profile").html(data);
        });

    });

    $('.deleteTweet').click(function () {
        $('.delBack').show();
    });

    $(document).on('click', '.user-click', function () {
        $('.user-details').toggle();
    });

    $('.file_upload').click(function () {
        $.post('http://localhost/socialbd/core/ajax/file_upload.php', {

        }, function (data) {
            $(".popupTweet").html(data);
        });
    });
    //create page................
    $(document).on('click', '.localBusshead', function () {
        $('.localBussDetails').slideToggle();
    });
    $(document).on('click', '.localEntHead', function () {
        $('.entertainmentDetails').slideToggle();
    });
    $(document).on('click', '.localArtHead', function () {
        $('.artDetails').slideToggle();
    });
    $(document).on('click', '.localCompHead', function () {
        $('.compDetails').slideToggle();
    });

});

//POST OPTION DROPDOWN............
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
//function myFunction() {
//    document.getElementById("myDropdown").classList.toggle("show");
//}

// Close the dropdown if the user clicks outside of it
//window.onclick = function (event) {
//    if (!event.target.matches('.dropbtn')) {
//
//        var dropdowns = document.getElementsByClassName("dropdown-content");
//        var i;
//        for (i = 0; i < dropdowns.length; i++) {
//            var openDropdown = dropdowns[i];
//            if (openDropdown.classList.contains('show')) {
//                openDropdown.classList.remove('show');
//            }
//        }
//    }
//};
