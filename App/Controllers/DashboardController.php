<?php

namespace App\Controllers;

use App\Repository\StudentRepository;
use Config\Database;
use Core\Controller;
use PDO;

class DashboardController extends Controller
{
    private $db;

    public function __construct()
    {
        parent::__construct();

        $this->db = Database::getInstance()->getConnection();
        if(session_status() == PHP_SESSION_NONE) session_start();
    }

    private function checkAuth($role = null) {
        if(!isset($_SESSION['user_id'])) {
            header('Location: ' . $this->view->shared('base_url') . '/login');
            exit;
        }
        if($role && $_SESSION['user_role'] !== $role) {
            header('Location: ' . $this->view->shared('base_url') . '/dashboard');
            exit; 
        }
    }

    public function index()
    {

        $this->checkAuth();

        $repo = new StudentRepository($this->db);
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

        $repo = new StudentRepository($this->db);
        $userId = $_SESSION['user_id'];

        return $this->render('dashboards.student.events', [
            'registered_events' => $repo->getRegisteredEvents($userId)
        ]);
    }

    public function studentArticles()
    {
        $this->checkAuth();

        $repo = new StudentRepository($this->db);
        $userId = $_SESSION['user_id'];

        return $this->render('dashboards.student.articles', [
            'past_articles' => $repo->getArticles($userId)
        ]);
    }

    public function president()
    {

        if(session_status() === PHP_SESSION_NONE) session_start();
        
        if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'president') {
            header('Location: '. $this->view->shared('base_url') . '/dashboard');
            exit;
        }

        // President Dashboard Data (Manages Robotics Club)
        return $this->render('dashboards.president', [
            'club' => [
                'name' => 'Robotics Club',
                'members_count' => 5,
                'max_members' => 8
            ],
            'members' => [
                ['id' => 1, 'name' => 'Anas Errak', 'email' => 'anas@univ.ma', 'role' => 'President', 'online' => true],
                ['id' => 2, 'name' => 'John Doe', 'email' => 'john@univ.ma', 'role' => 'Member', 'online' => false],
                ['id' => 3, 'name' => 'Sara Smith', 'email' => 'sara@univ.ma', 'role' => 'Member', 'online' => true],
                ['id' => 4, 'name' => 'Ahmed Ali', 'email' => 'ahmed@univ.ma', 'role' => 'Member', 'online' => false],
                ['id' => 5, 'name' => 'Yassine Kan', 'email' => 'yassine@univ.ma', 'role' => 'Member', 'online' => true],
            ]
        ]);
    }

    public function presidentEvents()
    {
        return $this->render('dashboards.president.events', [
            'events' => [
                ['id' => 1, 'title' => 'Cyber Security Talk', 'date' => '2026-03-12', 'participants' => 24, 'image' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b'],
                ['id' => 2, 'title' => 'IoT Workshop', 'date' => '2026-04-05', 'participants' => 12, 'image' => 'https://images.unsplash.com/photo-1518770660439-4636190af475'],
            ],
            'club' => ['name' => 'Robotics Club']
        ]);
    }

    public function presidentArticles()
    {
        return $this->render('dashboards.president.articles', [
            'club' => ['name' => 'Robotics Club']
        ]);
    }

    public function admin()
    {


        if(session_status() === PHP_SESSION_NONE) session_start();
        
        if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
            header('Location: '. $this->view->shared('base_url') . '/dashboard');
            exit;
        }
    
        // Admin Dashboard Data
        return $this->render('dashboards.admin', [
            'stats' => [
                'total_clubs' => 6,
                'total_students' => 428,
                'pending_reviews' => 14,
                'active_events' => 8
            ],
            'clubs' => [
                ['id' => 1, 'name' => 'Robotics Club', 'president' => 'Anas Errak', 'members' => 5, 'capacity' => 8, 'status' => 'active'],
                ['id' => 2, 'name' => 'Music Club', 'president' => 'Mehdi Ray', 'members' => 8, 'capacity' => 8, 'status' => 'full'],
                ['id' => 3, 'name' => 'Sport Club', 'president' => 'Youssef Zen', 'members' => 4, 'capacity' => 8, 'status' => 'active'],
                ['id' => 4, 'name' => 'Chess Club', 'president' => 'Sarah Smith', 'members' => 6, 'capacity' => 8, 'status' => 'active'],
                ['id' => 5, 'name' => 'Art Club', 'president' => 'Ines Ber', 'members' => 3, 'capacity' => 8, 'status' => 'low'],
                ['id' => 6, 'name' => 'Coding Club', 'president' => 'Omar Far', 'members' => 7, 'capacity' => 8, 'status' => 'active'],
            ]
        ]);
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
        return [
            'total_clubs' => 6,
            'total_students' => 428,
            'pending_reviews' => 14,
            'active_events' => 8
        ];
    }

    public function adminClubDetails($id)
    {
        // Mock data for a specific club (e.g., Robotics Club)
        return $this->render('dashboards.admin.club_details', [
            'club' => [
                'id' => $id,
                'name' => 'Robotics Club',
                'president' => 'Anas Errak',
                'members' => 5,
                'capacity' => 8,
                'status' => 'active',
                'description' => 'The premier robotics and automation research center on campus.'
            ],
            'events' => [
                ['id' => 1, 'title' => 'Global AI Summit', 'date' => 'Oct 24, 2026', 'attendance' => 156],
                ['id' => 2, 'title' => 'Workshop: Neural Networks', 'date' => 'Nov 12, 2026', 'attendance' => 42]
            ],
            'articles' => [
                ['id' => 1, 'title' => 'How we built our first humanoid', 'author' => 'Anas Errak', 'date' => '2 days ago'],
                ['id' => 2, 'title' => 'The future of campus robotics', 'author' => 'Mehdi Ray', 'date' => '1 week ago']
            ]
        ]);
    }
}
