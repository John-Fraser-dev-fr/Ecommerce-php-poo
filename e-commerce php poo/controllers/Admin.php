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
            if(!empty(['marque', 'modele','detail_modele', 'prix']) && isset($_FILES['photoProduit']) && !empty($_FILES['photoProduit']['name']))
            {

                $tailleMax= 2097152;
	            $extensionsValides = array('jpg', 'jpeg');

                $_POST=array_map('htmlspecialchars',$_POST);
		        extract($_POST,EXTR_SKIP);

                //retourne en minuscule/Ignore la 1ere chaine/Récupératoin de le extension avec le point
                $extensionUpload = strtolower(substr(strrchr($_FILES['photoProduit']['name'], '.'), 1)); 

                if ($_FILES['photoProduit']['size'] <= $tailleMax) 
                {
                
                    // Si extension d'upload correpond à $extensionsValides
		            if(in_array($extensionUpload,$extensionsValides))
		            {
                        $chemin= "assets/image_produits/".$_FILES['photoProduit']['name'];
                        $resultat = move_uploaded_file($_FILES['photoProduit']['tmp_name'], $chemin);
                        $file=$_FILES['photoProduit']['name'];

                        if($resultat && $marque && $modele && $detail_modele && $prix)
			            {
                            $this->model->addProduct($marque, $modele, $detail_modele, $prix, $file);
                            \Http::redirect("index.php?controller=admin&task=show");
			            }
                        else
                        {
                            die("erreur");
                        }


                      
                    }
                    else
                    {
                        die("La photo doit être au format jpg, jpeg");
                    }
                    
                }
                else
                {
                    die("La photo ne doit pas dépasser 2 Mo");
                }
              
            }
            else
            {
                die("Veuillez remplir tous les champs");
            }
        }
        
    }


    public function UpdateProduit()
    {
        if(isset($_POST['modifArt']))
        {
            if(!empty(['modif_marque', 'modif_modele','modif_detailModele', 'modif_prix', 'id_art_modif']) && isset($_FILES['photoProduitModif']) && !empty($_FILES['photoProduitModif']['name']))
            {

                $tailleMax= 2097152;
	            $extensionsValides = array('jpg', 'jpeg');

                $_POST=array_map('htmlspecialchars',$_POST);
		        extract($_POST,EXTR_SKIP);

                //retourne en minuscule/Ignore la 1ere chaine/Récupératoin de le extension avec le point
                $extensionUpload = strtolower(substr(strrchr($_FILES['photoProduitModif']['name'], '.'), 1)); 

                if ($_FILES['photoProduitModif']['size'] <= $tailleMax) 
                {
                
                    // Si extension d'upload correpond à $extensionsValides
		            if(in_array($extensionUpload,$extensionsValides))
		            {
                        $chemin= "assets/image_produits/".$_FILES['photoProduitModif']['name'];
                        $resultat = move_uploaded_file($_FILES['photoProduitModif']['tmp_name'], $chemin);
                        $file=$_FILES['photoProduitModif']['name'];
                        $id_article_modif = $_POST['id_art_modif'];

                        if($resultat && $modif_marque && $modif_modele && $modif_detailModele && $modif_prix)
			            {
                            $this->model->updateProduct($modif_marque, $modif_modele, $modif_detailModele, $modif_prix, $file,$id_article_modif);
                            \Http::redirect("index.php?controller=admin&task=show");
			            }
                        else
                        {
                            die("erreur");
                        }


                      
                    }
                    else
                    {
                        die("La photo doit être au format jpg, jpeg");
                    }
                    
                }
                else
                {
                    die("La photo ne doit pas dépasser 2 Mo");
                }
              
            }
            else
            {
                die("Veuillez remplir tous les champs");
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


    public function suppCommande()
    {
        if(isset($_POST['suppCom']) && !empty($_POST['id_commande_supp']))
        {
            $id_commande_supp = $_POST['id_commande_supp'];

            $this->model->suppCommande($id_commande_supp);

            \Http::redirect("index.php?controller=admin&task=show");
        }
    }
}