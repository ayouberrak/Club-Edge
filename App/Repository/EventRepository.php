<?php

namespace App\Repository;

use App\Models\Event;
use Config\Database;
use PDO;

class EventRepository
{
    private PDO $db;
/* // turbo */
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getCountUpcomingEvents(): int
    {
        $sql = "SELECT COUNT(*) FROM events WHERE date_event >= CURRENT_DATE";
        $stmt = $this->db->query($sql);
        return (int)$stmt->fetchColumn();
    }


    public function create(Event $event): bool
    {
        $sql = "INSERT INTO events (titre, description, date_event, lieu, image_event, id_club) 
                VALUES (:titre, :description, :date_event, :lieu, :image_event, :id_club)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':titre' => $event->getTitre(),
            ':description' => $event->getDescription(),
            ':date_event' => $event->getDateEvent(),
            ':lieu' => $event->getLieu(),
            ':image_event' => $event->getImageEvent(),
            ':id_club' => $event->getIdClub()
        ]);
    }

    public function findAll(): array
    {
        $sql = "SELECT 
                id_event as id,
                titre as title, 
                date_event as date, 
                lieu as location,
                CASE 
                    WHEN image_event IS NOT NULL AND image_event != '' 
                    THEN CONCAT('/upload/imageevent/', image_event)
                    ELSE 'https://images.unsplash.com/photo-1540575861501-7ad06763821d' 
                END as image,
                (SELECT COUNT(*) FROM participations WHERE id_event = events.id_event) as participants
            FROM events 
            ORDER BY date_event DESC";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findByClub(int $clubId): array
    {
        $sql = "SELECT 
                id_event as id,
                titre as title, 
                date_event as date, 
                lieu as location,
                image_event as image,
                (SELECT COUNT(*) FROM participations WHERE id_event = events.id_event) as participants
            FROM events 
            WHERE id_club = :id_club
            ORDER BY date_event DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_club' => $clubId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM events WHERE id_event = :id");
        return $stmt->execute([':id' => $id]);
    }
}
