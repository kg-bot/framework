<?php
define('APPLICATION_START', microtime(true));

require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/../../config/app.php';

// We assume that developer forgot to change environment so we are using production
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On'); 
// We need to alter error reporting and display
error_reporting(E_ALL);
if($app['environment'] === 'production') {
    ini_set('display_errors', 'Off');
    ini_set('log_errors', 'On');

} elseif($app['environment'] === 'development') {
    ini_set('display_errors', 'On');
    ini_set('log_errors', 'On'); ;

}