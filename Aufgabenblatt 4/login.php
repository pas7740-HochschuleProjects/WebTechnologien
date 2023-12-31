<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="index.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet">
</head>

<?php

require("start.php");

if(isset($_SESSION["user"])){
  header("Location: friends.php");
}

$login_failed = false;

if($_SERVER['REQUEST_METHOD'] == "POST"){
  $username = "";
  $password = "";
  if(empty($_POST['username'])){
    header("Location: login.php");
  }
  else{
    $username = $_POST["username"];
  }

  if(empty($_POST['password'])){
    header("Location: login.php");
  }
  else{
    $password = $_POST["password"];
  }

  if($service->login($username, $password)==true){
    $_SESSION["user"] = new Model\User($username);
    header("Location: friends.php");
  } else {
    $login_failed = true;
  }
}

?>

<body>
    <img class="round-image" src="images\chat.png" width="90">
    <h1>Please sign in</h1>
    <form method="post" action="login.php" class="form-design">
        <fieldset>
            <legend>Login</legend>
            <label> <text>Username</text> <input type="text" placeholder="Username" id="username" name="username"></label>
            <label> <text>Password</text> <input type="password" placeholder="Password" id="password" name="password"></label>
        </fieldset>
        <button class="secondary" formaction="register.php">Register</button>
        <button class="primary" type="submit">Login</button>
    </form>
    <br />
    <?php if($login_failed){ ?>
      <div id="login-failed">Login failed</div>
    <?php } ?>
</body>


</html>