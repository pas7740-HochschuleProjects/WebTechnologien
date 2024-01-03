
<?php

spl_autoload_register(function($class) {
    include str_replace('\\', '/', $class) . '.php';
});

session_start();

define('CHAT_SERVER_URL', 'https://online-lectures-cs.thi.de/chat/');
define('CHAT_SERVER_ID', 'f12cba6d-f360-44ca-a5de-6ca4fb1fd2f4');

$service = new Utils\BackendService(CHAT_SERVER_URL, CHAT_SERVER_ID);

?>