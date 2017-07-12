<?php

require __DIR__ . '/../app/Bootstrap/bootstrap.php';

use App\Helpers\Input;
use App\Helpers\View;

$routes = require __DIR__ . '/../routes/web.php';

try {
    $route = $routes[$_SERVER['REQUEST_METHOD']];

    if($_SERVER['REQUEST_METHOD'] === "GET") {

        $controller = $route[$_GET['c']]['_controller'];
        $action = $route[$_GET['c']][$_GET['m']];
        $arguments = Input::getArguments($_GET);    

    } elseif($_SERVER['REQUEST_METHOD'] === "POST") {

        $controller = $route[$_POST['c']]['_controller'];
        $action = $route[$_POST['c']][$_POST['m']];
        $arguments = Input::getArguments($_POST);

    } else {
        throw new Exception("Error Processing Request", 1);
        
    }

    if(isset($controller) && isset($action)) {
        $instance = new $controller();
        
        call_user_func_array(array($instance, $action), $arguments);
    } else {
        echo View::error403();
    }

} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}