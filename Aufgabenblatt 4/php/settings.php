<?php

require("start.php");

if (empty($_SESSION["user"])) {
    header("Location: login.php");
}

// In Progress
?>