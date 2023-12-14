<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Chat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet">

    <script defer src="./js/request.js"></script>
    <script defer src="./js/chat.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>

<?php

require("start.php");

if(empty($_SESSION["user"])){
    header("Location: login.php");
} else if(empty($_GET['friend'])){
    header("Location: friends.php");
}

?>

<body class="container">
    <h1 id="heading"></h1>
    <div class="btn-group" role="group">
      <a class="btn btn-secondary mt-0 mb-0"href="friends.php">
      < Back
      </a> 
        <a class="btn btn-secondary mt-0 mb-0" href="profile.php?friend=<?php echo $_GET['friend']; ?>">
        Profile
        </a> 
                <form class="btn btn-secondary bg-danger border-0" method="post" action="friends.php" id="remove-friend-form">
                <input type="hidden" value="<?php echo $_GET['friend']; ?>" name="friendname" />
                <button class="btn btn-secondary bg-danger border-0 mt-0 mb-0"type="submit" name="action"  value="delete-friend" id="remove-friend-button">
                Remove Friend
                </button>
                </form>
    </div>            
               

            <div class="container border border-dark mb-2 mt-2" >
                  <ul class="col align-items-start" id="chatbox" >
                  </ul>  
            </div>

            <div class="input-group mr-0">
                <input class="form-control" id="textsubmit" type="text" placeholder="New Message"/>
                <button class="btn btn-primary border-0" onclick="sendMessage()" >Send</button>
            </div>
</body>

<template id="message-template">
    <li class="d-flex justify-content-between"><text></text><text></text></li>
</template>

</html>