<?php
namespace Controllers;

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
        \Http::redirect("index.php?controller=article&task=show&id=".$article['id_article']." ");

       

    }


   public function show()
   {
        $pageTitle = 'panier';
        \Renderer::render('panier', compact('pageTitle'));
   }


   public function delete()
   {
        if(isset($_POST['delete']) ) {

            unset($_SESSION['panier']); 

            $pageTitle = 'panier';
            \Renderer::render('panier', compact('pageTitle'));
       
        }
    }


    public function montantTotal()
    {
        $total = 0; //contient le montant total de la commande

        for ($i = 0; $i < count($_SESSION['panier']['modele']); $i++) {
    
            $total += $_SESSION['panier']['qte_produit'][$i] * $_SESSION['panier']['prix'][$i];// le symbole += pour ajouter la nouvelle valeut a l ancienne sans l ecraser
            
    
        }
        return round($total, 2);
    }




    public function validate()
    {
        
        
        if(isset($_POST['validate']) )
        {

            $montantTotal = $this->montantTotal();

            $id_commande =$this->model->valid_commande($montantTotal);
        
		    //Comptage des articles contenue dans le panier
		    $produits = count($_SESSION['panier']['modele']);

        
            for ($i=0 ;$i < $produits ; $i++)
            {
                $total = $_SESSION['panier']['qte_produit'][$i] * $_SESSION['panier']['prix'][$i];

                $id_article = $_SESSION['panier']['id_article'][$i];
                $quantiteParProduit = $_SESSION['panier']['qte_produit'][$i];
                
                $this->model->detail_commande($id_commande, $id_article, $quantiteParProduit, $total, $montantTotal);
            }


           
           
          
            
   
           
    
            $pageTitle = 'test page';
            \Renderer::render('panier', compact('pageTitle', 'montantTotal', 'produits'));


        
    }
    



    
 
   





    
        
    





    


        
        




   



}

  

}