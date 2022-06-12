let chatOpen = false
let btnChat = document.getElementById('btn-chat')
let chatPanel = document.getElementById('chat-panel')
let chatBody = document.querySelector('#chat-panel .center')
let benCloseChat = document.getElementById('close-chat-panel')

btnChat.addEventListener('click', function(){
    chatOpen = true
    this.classList.add('hidden')
    chatBody.scrollTop = chatBody.scrollHeight - chatBody.offsetHeight
    chatPanel.classList.add('show-panel')
    ajaxRequest.get({
        "url": "/customer/chat/read",
    })
    $('#btn-chat .chat-notif').html('0')
    $('#btn-chat .chat-notif').css('display', 'none')
})

benCloseChat.addEventListener('click', function() {
    chatPanel.classList.remove('show-panel')
    btnChat.classList.remove('hidden')
    chatOpen = false
})

ajaxRequest.get({ "url": "/customer/chat/get" }).then(res => {
    let { chat, unread } = res
    let messages = ``

    if (chat.length > 0) {
        chat.forEach(c => {
            messages += `<div class="message ${ (c.from_user == document.getElementById('user-id').value) ? 'me' : '' }">
                            <div class="message-content">${c.message}</div>
                        </div>`
        });

        document.querySelector('#chat-panel .center').innerHTML = messages
    }

    let chatNotif = document.querySelector('#btn-chat .chat-notif')
    if (unread > 0) {
        chatNotif.innerHTML = parseInt(chatNotif.innerHTML) + unread
        chatNotif.style.display = 'block'
    } else {
        chatNotif.innerHTML = 0
        chatNotif.style.display = 'none'
    }
})

function sendMessage() {
    let message = document.querySelector('#form-chat .input-chat').value
    if (message.length > 0) {
        let messageContent = document.createElement('div')
        messageContent.setAttribute('class', 'message me')
        messageContent.innerHTML = `<div class="message-content">${message}</div>`
        document.querySelector('#chat-panel .center').appendChild(messageContent)
        chatBody.scrollTop = chatBody.scrollHeight - chatBody.offsetHeight
    
        ajaxRequest.post({
            "url": "/customer/chat/send",
            "data": {
                "message": message
            }
        }).then(res => {
            if (!res.response) {
                alert(res.message)
            }
        })
    
        document.querySelector('#form-chat .input-chat').value = ''
    }
}

let formChat = document.getElementById('form-chat')
formChat.addEventListener('submit', e => {
    e.preventDefault()
    sendMessage()
})

document.querySelector('#form-chat .input-chat').addEventListener('keydown', function (e) {
    const keyCode = e.which || e.keyCode;

    if (keyCode === 13 && !e.shiftKey) {
        e.preventDefault();
        sendMessage()
    }
});