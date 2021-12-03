<?php

namespace Models;


class Admin extends Model
{
    


    public function CommandeClient()
    {
        $r = $this->pdo->query('SELECT * FROM commande, users WHERE users.id_user = commande.id_user');
        $commandes = $r->fetchAll();

        return $commandes;
    }

    public function changeStatus($check, $id_commande)
    {
        $q = $this->pdo->prepare('UPDATE commande SET status = :status WHERE id_commande=:id_commande');
	    $q->execute(['status'=>$check,
                     'id_commande'=>$id_commande]);
    }


    public function deleteCommande($id_commande)
    {
        $q = $this->pdo->prepare("DELETE FROM commande WHERE id_commande =:id_commande ");
        $q->execute(['id_commande' => $id_commande]);
    }


    public function findAll(): array
    {
        $resultats = $this->pdo->query('SELECT * FROM articles');
        $articles = $resultats->fetchAll();

        return $articles;
    }

    public function addProduct($marque, $modele, $prix, $stock)
    {
	    $q = $this->pdo->prepare('INSERT INTO articles(marque, modele, prix, stock) VALUES (:marque,:modele,:prix,:stock)');
	    $q->execute(['marque'=>$marque,
		            'modele'=>$modele,
                    'prix'=>$prix,
                    'stock'=>$stock]);
    }


    public function deleteArticle($id_article)
    {
        $q = $this->pdo->prepare("DELETE FROM articles WHERE id_article =:id_article ");
        $q->execute(['id_article' => $id_article]);
    }
}