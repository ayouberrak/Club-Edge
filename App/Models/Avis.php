<?php

namespace App\Models;

class Avis
{
    private ?int $id_avis;
    private int $note;
    private ?string $commentaire;
    private int $id_user;
    private int $id_event;

    public function __construct(?int $id = null, int $note = 5, int $id_user = 0, int $id_event = 0)
    {
        $this->id_avis = $id;
        $this->note = $note;
        $this->id_user = $id_user;
        $this->id_event = $id_event;
    }

    // Getters & Setters
    public function getNote(): int { return $this->note; }
    public function setNote(int $note): void { if($note >= 1 && $note <= 5) $this->note = $note; }
    
    public function getCommentaire(): ?string { return $this->commentaire; }
    public function setCommentaire(?string $com): void { $this->commentaire = $com; }

    public function getIdUser(): int { return $this->id_user; }
    public function getIdEvent(): int { return $this->id_event; }
}