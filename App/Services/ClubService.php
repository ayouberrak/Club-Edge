<?php 

namespace App\Services;

use App\Repository\ClubRepository;


class ClubService {

    public function getallclub () {
        $clubRepository = new ClubRepository() ;
        return $clubRepository -> getall() ;
    }
}