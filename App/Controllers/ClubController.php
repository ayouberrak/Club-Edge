<?php

namespace App\Controllers;

use App\Models\Event;
use App\Repository\ArticleRepository;
use App\Repository\ClubRepository;
use App\Repository\EventRepository;
use Config\Database;
use Core\Controller;


class ClubController extends Controller
{
    // public function testClubDetails()
    // {
    //     $eventRepo = new EventRepository();

    //     $events = $eventRepo->findByClub();

    //     return $this->render('dashboards.admin.club_details', [
    //         'club' => [
    //             'id' => 1,
    //             'name' => 'Club de Test',
    //             'description' => 'Ceci est une description de test',
    //             'president' => 'Jean Dupont',
    //             'members' => 5,
    //             'capacity' => 8
    //         ],
    //         'events' => $events,
    //         'articles' => [] // On laisse vide pour le test
    //     ]);
    // }
    public function show($id)
    {
        if(session_status() === PHP_SESSION_NONE) session_start();
        
        if(!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        $repo = new ClubRepository();
        $eventRepo = new EventRepository();
        $articlRepo = new ArticleRepository();

        $club = $repo->findClub($id);
        $events = $eventRepo->findByClub($id);
        $articles = $articlRepo->getArticlebyClub($id);

        $memberShip = false;
        if(isset($_SESSION['user_id'])) {
            $repo = new ClubRepository();
            $memberShip = $repo->getUserMemberShip($_SESSION['user_id']);
            
            // Check registration for each event
            foreach($events as &$event) {
                $event['is_registered'] = $eventRepo->isUserRegistered($event['id'], $_SESSION['user_id']);
            }
        }

        if(!$club) {
            header("HTTP/1.0 404 NOT FOUND");
            die('Club not found');
        }
        

        return $this->render('clubs.show', [
            'club' => $club,
            'user_membership' => $memberShip,
            'events' => $events,
            'articles' => $articles
        ]);
    }


    public function joinClub() {

        if(session_start() === PHP_SESSION_NONE) session_start();

        
        $clubId = $_POST['club_id'];
        $userId = $_SESSION['user_id'];
        
        if(!isset($userId)) {
            header('Location: ' . $this->view->shared('base_url') .'/login');
            exit;
        }

        $repo = new ClubRepository();
        $repo->addMemberToClub($clubId, $userId);

        header('Location: '. $this->view->shared('base_url') . '/club/'.$clubId);
        exit;

    }

    public function leave() {
        if(session_status() === PHP_SESSION_NONE) session_start();

        if(!isset($_SESSION['user_id'])) {
            header('Location: ' . $this->view->shared('base_url') . '/login');
            exit;
        }

        $repo = new ClubRepository();

        if ($repo->leaveClub($_SESSION['user_id'])) {
            $_SESSION['flash_success'] = "You have successfully left the club.";
        } else {
            $_SESSION['flash_error'] = "An error occurred while trying to leave.";
        }

        header('Location: ' . $this->view->shared('base_url') . '/#clubs');
        exit;
    }


}
