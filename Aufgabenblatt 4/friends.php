<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Friends</title>
    <link rel="stylesheet" href="index.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet">
    <script defer src="./js/main.js"></script>
    <script defer src="./js/request.js"></script>
    <script defer src="./js/friends.js"></script>
</head>

<?php

require("start.php");

if(empty($_SESSION["user"])){
    header("Location: login.php");
}

$friends = $service->loadFriends();

?>

<body>
    <h1>Friends</h1>
    <a class="blue-link" href="logout.php">< Logout </a> | 
    <a class="blue-link" href="settings.php">Settings</a>
    <hr>
    <div class="container empty" id="friend-container">
        <ul>
            <?php foreach ($friends as $friend) {?>
            <li class="item">
                <a href="chat.php" class="blue-link">
                    <?= $friend->getUsername() ?>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
    <hr id="friend-break-line">
    <h2>New Requests</h2>
    <ol class="container empty" id="friend-request-container">
    </ol>
    <hr>
    <div class="input-container">
        <input type="text" placeholder="Add Friend to List" name="friendRequestname" id="friend-request-name" list="friend-selector">
        <datalist id="friend-selector"></datalist>
        <button onclick="addFriend()">Add</button>
    </div>
</body>

<template id="friend-request-template">
    <li class="list-item">
        <text>Friend request from <b></b></text>
        <button>Accept</button>
        <button>Reject</button>
    </li>
</template>

</html>