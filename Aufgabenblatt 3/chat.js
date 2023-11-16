let chatData = []; 

 function getChatpartner() {
     const url = new URL(window.location.href);
     const queryParams = url.searchParams;
     const friendValue = queryParams.get("friend");
     console.log("Friend:", friendValue);
     return friendValue;
 }

let friendName = getChatpartner();
friendName.setAttribute("href", "chat.html?friend=" + user.username);
let überSchrift = document.getElementById("heading");
überSchrift.innerText = "Chat with " + friendName;

function loadChat() {
    let ChatBox = document.getElementById("chatbox");
    getRequest("message/" + USERNAME).then((response)=>{
        if(response.status==200){
            console.log(response.data);
            chatData = response.data;
        } 
    });
    
}

window.setInterval(function () {
    loadChat();
}, 1000)

function sendMessage() {
    let newchatData = document.getElementById("textsubmit").value;

    postRequest("message/" + USERNAME, {name:"Jerry", msg: newchatData});
    
}