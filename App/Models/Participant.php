<?php

namespace App\Models;

class Participant
{
    private int $id_user;
    private int $id_event;
    private string $date_participation;

    public function __construct(int $id_user = 0, int $id_event = 0, string $date = "")
    {
        $this->id_user = $id_user;
        $this->id_event = $id_event;
        $this->date_participation = $date;
    }

    // Getters
    public function getIdUser(): int { return $this->id_user; }
    public function getIdEvent(): int { return $this->id_event; }
    public function getDateParticipation(): string { return $this->date_participation; }

    // Setters
    public function setIdUser(int $id): void { $this->id_user = $id; }
    public function setIdEvent(int $id): void { $this->id_event = $id; }
    public function setDateParticipation(string $date): void { $this->date_participation = $date; }
}