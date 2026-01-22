<?php 

namespace App\Services;

use App\Repository\AvisRepository; 


class AvisService {

    public function findAvis() {
        
    }
    

    public function addAvis($CommentData) {
        $requiredFields = ['note', 'commentaire', 'id_user', 'id_event'];

        foreach ($requiredFields as $field) {
            if (!isset($CommentData[$field]) || empty($CommentData[$field])) {
                return [
                    'success' => false, 
                    'message' => "The field '$field' cannot be empty."
                ];
            }
        }

        $avisRepo = new AvisRepository() ; 
        $avisRepo -> create($CommentData) ;

    }

}