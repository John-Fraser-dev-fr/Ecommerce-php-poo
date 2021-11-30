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

    public function CommandeClientDetail()
    {
        $r = $this->pdo->query('SELECT * FROM commande,details_commande, articles  
                                WHERE commande.id_commande = details_commande.id_commande 
                                AND details_commande.id_article = articles.id_article ');
        $commandeDetails = $r->fetchAll();

        return $commandeDetails;
    }
}