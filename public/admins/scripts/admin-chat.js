let messageUnread = 0
let chatOpen = null
let komplainData = []

let btnChat = document.getElementById('btn-chat')
let chatPanel = document.getElementById('chat-panel')
let benCloseChat = document.getElementById('close-chat-panel')

btnChat.addEventListener('click', function () {
    this.classList.add('hidden')
    chatPanel.classList.add('show-panel')
})

benCloseChat.addEventListener('click', function () {
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

function getKomplain() {
    messageUnread = 0
    return new Promise((resolve, reject) => {
        ajaxRequest.get({ "url": "/admin/komplain/get" }).then(res => {
            if (res.data.length > 0) {
                komplainData = res.data

                let users = ``
                let notif = ``

                res.data.forEach(u => {
                    messageUnread += u.unread
                    if (u.id == chatOpen) {
                        notif = `<span class="notif" data-notif="notif-${u.id}" style="display: none;">0</span>`
                    } else {
                        notif = `<span class="notif" data-notif="notif-${u.id}" style="display: ${(u.unread > 0) ? "block" : "none"};">${u.unread}</span>`
                    }

                    users += `<div class="user${chatOpen === u.id ? ' active' : ''}" data-id="${u.id}">
                                    <span class="subjek">${u.subjek}</span>
                                    <span class="small">From : ${u.user.name}</span>
                                    <span class="small">No. ${u.id}</span>
                                    ${notif}
                                </div>`
                });

                $('#chat-panel .left-panel .bottom').html(users)
                komplainClick()

                if (res.unread > 0) {
                    $('#btn-chat .chat-notif').html(messageUnread)
                    $('#btn-chat .chat-notif').css('display', 'block')
                }
            }
            resolve()
        })
    })
}

getKomplain().then(res => {
    // console.log('users refreshed !');
})

function komplainClick() {
    $('.user').on('click', function () {
        const data = komplainData.find(v => v.id === $(this).data('id'))

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
                "url": "/admin/komplain/read-message",
                "data": {
                    "komplain_id": $(this).data('id')
                }
            })
        }

        $('.user').removeClass('active')
        $(this).addClass('active')
        $('.right-panel .top span').html(data.user.name)

        let messages = `<div class="subjek">
                            <span>Subjek : </span>&nbsp; ${data.subjek}
                        </div>`

        data.chat.forEach(c => {
            messages += `<div class="message ${(c.from_user == document.getElementById('user-id').value) ? 'me' : ''}">
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

        const subjekHeight = $('#chat-panel .right-panel .center .subjek').outerHeight()
        $('#chat-panel .right-panel .center').css('padding-top', `calc(${subjekHeight}px + 1.25rem)`)

        sendMessageFn(data.user.id)
        let chatBody = document.querySelector('#chat-panel .center')
        chatBody.scrollTop = chatBody.scrollHeight - chatBody.offsetHeight
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
            "url": "/admin/komplain/send-message",
            "data": {
                "to_user": to,
                "komplain_id": chatOpen,
                "message": message
            }
        }).then(res => {
            if (!res.response) {
                alert(res.message)
            }

            komplainData.find(v => v.id === res.chat.komplain_id).chat.push(res.chat)
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

channel.bind('chat-event', function (data) {
    const checkData = komplainData.find(v => v.id === data.komplain_id)

    if (!checkData) return getKomplain()

    komplainData.find(v => v.id === data.komplain_id).chat.push(data.chat)

    if (chatOpen === data.komplain_id) {
        $('#chat-panel .right-panel .center').append(`<div class="message">
                                                            <div class="message-content">${data.chat.message}</div>
                                                        </div>`)

        let chatBody = document.querySelector('#chat-panel .center')
        chatBody.scrollTop = chatBody.scrollHeight - chatBody.offsetHeight
    } else {
        let thisKomplainUnread = $(`.notif[data-notif="notif-${data.komplain_id}"]`).html()
        thisKomplainUnread = parseInt(thisKomplainUnread) + 1

        if (thisKomplainUnread > 0) {
            $(`.notif[data-notif="notif-${data.komplain_id}"]`).html(thisKomplainUnread)
            $(`.notif[data-notif="notif-${data.komplain_id}"]`).show()
        }

        messageUnread += 1
        if (messageUnread == 0) {
            $('#btn-chat .chat-notif').hide()
            $('#btn-chat .chat-notif').html('0')
        } else {
            $('#btn-chat .chat-notif').html(messageUnread)
            $('#btn-chat .chat-notif').show()
        }
    }
});