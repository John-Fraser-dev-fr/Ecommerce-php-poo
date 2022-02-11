<?php

namespace Controllers;

use Stripe\ApiOperations;
use Stripe\Stripe;

class Panier extends Controller
{
    protected $modelName = \Models\Panier::class;
    

  
 

   public function add()
   {
        if (!empty($_GET['id']) && isset($_POST['ajout_panier']) )
        {
            
		
            $row =$this->model->ajouter();

		    $produit_nom = $row['marque'];
		    $produit_prix = $row['prix'];
            $produit_modele = $row['id_article'];
            $modele = $row['modele'];
		    $produit_qte = '1';
            
           
        }


        if(!isset($_SESSION['panier']))
        {
            $_SESSION['panier'] = array();

            $_SESSION['panier']['id_produit'] = array();
            $_SESSION['panier']['marque'] = array();
	        $_SESSION['panier']['qte_produit'] = array();
            $_SESSION['panier']['id_article'] = array();
            $_SESSION['panier']['modele'] = array();
	        $_SESSION['panier']['prix'] = array();
           
        }
    

        //On verifie si le produit existe deja dans le panier
        $produits = array_search($produit_modele, $_SESSION['panier']['id_article'], true);

        //Si le produit existe dans le panier on ajoute 1 a la quantite du produit selectionner
        if ($produits !== false)
        {
	        $_SESSION['panier']['qte_produit'][$produits] += $produit_qte ;

        //Sinon on ajoute l article selectionner avec une quantiter de depart a 1
        }
        else
        {
	        array_push($_SESSION['panier']['marque'], $produit_nom);
	        array_push($_SESSION['panier']['qte_produit'], $produit_qte);
	        array_push($_SESSION['panier']['prix'],$produit_prix);
            array_push($_SESSION['panier']['id_article'],$produit_modele);
            array_push($_SESSION['panier']['modele'],$modele);
           
        }

        $article= $_GET['id'];
        \Http::redirect("index.php?controller=article&task=show&id=".$article." ");

       

    }


   public function show()
   {
        $pageTitle = 'panier';
        \Renderer::render('panier', compact('pageTitle'));
   }


   public function delete()
   {
        if(isset($_POST['delete']) && !empty($_POST['status_stripe'])) {

           require_once('/Applications/MAMP/htdocs/GitHub/Ecommerce-php-poo/vendor/autoload.php');

           if(!empty($_POST['id_commande']) )
           {

            
            

            //instanciation Stripe
            \Stripe\Stripe::setApiKey('sk_test_51KHV5GAHhzIZdHyZaH9PmrBuPtOZJj0IqfgCN3wEDdZ6mwmCXIB80UvrN0D7ICezaa38aRtYQFTDaq6aZGlNPtEJ00FoXsgowS');

            

                      
            $id_commande =$_POST['id_commande'];
		    

            $statusPaiement = htmlspecialchars($_POST['status_stripe']);

            $this->model->change_status($statusPaiement,$id_commande);
              
        

            unset($_SESSION['panier']);
            \Http::redirect("index.php");
           }
       
        }
    }

    public function supprimerArticle()
    {
        
        //Paniet temporaire
        $panier_tmp = array("qte_produit"=>array(), "id_article"=>array(),"marque"=>array(),"modele"=>array(), "prix"=>array()); 

        //Comptage des articles du panier 
        $nb_articles = count($_SESSION['panier']['modele']); 

        //Transfert du panier dans le panier temporaire 
        for($i = 0; $i < $nb_articles; $i++) 
        { 
            $ref_article = $_POST['supp_art_hidden'];

            if($_SESSION['panier']['modele'][$i] != $ref_article) 
            { 
                array_push($panier_tmp['marque'],$_SESSION['panier']['marque'][$i]); 
                array_push($panier_tmp['qte_produit'],$_SESSION['panier']['qte_produit'][$i]); 
                array_push($panier_tmp['modele'],$_SESSION['panier']['modele'][$i]); 
                array_push($panier_tmp['id_article'],$_SESSION['panier']['id_article'][$i]);
                array_push($panier_tmp['prix'],$_SESSION['panier']['prix'][$i]); 
            } 
        } 

        //Réinitialisation du panier
        $_SESSION['panier'] = $panier_tmp; 

        //Suppression du panier temporaire
        unset($panier_tmp); 
  
        $pageTitle = 'panier';
        \Renderer::render('panier', compact('pageTitle'));
    }
 

   


    public function montantTotal()
    {
        $total = 0; //contient le montant total de la commande

        for ($i = 0; $i < count($_SESSION['panier']['modele']); $i++) {
    
            
            $total += $_SESSION['panier']['qte_produit'][$i] * $_SESSION['panier']['prix'][$i];// le symbole += pour ajouter la nouvelle valeut a l ancienne sans l ecraser
            
    
        }
        return round($total, 2);
    }

    

    public function finalisation()
    {
        if(isset($_SESSION['id'])){
        if(isset($_POST['prixFinal']) && !empty($_POST['prixFinal']))
        {
            require_once('/Applications/MAMP/htdocs/GitHub/Ecommerce-php-poo/vendor/autoload.php');

            $prix= $_POST['prixFinal'];

            //instanciation Stripe
            \Stripe\Stripe::setApiKey('sk_test_51KHV5GAHhzIZdHyZaH9PmrBuPtOZJj0IqfgCN3wEDdZ6mwmCXIB80UvrN0D7ICezaa38aRtYQFTDaq6aZGlNPtEJ00FoXsgowS');

            $intention = \Stripe\PaymentIntent::create([
                'amount' => $prix*100,
                'currency' => 'eur'
                
            ]);

            $id_stripe= $intention['id'];

            $paiementStatus=$intention['status'];


             
            $montantTotal = $this->montantTotal();

            if($montantTotal < 99){
                $montantTotal += 12.99;
            }else if($montantTotal >= 99){
                $montantTotal = $montantTotal;
            }


            $id_commande =$this->model->valid_commande($montantTotal, $paiementStatus, $id_stripe);
        
		    //Comptage des articles contenue dans le panier
		    $produits = count($_SESSION['panier']['modele']);

        
            for ($i=0 ;$i < $produits ; $i++)
            {
                $total = $_SESSION['panier']['qte_produit'][$i] * $_SESSION['panier']['prix'][$i];

                $id_article = $_SESSION['panier']['id_article'][$i];
                $quantiteParProduit = $_SESSION['panier']['qte_produit'][$i];
                
                $this->model->detail_commande($id_commande, $id_article, $quantiteParProduit, $total, $montantTotal);
            }

            $coms=$this->model->Commande($id_commande);

            $aaa= $coms['id_stripe'];

            $intention3 = \Stripe\PaymentIntent::retrieve($aaa);

            $intention4 = $intention3['status'];

            

            $pageTitle = 'Terminer ma commande';
            \Renderer::render('finalisation', compact('pageTitle','intention','id_commande','aaa', 'intention4'));

        }

    }else {
        $pageTitle = 'Terminer ma commande';
        \Renderer::render('finalisation', compact('pageTitle'));

    }
        
    }




   






    
 
   





    
        
    





    


        
        




   



}

  

