<?php

namespace Models;

class Panier extends Model
{
    public function ajouter()
    {
        $produit_id = $_GET['id'];
		$result = $this->pdo->query('SELECT * FROM articles WHERE id_article =' . $produit_id);
		$row = $result->fetch();
		

        return $row;

    }

    public function valid_commande($montantTotal, $paiementStatus)
    {
        $q = $this->pdo->prepare('INSERT INTO commande(id_user, montant,paiement, date ) VALUES (:id_user,:montant,:paiement, NOW())');
	    $q->execute(['id_user'=>$_SESSION['id'],
		            'montant'=>$montantTotal,
                    'paiement'=>$paiementStatus]);

        $id_commande = $this->pdo->lastInsertId();

        return $id_commande;
      
    }

    public function change_status($statusPaiement,$id_commande)
    {
        $q = $this->pdo->prepare('UPDATE commande SET paiement=:paiement WHERE id_commande=:id_commande');
	    $q->execute(['paiement'=>$statusPaiement,
                     'id_commande'=>$id_commande]);
    }
   

    public function showDetail()
    {

		$result = $this->pdo->query('SELECT  * FROM commande');
		$detail = $result->fetch();


        return $detail;

    }

 

    public function detail_commande($id_commande, $id_article, $quantiteParProduit, $total)
    {

     
        $q = $this->pdo->prepare('INSERT INTO details_commande(id_commande, id_article, quantite, prix ) VALUES (:id_commande, :id_article, :quantite, :prix) ');
	    $q->execute(['id_commande'=>$id_commande,
		            'id_article'=>$id_article,
                    'quantite'=> $quantiteParProduit,
                    'prix'=> $total]);
			        
    }

   
        
     

    public function lastInsertId() {
        return $this->pdo->lastInsertId();
    }
    
    
}
 