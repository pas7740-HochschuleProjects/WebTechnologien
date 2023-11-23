<?php
require("start.php");
if($this.username == null){
    header("Location: login.php");
} else if (getChatpartner()== null){
    header("Location: friend.php");
}
?>