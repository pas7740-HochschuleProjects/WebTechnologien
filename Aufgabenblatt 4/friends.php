<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Friends</title>
    <link rel="stylesheet" href="index.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet">
    <script defer src="./js/request.js"></script>
    <script defer src="./js/friends.js"></script>
</head>

<?php

require("start.php");

if(empty($_SESSION["user"])){
    header("Location: login.php");
}

$userList = $service->loadUsers();
$friends = $service->loadFriends();
$friendList = [];
$requestList = [];
$requestOptions = [];

$addFriendFailed = false;

// Load friends
foreach ($friends as $friend){
    if($friend->getStatus() == "accepted"){
        array_push($friendList, $friend);
    }
    else if($friend->getStatus() == "requested"){
        array_push($requestList, $friend);
    }
}

// Load userList without me and friends
foreach($userList as $user){
    if($user != $_SESSION["user"]->getUsername()){
        $isFriend = false;
        foreach ($friends as $friend){
            if($user == $friend->getUsername()){
                $isFriend = true;
                break;
            }
        }
        if(!$isFriend){
            array_push($requestOptions, $user);
        }
    }
}

if (isset($_POST["action"])) {
    if($_POST["action"] == "add-friend"){
        if(isset($_POST["friendRequestname"])){
            if($_POST["friendRequestname"] == $_SESSION["user"]->getUsername()){
                $addFriendFailed = true;
            }
            if(!$addFriendFailed){
                $service->friendRequest(new Model\Friend($_POST["friendRequestname"]));
            }
        }
    }
    else if($_POST["action"] == "delete-friend"){
        if(isset($_POST["friendname"])){
            $service->removeFriend($_POST["friendname"]);
        }
    }
    else if($_POST["action"] == "accept-friend"){
        if(isset($_POST["friendname"])){
            $service->friendAccept($_POST["friendname"]);
        }
    }
    else if($_POST["action"] == "reject-friend"){
        if(isset($_POST["friendname"])){
            $service->friendDismiss($_POST["friendname"]);
        }
    }
}

$unreadMessagesObject = $service->getUnread();

$unreadMessages = [];

foreach($unreadMessagesObject as $key => $value) {
    $unreadMessages[$key] = $value;
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
            <li class="item friend-item" id="<?php echo $friend->getUsername(); ?>">
                <a href="chat.php?friend=<?php echo $friend->getUsername(); ?>" class="blue-link">
                    <?php
                    if($friend->getStatus() == "accepted"){
                        echo $friend->getUsername();
                    }
                    ?>
                </a>
                <?php if(isset($unreadMessages[$friend->getUsername()]) && $unreadMessages[$friend->getUsername()] != 0){ ?>
                <div id="unread">
                    <?php echo $unreadMessages[$friend->getUsername()]; ?>
                </div>
                <?php } ?>
            </li>
            <?php } ?>
        </ul>
    </div>
    <hr id="friend-break-line" class="<?php if(count($friendList) == 0) echo 'invisible';?>">
    <h2>New Requests</h2>
    <ol class="container <?php if(count($requestList) == 0) echo 'empty';?>" id="friend-request-container">
        <?php foreach ($requestList as $request) {?>
            <form method="post" action="friends.php">
                <li class="list-item" id="<?php echo $request->getUsername(); ?>">
                    <text>Friend request from <b>
                        <?php echo $request->getUsername(); ?>
                    </b></text>
                    <input type="hidden" value="<?php echo $request->getUsername(); ?>" name="friendname"/>
                    <button type="submit" name="action" value="accept-friend">Accept</button>
                    <button type="submit" name="action" value="reject-friend">Reject</button>
                </li>
            </form>
        <?php } ?>
    </ol>
    <hr>
    <div class="input-container">
        <form method="post" action="friends.php">
            <fieldset>
                <input type="text" placeholder="Add Friend to List" name="friendRequestname" id="friend-request-name" list="friend-selector">
                <datalist id="friend-selector">
                    <?php foreach ($requestOptions as $option) {?>
                        <option value="<?php echo $option ?>"/>
                    <?php } ?>
                </datalist>
                <button type="submit" name="action" value="add-friend">Add</button>
            </fieldset>
        </form>
    </div>
    <br>
    <?php if($addFriendFailed) {?>
        <div id="add-friend-failed">Add Friend failed</div>
    <?php } ?>
</body>

<template id="friend-template">
    <li class="item friend-item"><a class="blue-link"></a></li>
</template>

<template id="friend-request-template">
    <form method="post" action="friends.php">
        <li class="list-item">
            <text>Friend request from <b></b></text>
            <input type="hidden" name="friendname"/>
            <button type="submit" name="action" value="accept-friend">Accept</button>
            <button type="submit" name="action" value="reject-friend">Reject</button>
        </li>
    </form>
</template>

</html>