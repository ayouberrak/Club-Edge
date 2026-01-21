<?php

namespace App\Controllers;

use App\Services\AdminService;
use App\Services\ClubService;
use Core\Controller;

class AdminController extends Controller
{
    public function deleteclub($id)
    {
        $clubsService = new ClubService();

        $clubsService->deletrclub($id);

        header('Location: ../../admin');

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
            $clubInfo[] = ['id_president' => $_POST['id_president']];
        }

        $adminServ = new ClubService();
        $adminServ->createClub($clubInfo);

        header('Location: ../admin');

    }

    public function clubaupdate()
    {
        $clubInfo = [
            'nom' => $_POST['nom'],
            'description' => $_POST['description'],
            'max_membres' => $_POST['max_membres']
        ];
        // var_dump($_FILES['image_url']);
        // exit;

        if (!empty($_POST['id_president'])) {
            $clubInfo[] = ['id_president' => $_POST['id_president']];
        }
        if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] === 0) {
            $clubInfo['image_url'] = $_FILES['image_url'];
        }

        $conditionEdit = ['id_club' => $_POST['id']];

        // var_dump($clubInfo);
        // exit;

        $clubsService = new ClubService();

        $clubsService->clubaupdate($clubInfo, $conditionEdit);

        header('Location: ../admin');


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

        $clubs = $clubsService->getallclub();

        // var_dump($clubs) ; 
        // exit ; 

        // Admin Dashboard Data
        return $this->render('dashboards.admin', [
            'stats' => [
                'total_clubs' => 6,
                'total_students' => 428,
                'pending_reviews' => 14,
                'active_events' => 8
            ],
            'clubs' => $clubs
        ]);
    }



}
