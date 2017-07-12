<?php

namespace App\Controllers;

use App\Models\Database;
use App\Helpers\View;

class HomeController
{
    public function indexAction()
    {
        $db = new Database();

        $quotes = $db->index();

        echo View::getView('index', $quotes);
    }
}