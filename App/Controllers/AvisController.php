<?php 

namespace App\Controllers;

use App\Services\AvisService;
use Core\Controller;

class AvisController extends Controller {

    public function addAvis($data) {
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        $baseUrl = $this->view->shared('base_url');

        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . $baseUrl . '/login');
            exit;
        }

        $redirectPath = $data['redirect_to'] ?? '/dashboard/events';

        // CSRF Check
        if (!isset($data['csrf_token']) || $data['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
            header('Location: ' . $baseUrl . $redirectPath . (strpos($redirectPath, '?') !== false ? '&' : '?') . 'error=csrf_error');
            exit;
        }

        $commentData = [
            'note' => (int)($data['note'] ?? 0),
            'commentaire' => $data['commentaire'] ?? '',
            'id_user' => $_SESSION['user_id'],
            'id_event' => (int)($data['id_event'] ?? 0)
        ];

        $avisServ = new AvisService();
        $result = $avisServ->addAvis($commentData);

        if ($result['success']) {
            header('Location: ' . $baseUrl . $redirectPath . (strpos($redirectPath, '?') !== false ? '&' : '?') . 'success=' . urlencode('review_added'));
        } else {
            header('Location: ' . $baseUrl . $redirectPath . (strpos($redirectPath, '?') !== false ? '&' : '?') . 'error=' . urlencode($result['message']));
        }
        exit;

    }

}