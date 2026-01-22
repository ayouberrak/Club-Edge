<?php

namespace App\Services;

use App\Repository\EtudiantRepository;
use App\Models\Etudiant;
use App\Models\Presidant;
use Exception;
 
class  EtudiantsServices
{
    private EtudiantRepository $etudiantsRepository;

    public function __construct()
    {
        $this->etudiantsRepository = new EtudiantRepository();
    }

    public function checkEtudiantIsMembre(int $id_etudiant): bool
    {
        return $this->etudiantsRepository->checkEtudiantIsMembre($id_etudiant);
    }

    public function addMembreClub(int $id_etudiant, int $id_club): bool
    {
        return $this->etudiantsRepository->addMembreClub($id_etudiant, $id_club);
    }

    public function removeMembreClub(int $id_etudiant, int $id_club): bool
    {
        return $this->etudiantsRepository->removeMembreClub($id_etudiant, $id_club);
    }

    public function updateEtudiant(Etudiant $etudiant): bool
    {
        try {
            return $this->etudiantsRepository->updateEtudiant($etudiant);
        } catch (Exception $e) {
            throw new Exception("Failed to update etudiant: " . $e->getMessage());
        }
    }
    public function getMembresByClub(int $id_club): ?array
    {
        return $this->etudiantsRepository->getMembreinClub($id_club);
    }

    public function getPresidentByClub(int $id_club): ?Presidant
    {
        return $this->etudiantsRepository->getPresidantByClub($id_club);
    }

    public function getAllEtudiants()
    {
        return $this->etudiantsRepository->getAllEtudiants();
    }

    public function deleteStudent(int $id): bool
    {
        return $this->etudiantsRepository->deleteStudent($id);
    }
}