<?php

namespace App\Models;

use App\Helpers\DatabaseHelper;
use App\Helpers\View;

class Database
{

    private $db;

    public function __construct()
    {
        $this->db = new DatabaseHelper();
    }
    /**
     * Method used to list all quotes from database
     *
     */
    public function index()
    {
        var_dump($this->db->select(['*'])->from('framework')->run()->all());
    }
}