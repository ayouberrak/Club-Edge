<?php

namespace App\Repository;

use Config\Database;
use PDO;

class ClubRepository
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

}