<?php

namespace Config;
use PDO;
use PDOException;
use Exception;


$env = parse_ini_file(__DIR__ .'/../.env');

    
define('DB_HOST',$env['DB_HOST']);
define('DB_NAME',$env['DB_NAME']);
define('DB_USER',$env['DB_USER']);
define('DB_PASS',$env['DB_PASS']);



class Database
{
    private static ?Database $instance = null;
    private PDO $pdo;

    private function __construct()
    {
        $host = DB_HOST;
        $db   = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;

        $dsn = "pgsql:host=$host;dbname=$db";

        try {
            $this->pdo = new PDO($dsn, $user, $pass);
            
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // echo 'reusi';
        } catch (PDOException $e) {
            throw new Exception("Erreur de connexion à la base de données.");
        }
    }


    
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->pdo;
    }
    // public static function showConfig()
    // {
    //    Database::getInstance();

    // }
}

