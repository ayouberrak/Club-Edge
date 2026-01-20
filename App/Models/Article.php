<?php

namespace App\Models;

class Article
{
    private ?int $id_article;
    private string $contenu;
    private ?string $image_article;
    private int $id_event;

    private ?string $created_at;

    public function __construct(?int $id = null, string $contenu = "", int $id_event = 0, ?string $image_article = null, ?string $created_at = null)
    {
        $this->id_article = $id;
        $this->contenu = $contenu;
        $this->id_event = $id_event;
        $this->image_article = $image_article;
        $this->created_at = $created_at;
    }

    // Getters
    public function getIdArticle(): ?int { return $this->id_article; }
    public function getContenu(): string { return $this->contenu; }
    public function getImageArticle(): ?string { return $this->image_article; }

    public function getPathImageArticle(): ?string 
    { 
        if ($this->image_article) {
            return '/upload/Image_article/' . $this->image_article; 
        }
        return null;
    }

    public function getIdEvent(): int { return $this->id_event; }
    public function getCreatedAt(): string { return $this->created_at; }

    // Setters
    public function setContenu(string $c): void { $this->contenu = $c; }
    public function setImageArticle(?string $img): void { $this->image_article = $img; }
    public function setIdEvent(int $id): void { $this->id_event = $id; }
    public function setCreatedAt(string $date): void { $this->created_at = $date; }

    public static function arrayToArticle($data): Article
    {
        return new Article(
            $data['id_article'] ? null : $data['id_article'],
            $data['contenu'],
            $data['id_event'],
            $data['articleImage'],
        );
    }
}