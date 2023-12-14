<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
        <div class="btn-group" role="group" aria-label="Links Grau Rechts Blau">
          <button class="btn btn-primary" formaction="register.php">Register</button>
          <button class="btn btn-primary" type="submit">Login</button>>
        </div>
    </form>
    <br />
    <?php if($login_failed){ ?>
      <div id="login-failed">Login failed</div>
    <?php } ?>
</body>


</html>