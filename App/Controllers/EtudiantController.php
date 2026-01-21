<?php

namespace App\Controllers;

use App\Services\EtudiantsServices;
use Core\Controller;

class EtudiantController extends Controller{
    private $articleServices;
    
    public function __construct()
    {
        parent::__construct();
        $this->articleServices = new EtudiantsServices();
    }

    public function index(){
        $menbres = $this->articleServices->getMembresByClub(1);
        $president = $this->articleServices->getPresidentByClub(1);
        $this->render('dashboards/president/index', ['members' => $menbres, 'president' => $president]);
    }
}