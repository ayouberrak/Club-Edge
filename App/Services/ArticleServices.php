<?php

namespace  App\Services;

use App\Repository\ArticleRepository;
use App\Models\Article;

class ArticleServices
{
    private ArticleRepository $articleRepository;

    public function __construct()
    {
        $this->articleRepository = new ArticleRepository(); 
    }

    public function createArticle(array $data ): bool
    {
        // $data['id_event'] = 11 ; 
        $article = Article::arrayToArticle($data);
        return $this->articleRepository->createArticle($article);
    }

    public function getArticleByIdEvent(int $id_event): ?array
    {
        return $this->articleRepository->getArticleByIdEvent($id_event);
    }

    public function getArticlesByClub(int $id_club): ?array
    {
        return $this->articleRepository->getArticlebyClub($id_club);
    }

}