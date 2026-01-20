<?php

namespace App\Models;

class Club
{
    private ?int $id_club;
    private string $nom;
    private ?string $description;
    private int $max_membres;
    private ?int $id_president;

    public function __construct(?int $id = null, string $nom = "", ?string $desc = null, int $max = 8, ?int $presId = null)
    {
        $this->id_club = $id;
        $this->nom = $nom;
        $this->description = $desc;
        $this->max_membres = $max;
        $this->id_president = $presId;
    }

    // Getters
    public function getIdClub(): ?int { return $this->id_club; }
    public function getNom(): string { return $this->nom; }
    public function getDescription(): ?string { return $this->description; }
    public function getMaxMembres(): int { return $this->max_membres; }
    public function getIdPresident(): ?int { return $this->id_president; }

    // Setters
    public function setNom(string $nom): void { $this->nom = $nom; }
    public function setDescription(?string $desc): void { $this->description = $desc; }
    public function setMaxMembres(int $max): void { $this->max_membres = $max; }
    public function setIdPresident(?int $id): void { $this->id_president = $id; }
}