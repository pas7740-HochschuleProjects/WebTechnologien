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
</head>

<?php

require("start.php");

if(empty($_SESSION["user"])){
    header("Location: login.php");
}

$friends = $service->loadFriends();
$friendList = [];
$requestList = [];

foreach ($friends as $friend){
    if($friend->getStatus() == "accepted"){
        array_push($friendList, $friend);
    }
    else if($friend->getStatus() == "requested"){
        array_push($requestList, $friend);
    }
}

?>

<body>
    <h1>Friends</h1>
    <a class="blue-link" href="logout.php">< Logout </a> | 
    <a class="blue-link" href="settings.php">Settings</a>
    <hr>
    <div class="container <?php if(count($friendList) == 0) echo 'empty';?>" id="friend-container">
        <ul>
            <?php foreach ($friendList as $friend) {?>
            <li class="item">
                <a href="chat.php?friend=<?php echo $friend->getUsername();?>" class="blue-link">
                    <?php
                    if($friend->getStatus() == "accepted"){
                        echo $friend->getUsername();
                    }
                    ?>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
    <hr id="friend-break-line" class="<?php if(count($friends) == 0) echo 'invisible';?>">
    <h2>New Requests</h2>
    <ol class="container <?php if(count($requestList) == 0) echo 'empty';?>" id="friend-request-container">
        <?php foreach ($requestList as $request) {?>
            <li class="list-item">
                <text>Friend request from <b>
                    <?php
                    echo $request->getUsername();
                    ?>
                </b></text>
                <button name="action" submit="accept-friend">Accept</button>
                <button name="action" submit="reject-friend">Reject</button>
            </li>
        <?php } ?>
    </ol>
    <hr>
    <div class="input-container">
        <input type="text" placeholder="Add Friend to List" name="friendRequestname" id="friend-request-name" list="friend-selector">
        <datalist id="friend-selector"></datalist>
        <button type="submit" name="action" onclick="addFriend()">Add</button>
    </div>
</body>

</html>