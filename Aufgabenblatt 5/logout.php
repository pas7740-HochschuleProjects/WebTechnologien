<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Logout</title>
    <link rel="stylesheet" href="index.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet">
</head>

<?php

require("start.php");

session_unset();

?>

<body>
    <img class="round-image" src="images/logout.png" width="90">
    <h1>Logged out...</h1>
    See u!
    <br>
    <br>
    <a href="login.php"> Login again </a>
</body>

</html>