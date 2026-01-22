<?php

namespace App\Controllers;

use Core\Controller;
use App\Services\EventService;
use App\Models\Event;
use App\Repository\EventRepository;
use Config\Database;

class EventController extends Controller
{
    private EventService $eventService;

    public function __construct()
    {
        parent::__construct();
        $this->eventService = new EventService();
    }

    /* affiche les evenment à venir */
    public function index()
    {
        $allEvents = $this->eventService->getAllEvents();
        $now = time();

        // Filtrer les événements à venir
        $upcomingEvents = array_filter($allEvents, function ($event) use ($now) {
            return strtotime($event['date']) >= $now;
        });

        // Filtrer les événements passés
        $pastEvents = array_filter($allEvents, function ($event) use ($now) {
            return strtotime($event['date']) < $now;
        });

        return $this->render('dashboards.president.events', [
            'upcomingEvents' => $upcomingEvents,
            'pastEvents' => $pastEvents,
            'club' => [
                'id' => 1,
                'name' => 'Robotics Club',
                'members_count' => 12,
                'max_members' => 20
            ]
        ]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = $_POST['titre'] ?? '';
            $description = $_POST['description'] ?? '';
            $date_event = $_POST['date_event'] ?? '';
            $lieu = $_POST['lieu'] ?? '';
            $id_club = isset($_POST['id_club']) ? (int) $_POST['id_club'] : 0;


            $imageName = null;
            if (isset($_FILES['image_event']) && $_FILES['image_event']['error'] === 0) {
                $uploadDir = __DIR__ . '/../../public/upload/imageevent/';


                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }


                $extension = pathinfo($_FILES['image_event']['name'], PATHINFO_EXTENSION);
                $imageName = bin2hex(random_bytes(10)) . '.' . $extension;
                $targetPath = $uploadDir . $imageName;

                if (!move_uploaded_file($_FILES['image_event']['tmp_name'], $targetPath)) {
                    $imageName = null; // En cas d'échec
                }
            }

            $event = new Event(null, $titre, $date_event, $id_club);
            $event->setDescription($description);
            $event->setLieu($lieu);
            $event->setImageEvent($imageName);

            $userRole = $_SESSION['user_role'] ?? 'president';

            try {
                $success = $this->eventService->organizeEvent($event, $userRole);

                if ($success) {
                    header("Location: " . $_SERVER['HTTP_REFERER'] . "?success=event_created");
                    exit();
                }
            } catch (\Exception $e) {
                die("Erreur lors de la création : " . $e->getMessage());
            }
        }
    }

    public function delete($id)
    {
        if ($this->eventService->cancelEvent((int) $id)) {
            header('Location: /events?deleted=1');
        }
    }

    public function register($data)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        $baseUrl = $this->view->shared('base_url');

        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . $baseUrl . '/login');
            exit;
        }

        // CSRF Check
        if(!isset($data['csrf_token']) || $data['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
            header('Location: ' . $baseUrl . '/dashboard/events?error=csrf_error');
            exit;
        }

        $eventId = (int)($data['event_id'] ?? 0);
        $userId = $_SESSION['user_id'];
        $redirectPath = $data['redirect_to'] ?? '/dashboard/events';

        if ($eventId > 0) {
            try {
                $result = $this->eventService->registerStudentToEvent($eventId, $userId);
                
                if ($result) {
                    header('Location: ' . $baseUrl . $redirectPath . (strpos($redirectPath, '?') !== false ? '&' : '?') . 'success=registered');
                } else {
                    header('Location: ' . $baseUrl . $redirectPath . (strpos($redirectPath, '?') !== false ? '&' : '?') . 'error=already_registered');
                }
            } catch (\Exception $e) {
                header('Location: ' . $baseUrl . $redirectPath . (strpos($redirectPath, '?') !== false ? '&' : '?') . 'error=' . urlencode($e->getMessage()));
            }
        } else {
            header('Location: ' . $baseUrl . $redirectPath . (strpos($redirectPath, '?') !== false ? '&' : '?') . 'error=invalid_event');
        }
        exit;
    }

    public function cancel($data)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        $baseUrl = $this->view->shared('base_url');

        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . $baseUrl . '/login');
            exit;
        }

        // CSRF Check
        if(!isset($data['csrf_token']) || $data['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
            header('Location: ' . $baseUrl . '/dashboard/events?error=csrf_error');
            exit;
        }

        $eventId = (int)($data['event_id'] ?? 0);
        $userId = $_SESSION['user_id'];
        $redirectPath = $data['redirect_to'] ?? '/dashboard/events';

        if ($eventId > 0) {
            try {
                $this->eventService->cancelStudentParticipation($eventId, $userId);
                header('Location: ' . $baseUrl . $redirectPath . (strpos($redirectPath, '?') !== false ? '&' : '?') . 'success=cancelled');
            } catch (\Exception $e) {
                header('Location: ' . $baseUrl . $redirectPath . (strpos($redirectPath, '?') !== false ? '&' : '?') . 'error=' . urlencode($e->getMessage()));
            }
        } else {
            header('Location: ' . $baseUrl . $redirectPath . (strpos($redirectPath, '?') !== false ? '&' : '?') . 'error=invalid_event');
        }
        exit;
    }
}
