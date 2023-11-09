let friendName = getChatpartner();
let überSchrift = document.getElementById("Chatüberschrift");
überSchrift.innerText = "Chat with " + friendName;

function getChatpartner() {
    const url = new URL(window.location.href);
    const queryParams = url.searchParams;
    const friendValue = queryParams.get("friend");
    console.log("Friend:", friendValue);
    return friendValue;
}

function loadChat() {
    fetch('Placeholder');
}
window.setInterval(function () {
    loadChat();
}, 1000)

window.backendUrl = "https://online-lectures-cs.thi.de/chat/id";
window.token = "token";
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
