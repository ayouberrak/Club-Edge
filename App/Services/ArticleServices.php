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

    public function deleteArticle(int $id): bool
    {
        return $this->articleRepository->deleteArticle($id);
    }

    public function updateArticle(array $data): bool
    {
        $article = Article::arrayToArticle($data);
        // Force ID since arrayToArticle might expect null for create. 
        // We need a way to set ID on article object, or pass it manually. 
        // Article model has private setter but private properties. 
        // arrayToArticle uses constructor: new Article(null, ...)
        // We need to modify arrayToArticle or create new instance manually here.
        
        // Let's create manually for update to ensure ID is set.
        $article = new Article(
            (int)$data['id_article'],
            $data['contenu'],
            (int)$data['id_event'],
            $data['image_article'] ?? null
        );
        
        return $this->articleRepository->updateArticle($article);
    }
}