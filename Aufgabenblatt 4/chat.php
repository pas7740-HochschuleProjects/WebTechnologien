<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Chat</title>
    <link rel="stylesheet" href="index.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet">

    <script defer src="./js/request.js"></script>
    <script defer src="./js/chat.js"></script>

</head>

<?php

require("start.php");

if(empty($_SESSION["user"])){
    header("Location: login.php");
} else if(empty($_GET['friend'])){
    header("Location: friends.php");
}

?>

<body>
    <h1 id="heading"></h1>

    <a class="blue-link" href="friends.php">
        < Back</a> |
            <a class="blue-link" href="profile.php?friend=<?php echo $_GET['friend']; ?>">Profile</a> |
            <form method="post" action="friends.php" id="remove-friend-form">
                <input type="hidden" value="<?php echo $_GET['friend']; ?>" name="friendname" />
                <button type="submit" name="action" class="no-button" value="delete-friend">
                    <a class="red-link">
                        Remove Friend
                    </a>
                </button>
            </form>

            <hr>

            <div class="container">
                <ul id="chatbox">
                </ul>
            </div>

            <hr>

            <div class="input-container">
                <input id="textsubmit" type="text" placeholder="New Message"/>
                <button onclick="sendMessage()" >Send</button>
            </div>
</body>

<template id="message-template">
    <li class="chatnachricht"><text></text><text id="timestamp"></text></li>
</template>

</html>