$(function () {
    $(document).on('click', '#messagePopup', function () {
        var getMessages = 1;
        $.post('http://localhost/socialbd/core/ajax/message.php', {
            showMessage: getMessages
        }, function (data) {
            $('.popupTweet').html(data);
            $('#messages').hide();
        });
    });

    $(document).on('click', '.people-message', function () {
        var get_id = $(this).data('user');
        $.post('http://localhost/socialbd/core/ajax/message.php', {
            showChatPopup: get_id
        }, function (data) {
            $('.popupTweet').html(data);

        });

        getMessages = function () {
            $.post('http://localhost/socialbd/core/ajax/message.php', {
                showChatMessage: get_id
            }, function (data) {
                $('.main-msg-inner').html(data);
                //                $('.main-msg-inner').append(data);
                if (autoscroll) {
                    scrolldown();
                }
                $('#chat').on('scroll', function () {
                    if ($(this).scrollTop() < this.scrollHeight - $(this).height()) {
                        autoscroll = false;
                    } else {
                        autoscroll = true;
                    }
                });
                $('.close-msgPopup').click(function () {
                    clearInterval(timer);
                });

            });
        }
        var timer = setInterval(getMessages, 1000);
        getMessages();

        autoscroll = true;
        scrolldown = function () {
            $('#chat').scrollTop($('#chat')[0].scrollHeight);
        }
        $(document).on('click', '.back-messages', function () {
            var getMessages = 1;
            $.post('http://localhost/socialbd/core/ajax/message.php', {
                showMessage: getMessages
            }, function (data) {
                $('.popupTweet').html(data);
                clearInterval(timer)
                $('#messages').hide();
            });
        });
        $(document).on('click', '.deleteMsg', function () {
            var messageID = $(this).data('message');
            $('.message-del-inner').height('100px');

            $(document).on('click', '.cancel', function () {
                $('.message-del-inner').height('0px');
            });

            $(document).on('click', '.delete', function () {
                $.post('http://localhost/socialbd/core/ajax/message.php', {
                    deleteMsg: messageID
                }, function (data) {
                    $('.message-del-inner').height('0px');
                    getMessages();
                });

            });
        });
    });
});
