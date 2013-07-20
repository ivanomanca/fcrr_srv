<?php
spl_autoload_register(); // dont load our classes unless we use them

$mode = 'debug'; // 'debug' or 'production'
$server = new RestServer($mode);
// $server->refreshCache(); // uncomment momentarily to clear the cache if classes change in production mode

$server->addClass('TestController');
//$server->addClass('productsController', '/products'); // adds this as a base to all the URLs in this class

$server->handle();
?>