<?php 

namespace App\Repository; 

use App\Repository\GenericRepository ; 



class AvisRepository extends GenericRepository {

    public function getTablename() {
        return 'avis' ;
    }

    public function getAvisByClub(int $clubId): array
    {
        $sql = "SELECT 
                    a.id_avis as id,
                    a.note,
                    a.commentaire,
                    e.titre as event_title,
                    u.nom as user_name,
                    u.email as user_email
                FROM avis a
                JOIN events e ON a.id_event = e.id_event
                JOIN users u ON a.id_user = u.id_user
                WHERE e.id_club = :id_club
                ORDER BY a.id_avis DESC";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id_club' => $clubId]);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return [];
        }
    }

}