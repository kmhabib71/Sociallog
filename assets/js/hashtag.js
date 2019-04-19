$(function () {
    var regex = /[#|@](\w+)$/ig;

    $(document).on('keyup', '.statuss', function () {
        var content = $.trim($(this).val());
        var text = content.match(regex);
        var max = 140;

        if (text != null) {
            var dataString = 'hashtag=' + text;
            $.ajax({
                type: "POST",
                url: "http://localhost/socialbd/core/ajax/getHashtag.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    $('.hash-box ul').html(data);
                    $('.hash-box li').click(function () {
                        var value = $.trim($(this).find('.getValue').text());
                        var oldContent = $('.statuss').val();
                        var newContent = oldContent.replace(regex, "");

                        $('.statuss').val(newContent + value + ' ');
                        $('.hash-box li').hide();
                        $('.statuss').focus();
                        $('#count').text(max - content.length);
                    });
                }

            });
        } else {
            $('.hash-box li').hide();
        }
    });
});
