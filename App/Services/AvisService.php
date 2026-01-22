<?php

namespace App\Services;

use App\Repository\AvisRepository;
use App\Repository\ParticipentRepository;


class AvisService
{

    public function findAvis($data)
    {

        $avisRepo = new ParticipentRepository();

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

        if ($CommentData['note'] > 5 || $CommentData['note'] < 0) {
            return [
                'success' => false,
                'message' => "Note need be entre 1 - 5 ."
            ];
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

        return [
            'success' => true,
            'message' => "avis added succesc"
        ];
    }

}