<?php

namespace App\Services;

use App\Repository\AvisRepository;


class AvisService
{

    public function findAvis($data)
    {

        $avisRepo = new AvisRepository();

        return $avisRepo->findbyid($data);

    }


    public function addAvis($CommentData)
    {
        $requiredFields = ['note', 'commentaire', 'id_user', 'id_event'];

        foreach ($requiredFields as $field) {
            if (!isset($CommentData[$field]) || empty($CommentData[$field])) {
                return [
                    'success' => false,
                    'message' => "The field '$field' cannot be empty."
                ];
            }
        }

        $userId = ['id_user' => $CommentData['id_user']];

        $participent = $this->findAvis($userId);

        if (!$participent) {
            return [
                'success' => false,
                'message' => "Vous devez participer avant de donner votre avis."
            ];
        }

        $avisRepo = new AvisRepository();
        $avisRepo->create($CommentData);

    }

}