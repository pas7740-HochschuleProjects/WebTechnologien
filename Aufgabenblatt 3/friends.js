let userList = [], friendList = [], requestList = [];

let friendSelector = document.getElementById("friend-selector");

window.setInterval(()=>loadFriends(), 1000);

getRequest("user").then((response)=>{
    userList = response.data;
    for(let username of response.data){
        if(!isCurrentUser(username)){
            if(!isUserInList(friendList, username)){
                // Add Check user
                var option = document.createElement('option');
                option.value = username;
                friendSelector.appendChild(option);
            }
        }
    }
});

function loadFriends(){
    getRequest("friend").then((response)=>{
        if(response.status == 200){
            for(let user of response.data){
                if(user.status == "accepted"){
                    if(!isUserInList(friendList, user.username)){
                        friendList.push(user.username);
                    }
                }
                else{
                    if(!isUserInList(requestList, user.username)){
                        requestList.push(user.username);
                    }
                }
            }
        }
    });
    //console.log("User: " + userList);
    //console.log("Friends: " + friendList);
    //console.log("Requested: " + requestList);
}

function addFriend(){
    let friendRequestName = document.getElementById("friend-request-name");
    let username = friendRequestName.value;
    if(isUserInList(userList, username)){
        if(!isUserInList(friendList, username)){
            if(!isCurrentUser(username)){
                postRequest("friend",  {username: username}).then((response)=>{
                    if(response.status == 204){
                        console.log("Okay");
                        friendRequestName.style.border = "1px solid black";
                        friendRequestName.value = "";
                        return;
                    }
                    console.log("Error");
                });
                return;
            }
        }
    }
    friendRequestName.style.border = "1px solid red";
}

function isUserInList(list, username){
    return list.indexOf(username) != -1;
}

function isCurrentUser(username){
    return username == USERNAME;
}