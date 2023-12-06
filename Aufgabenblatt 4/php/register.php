<?php

require("start.php");

// check if empty
if(empty($_POST["username"])){
    echo ("Empty!");
}
if(empty($_POST["password"])){
    echo ("Empty!");
}
if(empty($_POST["confirm"])){
    echo ("Empty!");
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
}
else {


    $a = true;
}

// PW Validation
if($passwordlength < 8) {
    echo("Password requires at least 8 characters");
}
else {
    if($password != $confirmpassword){
        echo("Password requires at least 8 characters");
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