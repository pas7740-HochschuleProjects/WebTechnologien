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
const xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        let data = JSON.parse(xmlhttp.responseText);
        console.log(data);
    }
};
xmlhttp.open("GET", backendUrl + "/user", true);
xmlhttp.setRequestHeader('Authorization', 'Bearer ' + token);
xmlhttp.send();

var xmlhttps = new XMLHttpRequest();
xmlhttps.onreadystatechange = function() {
    if(xmlhttps.readyState == 4) {
        if(xmlhttps.status == 204) {
            console.log("Exists");
        } else if(xmlhttps.status == 404) {
            console.log("Does not exist");
        }
    }
};
xmlhttps.open("GET", "https://online-lectures-cs.thi.de/chat/7b75c2e2-0dbd-4363-8e97-419ac36ac777/user/Tom", true);
xmlhttps.send();