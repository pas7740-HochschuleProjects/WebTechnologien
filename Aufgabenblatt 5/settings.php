<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Profile Settings</title>

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
$user = $_SESSION["user"];

//checks if Logged in
if(empty($user)){
  header("Location: login.php");
}

//$service->loadUser($user);
$user = $service->loadUser($user->getUsername());

//Checks if form has been submitted and save changes
if(isset($_POST["action"])){

    $user->setFirstname($_POST["firstname"]);
    $user->setLastname($_POST["lastname"]);
    $user->setFavdrink($_POST["favdrink"]);
    $user->setDescription($_POST["description"]);
    $user->setFavLayout($_POST["favlayout"]);

    $service->saveUser($user);

    header("Location: friends.php");
}
?>

<body>
    
        
    <div class="container border border-dark-subtle mt-4 mb-4 w-75">

        <h1 class="text-center mt-3">Profile Settings</h1>
        <hr />

        <form method="post" action="settings.php" class="form-design">
            <div class="mb-3">
                <h5 class="mb-3">Base Data</h5>
                <input type="text" class="form-control" value="<?= $user->getFirstname() ?>" placeholder="Your name" name="firstname" />
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" value="<?= $user->getLastname() ?>" placeholder="Your surname" name="lastname" />
            </div>

            <div class="mb-4">
                
                <h5 class="mb-3">Coffee or Tea?</h5>

                <select name="favdrink" class="form-select w-100">
                    <option value="Coffee" <?= $user->getFavdrink() != "Coffee" ?: "selected" ?>>Coffee</option>
                    <option value="Tea" <?= $user->getFavdrink() != "Tea" ?: "selected" ?>>Tea</option>
                    <option value="Neither" <?= $user->getFavdrink() != "Neither" ?: "selected" ?>>Neither</option>
                </select>
            </div>

            <hr />

            <div class="mb-3">
                <h5 class="mb-3">Tell Something About You</h5>
                <textarea class="form-control rounded-0" name="description" cols="70" rows="7" placeholder="Leave a comment here"><?= $user->getDescription() ?></textarea>
            </div>

            <div class="mb-3">
                <h5 class="mb-3">Prefered Chat Layout</h5>

                <div class="favlayout">
                    <input type="radio" name="favlayout" value="oneline" checked="true" <?= $user->getFavlayout() != "oneline" ?: "checked" ?> /> Username and message in one line
                </div>
                <div class="favlayout">
                    <input type="radio" name="favlayout" value="sepline" <?= $user->getFavlayout() != "sepline" ?: "checked" ?> /> Username and message in seperate lines
                </div>

            </div>

            <hr />

            <div class="btn-group text-center mt-3 mb-4 w-100" role="group" aria-label="Links Grau Rechts Blau">
                <button class=" btn btn-secondary" formaction="friends.php">Cancel</button>
                <button class=" btn btn-primary" type="submit" name="action">Save</button>
            </div>

        </form>
    </div>
    
</body>

</html>