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
        $titre = $_POST['titre'] ?? '';
        $date = $_POST['date_event'] ?? '';
        $id_club = (int)$_POST['id_club'];
        
       
        $event = new Event(null, $titre, $date, $id_club);
        $event->setDescription($_POST['description'] ?? null);
        $event->setLieu($_POST['lieu'] ?? null);

        
        $userRole = $_SESSION['user_role'] ?? 'etudiant';

        try {
            $this->eventService->organizeEvent($event, $userRole);
           
            header('Location: /events?success=1');
        } catch (\Exception $e) {
            return $this->render('events/create', [
                'error' => $e->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        if ($this->eventService->cancelEvent((int)$id)) {
            header('Location: /events?deleted=1');
        }
    }
}