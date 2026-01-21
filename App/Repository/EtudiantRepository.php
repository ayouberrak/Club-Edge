<?php

namespace App\Repository;

use App\Models\Etudiant;
use App\Models\Presidant;
use Config\Database;
use PDO;
use PDOException;

class EtudiantRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function checkEtudiantIsMembre(int $id_etudiant): bool
    {
        try {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM membres_club WHERE id_etudiant = :id_etudiant");
            $stmt->bindParam(':id_etudiant', $id_etudiant, PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt->fetchColumn();

            return $count > 0;
        } catch (PDOException $e) {
            throw new \Exception("Database error: " . $e->getMessage());
        }
    }

    public function addMembreClub(int $id_etudiant, int $id_club): bool
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO membres_club (id_etudiant, id_club) VALUES (:id_etudiant, :id_club)");
            $stmt->bindParam(':id_etudiant', $id_etudiant, PDO::PARAM_INT);
            $stmt->bindParam(':id_club', $id_club, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new \Exception("Database error: " . $e->getMessage());
        }
    }

    public function removeMembreClub(int $id_etudiant, int $id_club): bool
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM membres_club WHERE id_etudiant = :id_etudiant AND id_club = :id_club");
            $stmt->bindParam(':id_etudiant', $id_etudiant, PDO::PARAM_INT);
            $stmt->bindParam(':id_club', $id_club, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new \Exception("Database error: " . $e->getMessage());
        }
    }


    public function updateEtudiant(Etudiant $etudiant): bool
    {
        try {
            $stmt = $this->db->prepare("UPDATE users SET nom = :nom, email = :email, password = :password WHERE id_user = :id_user AND role = 'etudiant'");
            $stmt->bindValue(':nom', $etudiant->getNom(), PDO::PARAM_STR);
            $stmt->bindValue(':email', $etudiant->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(':password', $etudiant->getPassword(), PDO::PARAM_STR);
            $stmt->bindValue(':id_user', $etudiant->getIdUser(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new \Exception("Database error: " . $e->getMessage());
        }
    }

    public function checkNombreMembresClub(int $id_club): bool
    {
        try {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM membres_club WHERE id_club = :id_club");
            $stmt->bindParam(':id_club', $id_club, PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt->fetchColumn();

            return $count < 8;
        } catch (PDOException $e) {
            throw new \Exception("Database error: " . $e->getMessage());
        }
    }

    public function getMembreinClub(int $id_club): ?array
    {
        try {
            $stmt = $this->db->prepare("SELECT u.id_user, u.nom, u.email FROM users u JOIN club_members mc ON u.id_user = mc.id_user WHERE mc.id_club = :id_club");
            $stmt->bindParam(':id_club', $id_club, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($results === false) {
                return null;
            }

            $etudiants = [];
            foreach ($results as $row) {
                $etudiant = new Etudiant($row['id_user'], $row['nom'], $row['email']);
                $etudiants[] = $etudiant;
            }

            return $etudiants;
        } catch (PDOException $e) {
            throw new \Exception("Database error: " . $e->getMessage());
        }
    }

    public function getPresidantByClub(int $id_club): ?Presidant
    {
        try {
            $stmt = $this->db->prepare("SELECT u.id_user, u.nom, u.email , u.role FROM users u JOIN clubs c ON u.id_user  = c.id_president WHERE c.id_club = :id_club");
            $stmt->bindParam(':id_club', $id_club, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row === false) {
                return null;
            }

            return new Presidant($row['id_user'], $row['nom'], $row['email']);
        } catch (PDOException $e) {
            throw new \Exception("Database error: " . $e->getMessage());
        }
    }

    
    public function getAllEtudiants(): array
    {
        try {
            $sql = "SELECT u.id_user as id, u.nom as name, u.email, COALESCE(c.nom, 'None') as club 
                    FROM users u 
                    LEFT JOIN club_members cm ON u.id_user = cm.id_user 
                    LEFT JOIN clubs c ON cm.id_club = c.id_club 
                    WHERE u.role != 'admin' AND u.role != 'president'"; // Assuming we want students only? Or all non-admins? View says 'Student Directory'
            
            // Let's stick to users that are likely students.
            // Actually, users table usually has role.
            // Let's filter by role != 'admin' to include presidents as potential students/users too?
            // The request said "students".
            // Let's include 'etudiant' and 'president' (since presidents are also students)
            
            $stmt = $this->db->query("SELECT u.id_user as id, u.nom as name, u.email, COALESCE(c.nom, 'None') as club 
                                      FROM users u 
                                      LEFT JOIN club_members cm ON u.id_user = cm.id_user 
                                      LEFT JOIN clubs c ON cm.id_club = c.id_club 
                                      WHERE u.role != 'admin'");
                                      
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             throw new \Exception("Database error: " . $e->getMessage());
        }
    }

    public function deleteStudent(int $id): bool
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM users WHERE id_user = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            // Log error or throw
            return false;
        }
    }
}