<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Logout</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<?php

require("start.php");

session_unset();

?>

<body>
    <div class="text-center">
     <img class="rounded-circle mt-4 mb-2 w-25 h-25" src="images/logout.png" width="90px">
    </div>

    <div class="container border border-dark-subtle mt-4 text-center w-50" >
     <h1 class="mt-4">Logged out...</h1>
     See u!
     <br>
     <a class="btn btn-secondary mt-2 mb-4 w-75 text-center" href="login.php"> Login again </a>
    </div>
</body>

</html>