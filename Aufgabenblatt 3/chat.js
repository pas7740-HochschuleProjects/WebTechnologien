<script defer src="friends.js"></script>
const TomToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNzAwMDU5MDA0fQ.UwCn0HR0YEX5y6Mse0_HFti87dYCfYBIlDWty-6NZoM";
const JerryToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiSmVycnkiLCJpYXQiOjE3MDAwNTkwMDR9.8JH7M__d7gnofoWuEpf6KCVKfR5N75hJatTYpsvSrwk";
const CollectionID = "cafea7a0-e443-427e-950a-0326adb381e0";
window.backendUrl = "https://online-lectures-cs.thi.de/chat/cafea7a0-e443-427e-950a-0326adb381e0";
let username = getChatpartner();
let token;
function getChatpartner() {
    const url = new URL(window.location.href);
    const queryParams = url.searchParams;
    const friendValue = queryParams.get("friend");
    console.log("Friend:", friendValue);
    return friendValue;
}

let friendName = friendValue;
//friendName.setAttribute("href", "chat.html?friend=" + user.username);
let überSchrift = document.getElementById("heading");
überSchrift.innerText = "Chat with " + friendName;

function loadChat(username) {
    const xmlhttp4 = new XMLHttpRequest();
    xmlhttp4.open("GET", window.backendUrl + "/message/" + username, true);
    if (username == Tom) {
        token = TomToken;
    } else if (username == Jerry) {
        token = JerryToken;
    }
    xmlhttp4.setRequestHeader('Authorization', 'Bearer ' + token);
    xmlhttp4.send();
}

window.setInterval(function () {
    loadChat(username);
}, 1000)

const xmlhttp1 = new XMLHttpRequest();
xmlhttp1.onreadystatechange = function () {
    if (xmlhttp1.readyState == 4 && xmlhttp1.status == 200) {
        let data = JSON.parse(xmlhttp1.responseText);
        console.log(data);
    }
};
xmlhttp1.open("GET", backendUrl + "/user", true);
xmlhttp1.setRequestHeader('Authorization', 'Bearer ' + token);
xmlhttp1.send();

function UserExists(username) {
    var xmlhttp2 = new XMLHttpRequest();
    xmlhttp2.onreadystatechange = function () {
        if (xmlhttp2.readyState == 4) {
            if (xmlhttp2.status == 204) {
                console.log("Exists");
            } else if (xmlhttp2.status == 404) {
                console.log("Does not exist");
            }
        }
    };
    xmlhttps.open("GET", window.backendUrl + "/user/" + username, true);
    xmlhttps.send();
}

var xmlhttp3 = new XMLHttpRequest();
xmlhttp3.onreadystatechange = function () {
    if (xmlhttp3.readyState == 4 && xmlhttp3.status == 200) {
        let data = JSON.parse(xmlhttp3.responseText);
        console.log(data);
    }
};
xmlhttp3.open("GET", window.backendUrl + "/message/Jerry", true);
xmlhttp3.setRequestHeader('Authorization', 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNjk5NjIxNzk0fQ.zfRU6UnRiz853w3CAH4Ke0tADNqk0OxHQgxDFOnrE08');
xmlhttp3.send();

function sendMessage() {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 204) {
            console.log("done...");
        }
    };
    xmlhttp.open("POST", window.backendUrl + "/message", true);
    xmlhttp.setRequestHeader('Content-type', 'application/json');
    // Add token, e. g., from Tom
    xmlhttp.setRequestHeader('Authorization', '');
    // Create request data with message and receiver
    let data = {
        msg: message,
        to: user
    };
    let jsonString = JSON.stringify(data); // Serialize as JSON
    xmlhttp.send(jsonString); // Send JSON-data to server
}