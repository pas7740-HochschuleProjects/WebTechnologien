let friendList = [], requestList = [];

window.setInterval(()=>loadFriends(), 1000);

async function loadFriends(){
    await phpRequest(REQUEST_TYPE.GET,"ajax_load_friends.php", undefined, false).then((response)=>{
        if(response.status == 200){
            friendList = [], requestList = [];

            for(let user of response.data){
                if(user.status == "accepted"){
                    friendList.push(user.username);
                }
                else{
                    requestList.push(user.username);
                }
            }
        }
    });

    updateFriendList();
    updateFriendRequestList();
}

function updateFriendList(){
    let friendContainer = document.getElementById("friend-container");
    let friendBreakLine = document.getElementById("friend-break-line");
    let ulElement = friendContainer.children[0];

    for(let child of ulElement.children){
        if(!friendList.includes(child.id)){
            child.remove();
        }
    }

    // If friendlist is not empty
    if(friendList.length != 0){
        let liTemplate = document.getElementById("friend-template");

        // Style
        friendContainer.classList.remove("empty");
        friendBreakLine.classList.remove("invisible");

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
                liElement.children[0].setAttribute("href", "chat.php?friend=" + friend);
            }
        }
    }
    else{
        friendContainer.classList.add("empty");
        friendBreakLine.classList.add("invisible");
    }
}

function updateFriendRequestList(){
    let friendRequestContainer = document.getElementById("friend-request-container");

    for(let child of friendRequestContainer.children){
        if(!requestList.includes(child.children[0].id)){
            child.remove();
        }
    }

    if(requestList != 0){
        let liTemplate = document.getElementById("friend-request-template");

        // Style
        friendRequestContainer.classList.remove("empty");

        // Li
        for(let request of requestList){
            let requestFound = false;
            for(let child of friendRequestContainer.children){
                if(child.children[0].id == request){
                    requestFound = true;
                    break;
                }
            }
            if(!requestFound){
                friendRequestContainer.appendChild(liTemplate.content.cloneNode(true));
                let liElement = friendRequestContainer.children[friendRequestContainer.children.length-1].children[0];
                liElement.id = request;
                liElement.children[0].getElementsByTagName("b")[0].innerHTML = request;
                liElement.children[1].value = request;
            }
        }
    }
    else{
        friendRequestContainer.classList.add("empty");
    }
}