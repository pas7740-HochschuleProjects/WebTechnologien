<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>

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

<body class="container">
    <div class="text-center">
      <img class="rounded-circle img-fluid mt-4 mb-4 w-25 h-25" src="images\chat.png" width="90">
    </div>

    <div class="container border border-dark-subtle mt-4 mb-4 row-2 w-50 h-50">
      <p class="text-center mt-4 h5">Please sign in</p> 
      <div class="text-center mt-2"> 
        <form method="post" action="login.php" class="text-center">
          <div class="text-center text-wrap mt-2 mb-2" >
            
            <div class="container">
              <input class="form-control mt-2" required type="text" placeholder="Username" id="username" name="username" />
              <input class="form-control mt-2" required type="password" placeholder="Password" id="password" name="password" />
            </div>

            <div class="text-center btn-group mt-2 w-75" role="group">
              <button class="btn btn-secondary" formaction="register.php" formnovalidate>Register</button>
              <button class="btn btn-primary" type="submit">Login</button>
            </div>
          </div>
       </form>
      </div>
      <br />
      <?php if($login_failed){ ?>
        <div id="login-failed">Login failed</div>
      <?php } ?>
    </div>
</body>


</html>