let userList = [], friendList = [], requestList = [];

loadFriends();

window.setInterval(()=>loadFriends(), 1000);

function updateUI(){
    updateFriendSelectorList();
    updateFriendRequests();
    updateFriendList();
}

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

    updateUI();
}

function updateFriendSelectorList(){
    getRequest("user").then((response)=>{
        userList = response.data;
        for(let username of response.data){
            if(!isCurrentUser(username)){
                if(!isUserInList(friendList, username)){
                    let optionFound = false;
                    let friendSelector = document.getElementById("friend-selector");
                    // Add Check user
                    for(let child of friendSelector.children){
                        if(child.id == username){
                            optionFound = true;
                            break;
                        }
                    }
                    if(!optionFound){
                        var option = document.createElement('option');
                        option.value = username;
                        option.id = username;
                        friendSelector.appendChild(option);
                    }
                }
            }
        }
    });
}

function updateFriendRequests(){
    let friendRequestContainer = document.getElementById("friend-request-container");

    if(requestList != 0){
        let liTemplate = document.getElementById("friend-request-template");

        // Style
        friendRequestContainer.classList.remove("empty");

        // Li
        for(let request of requestList){
            let requestFound = false;
            for(let child of friendRequestContainer.children){
                if(child.id == request){
                    requestFound = true;
                    break;
                }
            }
            if(!requestFound){
                friendRequestContainer.appendChild(liTemplate.content.cloneNode(true));
                let liElement = friendRequestContainer.children[friendRequestContainer.children.length-1];
                liElement.id = request;
                liElement.children[0].getElementsByTagName("b")[0].innerHTML = request;
            }
        }
    }
}

function updateFriendList(){
    let friendContainer = document.getElementById("friend-container");
    let friendBreakLine = document.getElementById("friend-break-line");

    // If friendlist is not empty
    if(friendList.length != 0){
        let liTemplate = document.getElementById("friend-template");
        let ulElement = friendContainer.children[0];

        // Style
        friendContainer.classList.remove("empty");
        friendBreakLine.style.display = "block";

        // Li
        for(let friend of friendList){
            let friendFound = false;
            for(let child of ulElement.children){
                if(child.id == friend){
                    friendFound = true;
                    break;
                }
            }
            if(!friendFound){
                ulElement.appendChild(liTemplate.content.cloneNode(true));
                let liElement = ulElement.children[ulElement.children.length-1];
                liElement.id = friend;
                liElement.children[0].innerHTML = friend;
                liElement.children[0].setAttribute("href", "chat.html?friend=" + friend);
            }
        }
    }
    else{
        friendContainer.classList.add("empty");
        friendBreakLine.style.display = "none";
    }
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