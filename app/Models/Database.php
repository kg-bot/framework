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
        return $this->db->select(['*'])->from('quotes')->run()->all();
    }

    public function create($username, $quote)
    {
        return $this->db->insert('quotes', array('username', 'quote'))->run(array($username, $quote));
    }

    public function read($quote)
    {
        $conditions = [
            ['id', '='],
        ];
        return $this->db->select(['*'])->from('quotes')->where($conditions)->run(array($quote))->first();
    }

    public function update($id, $username, $quote)
    {
        $conditions = [
            ['id', '='],
        ];
        return $this->db->update('quotes', array('username', 'quote'))->where($conditions)->run(array($username, $quote, $id));
    }

    public function delete($id)
    {
        $conditions = [
            ['id', '='],
        ];
        return $this->db->delete()->from('quotes')->where($conditions)->run(array($id));
    }
}