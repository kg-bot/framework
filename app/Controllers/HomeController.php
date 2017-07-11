<?php

namespace App\Controllers;

use App\Models\Database;

class HomeController
{
    public function indexAction($name)
    {
        $db = new Database();

        $db->index();
    }
}