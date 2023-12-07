let chatData = [];
let chatBox = document.getElementById("chatbox");

let friendName = getChatpartner();
let überSchrift = document.getElementById("heading");
überSchrift.innerText = "Chat with " + friendName;

function getChatpartner() {
    const url = new URL(window.location.href);
    const queryParams = url.searchParams;
    const friendValue = queryParams.get("friend");
    return friendValue;
}

function loadChat() {
    getRequest("message/" + friendName).then((response) => {
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

function sendMessage() {
    let newchatData = document.getElementById("textsubmit").value;
    phpRequest(REQUEST_TYPE.POST, "ajax_send_message.php", { to: friendName, msg: newchatData}, false);
    //remove the input text for the submitfeeling
    document.getElementById("textsubmit").value = "";
}