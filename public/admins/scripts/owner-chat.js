let messageUnread = 0
let chatOpen = null

let btnChat = document.getElementById('btn-chat')
let chatPanel = document.getElementById('chat-panel')
// let chatBody = document.querySelector('#chat-panel .center')
let benCloseChat = document.getElementById('close-chat-panel')

btnChat.addEventListener('click', function(){
    this.classList.add('hidden')
    // chatBody.scrollTop = chatBody.scrollHeight - chatBody.offsetHeight
    chatPanel.classList.add('show-panel')
})

benCloseChat.addEventListener('click', function() {
    chatPanel.classList.remove('show-panel')
    btnChat.classList.remove('hidden')
    setTimeout(() => {
        chatOpen = null
        $('.left-panel .bottom .user').removeClass('active')
        $('.right-panel .top span').html('')
        $('#chat-panel .right-panel .empty-chat').remove()
        $('#chat-panel .right-panel .center').remove()
        $('#chat-panel .right-panel .bottom').remove()
        $('#chat-panel .right-panel').append(`<div class="empty-chat">
                                                    <i class="fas fa-comment-dots"></i>
                                                </div>`)
    }, 300);
})

function getUsers() {
    messageUnread = 0
    return new Promise((resolve, reject) => {
        ajaxRequest.get({ "url": "/owner/chat/get-users" }).then(res => {
            if (res.length > 0) {
                let users = ``
                let notif = ``
                res.forEach(u => {
                    messageUnread += u.unread
                    if (u.id == chatOpen) {
                        notif = `<span class="notif" style="display: none;">0</span>`
                    } else {
                        notif = `<span class="notif" style="display: ${ (u.unread > 0) ? "block" : "none" };">${u.unread}</span>`
                    }

                    users += `<div class="user" data-id="${u.id}" data-name="${u.name}">
                                    <i class="fas fa-user"></i>
                                    <span>${u.name}</span>
                                    ${notif}
                                </div>`
                });
                $('#chat-panel .left-panel .bottom').html(users)
                getUserMessage()
                if (messageUnread > 0) {
                    $('#btn-chat .chat-notif').html(messageUnread)
                    $('#btn-chat .chat-notif').css('display', 'block')
                }
                if (chatOpen != null) {
                    $(`.user[data-id="${chatOpen}"]`).addClass('active')
                }
            }
            resolve()
        })
    })
}

getUsers().then(res => {
    console.log('users refreshed !');
})


function getUserMessage(){
    $('.user').on('click', function(){
        chatOpen = $(this).data('id')
        let thisUnreadElement = $(this).find('.notif').eq(0)
        let thisUnread = thisUnreadElement.html()
        thisUnread = parseInt(thisUnread)
        if (thisUnread > 0) {
            thisUnreadElement.css('display', 'none')
            thisUnreadElement.html('0')
            messageUnread -= thisUnread
            if (messageUnread == 0) {
                $('#btn-chat .chat-notif').css('display', 'none')
                $('#btn-chat .chat-notif').html('0')
            } else {
                $('#btn-chat .chat-notif').html(messageUnread)
            }

            ajaxRequest.post({
                "url": "/owner/chat/read-message",
                "data": {
                    "from_user": $(this).data('id')
                }
            })
        }

        $('.user').removeClass('active')
        $(this).addClass('active')
        $('.right-panel .top span').html($(this).data('name'))
        ajaxRequest.post({
            "url": "/owner/chat/get-message",
            "data": {
                "user_id": $(this).data('id')
            }
        }).then(res => {
            let messages = ``
            res.chat.forEach(c => {
                messages += `<div class="message ${(c.from_user == res.my_id) ? 'me' : ''}">
                                <div class="message-content">${c.message}</div>
                            </div>`
            })

            $('.empty-chat').remove()
            $('#chat-panel .right-panel .center').remove()
            $('#chat-panel .right-panel .bottom').remove()

            $('#chat-panel .right-panel').append(`<div class="center"></div>
                                                    <div class="bottom">
                                                        <form id="form-chat">
                                                            <textarea class="input-chat" rows="1" placeholder="Tulis pesan ..."></textarea>
                                                            <button type="submit" class="send-chat"><i class="far fa-paper-plane"></i></button>
                                                        </form>
                                                    </div>`)
            $('#chat-panel .right-panel .center').html(messages)
            sendMessageFn($(this).data('id'))
            let chatBody = document.querySelector('#chat-panel .center')
            chatBody.scrollTop = chatBody.scrollHeight - chatBody.offsetHeight
        })
    })
}

function sendMessage(to) {
    let message = $('#form-chat .input-chat').val()
    if (message.length > 0) {
        $('#chat-panel .right-panel .center').append(`<div class="message me">
                                                            <div class="message-content">${message}</div>
                                                        </div>`)
        let chatBody = document.querySelector('#chat-panel .center')
        chatBody.scrollTop = chatBody.scrollHeight - chatBody.offsetHeight
        ajaxRequest.post({
            "url": "/owner/chat/send-message",
            "data": {
                "to_user": to,
                "message": message
            }
        }).then(res => {
            if (!res.response) {
                alert(res.message)
            }
        })
        $('#form-chat .input-chat').val('')
    }
}

function sendMessageFn(to) {
    $('#form-chat').on('submit', e => {
        e.preventDefault()
        sendMessage(to)
    })

    document.querySelector('#form-chat .input-chat').addEventListener('keydown', function (e) {
        const keyCode = e.which || e.keyCode;
    
        if (keyCode === 13 && !e.shiftKey) {
            e.preventDefault();
            sendMessage(to)
        }
    });
}

var pusher = new Pusher('77c3bdf5fd626a80691a', {
    cluster: 'ap1'
});

var channel = pusher.subscribe('owner-chat');

channel.bind('chat-event', function(data) {
    if (chatOpen == data.from) {
        $('#chat-panel .right-panel .center').append(`<div class="message">
                                                            <div class="message-content">${data.message}</div>
                                                        </div>`)
            let chatBody = document.querySelector('#chat-panel .center')
            chatBody.scrollTop = chatBody.scrollHeight - chatBody.offsetHeight
            ajaxRequest.post({
                "url": "/owner/chat/read-message",
                "data": {
                    "from_user": data.from
                }
            }).then(res => {
                getUsers()
            })
    } else {
        getUsers()
    }
    // getUsers().then(res => {
    // })
});