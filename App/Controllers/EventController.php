<?php

namespace App\Controllers;

use Core\Controller;
use App\Services\EventService;
use App\Repositories\EventRepository;
use App\Models\Event;
use Config\Database;

class EventController extends Controller
{
    private EventService $eventService;

    public function __construct()
    {
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $eventRepository = new EventRepository($pdo);
        $this->eventService = new EventService($eventRepository);
    }

    public function index()
    {
        $events = $this->eventService->getAllEvents();
        
        return $this->render('events/index', [
            'events' => $events
        ]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // 1. Récupération des données du formulaire
            $titre = $_POST['titre'] ?? '';
            $description = $_POST['description'] ?? '';
            $date_event = $_POST['date_event'] ?? '';
            $lieu = $_POST['lieu'] ?? '';
            $id_club = isset($_POST['id_club']) ? (int)$_POST['id_club'] : 0;

            
            $event = new Event(null, $titre, $date_event, $id_club);
            $event->setDescription($description);
            $event->setLieu($lieu);
            $event->setImageEvent(null); 

           
            $userRole = $_SESSION['user_role'] ?? 'president'; 

            try {
                // 4. Appel au Service pour la logique métier et l'insertion
                $success = $this->eventService->organizeEvent($event, $userRole);

                if ($success) {
                    // Redirection vers la page précédente avec succès
                    header("Location: " . $_SERVER['HTTP_REFERER'] . "?success=event_created");
                    exit();
                }
            } catch (\Exception $e) {
                // En cas d'erreur (ex: date passée), on renvoie vers le formulaire avec l'erreur
                die("Erreur lors de la création : " . $e->getMessage());
            }
        }
    }

    public function delete($id)
    {
        if ($this->eventService->cancelEvent((int)$id)) {
            header('Location: /events?deleted=1');
        }
    }
}