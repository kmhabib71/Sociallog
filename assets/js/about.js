$(function () {

    $(".myBtn").click(function () {
        $.post('http://localhost/socialbd/testFormAjax.php', function (data) {
            $(".modal-content-details").html(data);
        });
    });
//      $(".retweets").click(function () {
//        $.post('http://localhost/socialbd/testFormAjax.php', function (data) {
//            $(".popupTweet").html(data);
//        });
//    });




});
