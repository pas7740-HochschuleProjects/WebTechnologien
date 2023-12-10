<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Profile</title>
    <link rel="stylesheet" href="index.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet">
</head>

<?php

require("start.php");

if(empty($_SESSION["user"])){
    header("Location: login.php");
}
else if(empty($_GET["friend"])){
    header("Location: friends.php");
}

$friend = $service->loadUser($_GET["friend"]);

?>

<body>
    <h1>Profile of <?php echo $_GET["friend"]; ?></h1>

    <a href="chat.php?friend=<?php echo $_GET["friend"]; ?>">
        < Back to Chat</a> |
            <form method="post" action="friends.php" id="remove-friend-form">
                <input type="hidden" value="<?php echo $_GET['friend']; ?>" name="friendname" />
                <button type="submit" name="action" class="no-button" value="delete-friend">
                    <a class="red-link">
                        Remove Friend
                    </a>
                </button>
            </form>

            <p><?php echo $friend->getDescription(); ?></p>

            <img src="images/profile.png" width="200" />
            
            <div id="profile-infos">
                <dl>
                    <?php if($friend->getFavDrink() != NULL) { ?>
                        <dt>Coffee or Tea?</dt>
                        <dd><?php echo $friend->getFavDrink(); ?></dd>
                    <?php } ?>
                    <?php if($friend->getFirstname() != NULL && $friend->getLastName() != NULL) { ?>
                        <dt>Name</dt>
                        <dd><?php echo $friend->getFirstname(); echo " "; echo $friend->getLastname(); ?></dd>
                    <?php } ?>
                </dl>
            </div>
</body>

</html>