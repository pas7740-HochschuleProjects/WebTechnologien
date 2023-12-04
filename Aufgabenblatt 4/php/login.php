<?php

require("start.php");

if(isset($_SESSION["user"])){
  header("Location: friends.php");
}

if($service->login("Tom", "12345678")==true){
  $_SESSION["user"] = new Model\User("Tom");
  header("Location: friends.php");
} else {
    echo("Login Fehler!");
}

?>