<?php

require("start.php");

// check if empty
if(empty($_POST["username"])){
   header("Location: /register.html");
}
if(empty($_POST["password"])){
   header("Location: /register.html");
}
if(empty($_POST["confirm"])){
   header("Location: /register.html");
}


$username= $_POST['username'];
$password= $_POST['password'];
$confirmpassword= $_POST['confirm'];

$usernamelength= strlen($username);
$passwordlength= strlen($password);

$a;
$b;

// Username Validation

if($usernamelength < 3) {
    echo("Username requires at least 3 characters");
    header("Location: /register.html");
}
else {
    $a = true;
}

// PW Validation
if($passwordlength < 8) {
    echo("Password requires at least 8 characters");
    header("Location: /register.html");
}
else {
    if($password != $confirmpassword){
        echo("Password requires at least 8 characters");
        header("Location: /register.html");
    }
    else {
        $b = true;
    }
}



if ($a && $b) {
    if ($service->register($username, $password) == true) {
        $_SESSION["user"] = new Model\User($username);
        header("Location: friends.php");
    } else {
        echo ("Register Error!");
    }
}
else {
    echo ("Validation failed!");
}

?>