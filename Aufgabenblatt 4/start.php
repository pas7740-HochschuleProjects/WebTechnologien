<?php
spl_autoload_register(function($class) {
include str_replace('\\', '/', $class) . '.php';
});

session_start();

define('CHAT_SERVER_URL', 'https://online-lectures-cs.thi.de/chat/');
define('CHAT_SERVER_ID', 'COLLECTION_ID'); 

// in jede andere php Datei bitte " require("start.php"); " einfügen

?>