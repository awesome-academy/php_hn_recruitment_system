let userId = $('#user-id').val();
let conversationId = '';
let toId = '';

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    getConversationList();
    $(document).on('click', '.list-item', function() {
        toId = $(this).attr('id');
        conversationId = $(this).attr('conversation');
        showMessages(); // show messages of the conversation
        readMessages(); // click to read messages
    });

    $("#search-contact").keyup(function () {
        var query = $(this).val();
        searchContact(query);
    });

    $('#message-form').submit(function( event ) {
        event.preventDefault();
        let message = $('.chat-input').val();
        if (message !== '' && toId !== '') {
            $('.chat-input').val('');
            $.ajax({
                type: "post",
                url: "messages",
                data: {
                    toId: toId,
                    message: message,
                },
                cache: false,
                success: function (data) {
                    $('.message-content').html(data);
                },
                error: function (jqXHR, status, err) {
                },
                complete: function () {
                    scrollToBottom();
                    getConversationList();
                }
            })
        }
    });
});

Echo.private(`message.${userId}`)
    .listen('MessageSent', (e) => {
        showMessages();
    });

function scrollToBottom() {
    $('.conversation-body').animate({
        scrollTop: $('.conversation-body').get(0).scrollHeight
    }, 0);
}

function getConversationList() {
    $.ajax({
        type: 'get',
        url: 'messages',
        cache: false,
        success: function (data) {
            $('.chat-user-list').html(data);
        }
    });
}

function showMessages() {
    $.ajax({
        type: 'get',
        url: 'conversation/' + toId,
        data: '',
        cache: false,
        success: function (data) {
            $('.message-content').html(data);
        },
        complete: function () {
            getConversationList();
            scrollToBottom();
        }
    });
}

function readMessages() {
    $.ajax({
        type: 'get',
        url: 'read-messages/' + conversationId,
        success: function (data) {
        }
    });
}

function searchContact(query = '') {
    $.ajax({
        url: 'search-contact',
        method: 'GET',
        data: { query: query },
        success: function (data) {
            $('.chat-user-list').html(data);
        }
    })
}
