let friendList = [], requestList = [], unreadList = {};

window.setInterval(()=>loadFriends(), 1000);

async function loadFriends(){
    await phpRequest(REQUEST_TYPE.GET,"ajax_load_friends.php", undefined, false).then((response)=>{
        if(response.status == 200){
            friendList = [], requestList = [], unreadList = {};
            for(let user of response.data){
                if(user.status == "accepted"){
                    friendList.push(user.username);
                    if(user.unread > 0){
                        unreadList[user.username] = user.unread;
                    }
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
        friendContainer.classList.remove("d-none");
        friendBreakLine.classList.remove("d-none");

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
                liElement.setAttribute("href", "chat.php?friend=" + friend);
            }
        }

        for(let child of ulElement.children){
            // Badges
            if(unreadList[child.id] != undefined){
                let span = child.children[1];
                span.classList.remove("d-none");
                span.innerHTML = unreadList[child.id];
            }
        }
    }
    else{
        friendContainer.classList.add("d-none");
        friendBreakLine.classList.add("d-none");
    }
}

function updateFriendRequestList(){
    let friendRequestContainer = document.getElementById("friend-request-container");
    let friendRequestList = friendRequestContainer.children[0];

    for(let child of friendRequestList.children){
        if(!requestList.includes(child.id)){
            child.remove();
        }
    }

    if(requestList != 0){
        let liTemplate = document.getElementById("friend-request-template");

        // Style
        friendRequestContainer.classList.remove("d-none");

        // Li
        for(let request of requestList){
            let requestFound = false;
            for(let child of friendRequestList.children){
                if(child.id == request){
                    requestFound = true;
                    break;
                }
            }
            if(!requestFound){
                friendRequestList.appendChild(liTemplate.content.cloneNode(true));
                let liElement = friendRequestList.children[friendRequestList.children.length-1];
                liElement.id = request;
                liElement.children[1].innerHTML = request;
            }
        }
    }
    else{
        friendRequestContainer.classList.add("d-none");
    }
}

function setModal(request){
    // Set title
    document.getElementsByClassName("modal-title")[0].children[1].innerHTML = request.id;
    document.getElementById("modalRequestFriendname").value = request.id;
}