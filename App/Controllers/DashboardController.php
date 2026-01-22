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
        
        if(!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
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
            'past_articles' => $repo->getArticles()
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
        $articles = [];

        if (!$club) {
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
        $this->checkAuth('president');
        $clubService = new ClubService();
        $club = $clubService->getClubByPresident($_SESSION['user_id']);
        
        $eventService = new EventService();
        $events = $club ? $eventService->getEventsByClub($club['id_club']) : [];

        return $this->render('dashboards.president.events', [
            'events' => $events,
            'club' => $club
        ]);
    }




    public function admin()
    {


        if(session_status() === PHP_SESSION_NONE) session_start();
        
        $this->checkAuth('admin');
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
        $this->checkAuth('admin');

        $clubsService = new ClubService();
        $club = $clubsService->getclubinfo((int)$id);

        if (!$club) {
            header('Location: ' . $this->view->shared('base_url') . '/admin/clubs');
            exit;
        }

        $eventService = new EventService();
        $events = $eventService->getEventsByClub((int)$id);
        
        $articleService = new ArticleServices();
        $articles = $articleService->getArticlesByClub((int)$id);

        return $this->render('dashboards.admin_club_details', [
            'club' => [
                'id'          => $club['id_club'],
                'name'        => $club['nom'],
                'president'   => $club['president'] ?? 'Not Assigned',
                'members'     => $club['members_count'] ?? 0,
                'capacity'    => $club['max_membres'],
                'status'      => 'Active Entity', 
                'description' => $club['description']
            ],
            'events' => $events,
            'articles' => $articles,
            'stats' => $this->getAdminStats()
        ]);
    }

    


}
