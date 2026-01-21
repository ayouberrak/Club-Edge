<?php

namespace App\Controllers;

use App\Repository\ClubRepository;
use Config\Database;
use Core\Controller;

class HomeController extends Controller
{
    private $db;

    public function __construct()
    {
        parent::__construct();

        $this->db = Database::getInstance()->getConnection();
        // if(session_status() == PHP_SESSION_NONE) session_start();
    }


    public function index()
    {
        if(session_status() === PHP_SESSION_NONE ) session_start();

        $repo = new ClubRepository($this->db);
        $clubs = $repo->allClubs();

        return $this->render('home', [
            'clubs' => $clubs
        ]);
    }
}
