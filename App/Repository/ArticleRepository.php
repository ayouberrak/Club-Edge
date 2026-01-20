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

    
}