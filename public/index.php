<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Helpers\Input;

$routes = require __DIR__ . '/../routes/web.php';

try {
    $route = $routes[$_SERVER['REQUEST_METHOD']];

    $controller = $route[$_GET['c']]['_controller'];
    $action = $route[$_GET['c']][$_GET['m']];

    $arguments = Input::getArguments($_GET);

    $instance = new $controller();

    call_user_func_array(array($instance, $action), $arguments);

} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}