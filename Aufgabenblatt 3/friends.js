let friendSelector = document.getElementById("friend-selector");

let userList = getAllUsers((response)=>{
    for(let user of response){
        // Add Check user
        var option = document.createElement('option');
        option.value = user;
        friendSelector.appendChild(option);
    }
});

function getAllUsers(callbackFunction){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if(typeof callbackFunction == "function"){
                callbackFunction(JSON.parse(xmlhttp.responseText));
            }
        }
    };
    xmlhttp.open("GET", "https://online-lectures-cs.thi.de/chat/9553730f-9fa6-4e5a-9876-f2d8b5f568f6/user", true);
    xmlhttp.setRequestHeader('Authorization', 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNjk5NTM4MjUzfQ.J_A_2fq5URQtKLnC-RNpSNKetU-hBhDBeL39okA6cv0');
    xmlhttp.send();
}