<?php 

namespace App\Repository;

use App\Repository\GenericRepository;
use Config\Database;



class ClubRepository extends GenericRepository {

    public function getTablename() {
        return 'clubs' ;
    }

    public function getCountClubs() {
        $table = $this -> getTablename(); 
        $pdo = Database::getInstance() -> getConnection() ;
        
        $sql = "SELECT COUNT(*) FROM $table" ;

        try {

            $stmt = $pdo -> query($sql) ; 

            return $stmt -> fetchColumn() ;

        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }



    }

}