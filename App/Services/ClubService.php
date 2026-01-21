<?php 

namespace App\Services;

use App\Repository\ClubRepository;


class ClubService {

    public function getallclub () {
        $clubRepository = new ClubRepository() ;
        return $clubRepository -> getall() ;
    }


    public function deletrclub($id) {
        $clubrep = new ClubRepository() ; 
        $countClub = $clubrep -> getCountClubs() ; 

        if($countClub <= 6) {
            return false ; 
        }

        $idClub = ['id_club' => $id] ; 
    

        $clubrep -> delete($idClub) ; 

        
    }

    public function getclubinfo($id) {

        $clubrep = new ClubRepository() ; 

        $idClub = ['id_club' => $id] ; 

        return $clubrep -> findbyid($idClub) ; 

    }

}