<?php

namespace App\Repositories;

use App\Models\Event;
use PDO;

class EventRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
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
        $stmt = $this->db->query("SELECT * FROM events ORDER BY date_event DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByClub(int $id_club): array
    {
        $stmt = $this->db->prepare("SELECT * FROM events WHERE id_club = :id_club");
        $stmt->execute([':id_club' => $id_club]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM events WHERE id_event = :id");
        return $stmt->execute([':id' => $id]);
    }
}