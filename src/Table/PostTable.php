<?php

namespace App\Table;


use Core\Table\Table;

class PostTable extends Table
{
    protected string $table = 'articles';

    public function last(): array
    {
        return $this->query("
            SELECT articles.id, articles.titre, articles.contenu, articles.date, categories.titre 
                AS categorie 
            FROM articles
                LEFT JOIN categories 
                    ON categories_id = categories.id 
            ORDER BY articles.date DESC");
    }

    public function findWithCategory($id)
    {
        return $this->query("
            SELECT articles.id, articles.titre, articles.contenu, articles.date, categories.titre 
                AS categorie 
            FROM articles
                LEFT JOIN categories 
                    ON categories_id = categories.id 
            WHERE articles.id = ?", [$id], true);
    }

    public function lastByCategory($category_id)
    {
        return $this->query("
            SELECT articles.id, articles.titre, articles.contenu, articles.date, categories.titre 
                AS categorie 
            FROM articles
                LEFT JOIN categories 
                    ON categories_id = categories.id 
            WHERE articles.categories_id = ? 
            ORDER BY articles.date DESC", [$category_id]);
    }

}