<?php 

namespace App\Repository; 

use App\Repository\GenericRepository ; 



class ParticipentRepository extends GenericRepository {

    public function getTablename() {
        return 'participations' ;
    }
    

}