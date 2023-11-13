const TomToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNjk5NTM4Mzk1fQ.fMSqkUd7KhPW-G01o4f_h3Ai5s8qHsUSK3VkqQ1kCow";
const JerryToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiSmVycnkiLCJpYXQiOjE2OTk1MzgzOTV9.ifConheetJG1jtufH1_wsd3ue159ivJ9XcfG-cVDmXs";
const CollectionID = "7b75c2e2-0dbd-4363-8e97-419ac36ac777";
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

//function loadChat() {
//   fetch();
//}

window.setInterval(function () {
    loadChat();
}, 1000)

window.backendUrl = "https://online-lectures-cs.thi.de/chat/7b75c2e2-0dbd-4363-8e97-419ac36ac777";
window.token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNjk5NTM4Mzk1fQ.fMSqkUd7KhPW-G01o4f_h3Ai5s8qHsUSK3VkqQ1kCow";
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
xmlhttps.open("GET", "https://online-lectures-cs.thi.de/chat/7b75c2e2-0dbd-4363-8e97-419ac36ac777/user/Tom", true);
xmlhttps.send();

var xmlhttp3 = new XMLHttpRequest();
xmlhttp3.onreadystatechange = function () {
    if (xmlhttp3.readyState == 4 && xmlhttp3.status == 200) {
        let data = JSON.parse(xmlhttp3.responseText);
        console.log(data);
    }
};
xmlhttp3.open("GET", "https://online-lectures-cs.thi.de/chat/ed84cb44-8b4c-4eeb-83d8-7df122c7b164/message/Jerry", true);
xmlhttp3.setRequestHeader('Authorization', 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNjk5NjIxNzk0fQ.zfRU6UnRiz853w3CAH4Ke0tADNqk0OxHQgxDFOnrE08');
xmlhttp3.send();

let xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 204) {
        console.log("done...");
    }
};
xmlhttp.open("POST", "https://online-lectures-cs.thi.de/chat/ed84cb44-8b4c-4eeb-83d8-7df122c7b164/message", true);
xmlhttp.setRequestHeader('Content-type', 'application/json');
// Add token, e. g., from Tom
xmlhttp.setRequestHeader('Authorization', 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNjk5NjIxNzk0fQ.zfRU6UnRiz853w3CAH4Ke0tADNqk0OxHQgxDFOnrE08');
// Create request data with message and receiver
let data = {
    message: "Hello?!",
    to: "Jerry"
};
let jsonString = JSON.stringify(data); // Serialize as JSON
xmlhttp.send(jsonString); // Send JSON-data to server