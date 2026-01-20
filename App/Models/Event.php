<?php

namespace App\Models;

class Event
{
    private ?int $id_event;
    private string $titre;
    private ?string $description;
    private string $date_event; 
    private ?string $lieu;
    private ?string $image_event;
    private int $id_club;

    public function __construct(?int $id = null, string $titre = "", string $date = "", int $id_club = 0)
    {
        $this->id_event = $id;
        $this->titre = $titre;
        $this->date_event = $date;
        $this->id_club = $id_club;
    }

    public function getIdEvent(): ?int { return $this->id_event; }
    public function getTitre(): string { return $this->titre; }
    public function getDescription(): ?string { return $this->description; }
    public function getDateEvent(): string { return $this->date_event; }
    public function getLieu(): ?string { return $this->lieu; }
    public function getImageEvent(): ?string { return $this->image_event; }
    public function getIdClub(): int { return $this->id_club; }


    public function setTitre(string $t): void { $this->titre = $t; }
    public function setDescription(?string $d): void { $this->description = $d; }
    public function setDateEvent(string $date): void { $this->date_event = $date; }
    public function setLieu(?string $l): void { $this->lieu = $l; }
    public function setImageEvent(?string $img): void { $this->image_event = $img; }
    public function setIdClub(int $id): void { $this->id_club = $id; }
}