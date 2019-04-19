$(function () {
    $(document).on('click', '.memReq-btn', function () {
        var followID = $(this).data('follow');
        var profile = $(this).data('profile');
        $button = $(this);
        $.post('http://localhost/socialbd/core/ajax/member.php', {
            unfollow: followID,
            profile: profile
        }, function (data) {
            $button.removeClass('memReq-btn');
            $button.addClass('memberReq-btn');
            $button.html('Society Request has sent');

        });
    });

    $(document).on('click', '.memberReq-btn', function () {
        var followID = $(this).data('follow');
        var profile = $(this).data('profile');
        $button = $(this);
        $.post('http://localhost/socialbd/core/ajax/member.php', {
            unfolloww: followID,
            profilee: profile
        }, function (data) {
            $button.removeClass('memberReq-btn');
            $button.addClass('memReq-btn');
            $button.html('Add in society');

        });
    });
    $(document).on('click', '.cancReq-btn', function () {
        var followID = $(this).data('follow');
        var profile = $(this).data('profile');
        $button = $(this);
        $.post('http://localhost/socialbd/core/ajax/member.php', {
            unfollowww: followID,
            profileee: profile
        }, function (data) {
            $('.acceReq-btn').hide();
            $button.removeClass('cancReq-btn');
            $button.addClass('memReq-btn');
            $button.html('Add in society');

        });
    });
    $(document).on('click', '.acceReq-btn', function () {
        var followID = $(this).data('follow');
        var profile = $(this).data('profile');
        $button = $(this);
        $.post('http://localhost/socialbd/core/ajax/member.php', {
            unfollowwww: followID,
            profileeee: profile
        }, function (data) {
            $('.cancReq-btn').hide();
            $button.removeClass('acceReq-btn');
            $button.addClass('member-btn');
            $button.html('<i class="fa fa-check" style="color:lightgreen;font-size=20px;"></i>Society member');

        });
    });
    $(document).on('click', '.member-btn', function () {
        $('.memberActionList').slideToggle();
    });
    $(document).on('click', '.societyOut', function () {
        var followID = $(this).data('follow');
        var profile = $(this).data('profile');
        //        $button = $(this);

        $.post('http://localhost/socialbd/core/ajax/member.php', {
            societyOut: followID,
            profila: profile
        }, function (data) {

            location.reload();

        });
    });
    $(document).on('click', '.societyOut', function () {
        var followID = $(this).data('follow');
        var profile = $(this).data('profile');
        //        $button = $(this);

        $.post('http://localhost/socialbd/core/ajax/member.php', {
            societyOut: followID,
            profila: profile
        }, function (data) {

            location.reload();

        });
    }); 
    $(document).on('click', '.blockUser', function () {
        var user = $(this).data('user');
        var profile = $(this).data('profile');
        //        $button = $(this);

     $.post('http://localhost/socialbd/core/ajax/member.php', {
            blockedID: profile,
            blockerID: user
        }, function (data) {

            location.reload();

        });
    }); 
//    unBlockYes
    $(document).on('click', '.unBloc', function () {
        
        $(".unblockUser").toggle();

    });  
    
    $(document).on('click', '.unBlockYes', function () {
        var userBlock = $(this).data('user');
        var profileBlock = $(this).data('profile');
        //        $button = $(this);
//        $(".unblockUser").toggle();
   
        alert(profileBlock);
        $.post('http://localhost/socialbd/core/ajax/member.php', {
            userBlock: userBlock,
            profileBlock: profileBlock
        }, function (data) {

            location.reload();

        });
    });
});
