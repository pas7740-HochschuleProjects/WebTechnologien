let chatData = []; 
const JERRY_ACCESS_TOKEN = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiSmVycnkiLCJpYXQiOjE3MDAxNDM4NTR9.tOujsKI14Uxl5ZNagmvXALRBJf7WtHuIvXSt2UYDucE";

// function getChatpartner() {
//     const url = new URL(window.location.href);
//     const queryParams = url.searchParams;
//     const friendValue = queryParams.get("friend");
//     console.log("Friend:", friendValue);
//     return friendValue;
// }

//let friendName = friendValue;
//friendName.setAttribute("href", "chat.html?friend=" + user.username);
//let überSchrift = document.getElementById("heading");
//überSchrift.innerText = "Chat with " + friendName;

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

// const xmlhttp1 = new XMLHttpRequest();
// xmlhttp1.onreadystatechange = function () {
//     if (xmlhttp1.readyState == 4 && xmlhttp1.status == 200) {
//         let data = JSON.parse(xmlhttp1.responseText);
//         console.log(data);
//     }
// };
// xmlhttp1.open("GET", BASE_URL + "/user", true);
// xmlhttp1.setRequestHeader('Authorization', 'Bearer ' + ACCESS_TOKEN);
// xmlhttp1.send();

function sendMessage() {
    let newchatData = [];
    newchatData = document.getElementById("textsubmit");
    // let xmlhttp = new XMLHttpRequest();
    // xmlhttp.onreadystatechange = function () {
    //     if (xmlhttp.readyState == 4 && xmlhttp.status == 204) {
    //         console.log("done...");
    //     }
    // };
    postRequest("message/" + USERNAME).then((response)=>{
        if(response.status==200){
            chatData= response.data + newchatData;
        }
    })
    
    // xmlhttp.open("POST", window.backendUrl + "/message", true);
    // xmlhttp.setRequestHeader('Content-type', 'application/json');
    // // Add token, e. g., from Tom
    // xmlhttp.setRequestHeader('Authorization', '');
    // // Create request data with message and receiver
    // let data = {
    //     msg: message,
    //     to: user
    // };
    // let jsonString = JSON.stringify(data); // Serialize as JSON
    // xmlhttp.send(jsonString); // Send JSON-data to server
}