<?php 

namespace App\Controllers;

use App\Services\AvisService;

class  AvisController {

    public function addAvis() {
        $CommentData = [
            'note' => $_POST['note'] , 
            'commentaire' => $_POST['commentaire'] , 
            'id_user' => $_POST['id'] , // modifier to get from session
            'id_event' => $_POST['id_event'] 
        ] ;

        $avisServ = new AvisService() ; 
        $avisServ -> addAvis($CommentData) ; 



    }


}