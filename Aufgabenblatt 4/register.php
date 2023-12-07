<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" href="index.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet">
    <script defer src="./js/main.js"></script>
    <script defer src="./js/request.js"></script>
    <script defer src="./js/register.js"></script>
</head>

<?php

require("start.php");

if (isset($_POST["submit"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];

    // check if empty
    if (empty($username)) {
        echo ("Username empty!");
    }
    if (empty($password)) {
        echo ("Password empty!");
    }
    if (empty($confirm)) {
        echo ("Confirm empty!");
    }

    $usernamelength = strlen($username);
    $passwordlength = strlen($password);

    $a = false;
    $b = false;

    // Username Validation
    if ($usernamelength < 3) {
        echo ("Username requires at least 3 characters");
    } else {
        $response = $service->userExists($username);
        if ($response) {
            echo ("Username already exists! ");
        } else {
            $a = true;
        }
    }

    // PW Validation
    if ($passwordlength < 8) {
        echo ("Password requires at least 8 characters");
    } else {
        if ($password != $confirm) {
            echo ("Password requires at least 8 characters");
        } else {
            $b = true;
        }
    }

    if ($a && $b) {
        if ($service->register($username, $password) == true) {
            $_SESSION["user"] = new Model\User($username);
            header("Location: friends.php");
        } else {
            echo ("Registration failed!");
        }
    } else {
        echo ("Registration failed!");
    }
}

?>

<body>
    <img class="round-image" src="images/user.png" width="90" />
    <h1>Register yourself</h1>

    <form id="register-form" method="post" action="register.php">
        <fieldset>
            <legend>Register</legend>
            <label> <text>Username</text> <input placeholder="Username" type="text" id="username" name="username"/> </label>
            <div class="input-error" id="UserError"></div>
            <label> <text>Password</text> <input placeholder="Password" type="password" id="password" name="password"/> </label>
            <div class="input-error" id="PasswordError"></div>
            <label> <text>Confirm Password</text> <input placeholder="Confirm Password" type="password" id="confirm" name="confirm"/> </label>
            <div class="input-error" id="ConfirmError"></div>
        </fieldset>

        <button class="secondary" formaction="login.php">Cancel</button>
        <button name="submit" type="submit" id="submitBTN" disabled="disabled" class="primary" >Create Account</button>
    </form>

</body>

</html>