<?php

namespace App\Controllers;

use App\Repositories\EventRepository;
use Config\Database;
use Core\Controller;
use PSpell\Config;
class ClubController extends Controller
{
    public function testCreateEvent()
{
    try {
        $db = Database::getInstance()->getConnection();
        $eventRepo = new EventRepository($db);

        // 1. Création de l'objet Event avec des données de test
        // On suppose que l'id_club 1 existe déjà dans votre table 'clubs'
        $newEvent = new \App\Models\Event(null, "Atelier Robotique 2026", "2026-03-15 10:00:00", 1);
        $newEvent->setDescription("Apprendre les bases de la programmation Arduino.");
        $newEvent->setLieu("Salle de conférence A");
        $newEvent->setImageEvent("robot.jpg");

        // 2. Appel de la méthode create du Repository
        $success = $eventRepo->create($newEvent);

        if ($success) {
            echo "Succès : L'événement a été ajouté à la base de données !";
        } else {
            echo "Erreur : L'insertion a échoué.";
        }

    } catch (\Exception $e) {
        echo "Exception capturée : " . $e->getMessage();
    }
}
    public function testClubDetails()
{
    $db = Database::getInstance()->getConnection();
    $eventRepo = new EventRepository($db);

    // Récupération des events (statique id 1)
    $events = $eventRepo->findByClub();

    return $this->render('dashboards.admin.club_details', [
        'club' => [
            'id' => 1,
            'name' => 'Club de Test',
            'description' => 'Ceci est une description de test',
            'president' => 'Jean Dupont',
            'members' => 5,
            'capacity' => 8
        ],
        'events' => $events,
        'articles' => [] // On laisse vide pour le test
    ]);
}
    public function show($id)
    {
        return $this->render('clubs.show', [
            'club' => [
                'id' => $id,
                'name' => 'Robotics Club',
                'description' => 'Detailed description of the Robotics club. We focus on building autonomous robots and competing in national challenges. Our missions include training students on Arduino, Raspberry Pi, and advanced AI navigation.',
                'president' => 'Anas Errak',
                'established_at' => '2024',
                'members_count' => 5,
                'max_members' => 8,
                'image' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837',
                'rating' => 4.8,
                'reviews_count' => 12
            ],
            'events' => [
                ['id' => 1, 'title' => 'Arduino Workshop', 'date' => '2026-02-15', 'location' => 'Lab 101', 'day' => '15', 'month' => 'FEB'],
                ['id' => 2, 'title' => 'Robot Race 2K26', 'date' => '2026-03-10', 'location' => 'Main Hall', 'day' => '10', 'month' => 'MAR'],
            ],
            'articles' => [
                ['id' => 1, 'title' => 'Our first robot wins Gold!', 'summary' => 'Last weekend, our team competed in the regional robotics competition and secured a first-place finish with our custom drone.', 'image' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e'],
            ]
        ]);
    }
}
