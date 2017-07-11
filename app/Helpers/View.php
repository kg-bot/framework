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
}