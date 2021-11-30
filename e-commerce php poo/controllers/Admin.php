<?php 

namespace Controllers;


class Admin extends Controller
{
   
    protected $modelName = \Models\Admin::class;


    public function show()
    {
        

        $commandes = $this->model->CommandeClient();
            
        $commandeDetails = $this->model->CommandeClientDetail();

        $pageTitle= 'Administrateur';
        \Renderer::render('admin', compact('pageTitle', 'commandes', 'commandeDetails'));
       
    }
}