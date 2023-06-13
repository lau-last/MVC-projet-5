<?php

namespace App\Entity;

use Core\Entity\Entity;

class PostEntity extends Entity
{
    public int $id;
    public string $titre;
    public string $contenu;

    public function getUrl(): string
    {
        return 'index.php?page=posts.show&id=' . $this->id;
    }

    public function getExtrait(): string
    {
        $html = '<p>' . \substr($this->contenu, 0, 100) . '...</p>';
        $html .= '<p><a href="' . $this->getUrl() . '">Voir la suite</a></p>';
        return $html;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getContenu(): string
    {
        return $this->contenu;
    }
}