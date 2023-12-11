
<?php

spl_autoload_register(function($class) {
    include str_replace('\\', '/', $class) . '.php';
});

session_start();

define('CHAT_SERVER_URL', 'https://online-lectures-cs.thi.de/chat/');
define('CHAT_SERVER_ID', '44546a7d-74bf-4a1c-8458-a4c71d553fad');

$service = new Utils\BackendService(CHAT_SERVER_URL, CHAT_SERVER_ID);

?>