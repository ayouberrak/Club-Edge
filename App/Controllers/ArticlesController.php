<?php

namespace App\Controllers;

use Core\Controller;
use App\Services\ArticleServices;

class ArticlesController extends Controller
{
    private ArticleServices $articleServices;

    public function __construct()
    {
        parent::__construct();
        $this->articleServices = new ArticleServices();
    }

    public function createArticle($data)
    {
        if(!isset($data['contenu']) || empty($data['contenu']) || empty($data['id_event'])) {
            header('Location: ' . $this->view->shared('base_url') . '/dashboard/president/articles/failure');
            exit;
        }
        $pathimage = null;
        if (isset($_FILES['image_article']) && $_FILES['image_article']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../public/upload/Image_article/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $filename = basename($_FILES['image_article']['name']);
            $targetFilePath = $uploadDir . $filename;
            if (move_uploaded_file($_FILES['image_article']['tmp_name'], $targetFilePath)) {
                $pathimage = $filename;
            }
        }
        $data['image_article'] = $pathimage;
        
        
        $success = $this->articleServices->createArticle($data);
        
        $redirectUrl = $this->view->shared('base_url') . '/dashboard/president';
        
        if ($success) {
            header('Location: ' . $redirectUrl . '?success=article_created');
        } else {
             // In a real app we'd flash errors to session
            header('Location: ' . $redirectUrl . '?error=article_creation_failed');
        }
        exit;
    } 
    public function articleSuccess()
    {
        $id_club = 1; 
        $articles = $this->articleServices->getArticlesByClub($id_club);
        return $this->render('dashboards.president.articles' , [
            'message' => 'Article posted successfully!' , 
            'type' => 'success',
            'articles' => $articles,
            'club' => ['id' => $id_club, 'name' => 'Robotics Club']
        ]);
    }

    public function articleFailure()
    {
        $id_club = 1;
        $articles = $this->articleServices->getArticlesByClub($id_club);
        return $this->render('dashboards.president.articles' , [
            'message' => 'Failed to post article. All fields are mandatory.', 
            'type' => 'error',
            'articles' => $articles,
            'club' => ['id' => $id_club, 'name' => 'Robotics Club']
        ]);
    }


    public function deleteArticle($id)
    {
        if ($this->articleServices->deleteArticle((int)$id)) {
            $redirectUrl = $this->view->shared('base_url') . '/dashboard/president';
            header('Location: ' . $redirectUrl . '?success=article_deleted');
        } else {
            $redirectUrl = $this->view->shared('base_url') . '/dashboard/president';
            header('Location: ' . $redirectUrl . '?error=article_delete_failed');
        }
        exit;
    }

    public function updateArticle()
    {
        $id_article = $_POST['id_article'] ?? null;
        if (!$id_article) {
             header('Location: ' . $this->view->shared('base_url') . '/dashboard/president?error=missing_id');
             exit;
        }

        $data = [
            'id_article' => $id_article,
            'contenu' => $_POST['contenu'],
            'id_event' => $_POST['id_event']
        ];

        $pathimage = null;
        if (isset($_FILES['image_article']) && $_FILES['image_article']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../public/upload/Image_article/';
             if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $filename = basename($_FILES['image_article']['name']);
            $targetFilePath = $uploadDir . $filename;
            if (move_uploaded_file($_FILES['image_article']['tmp_name'], $targetFilePath)) {
                $pathimage = $filename;
            }
        }
        
        if ($pathimage) {
            $data['image_article'] = $pathimage;
        }

        $success = $this->articleServices->updateArticle($data);
        
        $redirectUrl = $this->view->shared('base_url') . '/dashboard/president';

        if ($success) {
            header('Location: ' . $redirectUrl . '?success=article_updated');
        } else {
            header('Location: ' . $redirectUrl . '?error=article_update_failed');
        }
        exit;
    }
}