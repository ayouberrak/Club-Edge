<?php

namespace App\Controllers;

use App\Services\AdminService;
use App\Services\ClubService;
use App\Services\EtudiantsServices;
use App\Repository\ArticleRepository;
use App\Repository\EventRepository;
use Core\Controller;

class AdminController extends Controller
{
    public function deleteclub($id)
    {
        $clubsService = new ClubService();
        $clubsService->deleteClub($id);
        header('Location: ' . \Core\Helpers::url('/dashboard/admin'));
        exit;
    }

    public function deleteStudent($id)
    {
        $etudiantService = new EtudiantsServices();
        $etudiantService->deleteStudent($id);
        header('Location: ' . \Core\Helpers::url('/dashboard/admin'));
        exit;
    }


    public function modifierclub($id)
    {
        header('Content-Type: application/json');
        $clubsService = new ClubService();
        $return = $clubsService->getclubinfo($id);
        echo json_encode($return);
    }

    public function createClub()
    {
        $clubInfo = [
            'nom' => $_POST['nom'],
            'description' => $_POST['description'],
            'max_membres' => $_POST['max_membres'],
            'image_url' => $_FILES['image_url']
        ];

        if (!empty($_POST['id_president'])) {
            $clubInfo['id_president'] = $_POST['id_president'];
        }

        $adminServ = new ClubService();
        if ($adminServ->createClub($clubInfo) === false) {
            header('Location: ' . \Core\Helpers::url('/dashboard/admin?error=1'));
            exit;
        }

        header('Location: ' . \Core\Helpers::url('/dashboard/admin'));
        exit;
    }

    public function clubaupdate()
    {
        $clubInfo = [
            'nom' => $_POST['nom'],
            'description' => $_POST['description'],
            'max_membres' => $_POST['max_membres']
        ];

        if (!empty($_POST['id_president'])) {
            $clubInfo['id_president'] = $_POST['id_president'];
        }
        if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] === 0) {
            $clubInfo['image_url'] = $_FILES['image_url'];
        }

        $conditionEdit = ['id_club' => $_POST['id']];

        $clubsService = new ClubService();
        $clubsService->clubaupdate($clubInfo, $conditionEdit);

        header('Location: ' . \Core\Helpers::url('/dashboard/admin'));
        exit;
    }

    public function admin()
    {


        if (session_status() === PHP_SESSION_NONE)
            session_start();

        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
            header('Location: ' . $this->view->shared('base_url') . '/dashboard');
            exit;
        }

        $clubsService = new ClubService();
        $etudiantService = new EtudiantsServices();

        $clubs = $clubsService->getallclub();
        $potentialPresidents = $clubsService->getPotentialPresidents();
        $students = $etudiantService->getAllEtudiants();

        $articleRepo = new ArticleRepository();
        $eventRepo = new EventRepository();
        
        // Admin Dashboard Data
        return $this->render('dashboards.admin', [
            'stats' => [
                'total_clubs' => count($clubs),
                'total_students' => count($students),
                'pending_reviews' => $articleRepo->getCountArticles(),
                'active_events' => $eventRepo->getCountUpcomingEvents()
            ],
            'clubs' => $clubs,
            'potentialPresidents' => $potentialPresidents,
            'students' => $students
        ]);
    }



}
