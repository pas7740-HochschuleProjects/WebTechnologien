let chatData = [];
let chatBox = document.getElementById("chatbox");

let friendName = getChatpartner();
let überSchrift = document.getElementById("heading");
überSchrift.innerText = "Chat with " + friendName;

loadChat();

window.setInterval(function () {
    loadChat();
}, 1000);

function getChatpartner() {
    const url = new URL(window.location.href);
    const queryParams = url.searchParams;
    const friendValue = queryParams.get("friend");
    return friendValue;
}

function loadChat() {
    phpRequest(REQUEST_TYPE.GET,"ajax_load_messages.php?to=" + friendName, undefined, false).then((response) => {
        if (response.status == 200) {
            chatData = response.data;
            let arrayLength = response.data.length;
            //Schleife über jedes Chatarray Element
            for (let j = 0; j < arrayLength; j++) {
                let messageFound = false;

                //foreach Schleife über jedes li Element in der Chatbox
                for (let child of chatBox.children) {

                    //wenn id noch nicht vorhanden dann ist es eine neue Nachricht -> renderChat()
                    if (child.id == j) {
                        messageFound = true;
                        break;
                    }

                }

                if (!messageFound) {
                    renderChat(chatBox, chatData[j], j);
                }
            }
        }
    });
}

function renderChat(chatBox, chatMessage, id) {
    //Template for the timeStamp
    
    let messageTemplate = document.getElementById("message-template");
    chatBox.appendChild(messageTemplate.content.cloneNode(true));
    let liElement = chatBox.children[chatBox.children.length-1];
    liElement.id = id;
    liElement.classList.add("item");

    //create liElement with chatmessage
    liElement.children[0].innerText = chatMessage.from + ": " + chatMessage.msg;

    // Timestamp
    
    let time = new Date(chatMessage.time).toLocaleTimeString();
    liElement.children[1].innerText = time;
    // let hours = time.getHours();
    // let minutes = time.getMinutes();
    // let seconds = time.getSeconds();
    // if(hours<10){
    //     liElement.children[1].innerText = "0"+hours+":"+minutes+":"+seconds;
    // } else if(minutes<10) {
    //     liElement.children[1].innerText = hours+":0"+minutes+":"+seconds;    
    // } else if(seconds<10) {
    //     liElement.children[1].innerText = hours+":"+minutes+":0"+seconds;
    // } else if((hours && minutes) <10) { 
    //     liElement.children[1].innerText = "0"+hours+":0"+minutes+":"+seconds;
    // } else if ((hours && seconds)<10){
    //     liElement.children[1].innerText = "0"+hours+":"+minutes+":0"+seconds;
    // } else if((hours && minutes && seconds)<10){
    //     liElement.children[1].innerText = "0"+hours+":0"+minutes+":0"+seconds;
    // } else {
    //     liElement.children[1].innerText = hours+":"+minutes+":"+seconds;
    // }
    chatBox.appendChild(liElement);
}

function sendMessage() {
    let newchatData = document.getElementById("textsubmit").value;
    phpRequest(REQUEST_TYPE.POST, "ajax_send_message.php", { to: friendName, msg: newchatData}, false);
    //remove the input text for the submitfeeling
    document.getElementById("textsubmit").value = "";
}