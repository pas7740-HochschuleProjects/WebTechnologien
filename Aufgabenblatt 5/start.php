
<?php

spl_autoload_register(function($class) {
    include str_replace('\\', '/', $class) . '.php';
});

session_start();

define('CHAT_SERVER_URL', 'https://online-lectures-cs.thi.de/chat/');
define('CHAT_SERVER_ID', 'c37e3a64-2869-470e-b895-093ea974f690');

$service = new Utils\BackendService(CHAT_SERVER_URL, CHAT_SERVER_ID);

?>