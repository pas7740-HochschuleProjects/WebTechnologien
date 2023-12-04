<!-- in jede andere php Datei bitte " require("start.php"); " einfügen -->

<?php

spl_autoload_register(function($class) {
    include str_replace('\\', '/', $class) . '.php';
});

session_start();

define('CHAT_SERVER_URL', 'https://online-lectures-cs.thi.de/chat/');
define('CHAT_SERVER_ID', 'e249deeb-35bd-42a1-9f1e-80dba35a7010');

$service = new Utils\BackendService(CHAT_SERVER_URL, CHAT_SERVER_ID);

?>