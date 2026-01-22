<?php 



namespace App\Controllers;

use App\Services\AvisService;

require_once __DIR__ . '/../../vendor/autoload.php';
class  AvisController {

    public function addAvis($data) {
        $CommentData = [
            'note' => $_POST['note'] , 
            'commentaire' => $_POST['commentaire'] , 
            'id_user' => $_POST['id_user'] , // modifier to get from session
            'id_event' => $_POST['id_event'] 
        ] ;

        $avisServ = new AvisService() ; 
        $message = $avisServ -> addAvis($CommentData) ; 

        var_dump($message) ; 

    }


}

// $avis = new AvisController() ; 

// $data = [
//     'note' => 4 , 
//     'commentaire' => 'slm cv ' , 
//     'id_user' => 6 , 
//     'id_event' => 3 
// ] ;

// $avis -> addAvis($data) ; 