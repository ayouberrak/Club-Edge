<?php

namespace App\Services;

use App\Repository\AvisRepository;
use App\Repository\ParticipentRepository;


class AvisService
{
    private AvisRepository $avisRepo;

    public function __construct()
    {
        $this->avisRepo = new AvisRepository();
    }

    public function getAvisByClub(int $clubId): array
    {
        return $this->avisRepo->getAvisByClub($clubId);
    }

    public function findAvis($data)
    {
        $partRepo = new ParticipentRepository();
        return $partRepo->findbyid($data);
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

        if ($CommentData['note'] > 5 || $CommentData['note'] < 1) {
            return [
                'success' => false,
                'message' => "Rating must be between 1 and 5."
            ];
        }

        // Check if user participated in THIS specific event
        $eventRepo = new \App\Repository\EventRepository();
        if (!$eventRepo->isUserRegistered((int)$CommentData['id_event'], (int)$CommentData['id_user'])) {
            return [
                'success' => false,
                'message' => "You must participate in this event before giving your review."
            ];
        }

        // Check if user already reviewed this event
        if ($this->avisRepo->hasUserReviewedEvent((int)$CommentData['id_user'], (int)$CommentData['id_event'])) {
            return [
                'success' => false,
                'message' => "You have already submitted a review for this event."
            ];
        }

        $id = $this->avisRepo->create($CommentData);

        return [
            'success' => $id !== false,
            'message' => $id !== false ? "Review added successfully!" : "Failed to save review."
        ];
    }
}