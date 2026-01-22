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
        $sql = "SELECT 
                    a.id_article as id,
                    a.contenu as content,
                    a.image_article as image,
                    e.titre as event_title,
                    e.date_event as event_date,
                    a.date_creation as published_date -- Assuming this column exists, or we use event date
                FROM articles a
                JOIN events e ON a.id_event = e.id_event
                WHERE e.id_club = :id_club
                ORDER BY a.date_creation DESC"; // Assuming date_creation exists
        
        // If date_creation doesn't exist, we might need to check schema. 
        // For now let's assume it doesn't and just order by id or event date.
        // Actually, let's check if date_creation exists. 
        // Previous INSERT didn't show it. Likely timestamp default?
        // Let's stick to safe columns for now.
        
        $sql = "SELECT 
                    a.id_article as id,
                    a.contenu as content,
                    a.image_article as image,
                    a.id_event, -- Needed for edit
                    e.titre as title, -- Article title = Event title for now as we don't have article title
                    e.date_event as date
                FROM articles a
                JOIN events e ON a.id_event = e.id_event
                WHERE e.id_club = :id_club
                ORDER BY e.date_event DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_club', $id_club);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function deleteArticle(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM articles WHERE id_article = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updateArticle(Article $article): bool
    {
        $sql = "UPDATE articles SET contenu = :contenu";
        if ($article->getImageArticle()) {
            $sql .= ", image_article = :image_article";
        }
        $sql .= " WHERE id_article = :id_article";
        
        $stmt = $this->pdo->prepare($sql);

        $contenu = $article->getContenu();
        $id = $article->getIdArticle();

        $stmt->bindParam(':contenu', $contenu);
        $stmt->bindParam(':id_article', $id, PDO::PARAM_INT);
        
        if ($article->getImageArticle()) {
            $image = $article->getImageArticle();
            $stmt->bindParam(':image_article', $image);
        }

        return $stmt->execute();
    }
}