<?php

namespace App\Controllers;

use App\Repository\ClubRepository;
use Config\Database;
use Core\Controller;

class HomeController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        if(session_status() === PHP_SESSION_NONE ) session_start();

        $repo = new ClubRepository();
        $clubs = $repo->allClubs();

        return $this->render('home', [
            'clubs' => $clubs
        ]);
    }
}
