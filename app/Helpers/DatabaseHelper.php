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
        
        $dsn = $database['db'][$database['default']]['driver'] . ':dbname=' . $database['db'][$database['default']]['database'] . ';host=' . $database['db'][$database['default']]['hostname'];
        
        try {
            $this->db = new \PDO($dsn, $database['db'][$database['default']]['username'], $database['db'][$database['default']]['password']);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    private function create_question_marks($columns)
    {
        // We need to add ? sign for every value in $values
        $question_marks = [];
        foreach($columns as $column) {
            array_push($question_marks, '?');
        }
        $question_marks = '(' . implode(', ', $question_marks) . ')';

        return $question_marks;
    }

    public function select($what)
    {
        $this->sql = 'SELECT ' . implode(', ', $what);
        return $this;
    }

    public function from($table)
    {
        $this->sql .= ' FROM ' . $table;
        return $this;
    }

    /**
     * Method used to add WHERE part of SQL query
     * eg. SELECT name FROM users WHERE id = 3,
     * last value, OR or AND is optional
     * @param  array $conditions Multidimension rray of conditions, example [ ['username', '=', OR'], ['quote' '<>', END'] ]
     * @return [type]            [description]
     */
    public function where($conditions)
    {
        $this->sql .= ' WHERE';
        foreach ($conditions as $condition) {
            $this->sql .= ' ' . $condition[0] . ' ' . $condition[1] . ' ? ';
            // We need to check if there's OR or AND at the end of condition
            if(isset($condition[2])) {
                $this->sql .= ' ' . $condition[2];
            }
        }
        return $this;
    }

    public function insert($table, array $columns)
    {
        $question_marks = $this->create_question_marks($columns);
        
        $columns = '(' . implode(', ', $columns) . ')';
        $this->sql = 'INSERT INTO ' . $table . $columns . 'VALUES' . $question_marks;

        return $this;
    }

    public function update($table, array $columns)
    {
        
        $columns = implode(' = ?, ', $columns) . ' = ?';
        
        $this->sql = 'UPDATE ' . $table . ' SET ' . $columns;

        return $this;
    }

    public function delete()
    {
        $this->sql = 'DELETE';

        return $this;
    }

    

    

    public function prepare()
    {
        $this->stmt = $this->db->prepare($this->sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));

        return $this;
    }

    public function execute($values)
    {
        // We must escape any special characters to prevent XSS attack
        $clean_values = [];
        foreach($values as $value) {
            array_push($clean_values, htmlspecialchars($value, ENT_COMPAT, 'UTF-8'));
        }
        $this->stmt->execute($clean_values);

        return $this;
    }

    





    public function run($params = [])
    {
        $this->prepare();

        $this->execute($params);
        
        return $this;
    }

    public function all()
    {
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function first()
    {
        return $this->stmt->fetch(\PDO::FETCH_OBJ);
    }
}