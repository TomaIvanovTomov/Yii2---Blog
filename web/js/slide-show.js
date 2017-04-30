
$(window).load(function () {
    //slide show
    var imgs = [
        '../images/1.jpg',
        '../images/2.jpg',
        '../images/3.jpg',
        '../images/4.jpg',
        '../images/5.png'
    ];

    var counter = 0;

    var currImg = new Image();

    currImg.src = imgs[counter];

    $('.slides').prepend("<img src=" + currImg.src + ">");

    setInterval(function () {

        $('.slides').find('img').fadeOut(500, function () {

            counter < imgs.length - 1 ? counter++ : counter = 0;

            $('.slides').find('img').attr('src', imgs[counter]).fadeIn(500);

        });

    }, 6000);

});

$(document).ready(function () {
    function resizeImg(imgClass) {
        $('.' + imgClass + ' img').each(function() {
            if($(this).width() > $(this).height()){
                $(this).removeClass('wide');
                $(this).addClass('tall');
            }
        });
    }

    resizeImg('profile-picture');
    resizeImg('post-prof-img');
    resizeImg('full-post-image')

    //show paragraph on hover
    $('.post-cont').hover(function () {
       $(this).addClass('hoverin-cont');
       $(this).find('p').css('visibility', 'visible');
       $(this).children().not('p').css('opacity', 0.3);
    }, function () {
       $(this).removeClass('hoverin-cont');
       $(this).find('p').css('visibility', 'hidden');
        $(this).children().not('p').css('opacity', 1);
    });

    //chat box settings
    var chatBox = $('.chat-box');
    var body = $('body');
    var chatContent = $('<textarea>', {
        rows : 11,
        "class" : 'chat-content',
        placeholder : 'Find your friens here .. ',
        readonly : true,
        id : 'cont'
    });

    //load last 10 messages on ready
    $.ajax({
        method : 'POST',
        url : '../site/load-messages',
        dataType : 'json',
        success : function (data) {
            $.each(data.reverse(), function (key, value) {
                chatContent.val(chatContent.val() + value.message_author + " : " + value.message_content + '\n');
            });
        }
    });

    var chatMessage = $('<input>', {
        type : 'text',
        "class" : 'chat-message',
        id : 'chat-message'
    });

    var chatButton = $('<input>', {
        type : 'button',
        value : 'Send',
        "class" : 'chat-button',
        id : 'chat-button'
    });

    chatBox.hover(function () {
        $(this).animate({height : '300px'}, 'slow');
        chatBox.append(chatContent)
            .append(chatMessage)
            .append(chatButton);
    }, function () {
        $(this).animate({height : '40px'}, 'slow');
    });

    body.keypress(function (e) {
        if(e.which == 13)
        {
            return sendMessage();
        }
    });

    body.on('click', '#chat-button', function () {
        return sendMessage();
    });

    function sendMessage() {
        var message = $('#chat-message').val();
        var chat = $('#cont');
        $.ajax({
            method : 'POST',
            url : '../site/add-message?message=' + message,
            dataType : 'json',
            success : function ( data ) {
                chat.val(chat.val() + data.message_author + ' : ' + data.message_content + '\n');
                $('#chat-message').val('');
                chat.scrollTop(chat.prop('scrollHeight') - chat.height());
            }
        }) ;
    }

});