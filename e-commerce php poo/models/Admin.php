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


    
}