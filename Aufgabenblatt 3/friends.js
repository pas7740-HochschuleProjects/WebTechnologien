let friendSelector = document.getElementById("friend-selector");

getRequest("user").then((response)=>{
    for(let user of response.data){
        if(user != USERNAME){
            // Add Check user
            var option = document.createElement('option');
            option.value = user;
            friendSelector.appendChild(option);
        }
    }
});

function AddFriend(){
    let friendRequestName = document.getElementById("friend-request-name");
    postRequest("friend",  {username: friendRequestName.value}).then((response)=>{
        if(response.status == 204){
            console.log("Okay");
            return;
        }
        console.log("Error");
    });
}