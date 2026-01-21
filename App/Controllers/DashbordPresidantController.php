<?php

namespace App\Controllers;
use Core\Controller;
use App\Controllers\EtudiantController;

class DashbordPresidantController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $etudiantController = new EtudiantController();
        $etudiantController->index();
        
        
    }

}