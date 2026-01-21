<?php

namespace App\Repository;

use PDO;

class StudentRepository
{
    private $db;
/* // turbo */
    public function __construct()
    {
        $this->db = \Config\Database::getInstance()->getConnection();
    }


    public function getClub(int $userId) {
        $stmt = $this->db->prepare("SELECT c.*, cm.date_adhesion as joined_at, 
                            (SELECT COUNT(*) FROM club_members WHERE id_club = c.id_club) as members_count
                            FROM clubs c
                            JOIN club_members cm ON c.id_club = cm.id_club
                            WHERE cm.id_user = :id_user");
        $stmt->execute(['id_user' => $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getRegisteredEvents(int $userId) {
       $stmt1 = $this->db->prepare("
                                SELECT 
                                    e.id_event as id,
                                    e.titre as title, 
                                    e.date_event as date, 
                                    e.lieu as location,
                                    CASE 
                                        WHEN e.date_event < CURRENT_TIMESTAMP THEN 'completed' 
                                        ELSE 'upcoming' 
                                    END as status,
                                    CASE 
                                        WHEN av.id_avis IS NOT NULL THEN 1 
                                        ELSE 0 
                                    END as reviewed
                                FROM events e
                                JOIN participations p ON e.id_event = p.id_event
                                LEFT JOIN avis av ON (e.id_event = av.id_event AND p.id_user = av.id_user)
                                WHERE p.id_user = :id_user
                                ORDER BY e.date_event DESC
                            ");
        $stmt1->execute(['id_user' => $userId]);
        return $stmt1->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getReviewsCount(int $userId) {
        $stmt2 = $this->db->prepare("SELECT COUNT(*) FROM avis WHERE id_user = :id_user");
        $stmt2->execute(['id_user' => $userId]);
        return $stmt2->fetchColumn();
    }

    public function getArticles(int $userId) {
        $stmt = $this->db->prepare("SELECT a.*, e.titre as event_title, c.nom as club_name  FROM articles a
                                    JOIN events e ON a.id_event = e.id_event
                                    JOIN clubs c ON e.id_club = c.id_club
                                    JOIN participations p ON e.id_event = p.id_event
                                    WHERE p.id_user = :id_user");
        $stmt->execute(['id_user' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}