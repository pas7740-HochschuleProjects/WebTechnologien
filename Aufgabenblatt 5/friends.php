<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Friends</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet">

    <script defer src="./js/request.js"></script>
    <script defer src="./js/friends.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
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

<body class="container">
    <h1 class="mt-4">Friends</h1>
    <div class="btn-group mt-3">
        <a class="btn btn-secondary" href="logout.php">< Logout </a>
        <a class="btn btn-secondary" href="settings.php">Settings</a>
    </div>
    <hr class="mt-5">
    <div class="friend-container container <?php if(count($friendList) == 0) echo 'empty';?>" id="friend-container">
        <ul class="list-group">
            <?php foreach ($friendList as $friend) {?>
                <a href="chat.php?friend=<?php echo $friend->getUsername(); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" id="<?php echo $friend->getUsername(); ?>">
                    <?php
                    if($friend->getStatus() == "accepted"){
                        echo $friend->getUsername();
                    }
                    ?>
                    <?php if(isset($unreadMessages[$friend->getUsername()]) && $unreadMessages[$friend->getUsername()] != 0){ ?>
                        <span class="badge badge-primary badge-pill">
                            <?php echo $unreadMessages[$friend->getUsername()]; ?>
                        </span>
                    <?php } ?>
                </a>
            <?php } ?>
        </ul>
    </div>
    <hr id="friend-break-line" class="<?php if(count($friendList) == 0) echo 'd-none';?>">
    <h2 class="mb-4">New Requests</h2>
    <ol class="container <?php if(count($requestList) == 0) echo 'empty';?>" id="friend-request-container">
        <?php foreach ($requestList as $request) {?>
            <form method="post" action="friends.php">
                <li class="list-group-item list-group-item-action" id="<?php echo $request->getUsername(); ?>">
                    <text>Friend request from <b>
                        <?php echo $request->getUsername(); ?>
                    </b></text>
                    <!-- <input type="hidden" value="<?php echo $request->getUsername(); ?>" name="friendname"/>
                    <button type="submit" name="action" value="accept-friend">Accept</button>
                    <button type="submit" name="action" value="reject-friend">Reject</button> -->
                </li>
            </form>
        <?php } ?>
    </ol>
    <hr>
    <div class="input-container">
        <form method="post" action="friends.php">
            <fieldset>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="friendRequestname" placeholder="Add Friend to List" aria-describedby="basic-addon2" list="friend-selector">
                    <datalist id="friend-selector">
                        <?php foreach ($requestOptions as $option) {?>
                            <option value="<?php echo $option ?>"/>
                        <?php } ?>
                    </datalist>
                    <button class="btn btn-primary" type="submit" name="action" value="add-friend">Add</button>
                </div>
            </fieldset>
        </form>
    </div>

    <br>
    <?php if($addFriendFailed) {?>
        <div id="add-friend-failed">Add Friend failed</div>
    <?php } ?>
</body>

<template id="friend-template">
    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
        <div id="name">
        </div>
        <span class="badge badge-primary badge-pill d-none">
        </span>
    </a>
</template>

<template id="friend-request-template">
    <form method="post" action="friends.php">
        <li class="list-group-item list-group-item-action">
            <text>Friend request from <b></b></text>
            <!-- <input type="hidden" name="friendname"/>
            <button type="submit" name="action" value="accept-friend">Accept</button>
            <button type="submit" name="action" value="reject-friend">Reject</button> -->
        </li>
    </form>
</template>

</html>