<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Register</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    
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

<body class="container">
    <div class="text-center" style="">
        <img class="rounded-circle img-fluid mt-4 mb-4 w-25 h-25" src="images\user.png" width="90" />
    </div>

    <div class="container border border-dark-subtle mt-4 mb-4 row-2 w-50 h-50">
        <p class="text-center mt-4 h5">Register yourself</p>
        <form id="register-form" method="post" action="register.php" class="text-center mt-3">
            <div class="text-center text-wrap mt-2 mb-2">

                <div class="container">
                    <div class="form-floating">
                        <input class="form-control mt-2" type="text" placeholder="Username" id="username" name="username" />
                        <label for="username">Username</label>
                    </div>
                    <div class="form-floating">
                        <input class="form-control mt-2" type="password" placeholder="Password" id="password" name="password" />
                        <label for="password">Password</label>
                    </div>
                    <div class="form-floating">
                        <input class="form-control mt-2" type="password" placeholder="Confirm Password" id="confirm" name="confirm" />
                        <label for="confirm">Confirm</label>

                    </div>
                </div>

                <div class="container btn-group text-center mt-2 mb-3" role="group">
                    <button class="btn btn-secondary" formaction="login.php">Cancel</button>
                    <button name="submit" type="submit" id="submitBTN" disabled="disabled" class="btn btn-primary">Create Account</button>
                </div>
            </div>

    </div>
</body>

</html>