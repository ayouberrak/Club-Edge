<?php

namespace App\Controllers;

use App\Services\AvisService;
use App\Services\AdminService;
use App\Services\ClubService;
use Core\Controller;
use App\Services\ArticleServices;
use App\Repository\StudentRepository;

use App\Repository\EventRepository;

use App\Services\EtudiantsServices;

use App\Services\EventService;
use Config\Database;

class DashboardController extends Controller
{
    private ArticleServices $articleServices;
    private AvisService $avisService;

    public function __construct()
    {
        parent::__construct();
        $this->articleServices = new ArticleServices();
        $this->avisService = new AvisService();
        if(session_status() == PHP_SESSION_NONE) session_start();
    }

    private function checkAuth($role = null) {

        if(!isset($_SESSION['user_id'])) {
            header('Location: ' . $this->view->shared('base_url') . '/login');
            exit;
        }

        if($role !== null) {
            if($_SESSION['user_role'] !== $role) {
                header('Location: ' . $this->view->shared('base_url') . '/dashboard');
                exit; 
            }
        }

    }

    public function index()
    {

        $this->checkAuth();
        

        $repo = new StudentRepository();
        $userId = $_SESSION['user_id'];


        // Student Dashboard Data
        return $this->render('dashboards.student', [
            'my_club' => $repo->getClub($userId),
            'registered_events' => $repo->getRegisteredEvents($userId),
            'reviews_count' => $repo->getReviewsCount($userId),
            'past_articles' => []
        ]);
    }

    public function studentEvents()
    {
        $this->checkAuth();

        $repo = new StudentRepository();
        $userId = $_SESSION['user_id'];

        return $this->render('dashboards.student.events', [
            'registered_events' => $repo->getRegisteredEvents($userId)
        ]);
    }   

    public function studentArticles()
    {
        $this->checkAuth();

        $repo = new StudentRepository();
        $userId = $_SESSION['user_id'];

        return $this->render('dashboards.student.articles', [
            'past_articles' => $repo->getArticles($userId)
        ]);
    }

    public function president()
    {
        if(session_status() === PHP_SESSION_NONE) session_start();
        $this->checkAuth('president');

        $clubService = new ClubService();
        $eventService = new EventService();
        // $this->articleServices is instantiated in constructor

        $club = $clubService->getClubByPresident($_SESSION['user_id']);
        
        $members = [];
        $events = [];
        $articles = []; // If you plan to use articles in the main dashboard or pass for modals

        if (!$club) {
            // Handle case where president has no club yet
            $club = [
                'name' => 'No Club Assigned',
                'nom' => 'No Club Assigned', // Alias for view compatibility
                'members_count' => 0,
                'max_membres' => 0,
                'logo' => 'default_club.png' 
            ];
        } else {
            $members = $clubService->getClubMembers($club['id_club']);
            $events = $eventService->getEventsByClub($club['id_club']);
            $articles = $this->articleServices->getArticlesByClub($club['id_club']);
            $comments = $this->avisService->getAvisByClub($club['id_club']);
        }

        // President Dashboard Data
        return $this->render('dashboards.president', [
            'club' => $club,
            'members' => $members,
            'events' => $events,
            'articles' => $articles,
            'comments' => $comments ?? []
        ]);
    }

    public function presidentEvents()
    {
        return $this->render('dashboards.president.events', [
            'events' => [
                ['id' => 1, 'title' => 'Cyber Security Talk', 'date' => '2026-03-12', 'participants' => 24, 'image' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b'],
                ['id' => 2, 'title' => 'IoT Workshop', 'date' => '2026-04-05', 'participants' => 12, 'image' => 'https://images.unsplash.com/photo-1518770660439-4636190af475'],
            ],
            'club' => ['id' => 1, 'name' => 'Robotics Club']
        ]);
    }

    public function presidentArticles()
    {
        // In a real application, the club ID would come from the session:
        // $id_club = $_SESSION['user']['id_club'];
        $id_club = 1; // Mocking with 1 for now

        $articles = $this->articleServices->getArticlesByClub($id_club);

        return $this->render('dashboards.president.articles', [
            'club' => ['id' => $id_club, 'name' => 'Robotics Club'],
            'articles' => $articles
        ]);
    }


    public function admin()
    {


        if(session_status() === PHP_SESSION_NONE) session_start();
        
        $this->checkAuth('admin');
    }

    public function adminStudents()
    {
        return $this->render('dashboards.admin.students', [
            'stats' => $this->getAdminStats(),
            'students' => [
                ['id' => 101, 'name' => 'Ayoub Errak', 'email' => 'ayoub@univ.ma', 'club' => 'Coding Club'],
                ['id' => 102, 'name' => 'Fatima Zahra', 'email' => 'fatima@univ.ma', 'club' => 'Robotics Club'],
                ['id' => 103, 'name' => 'Karim Ben', 'email' => 'karim@univ.ma', 'club' => 'None'],
            ]
        ]);
    }

    public function adminLogs()
    {
        return $this->render('dashboards.admin.logs', [
            'stats' => $this->getAdminStats()
        ]);
    }

    private function getAdminStats()
    {
        $clubRepo = new \App\Repository\ClubRepository();
        $studentRepo = new \App\Repository\EtudiantRepository();
        $articleRepo = new \App\Repository\ArticleRepository();
        $eventRepo = new EventRepository();

        return [
            'total_clubs' => $clubRepo->getCountClubs(),
            'total_students' => $studentRepo->getCountUsers(),
            'pending_reviews' => $articleRepo->getCountArticles(),
            'active_events' => $eventRepo->getCountUpcomingEvents()
        ];
    }

    
public function adminClubDetails($id)
{
    $clubsService = new ClubService();
    $club = $clubsService->getclubinfo((int)$id);

    if (!$club) {
        header('Location: ' . $this->view->shared('base_url') . '/admin/clubs');
        exit;
    }

    $clubs = $clubsService->getallclub();
    $potentialPresidents = $clubsService->getPotentialPresidents();



    $eventService = new EventService();
    $events = $eventService->getEventsByClub((int)$id);
    $etudiantService = new EtudiantsServices();
    $students = $etudiantService->getAllEtudiants();
    $articleService = new ArticleServices();
    $articles = $articleService->getArticlesByClub((int)$id);

    return $this->render('dashboards.admin.club_details', [
        'club' => [
            'id'          => $club['id_club'],
            'name'        => $club['nom'],
            'president'   => $club['president'] ?? 'No President Assigned',
            'members'     => $club['current_members_count'] ?? 0,
            'capacity'    => $club['max_membres'],
            'status'      => 'active', 
            'description' => $club['description']
        ],
        'events' => $events,
        'articles' => $articles,
            'stats' => [
                'total_clubs' => count($clubs),
                'total_students' => count($students),
                'pending_reviews' => 14,
                'active_events' => 8
            ],
            'clubs' => $clubs,
            'potentialPresidents' => $potentialPresidents,
            'students' => $students
            ]);
}

    


}
