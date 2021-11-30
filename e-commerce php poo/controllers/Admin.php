<?php 

namespace Controllers;


class Admin extends Controller
{
   
    protected $modelName = \Models\Admin::class;


    public function show()
    {
        

            $this->model->showAdmin();
        
            $pageTitle= 'Administrateur';
            \Renderer::render('admin', compact('pageTitle'));
       
    }
}