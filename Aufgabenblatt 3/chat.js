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
            console.log(response.data);
            chatData = response.data;
            let arrayLength = response.data.length;
            for (let j; j < arrayLength; j++) {
                renderChat(chatBox, chatData[j]);
            }
        }
    });
}

function renderChat(chatBox, chatMessage) {
    document.createElement("li");

    chatBox.appendChild();
}

window.setInterval(function () {
    loadChat();
}, 1000)

function sendMessage() {
    let newchatData = document.getElementById("textsubmit").value;

    postRequest("message", { to: friendName, message: newchatData, from: USERNAME });

}