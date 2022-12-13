let chatOpen = false
let chatOpenId = ''
let btnChat = document.getElementById('btn-chat')
let chatPanel = document.getElementById('chat-panel')
let chatBody = document.querySelector('#chat-panel .center')
let btnCloseChat = document.getElementById('close-chat-panel')
let komplainData = []
let chatUnread = 0

btnChat.addEventListener('click', function () {
    chatOpen = true
    this.classList.add('hidden')
    chatBody.scrollTop = chatBody.scrollHeight - chatBody.offsetHeight
    chatPanel.classList.add('show-panel')
    // ajaxRequest.get({
    //     "url": "/customer/chat/read",
    // })
    // $('#btn-chat .chat-notif').html('0')
    // $('#btn-chat .chat-notif').css('display', 'none')
})

btnCloseChat.addEventListener('click', function () {
    chatPanel.classList.remove('show-panel')
    btnChat.classList.remove('hidden')
    chatOpen = false
    chatOpenId = ''

    setTimeout(() => {
        $('.center').hide()
        $('#komplain-data').show()
        $('#add-komplain').show()

        $('.chat-panel .bottom').hide()
        $('.chat-panel .bottom #form-chat').hide()
        $('.chat-panel .bottom #send-komplain').hide()

        $('#form-chat .input-chat').val('')
        $('#add-komplain-data #subjek-komplain').val('')
        $('#add-komplain-data #pesan-komplain').val('')

        $('#komplain-back').hide()
    }, 300);
})

// ajaxRequest.get({ "url": "/customer/chat/get" }).then(res => {
//     let { chat, unread } = res
//     let messages = `
//     <div class="chat-data-subjek">
//         <b>Subjek : </b>&nbsp; Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident, delectus.
//     </div>
//     `

//     if (chat.length > 0) {
//         chat.forEach(c => {
//             messages += `<div class="message ${(c.from_user == document.getElementById('user-id').value) ? 'me' : ''}">
//                             <div class="message-content">${c.message}</div>
//                         </div>`
//         });

//         document.querySelector('#chat-panel .center').innerHTML = messages
//     }

//     let chatNotif = document.querySelector('#btn-chat .chat-notif')
//     if (unread > 0) {
//         chatNotif.innerHTML = parseInt(chatNotif.innerHTML) + unread
//         chatNotif.style.display = 'block'
//     } else {
//         chatNotif.innerHTML = 0
//         chatNotif.style.display = 'none'
//     }
// })

function sendMessage() {
    let message = document.querySelector('#form-chat .input-chat').value
    if (message && message.replaceAll(' ', '').length > 0) {
        let messageContent = document.createElement('div')
        messageContent.setAttribute('class', 'message me')
        messageContent.innerHTML = `<div class="message-content">${message}</div>`
        document.querySelector('#chat-panel .center#chat-data').appendChild(messageContent)
        chatBody.scrollTop = chatBody.scrollHeight - chatBody.offsetHeight

        ajaxRequest.post({
            "url": "/customer/chat/send",
            "data": {
                "komplain_id": chatOpenId,
                "message": message
            }
        }).then(res => {
            if (!res.response) {
                alert(res.message)
            }

            komplainData.find(v => v.id === res.komplain_id).chat.push(res.chat)
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

// 

function getKomplainData() {
    return new Promise((resolve, reject) => {
        ajaxRequest.get({ 'url': '/customer/komplain/get' }).then(res => {
            let komplainHTML = ``
            komplainData = res.data
            chatUnread += res.unread

            if (res.data.length > 0) {
                res.data.forEach(v => {
                    komplainHTML += `<div class="komplain" id="komplain-data-${v.id}" data-id=${v.id}>
                                        <div>
                                            <span class="komplain-subjek">${v.subjek}</span>
                                            <span class="komplain-id">No. &nbsp;<span>${v.id}</span></span>
                                        </div>
                                        <span class="chat-notif komplain-notif" data-notif="${v.id}" ${v.unread > 0 ? '' : 'style="display: none;"'}>${v.unread}</span>
                                    </div>`
                })
            } else {
                komplainHTML += `<div class="komplain-empty">
                                    <i class="fas fa-comment-dots"></i>
                                    <span>Belum ada pengaduan yang dibuat.</span>
                                </div>`
            }


            $('#komplain-data').html(komplainHTML)

            if (res.data.length > 0) komplainDataClick()

            let chatNotif = document.querySelector('#btn-chat .chat-notif')
            if (chatUnread > 0) {
                chatNotif.innerHTML = chatUnread
                chatNotif.style.display = 'block'
            } else {
                chatNotif.innerHTML = 0
                chatNotif.style.display = 'none'
            }
            resolve()
        })
    })
}
getKomplainData()

$('#komplain-back').on('click', function () {
    chatOpenId = ''

    $('.center').hide()
    $('#komplain-data').show()
    $('#add-komplain').show()

    $('.chat-panel .bottom').hide()
    $('.chat-panel .bottom #form-chat').hide()
    $('.chat-panel .bottom #send-komplain').hide()

    $('#form-chat .input-chat').val('')
    $('#add-komplain-data #subjek-komplain').val('')
    $('#add-komplain-data #pesan-komplain').val('')

    $(this).hide()
})

$('#add-komplain').on('click', function () {
    $('.center').hide()
    $('#add-komplain-data').show()
    $('#komplain-back').show()

    $('.chat-panel .bottom #form-chat').hide()
    $('.chat-panel .bottom #send-komplain').show()
    $('.chat-panel .bottom').show()

    $('#subjek-komplain').focus()

    $(this).hide()
})

function komplainDataClick() {
    $('#komplain-data .komplain').on('click', function () {
        chatOpenId = $(this).data('id')
        const data = komplainData.find(v => v.id === $(this).data('id'))

        let thisChatNotif = parseInt($(`.komplain-notif[data-notif="${data.id}"]`).html())

        if (thisChatNotif > 0) {
            ajaxRequest.post({
                "url": "/customer/chat/read",
                "data": {
                    "komplain_id": data.id
                }
            })

            $(`.komplain-notif[data-notif="${data.id}"]`).hide()
            $(`.komplain-notif[data-notif="${data.id}"]`).html(0)

            chatUnread -= thisChatNotif

            let btnChatNotif = document.querySelector('#btn-chat .chat-notif')
            if (chatUnread > 0) {
                btnChatNotif.innerHTML = chatUnread
                btnChatNotif.style.display = 'block'
            } else {
                btnChatNotif.innerHTML = 0
                btnChatNotif.style.display = 'none'
            }
        }

        let messagesHTML = `<div class="chat-data-subjek">
            <b>Subjek : </b>&nbsp; ${data.subjek}
        </div>
        `

        if (data.chat.length > 0) {
            data.chat.forEach(c => {
                messagesHTML += `<div class="message ${(c.from_user == document.getElementById('user-id').value) ? 'me' : ''}">
                                <div class="message-content">${c.message}</div>
                            </div>`
            });
        }

        $('#chat-panel .center#chat-data').html(messagesHTML)

        $('.center').hide()
        $('#chat-data').show()
        $('#komplain-back').show()
        $('#add-komplain').hide()

        const subjekHeight = $('#chat-data .chat-data-subjek').outerHeight()
        $('#chat-data').css('padding-top', `calc(${subjekHeight}px + .75rem)`)

        $('.chat-panel .bottom #send-komplain').hide()
        $('.chat-panel .bottom #form-chat').show()
        $('.chat-panel .bottom').show()

        let chatBody = document.querySelector('#chat-panel .center')
        chatBody.scrollTop = chatBody.scrollHeight - chatBody.offsetHeight
    })
}

$('.chat-panel .bottom #send-komplain').on('click', function () {
    const subjek = $('#subjek-komplain').val()
    const message = $('#pesan-komplain').val()

    if (subjek.replaceAll(' ', '').length === 0) return alert('Field subjek is required !')
    if (message.replaceAll(' ', '').length === 0) return alert('Field message is required !')

    $(this).attr('disabled', true)

    ajaxRequest.post({
        url: '/customer/komplain/add',
        data: {
            subjek: subjek,
            message: message
        }
    }).then(res => {
        getKomplainData().then(x => {
            $('.chat-panel .bottom #send-komplain').removeAttr('disabled')

            $('#subjek-komplain').val('')
            $('#pesan-komplain').val('')

            $(`.komplain#komplain-data-${res.komplain_id}`).click()
        })
    })
})

channel.bind(`user-${document.getElementById('user-id').value}-komplain-chanel`, function (data) {
    komplainData.find(v => v.id === data.komplain_id).chat.push(data.chat)

    if (chatOpen && chatOpenId === data.komplain_id) {
        ajaxRequest.post({
            "url": "/customer/chat/read",
            "data": {
                "komplain_id": data.komplain_id
            }
        })

        $('#chat-panel .center#chat-data').append(`<div class="message">
                                            <div class="message-content">${data.chat.message}</div>
                                        </div>`)

        let chatBody = document.querySelector('#chat-panel .center')
        chatBody.scrollTop = chatBody.scrollHeight - chatBody.offsetHeight
        return
    }

    let thisChatNotif = parseInt($(`.komplain-notif[data-notif="${data.komplain_id}"]`).html())
    $(`.komplain-notif[data-notif="${data.komplain_id}"]`).html(thisChatNotif + 1)
    $(`.komplain-notif[data-notif="${data.komplain_id}"]`).show()

    chatUnread += 1

    let btnChatNotif = document.querySelector('#btn-chat .chat-notif')
    if (chatUnread > 0) {
        btnChatNotif.innerHTML = chatUnread
        btnChatNotif.style.display = 'block'
    } else {
        btnChatNotif.innerHTML = 0
        btnChatNotif.style.display = 'none'
    }
});