<?php

namespace Models;


class Admin extends Model
{
    


    public function CommandeClient()
    {
        $requete= $this->pdo->query('SET lc_time_names = \'fr_FR\'');
        $r = $this->pdo->query('SELECT * , DATE_FORMAT(date,"%W %d %M %Y") AS date FROM commande, users WHERE users.id_user = commande.id_user  ORDER BY commande.date DESC');
        $commandes = $r->fetchAll();

        return $commandes;
    }

    public function changeStatus($check, $id_commande)
    {
        $q = $this->pdo->prepare('UPDATE commande SET status = :status WHERE id_commande=:id_commande');
	    $q->execute(['status'=>$check,
                     'id_commande'=>$id_commande]);
    }




    public function findAll(): array
    {
        $resultats = $this->pdo->query('SELECT * FROM articles');
        $articles = $resultats->fetchAll();

        return $articles;
    }

    public function addProduct($marque, $modele, $prix)
    {
	    $q = $this->pdo->prepare('INSERT INTO articles(marque, modele, prix) VALUES (:marque,:modele,:prix)');
	    $q->execute(['marque'=>$marque,
		            'modele'=>$modele,
                    'prix'=>$prix]);
    }


    public function deleteArticle($id_article)
    {
        $q = $this->pdo->prepare("DELETE FROM articles WHERE id_article =:id_article ");
        $q->execute(['id_article' => $id_article]);
    }



    public function commandeEnCours()
    {
        
        $r = $this->pdo->query('SELECT COUNT(id_commande) FROM commande WHERE status < 3');
        $commandeEnCours = $r->fetchColumn();

        return $commandeEnCours;
    }


    public function commandeTermine()
    {
        
        $r = $this->pdo->query('SELECT COUNT(id_commande) FROM commande WHERE status = 3');
        $commandeTermine = $r->fetchColumn();

        return $commandeTermine;
    }

    public function nbUser()
    {
        
        $r = $this->pdo->query('SELECT COUNT(id_user) FROM users WHERE role = 0');
        $nbUser = $r->fetchColumn();

        return $nbUser;
    }

    public function infoLivraison()
    {
        $r = $this->pdo->query('SELECT commande.id_commande, users.nom,users.prenom,users.numero_rue,users.rue,users.code_postal,users.ville,users.pays,details_commande.quantite, GROUP_CONCAT(articles.modele) AS articleByUser, COUNT(*) AS nbArtByUser
                                FROM articles,users,commande, details_commande 
                                WHERE commande.id_commande = details_commande.id_commande
                                AND users.id_user = commande.id_user
                                AND details_commande.id_article= articles.id_article
                                GROUP BY commande.id_commande');
        $infoLivraisons = $r->fetchAll();

        return $infoLivraisons;
    }

    
    
    
}