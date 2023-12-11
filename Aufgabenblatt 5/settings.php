<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Profile Settings</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
    <h1>Profile Settings</h1>

    <form method="post" action="settings.php" class="form-design">
        <fieldset>
            <legend>Base Data</legend>
            <label> <text>First Name</text> <input type="text" value="<?= $user->getFirstname() ?>"  placeholder="Your name" name="firstname" /></label>
            <label> <text>Last Name</text> <input type="text" value="<?= $user->getLastname() ?>" placeholder="Your surname" name="lastname" /></label>
            <label><text>Coffee or Tea?</text>
                <select name="favdrink">
                    <option value="Coffee" <?= $user->getFavdrink() != "Coffee" ?: "selected" ?>>Coffee</option>
                    <option value="Tea" <?= $user->getFavdrink() != "Tea" ?: "selected" ?>>Tea</option>
                    <option value="Neither" <?= $user->getFavdrink() != "Neither" ?: "selected" ?>>Neither</option>
                </select>
            </label>
        </fieldset>
        <fieldset>
            <legend>Tell Something About You</legend>
            <textarea name="description" cols="70" rows="6" placeholder="Leave a comment here"><?= $user->getDescription() ?></textarea>
        </fieldset>
        <fieldset>
            <legend>Prefered Chat Layout</legend>
            <div class="favlayout">
                <input type="radio" name="favlayout" value="oneline" checked="true" <?= $user->getFavlayout() != "oneline" ?: "checked" ?> />Username and message in one line
            </div>
            <div class="favlayout">
                <input type="radio" name="favlayout" value="sepline" <?= $user->getFavlayout() != "sepline" ?: "checked" ?> />Username and message in seperate lines
            </div>
        </fieldset>
        <button formaction="friends.php">Cancel</button>
        <button type="submit" name="action">Save</button>
    </form>
</body>

</html>