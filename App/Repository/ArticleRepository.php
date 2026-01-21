<?php


namespace App\Repository;

use Config\Database;
use PDO;
use App\Models\Article;

class ArticleRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    
    public function createArticle(Article  $article): bool
    {
        $sql = "INSERT INTO articles (contenu, id_event, image_article) VALUES (:contenu, :id_event, :image_article)";
        $stmt = $this->pdo->prepare($sql);

        $contenu = $article->getContenu();
        $idEvent = $article->getIdEvent();
        $imageArticle = $article->getImageArticle();

        $stmt->bindParam(':contenu', $contenu);
        $stmt->bindParam(':id_event', $idEvent);
        $stmt->bindParam(':image_article', $imageArticle);

        return $stmt->execute();
    }

    public function getArticleByIdEvent(int $id_event): ?Article
    {
        $sql = "SELECT * FROM articles WHERE id_event = :id_event";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_event', $id_event);
        $stmt->execute();
        $article = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($article) {
            return new Article(
                $article['id_article'],
                $article['contenu'],
                $article['id_event'],
                $article['image_article'],
            );
        }
        return null;
    }

    public function getArticlebyClub(int $id_club): ?array
    {
        $sql = "SELECT a.* FROM articles a
                JOIN events e ON a.id_event = e.id_event
                WHERE e.id_club = :id_club";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_club', $id_club);
        $stmt->execute();
        $articlesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $articles = [];
        foreach ($articlesData as $article) {
            $articles[] = new Article(
                $article['id_article'],
                $article['contenu'],
                $article['id_event'],
                $article['image_article'],
            );
        }
        return $articles;
    }
    
}