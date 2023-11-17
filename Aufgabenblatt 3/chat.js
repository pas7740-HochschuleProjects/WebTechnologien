let chatData = [];

function getChatpartner() {
    const url = new URL(window.location.href);
    const queryParams = url.searchParams;
    const friendValue = queryParams.get("friend");
    console.log("Friend:", friendValue);
    return friendValue;
}

let friendName = getChatpartner();
let überSchrift = document.getElementById("heading");
überSchrift.innerText = "Chat with " + friendName;

function loadChat() {
    let chatBox = document.getElementById("chatbox");
    getRequest("message/" + friendName).then((response) => {
        if (response.status == 200) {
            chatData = response.data;
            let arrayLength = response.data.length;
            //Schleife über jedes Chatarray Element
            for(let j = 0; j < arrayLength; j++) {
                let messageFound = false;
    
                //foreach Schleife über jedes li Element in der Chatbox
                for (let child of chatBox.children) {

                    //wenn id noch nicht vorhanden dann ist es eine neue Nachricht -> renderChat()
                    if (child.id == j) {
                        messageFound = true;
                        break;
                    }
                    
                }
                if(messageFound == true) {
                    renderChat(chatBox, chatData[j]);
                }
            }
        }
    });
}

function renderChat(chatBox, chatMessage) {
    //create li with chatmessage
    let listElement = document.createElement("li");
    listElement.innerText = chatMessage.msg;
    chatBox.appendChild(listElement);
}

window.setInterval(function () {
    loadChat();
}, 1000)

function sendMessage() {
    let newchatData = document.getElementById("textsubmit").value;
    postRequest("message", { to: friendName, message: newchatData, from: USERNAME });
    
}