<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Profile</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet">

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
else if(empty($_GET["friend"])){
    header("Location: friends.php");
}

$friend = $service->loadUser($_GET["friend"]);

?>

<body>
    <div class="container border border-dark-subtle mt-3 mb-3w-75 ">
        <h1 class="text-center mt-3">Profile of <?php echo $_GET["friend"]; ?></h1>

        <hr>

        <div class="btn-group w-25" role="group">

            <a class="btn btn-secondary mt-0 mb-0" href="chat.php?friend=<?php echo $_GET["friend"]; ?>"> < Back</a>

            <a class="btn btn-danger border-0 mt-0 mb-0" data-bs-toggle="modal" data-bs-target="#chatModal">
                Remove Friend
            </a>
        </div>

    <div class="modal" id="chatModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5">Remove <?php echo $_GET['friend']; ?> 
                    as Friend
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
                </div>
                <div class="modal-body">
                    <p>Do you really want to end your friendship?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary"data-bs-dismiss="modal">
                    Cancel
                    </button>
                    <form method="post" action="friends.php" id="remove-friend-form">
                        <input type="hidden" value="<?php echo $_GET['friend']; ?>" name="friendname" />
                        <button class="btn btn-primary" type="submit" name="action"  value="delete-friend" id="remove-friend-button">
                        Yes, end this friendship!
                        </button>
                    </form>
                </div>  
            </div>    
        </div>  
    </div>
</body>

        <div class="mt-3 mb-3">
            <img src="images/profile.png" width="200" />
        </div>

        <div class="container border border-dark-subtle  mb-3 w-100">

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