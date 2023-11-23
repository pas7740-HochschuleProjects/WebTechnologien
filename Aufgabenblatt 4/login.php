<?php
require("start.php");
if($this->username != null){
    header("Location: friends.php");
}
if(login()==true){
$this->username = username;
header("Location: friends.php");
} else {
    echo("Login Fehler!");
}
?>