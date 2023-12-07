<?php

require("start.php");
$username="";
$password="";
if(isset($_SESSION["user"])){
  header("Location: friends.php");
}
if($_SERVER['REQUEST_METHOD'] == "POST"){

if(isset($_POST['Login'])){
  $username = $_POST["username"];
  $password = $_POST["password"];
}

if($service->login($username, $password)==true){
  $_SESSION["user"] = new Model\User($username);
  header("Location: friends.php");
} else {  
  echo("Login Fehler!");
}
}
?>
