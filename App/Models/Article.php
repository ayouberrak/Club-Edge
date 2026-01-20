<?php

namespace App\Models;

class Article
{
    private ?int $id_article;
    private string $contenu;
    private ?string $image_article;
    private int $id_event;

    public function __construct(?int $id = null, string $contenu = "", int $id_event = 0)
    {
        $this->id_article = $id;
        $this->contenu = $contenu;
        $this->id_event = $id_event;
    }

    // Getters
    public function getIdArticle(): ?int { return $this->id_article; }
    public function getContenu(): string { return $this->contenu; }
    public function getImageArticle(): ?string { return $this->image_article; }
    public function getIdEvent(): int { return $this->id_event; }

    // Setters
    public function setContenu(string $c): void { $this->contenu = $c; }
    public function setImageArticle(?string $img): void { $this->image_article = $img; }
    public function setIdEvent(int $id): void { $this->id_event = $id; }
}