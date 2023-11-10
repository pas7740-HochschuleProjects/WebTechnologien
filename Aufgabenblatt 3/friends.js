let friendSelector = document.getElementById("friend-selector");

getRequest("user").then((response)=>{
    for(let user of response.data){
        // Add Check user
        var option = document.createElement('option');
        option.value = user;
        friendSelector.appendChild(option);
    }
});