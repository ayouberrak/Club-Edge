<?php 

namespace App\Repository; 

use App\Repository\GenericRepository ; 



class AvisRepository extends GenericRepository {

    public function getTablename() {
        return 'avis' ;
    }

    

}