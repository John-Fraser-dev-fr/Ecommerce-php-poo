<?php 

namespace Controllers;


class Admin extends Controller
{
   
    protected $modelName = \Models\Admin::class;


    public function show()
    {
        

        $commandes = $this->model->CommandeClient();
            
       

        $pageTitle= 'Administrateur';
        \Renderer::render('admin', compact('pageTitle', 'commandes'));
       
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
}