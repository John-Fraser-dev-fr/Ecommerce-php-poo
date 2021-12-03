<?php 

namespace Controllers;


class Admin extends Controller
{
   
    protected $modelName = \Models\Admin::class;


    public function show()
    {
        

        $commandes = $this->model->CommandeClient();
        $articles=$this->model->findAll();
            
       

        $pageTitle= 'Administrateur';
        \Renderer::render('admin', compact('pageTitle', 'commandes', 'articles' ));
       
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


    public function suppCommande()
    {
        
        if(isset($_POST['sup_com']) && !empty($_POST['id_commande_supp']))
        {

            $id_commande = $_POST['id_commande_supp'];

            $this->model->deleteCommande($id_commande);

            \Http::redirect("index.php?controller=admin&task=show");
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