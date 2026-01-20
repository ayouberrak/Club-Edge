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

    public function createArticle($data, $id_event)
    {
        $success = $this->articleServices->createArticle($data, $id_event);
        if ($success) {
            header('Location: ' . $this->view->shared('base_url') . '/articles/success');
        } else {
            header('Location: ' . $this->view->shared('base_url') . '/articles/failure');
        }
        exit;
    }
}