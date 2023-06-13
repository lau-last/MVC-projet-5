<?php

namespace App\Entity;

use Core\Entity\Entity;

class CategoryEntity extends Entity
{
    public int $id;
    public string $titre;

    public function getUrl(): string
    {
        return 'index.php?page=posts.categories&id=' . $this->id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }
}