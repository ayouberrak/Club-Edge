<?php

namespace App\Repository; 


use Config\Database ; 
use PDO ; 
use PDOException ;


abstract class GenericRepository
{

    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    private $classes = [

    ];


    abstract public function getTablename();

    public function getTargetClass()
    {
        $table = $this->getTablename();

        if (isset($this->classes[$table])) {
            return $this->classes[$table];
        }

    }

    public function getall(?array $data = null)
    {
        $table = $this->getTablename();
        $params = [];
        $sql = "SELECT * FROM $table ";


        if (!empty($data)) {
            $where = [];

            foreach ($data as $column => $value) {
                $where[] = " $column = ?";
                $params[] = $value;
            }

            $sql .= ' WHERE' . implode(' AND ', $where);

        }
        // var_dump($sql);
        // exit;

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);

            $result = $stmt->fetchALl();

            // echo 'dkede';
            // var_dump($result);
            // exit;

            return $result;

        } catch (PDOException $e) {
            return false;
        }

    }

    // authService
    public function create($data)
    {
        $table = $this->getTablename();

        $columns = implode(', ', array_keys($data));
        $placeholder = implode(', ', array_fill(0, count($data), '?'));



        $sql = "INSERT INTO $table ($columns) VALUES ($placeholder)";

        // var_dump($columns , $placeholder , $sql , array_values($data)) ; 
        // exit ; 

        try {

            $stmt = $this->db->prepare($sql);
            $stmt->execute(array_values($data));

            $id = $this->db->lastInsertId();

            // die ($id) ;  

            return $id;

        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }

    }

    public function findbyid($id)
    {
        $table = $this->getTablename();

        $key = array_key_first($id) ; 

        $sql = "SELECT * FROM $table WHERE $key = ?";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array_values($id));

            $result = $stmt->fetch();

            return $result;

        } catch (PDOException $e) {
            return false;
        }

    }

    public function delete($id)
    {
        $table = $this->getTablename();
        $column = array_key_first($id);

        $iddelete = $id[$column];

        // var_dump($id, $column , $iddelete) ;
        // exit;

        $sql = "DELETE FROM $table WHERE  $column = ? ";

        try {
            $stmt = $this->db->prepare($sql);

            return $stmt->execute([$iddelete]);

        } catch (PDOException $e) {
            return false;
        }

    }

    public function update($data, $condition)
    {
        $table = $this->getTablename();
        $columns = [];
        $values = [];
        foreach ($data as $column => $value) {
            $columns[] = " $column = ? ";
            $values[] = $value;
        }

        $columns = implode(' ,', $columns);

        $colCondition = array_key_first($condition);
        $values[] = $condition[$colCondition];


        $sql = "UPDATE $table SET $columns WHERE $colCondition = ? ";



        // var_dump($sql , $values , $columns , $colCondition ) ;
        // exit ; 


        try {
            $stmt = $this->db->prepare($sql);

            $stmt->execute($values);

        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());

        }
    }

}