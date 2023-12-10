
<?php

spl_autoload_register(function($class) {
    include str_replace('\\', '/', $class) . '.php';
});

session_start();

define('CHAT_SERVER_URL', 'https://online-lectures-cs.thi.de/chat/');
define('CHAT_SERVER_ID', '583eac22-e656-4de7-8cde-ff360b3516a3');

$service = new Utils\BackendService(CHAT_SERVER_URL, CHAT_SERVER_ID);

?>