<?php 
namespace Models;



class Article extends Model
{
    

    //Récupération de tous les articles
    public function findAll(): array
    {
        $resultats = $this->pdo->query('SELECT * FROM articles');
        $articles = $resultats->fetchAll();

        return $articles;
    }


    //Récupération de l'article en question
    public function find(int $id): array
    {  
        $query = $this->pdo->prepare("SELECT * FROM articles WHERE id_article = :article_id");
        $query->execute(['article_id' => $id]);
        $article = $query->fetch();

        return $article;
    }

}