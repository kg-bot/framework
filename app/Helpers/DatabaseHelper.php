<?php

namespace App\Helpers;

class DatabaseHelper
{
    protected $db;

    private $sql;

    private $stmt;

    public function __construct()
    {
        // Read database config file
        require __DIR__ . '/../../config/database.php';

        $dsn = $database[$default]['driver'] . ':dbname=' . $database[$default]['database'] . ';host=' . $database[$default]['hostname'];
        
        try {
            $this->db = new \PDO($dsn, $database[$default]['username'], $database[$default]['password']);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function select($what)
    {
        $this->sql = 'SELECT ' . implode(', ', $what) . ' ';
        return $this;
    }

    public function from($table)
    {
        $this->sql .= $table;
        return $this;
    }

    public function run($params = [])
    {
        $stmt = $this->db->prepare($this->sql);

        $stmt->execute($params);
        $this->stmt = $stmt;
        
        return $this;
    }

    public function all()
    {
        return $this->stmt->fetchAll();
    }
}