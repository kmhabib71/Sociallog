$(function () {

    $(document).on('click', '.likeSection', function () {
        var counterM = $(this).find('.unMainLike-btn>.likesCounter');
        var countt = counterM.text();
        countt--;
        if (countt === 0) {
            counterM.hide();
        } else {
            counterM.text(countt);
        }
        counterM.text(countt);
        $mainn = $(this).find('.unMainLike-btn');

        $mainn.addClass('mainLike-btn');
        $mainn.removeClass('unMainLike-btn');


        var counterS = $(this).find('.unSmile-btn>.likesCounter');
        var countS = counterS.text();
        countS--;
        if (countS === 0) {
            counterS.hide();
        } else {
            counterS.text(countS);
        }
        counterS.text(countS);
        $mainnS = $(this).find('.unSmile-btn');

        $mainnS.addClass('smile-btn');
        $mainnS.removeClass('unSmile-btn');


        var counterA = $(this).find('.unAngry-btn>.likesCounter');
        var countA = counterA.text();
        countA--;
        if (countA === 0) {
            counterA.hide();
        } else {
            counterA.text(countA);
        }
        counterA.text(countA);
        $mainnS = $(this).find('.unAngry-btn');

        $mainnS.addClass('angry-btn');
        $mainnS.removeClass('unAngry-btn');


        var counterSA = $(this).find('.unSad-btn>.likesCounter');
        var countSA = counterSA.text();
        countSA--;
        if (countSA === 0) {
            counterSA.hide();
        } else {
            counterSA.text(countSA);
        }
        counterSA.text(countSA);
        $mainnS = $(this).find('.unSad-btn');

        $mainnS.addClass('sad-btn');
        $mainnS.removeClass('unSad-btn');


        var counterSE = $(this).find('.unSecret-btn>.likesCounter');
        var countSE = counterSE.text();
        countSE--;
        if (countSE === 0) {
            counterSE.hide();
        } else {
            counterSE.text(countSE);
        }
        counterSE.text(countSE);
        $mainnS = $(this).find('.unSecret-btn');

        $mainnS.addClass('secret-btn');
        $mainnS.removeClass('unSecret-btn');


        var counterL = $(this).find('.unLove-btn>.likesCounter');
        var countL = counterL.text();
        countL--;
        if (countL === 0) {
            counterL.hide();
        } else {
            counterL.text(countL);
        }
        counterL.text(countL);
        $mainnS = $(this).find('.unLove-btn');

        $mainnS.addClass('love-btn');
        $mainnS.removeClass('unLove-btn');


        var counterM = $(this).find('.unMd-btn>.likesCounter');
        var countM = counterM.text();
        countM--;
        if (countM === 0) {
            counterM.hide();
        } else {
            counterM.text(countM);
        }
        counterM.text(countM);
        $mainnS = $(this).find('.unMd-btn');

        $mainnS.addClass('md-btn');
        $mainnS.removeClass('unMd-btn');

        var counterB = $(this).find('.unBed-btn>.likesCounter');
        var countB = counterB.text();
        countB--;
        if (countB === 0) {
            counterB.hide();
        } else {
            counterB.text(countB);
        }
        counterB.text(countB);
        $mainnS = $(this).find('.unBed-btn');

        $mainnS.addClass('bed-btn');
        $mainnS.removeClass('unBed-btn');


    });

    $(document).on('click', '.replyLike', function () {
        var counterLC = $(this).find('.Unlikec-btn>.likesCounter');
        var counlc = counterLC.text();
        counlc--;
        if (counlc === 0) {
            counterLC.hide();
        } else {
            counterLC.text(counlc);
        }
        counterLC.text(counlc);
        $mainn = $(this).find('.Unlikec-btn');

        $mainn.addClass('Likec-btn');
        $mainn.removeClass('Unlikec-btn');

        var counterSC = $(this).find('.unSmilec-btn>.likesCounter');
        var counsc = counterSC.text();
        counsc--;
        if (counsc === 0) {
            counterSC.hide();
        } else {
            counterSC.text(counsc);
        }
        counterSC.text(counsc);
        $mainn = $(this).find('.unSmilec-btn');

        $mainn.addClass('smilec-btn');
        $mainn.removeClass('unSmilec-btn');

        var counterSAC = $(this).find('.unSadc-btn>.likesCounter');
        var counsac = counterSAC.text();
        counsac--;
        if (counsac === 0) {
            counterSAC.hide();
        } else {
            counterSAC.text(counsac);
        }
        counterSAC.text(counsac);
        $mainn = $(this).find('.unSadc-btn');

        $mainn.addClass('sadc-btn');
        $mainn.removeClass('unSadc-btn');

        var counterAN = $(this).find('.unAngryc-btn>.likesCounter');
        var counsan = counterAN.text();
        counsan--;
        if (counsan === 0) {
            counterAN.hide();
        } else {
            counterAN.text(counsan);
        }
        counterAN.text(counsan);
        $mainn = $(this).find('.unAngryc-btn');

        $mainn.addClass('angryc-btn');
        $mainn.removeClass('unAngryc-btn');
    });
    $(document).on('click', '.reactReplyLike', function () {
        //replyReact
        var counterRL = $(this).find('.Unliker-btn>.likesCounter');
        var counsrl = counterRL.text();
        counsrl--;
        if (counsrl === 0) {
            counterRL.hide();
        } else {
            counterRL.text(counsrl);
        }
        counterRL.text(counsrl);
        $mainn = $(this).find('.Unliker-btn');

        $mainn.addClass('Liker-btn');
        $mainn.removeClass('Unliker-btn');

        var counterSL = $(this).find('.unSmiler-btn>.likesCounter');
        var counssl = counterSL.text();
        counssl--;
        if (counssl === 0) {
            counterSL.hide();
        } else {
            counterSL.text(counssl);
        }
        counterSL.text(counssl);
        $mainn = $(this).find('.unSmiler-btn');

        $mainn.addClass('smiler-btn');
        $mainn.removeClass('unSmiler-btn');

        var counterSAR = $(this).find('.unSadr-btn>.likesCounter');
        var counssar = counterSAR.text();
        counssar--;
        if (counssar === 0) {
            counterSAR.hide();
        } else {
            counterSAR.text(counssar);
        }
        counterSAR.text(counssar);
        $mainn = $(this).find('.unSadr-btn');

        $mainn.addClass('sadr-btn');
        $mainn.removeClass('unSadr-btn');

        var counterAR = $(this).find('.unAngryr-btn>.likesCounter');
        var counsar = counterAR.text();
        counsar--;
        if (counsar === 0) {
            counterAR.hide();
        } else {
            counterAR.text(counsar);
        }
        counterAR.text(counsar);
        $mainn = $(this).find('.unAngryr-btn');

        $mainn.addClass('angryr-btn');
        $mainn.removeClass('unAngryr-btn');




    });
    //         
    //     var counter = $(this).find('.unMainLike-btn>.likesCounter');
    //         var countt = counter.text();
    //         countt--;
    //            if (countt === 0) {
    //                counter.hide();
    //            } else {
    //                counter.text(countt);
    //            }
    //            counter.text(countt);
    //         
    //         var counterAngr = $(this).find('.unAngry-btn');
    //         $('counterAngr').removeClass();
    //         $(counterAngr).addClass('angry-btn');
    //         var counterAngry = $(this).find('.unAngry-btn>.likesCounter');
    //         
    //         
    //         
    //         var countAng = counterAngry.text();
    //         countAng--;
    //            if (countAng === 0) {
    //                counterAngry.hide();
    //            } else {
    //                counterAngry.text(countAng);
    //            }
    //            counterAngry.text(countAng);
    //        $(counter).hide(); 
    //     var countera = $(this).find('.unSmile-btn-btn');
    //        $(countera).hide(); 
    //    var counteraa = $(this).find('.unAngry-btn-btn');
    //        $(counteraa).hide(); 
    //         var counteraaa = $(this).find('.unSad-btn-btn');
    //        $(counteraaa).hide(); 
    //         var counter = $(this).find('.unMainLike-btn');
    //        $(counter).hide(); 
    //         var counter = $(this).find('.unMainLike-btn');
    //        $(counter).hide(); 
    //         var counter = $(this).find('.unMainLike-btn');
    //        $(counter).hide(); 
    //         var counter = $(this).find('.unMainLike-btn');
    //        $(counter).hide();
    //     });


    $(document).on('click', '.smile-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');
        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);

        //        $mainHide = $(this).parents(".likeSection");
        //      $idSearcher = $($mainHide).find('#replyCountSyleID');
        //        $idSearcher.hide();
        $.post('http://localhost/socialbd/core/ajax/pageReact.php', {
            happyReact: type,
            smileId: tweet_id,
            user_id: user_id,
            page_id: page_id
        }, function (data) {
            counter.show();
            button.addClass('unSmile-btn');
            button.removeClass('smile-btn');
            count++;
            counter.text(count);
            alert(data);

            //        $('.unSmile-btn').attr('id', 'replyCountSyleID');
        });
    });

    $(document).on('click', '.unSmile-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');

        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);

        $.post('http://localhost/socialbd/core/ajax/pageReact.php', {
            unHappyReact: type,
            smileId: tweet_id,
            user_id: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('smile-btn');
            button.removeClass('unSmile-btn');
            count--;
            if (count === 0) {
                counter.hide();
            } else {
                counter.text(count);
            }
            counter.text(count);

        });
    });
    $(document).on('click', '.mainLike-btn', function () {
        var tweet_id = $(this).data('tweet');
        var user_id = $(this).data('user');
        var page_id = $(this).data('pageid');
        var type = $(this).data('type');
        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);


        $.post('http://localhost/socialbd/core/ajax/pageReact.php', {
            happyReact: type,
            smileId: tweet_id,
            user_id: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('unMainLike-btn');
            button.removeClass('mainLike-btn');
            count++;
            counter.text(count);
            //             $('.unMainLike-btn').attr('id', 'replyCountSyleID');
        });
    });

    $(document).on('click', '.unMainLike-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');

        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);

        $.post('http://localhost/socialbd/core/ajax/pageReact.php', {
            unHappyReact: type,
            smileId: tweet_id,
            user_id: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('mainLike-btn');
            button.removeClass('unMainLike-btn');
            count--;
            if (count === 0) {
                counter.hide();
            } else {
                counter.text(count);
            }
            counter.text(count);

        });
    });
    $(document).on('click', '.sad-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');
        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);


        $.post('http://localhost/socialbd/core/ajax/pageReact.php', {
            happyReact: type,
            smileId: tweet_id,
            user_id: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('unSad-btn');
            button.removeClass('sad-btn');
            count++;
            counter.text(count);
        });
    });

    $(document).on('click', '.unSad-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');

        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);

        $.post('http://localhost/socialbd/core/ajax/pageReact.php', {
            unHappyReact: type,
            smileId: tweet_id,
            user_id: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('sad-btn');
            button.removeClass('unSad-btn');
            count--;
            if (count === 0) {
                counter.hide();
            } else {
                counter.text(count);
            }
            counter.text(count);

        });
    });
    $(document).on('click', '.angry-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');
        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);


        $.post('http://localhost/socialbd/core/ajax/pageReact.php', {
            happyReact: type,
            smileId: tweet_id,
            user_id: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('unAngry-btn');
            button.removeClass('angry-btn');
            count++;
            counter.text(count);
        });
    });

    $(document).on('click', '.unAngry-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');

        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);

        $.post('http://localhost/socialbd/core/ajax/pageReact.php', {
            unHappyReact: type,
            smileId: tweet_id,
            user_id: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('angry-btn');
            button.removeClass('unAngry-btn');
            count--;
            if (count === 0) {
                counter.hide();
            } else {
                counter.text(count);
            }
            counter.text(count);

        });
    });
    $(document).on('click', '.secret-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');
        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);


        $.post('http://localhost/socialbd/core/ajax/pageReact.php', {
            happyReact: type,
            smileId: tweet_id,
            user_id: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('unSecret-btn');
            button.removeClass('secret-btn');
            count++;
            counter.text(count);
        });
    });

    $(document).on('click', '.unSecret-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');

        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);

        $.post('http://localhost/socialbd/core/ajax/pageReact.php', {
            unHappyReact: type,
            smileId: tweet_id,
            user_id: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('secret-btn');
            button.removeClass('unSecret-btn');
            count--;
            if (count === 0) {
                counter.hide();
            } else {
                counter.text(count);
            }
            counter.text(count);

        });
    });
    $(document).on('click', '.love-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');
        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);


        $.post('http://localhost/socialbd/core/ajax/pageReact.php', {
            happyReact: type,
            smileId: tweet_id,
            user_id: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('unLove-btn');
            button.removeClass('love-btn');
            count++;
            counter.text(count);
        });
    });

    $(document).on('click', '.unLove-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');

        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);

        $.post('http://localhost/socialbd/core/ajax/pageReact.php', {
            unHappyReact: type,
            smileId: tweet_id,
            user_id: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('love-btn');
            button.removeClass('unLove-btn');
            count--;
            if (count === 0) {
                counter.hide();
            } else {
                counter.text(count);
            }
            counter.text(count);

        });
    });
    $(document).on('click', '.md-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');
        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);


        $.post('http://localhost/socialbd/core/ajax/pageReact.php', {
            happyReact: type,
            smileId: tweet_id,
            user_id: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('unMd-btn');
            button.removeClass('md-btn');
            count++;
            counter.text(count);
        });
    });

    $(document).on('click', '.unMd-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');

        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);

        $.post('http://localhost/socialbd/core/ajax/pageReact.php', {
            unHappyReact: type,
            smileId: tweet_id,
            user_id: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('md-btn');
            button.removeClass('unMd-btn');
            count--;
            if (count === 0) {
                counter.hide();
            } else {
                counter.text(count);
            }
            counter.text(count);

        });
    });
    $(document).on('click', '.bed-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');
        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);


        $.post('http://localhost/socialbd/core/ajax/pageReact.php', {
            happyReact: type,
            smileId: tweet_id,
            user_id: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('unBed-btn');
            button.removeClass('bed-btn');
            count++;
            counter.text(count);
        });
    });

    $(document).on('click', '.unBed-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');

        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);

        $.post('http://localhost/socialbd/core/ajax/pageReact.php', {
            unHappyReact: type,
            smileId: tweet_id,
            user_id: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('bed-btn');
            button.removeClass('unBed-btn');
            count--;
            if (count === 0) {
                counter.hide();
            } else {
                counter.text(count);
            }
            counter.text(count);

        });
    });
    $(document).on('click', '.Likec-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');
        var comment = $(this).data('comment');
        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);


        $.post('http://localhost/socialbd/core/ajax/pageReactComment.php', {
            commentIDD: comment,
            happyReactt: type,
            smileIdD: tweet_id,
            user_idD: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('Unlikec-btn');
            button.removeClass('Likec-btn');
            count++;
            counter.text(count);
        });
    });

    $(document).on('click', '.Unlikec-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');
        var comment = $(this).data('comment');

        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);

        $.post('http://localhost/socialbd/core/ajax/pageReactComment.php', {
            unComment_id: comment,
            unHappyReact: type,
            smileId: tweet_id,
            user_id: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('Likec-btn');
            button.removeClass('Unlikec-btn');
            count--;
            if (count === 0) {
                counter.hide();
            } else {
                counter.text(count);
            }
            counter.text(count);

        });
    });
    $(document).on('click', '.smilec-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');
        var comment = $(this).data('comment');
        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);
        alert(type);

        $.post('http://localhost/socialbd/core/ajax/pageReactComment.php', {
            commentIDD: comment,
            happyReactt: type,
            smileIdD: tweet_id,
            user_idD: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('unSmilec-btn');
            button.removeClass('smilec-btn');
            count++;
            counter.text(count);
        });
    });

    $(document).on('click', '.unSmilec-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');
        var comment = $(this).data('comment');

        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);


        $.post('http://localhost/socialbd/core/ajax/pageReactComment.php', {
            unComment_id: comment,
            unHappyReact: type,
            smileId: tweet_id,
            user_id: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('smilec-btn');
            button.removeClass('unSmilec-btn');
            count--;
            if (count === 0) {
                counter.hide();
            } else {
                counter.text(count);
            }
            counter.text(count);

        });
    });
    $(document).on('click', '.sadc-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');
        var comment = $(this).data('comment');
        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);


        $.post('http://localhost/socialbd/core/ajax/pageReactComment.php', {
            commentIDD: comment,
            happyReactt: type,
            smileIdD: tweet_id,
            user_idD: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('unSadc-btn');
            button.removeClass('sadc-btn');
            count++;
            counter.text(count);
        });
    });

    $(document).on('click', '.unSadc-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');
        var comment = $(this).data('comment');

        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);

        $.post('http://localhost/socialbd/core/ajax/pageReactComment.php', {
            unComment_id: comment,
            unHappyReact: type,
            smileId: tweet_id,
            user_id: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('sadc-btn');
            button.removeClass('unSadc-btn');
            count--;
            if (count === 0) {
                counter.hide();
            } else {
                counter.text(count);
            }
            counter.text(count);

        });
    });

    $(document).on('click', '.angryc-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');
        var comment = $(this).data('comment');
        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);


        $.post('http://localhost/socialbd/core/ajax/pageReactComment.php', {
            commentIDD: comment,
            happyReactt: type,
            smileIdD: tweet_id,
            user_idD: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('unAngryc-btn');
            button.removeClass('angryc-btn');
            count++;
            counter.text(count);
        });
    });

    $(document).on('click', '.unAngryc-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');
        var comment = $(this).data('comment');

        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);

        $.post('http://localhost/socialbd/core/ajax/pageReactComment.php', {
            unComment_id: comment,
            unHappyReact: type,
            smileId: tweet_id,
            user_id: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('angryc-btn');
            button.removeClass('unAngryc-btn');
            count--;
            if (count === 0) {
                counter.hide();
            } else {
                counter.text(count);
            }
            counter.text(count);

        });
    });


    $(document).on('click', '.Liker-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');
        var comment = $(this).data('comment');
        var reply = $(this).data('reply');
        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);


        alert(reply);
        $.post('http://localhost/socialbd/core/ajax/pageReactComment.php', {
            replyIdD: reply,
            rcommentIDD: comment,
            rhappyReactt: type,
            rsmileIdD: tweet_id,
            ruser_idD: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('Unliker-btn');
            button.removeClass('Liker-btn');
            count++;
            counter.text(count);
        });
    });

    $(document).on('click', '.Unliker-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');
        var comment = $(this).data('comment');
        var reply = $(this).data('reply');
        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);

        $.post('http://localhost/socialbd/core/ajax/pageReactComment.php', {
            unReplyIdD: reply,
            runComment_id: comment,
            runHappyReact: type,
            rsmileId: tweet_id,
            ruser_id: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('Liker-btn');
            button.removeClass('Unliker-btn');
            count--;
            if (count === 0) {
                counter.hide();
            } else {
                counter.text(count);
            }
            counter.text(count);

        });
    });
    $(document).on('click', '.smiler-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');
        var comment = $(this).data('comment');
        var reply = $(this).data('reply');
        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);


        $.post('http://localhost/socialbd/core/ajax/pageReactComment.php', {
            replyIdD: reply,
            rcommentIDD: comment,
            rhappyReactt: type,
            rsmileIdD: tweet_id,
            ruser_idD: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('unSmiler-btn');
            button.removeClass('smiler-btn');
            count++;
            counter.text(count);
        });
    });

    $(document).on('click', '.unSmiler-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');
        var comment = $(this).data('comment');
        var reply = $(this).data('reply');
        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);

        $.post('http://localhost/socialbd/core/ajax/pageReactComment.php', {
            unReplyIdD: reply,
            runComment_id: comment,
            runHappyReact: type,
            rsmileId: tweet_id,
            ruser_id: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('smiler-btn');
            button.removeClass('unSmiler-btn');
            count--;
            if (count === 0) {
                counter.hide();
            } else {
                counter.text(count);
            }
            counter.text(count);

        });
    });

    $(document).on('click', '.sadr-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');
        var comment = $(this).data('comment');
        var reply = $(this).data('reply');
        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);


        $.post('http://localhost/socialbd/core/ajax/pageReactComment.php', {
            replyIdD: reply,
            rcommentIDD: comment,
            rhappyReactt: type,
            rsmileIdD: tweet_id,
            ruser_idD: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('unSadr-btn');
            button.removeClass('sadr-btn');
            count++;
            counter.text(count);
        });
    });

    $(document).on('click', '.unSadr-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');
        var comment = $(this).data('comment');
        var reply = $(this).data('reply');
        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);

        $.post('http://localhost/socialbd/core/ajax/pageReactComment.php', {
            unReplyIdD: reply,
            runComment_id: comment,
            runHappyReact: type,
            rsmileId: tweet_id,
            ruser_id: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('sadr-btn');
            button.removeClass('unSadr-btn');
            count--;
            if (count === 0) {
                counter.hide();
            } else {
                counter.text(count);
            }
            counter.text(count);

        });
    });

    $(document).on('click', '.angryr-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');
        var user_id = $(this).data('user');
        var type = $(this).data('type');
        var comment = $(this).data('comment');
        var reply = $(this).data('reply');
        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);


        $.post('http://localhost/socialbd/core/ajax/pageReactComment.php', {
            replyIdD: reply,
            rcommentIDD: comment,
            rhappyReactt: type,
            rsmileIdD: tweet_id,
            ruser_idD: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('unAngryr-btn');
            button.removeClass('angryr-btn');
            count++;
            counter.text(count);
        });
    });

    $(document).on('click', '.unAngryr-btn', function () {
        var tweet_id = $(this).data('tweet');
        var page_id = $(this).data('pageid');

        var user_id = $(this).data('user');
        var type = $(this).data('type');
        var comment = $(this).data('comment');
        var reply = $(this).data('reply');
        var counter = $(this).find('.likesCounter');
        var count = counter.text();
        var button = $(this);

        $.post('http://localhost/socialbd/core/ajax/pageReactComment.php', {
            unReplyIdD: reply,
            runComment_id: comment,
            runHappyReact: type,
            rsmileId: tweet_id,
            ruser_id: user_id,
            page_id: page_id
        }, function () {
            counter.show();
            button.addClass('angryr-btn');
            button.removeClass('unAngryr-btn');
            count--;
            if (count === 0) {
                counter.hide();
            } else {
                counter.text(count);
            }
            counter.text(count);

        });
    });





    $(document).on('click', '.reactTitle', function () {
        $('.reactWrap').remove();
        //        $($reply_in).attr('id', 'reply_inn');
        //        $reactAjax = $(this).attr('id', 'reply_inn');
        $('#reactBut').removeAttr('id');
        $countemm = $(this).siblings('.reactButton');
        $($countemm).attr('id', 'reactBut');
        //   $('.reactButton').toggle();
        $commentID = $(this).data('comment');
        $tweetID = $(this).data('tweet');
        $.post('http://localhost/socialbd/core/ajax/pageReact.php', {
            reactComment: $commentID,
            reactTweetId: $tweetID
        }, function (data) {
            $('#reactBut').html(data);


        });

    });
    $(document).on('click', '.commentReactClose', function () {
        $('.reactWrap').remove();
    });

});
