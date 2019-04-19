	$(document).on('click', '.imagePopup', function (e) {
	    e.stopPropagation();
	    var tweet_id = $(this).data('tweet');
	    $.post('http://localhost/socialbd/core/ajax/imagePopup.php', {
	        showImage: tweet_id
	    }, function (data) {
	        $('.popupTweet').html(data);
	        $('.closeImage').click(function () {
	            $('.retweet-popup').hide();
	        });
	        $('.img-popup-body').click(function () {
	            $('.img-popup').hide();
	        });
	    });
	});
$(document).on('click', '.img_box', function (e) {
	    e.stopPropagation();
	    var tweet_id = $(this).data('tweet');
	    $.post('http://localhost/socialbd/core/ajax/imagePopup.php', {
	        showImage: tweet_id
	    }, function (data) {
	        $('.popupTweet').html(data);
	        $('.closeImage').click(function () {
	            $('.retweet-popup').hide();
	        });
	        $('.img-popup-body').click(function () {
	            $('.img-popup').hide();
	        });
	    });
	});
$(document).on('click', '.cover_img', function (e) {
	    e.stopPropagation();
	    var tweet_id = $(this).data('tweet');
	    $.post('http://localhost/socialbd/core/ajax/imagePopup.php', {
	        showImage: tweet_id
	    }, function (data) {
	        $('.popupTweet').html(data);
	        $('.closeImage').click(function () {
	            $('.retweet-popup').hide();
	        });
	        $('.img-popup-body').click(function () {
	            $('.img-popup').hide();
	        });
	    });
	});
$(document).on('click', '.proPicAll', function (e) {
	    e.stopPropagation();
	    var tweet_id = $(this).data('tweet');
	    $.post('http://localhost/socialbd/core/ajax/imagePopup.php', {
	        showImage: tweet_id
	    }, function (data) {
	        $('.popupTweet').html(data);
	        $('.closeImage').click(function () {
	            $('.retweet-popup').hide();
	        });
	        $('.img-popup-body').click(function () {
	            $('.img-popup').hide();
	        });
	    });
	});
