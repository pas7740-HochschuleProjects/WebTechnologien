<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
    <div class="container border border-dark-subtle mt-3 mb-3w-75 " style="background-color: #f5f5f5;">
        <h1 class="text-center mt-3">Profile of <?php echo $_GET["friend"]; ?></h1>

        <hr />

        <div class="btn-group w-50" role="group">

            <button class="btn btn-secondary border-0 mt-0 mb-0" href="chat.php?friend=<?php echo $_GET["friend"]; ?>">< back</button>

            <form class="btn btn-secondary bg-danger border-0" method="post" action="friends.php" id="remove-friend-form">
                <input type="hidden" value="<?php echo $_GET['friend']; ?>" name="friendname" />
                <button class="btn btn-secondary bg-danger border-0 mt-0 mb-0" type="submit" name="action" value="delete-friend" id="remove-friend-button"> Remove Friend </button>
            </form>

        </div>
        <div class="mt-3 mb-3">
            <img src="images/profile.png" width="200" />
        </div>

        <div class="container border border-dark-subtle  mb-3 w-100" style="background-color: white;">

            <p><?php echo $friend->getDescription(); ?></p>

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
        </div>
    </div>
</body>

</html>