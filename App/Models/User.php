<?php

namespace App\Models;

class User
{
    private ?int $id_user;
    private string $nom;
    private string $email;
    private string $password;
    private string $role;

    public function __construct(?int $id_user = null, string $nom = "", string $email = "", string $password = "", string $role = "" ? "etudiant" : "")
    {
        $this->id_user = $id_user;
        $this->nom = $nom;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    // Getters
    public function getIdUser(): ?int { return $this->id_user; }
    public function getNom(): string { return $this->nom; }
    public function getEmail(): string { return $this->email; }
    public function getPassword(): string { return $this->password; }
    public function getRole(): string { return $this->role; }

    // Setters
    public function setIdUser(?int $id): void { $this->id_user = $id; }
    public function setNom(string $nom): void { $this->nom = $nom; }
    public function setEmail(string $email): void { $this->email = $email; }
    public function setPassword(string $pw): void { $this->password = $pw; }
    public function setRole(string $role): void { $this->role = $role; }
}