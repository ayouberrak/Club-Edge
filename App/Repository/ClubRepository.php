<?php

namespace App\Repository;

use PDO;

class ClubRepository extends GenericRepository
{
    public function getTablename()
    {
        return 'clubs';
    }
    protected $db;
/* // turbo */
    public function __construct()
    {
        $this->db = \Config\Database::getInstance()->getConnection();
    }

    public function getCountClubs() {
        $stmt = $this->db->query("SELECT COUNT(*) FROM clubs");
        return (int)$stmt->fetchColumn();
    }

    public function allClubs() {
        $stmt = $this->db->prepare("SELECT c.*, 
                                    u.nom as president, 
                                    COALESCE(
                                        (SELECT ROUND(AVG(a.note), 1)
                                         FROM avis a 
                                         JOIN events e ON a.id_event = e.id_event 
                                         WHERE e.id_club = c.id_club)
                                    , 5.0) as rating,
                                    COUNT(cm.id_user) as club_members
                                    FROM clubs c
                                    LEFT JOIN users u ON c.id_president = u.id_user
                                    LEFT JOIN club_members cm ON c.id_club = cm.id_club
                                    GROUP BY c.id_club, u.nom
                                    "); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);   
    }

    public function findClub($clubId) {
        $stmt = $this->db->prepare("SELECT c.*, 
                                    u.nom as president, 
                                    COALESCE(
                                        (SELECT ROUND(AVG(a.note), 1)
                                         FROM avis a 
                                         JOIN events e ON a.id_event = e.id_event
                                         WHERE e.id_club = c.id_club)
                                    , 5.0) as rating,
                                    FROM clubs c
                                    JOIN users u ON c.id_president = u.id_user
                                    LEFT JOIN club_members cm ON c.id_club = cm.id_club
                                    WHERE c.id_club = :id_club
                                    GROUP BY c.id_club, u.nom");
        $stmt->execute(['id_club' => $clubId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addMemberToClub($clubId, $userId) {
        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("SELECT id_president FROM clubs WHERE id_club = :id_club");
            $stmt->execute(['id_club' => $clubId]);
            $club = $stmt->fetch(PDO::FETCH_ASSOC);

            $isFirst = false;
            if(empty($club['id_president']))    {

                $stmtUpdateClub = $this->db->prepare("UPDATE clubs SET id_president = :user_id WHERE id_club = :id_club");
                $stmtUpdateClub->execute([
                    'id_user' => $userId,
                    'id_club' => $clubId
                ]);

                $stmtUpdateRole = $this->db->prepare("UPDATE users SET role = 'president' WHERE id_user = :id_user");
                $stmtUpdateRole->execute(['id_user' => $userId]);

                $isFirst = true;
            }

            $stmtMember = $this->db->prepare("INSERT INTO club_members (id_user, id_club) VALUES (:id_user, :id_club)");
            $stmtMember->execute([
                'id_user' => $userId,
                'id_club' => $clubId
            ]);

            $this->db->commit();
            return $isFirst ? 'promoted' : 'joined';
        } catch(\Exception $e) {
            $this->db->rollBack();
            return false;
        }
    } 


    public function getPotentialPresidents() {
        $stmt = $this->db->query("SELECT id_user, nom FROM users WHERE role != 'admin'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}