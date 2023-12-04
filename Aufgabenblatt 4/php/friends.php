<?php

require("start.php");

if(empty($_SESSION["user"])){
    header("Location: login.php");
}

$friends = $service->loadFriends();

?>

<ul>
    <?php foreach ($friends as $friend) {?>
    <li class="item">
        <a href="chat.html" class="blue-link">
            <?= $friend->getUsername() ?>
        </a>
    </li>
    <?php } ?>
</ul>