<?php

namespace App\Helpers;

class View
{
    public static function getView($view, $data)
    {
        try {
            require_once(__DIR__ . '/../../resources/views/' . $view . '.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function redirect($where = '/index.php?c=Home&m=index')
    {
        header('Location: ' . $where);
    }

    public static function error403($message = "Page not found")
    {
        try {
            http_response_code(403);
            require_once(__DIR__ . '/../../resources/views/errors/403.php');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}