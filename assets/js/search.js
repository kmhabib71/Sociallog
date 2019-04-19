$(function () {
    $(".searchh").keyup(function () {
        var searchh = $(this).val();
        $.post('http://localhost/socialbd/core/ajax/search.php', {
            searchh: searchh
        }, function (data) {
            $('.search-result').html(data);
        });
    });

    $(document).on('keyup', '.search-user', function () {
        $('.message-recent').hide();
        var search = $(this).val();
        $.post('http://localhost/socialbd/core/ajax/searchUserInMsg.php', {
            search: search
        }, function (data) {
            $('.message-body').html(data);
        });

    });
});
