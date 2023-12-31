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

<body class="h-100">
    
    <div class="text-center row-2">
      <img class="rounded-circle img-fluid mt-4 mb-4 w-25 h-25" src="images\chat.png" width="90">
    </div>

    <div class="container border border-dark-subtle mt-4 mb-4 row-2 w-50 h-50">
       <p class="text-center mt-4 h5">Please sign in</p> 
     <div class="text-center"> 
       <form method="post" action="login.php" class="text-center">
            
          
        

        <div class="text-center text-wrap mt-2 mb-2" >
          <div class="text-center text-wrap mb-2 mt-1">
          <input class="w-75" required type="text" placeholder="Username" id="username" name="username">
          <input class="w-75" required type="password" placeholder="Password" id="password" name="password">
          </div>
           <div class="text-center btn-group w-75" role="group">
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