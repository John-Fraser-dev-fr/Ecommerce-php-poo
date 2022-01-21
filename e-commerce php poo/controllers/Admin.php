<?php 

namespace Controllers;


class Admin extends Controller
{
   
    protected $modelName = \Models\Admin::class;


    public function show()
    {
        if($_SESSION['role'] == 1) {

         $commandes = $this->model->CommandeClient();
         $articles=$this->model->findAll();
         $commandeEnCours=$this->model->commandeEnCours();
         $commandeTermine=$this->model->commandeTermine();
         $nbUser=$this->model->nbUser();
         $infoLivraisons=$this->model->infoLivraison();

            
       

         $pageTitle= 'Administrateur';
         \Renderer::render('admin', compact('pageTitle', 'commandes', 'articles', 'commandeEnCours', 'commandeTermine', 'nbUser', 'infoLivraisons' ));
        }else{}
       
    }


    public function changeStatus()
    {

        if (isset($_POST['status']) && !empty($_POST['id_commande']))
        {

	        if (!empty($_POST['changementStatus']))
	        {
                
                $check = $_POST['changementStatus'];
                $id_commande = $_POST['id_commande'];
                $this->model->changeStatus($check, $id_commande);
                
                \Http::redirect("index.php?controller=admin&task=show");
            }
	        else
            {
                die("Veuillez selectionner un état");
            }
        }

    }


   


    public function AjoutProduit()
    {
        if(isset($_POST['ajoutProduit']))
        {
            if(!empty(['marque', 'modele', 'prix', 'stock']))
            {
                $_POST=array_map('htmlspecialchars',$_POST);
		        extract($_POST,EXTR_SKIP);

                if (!$marque || !$modele|| !$prix|| !$stock) 
                {
                    die("Veuillez remplir tous les champs");
                }
                else
                {


                $this->model->addProduct($marque, $modele, $prix, $stock);
                

                \Http::redirect("index.php?controller=admin&task=show");
                }
              
            }
            else
            {
            
            }
        }
        
    }


    public function suppProduit()
    {
        if(isset($_POST['suppArt']) && !empty($_POST['article_supp']))
        {
            $id_article = $_POST['article_supp'];

            $this->model->deleteArticle($id_article);

            \Http::redirect("index.php?controller=admin&task=show");
        }
    }
}