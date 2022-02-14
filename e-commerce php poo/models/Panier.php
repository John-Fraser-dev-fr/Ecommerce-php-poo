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

    public function valid_commande($montantTotal, $paiementStatus, $id_stripe)
    {
        $q = $this->pdo->prepare('INSERT INTO commande(id_user, montant,paiement, date, id_stripe ) VALUES (:id_user,:montant,:paiement, NOW(),:id_stripe)');
	    $q->execute(['id_user'=>$_SESSION['id'],
		            'montant'=>$montantTotal,
                    'paiement'=>$paiementStatus,
                    'id_stripe'=>$id_stripe]);

        $id_commande = $this->pdo->lastInsertId();

        return $id_commande;
      
    }

    public function change_status($statusPaiement,$id_commande)
    {
        $q = $this->pdo->prepare('UPDATE commande SET paiement = :paiement WHERE id_commande=:id_commande');
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


    public function Commande($id_commande)
    {
        
        $r = $this->pdo->prepare('SELECT * FROM commande WHERE id_commande =:id_commande');
        $r->execute(['id_commande'=>$id_commande]);
        $coms = $r->fetch();

        return $coms;

    }

   
        
     

    public function lastInsertId() {
        return $this->pdo->lastInsertId();
    }


    public function modifInfoUser($nom, $prenom, $email, $id_user)
    {
        $q = $this->pdo->prepare('UPDATE users SET nom = :nom, prenom= :prenom, email= :email WHERE id_user=:id_user');
	    $q->execute(['nom'=>$nom,
                     'prenom'=>$prenom, 
                    'email' =>$email,
                    'id_user' => $id_user]);
    }

    public function infoUtilisateur()
    {
        $r = $this->pdo->prepare('SELECT * FROM users WHERE id_user= :id_user');
        $r->execute(['id_user'=>$_SESSION['id']]);
        $infosUsers = $r->fetch();

        return $infosUsers;
    }


    public function modif_adresse($numero_rue, $rue, $code_postal, $ville, $pays, $id_user2)
    {
        $q = $this->pdo->prepare('UPDATE users SET numero_rue = :numero_rue, rue= :rue, code_postal= :code_postal, ville= :ville, pays= :pays WHERE id_user=:id_user');
	    $q->execute(['numero_rue'=>$numero_rue,
                     'rue'=>$rue, 
                    'code_postal' =>$code_postal,
                    'ville' => $ville,
                    'pays' => $pays,
                    'id_user' => $id_user2]);
    }
    
    
}
 