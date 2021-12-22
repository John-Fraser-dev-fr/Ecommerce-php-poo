<?php

namespace Controllers;



class User extends Controller
{

   protected $modelName = \Models\User::class;


    public function inscription()
    {

        if (isset($_POST['register']))
        {

	        if (!empty(['nom','prenom','email','password']))
	        {
		        $_POST=array_map('htmlspecialchars',$_POST);
		        extract($_POST,EXTR_SKIP);

                if (!$nom || !$prenom|| !$email|| !$password) 
                {
                    die("Veuillez remplir tous les champs");
                }
                else
                {
                    $password = password_hash($password,PASSWORD_DEFAULT);
                    $this->model->inscription($nom,$prenom,$email,$password);
		            \Http::redirect("index.php?controller=user&task=connexion");
                }
	        }
	        else{}
        }

        $pageTitle = 'Inscription';
        \Renderer::render('inscription', compact('pageTitle'));
    }


    public function connexion()
    {
       

        if (isset($_POST['login']))
        {

	        if (!empty(['email','password']))
	        {
		        $_POST=array_map('htmlspecialchars',$_POST);
		        $_POST=array_map('trim',$_POST);
		        extract($_POST,EXTR_SKIP);

		        $this->model->connexion($email,$password);
                \Http::redirect("index.php");
	        }
	        else
	        {
	            die("Veuillez remplir tous les champs");
	        }
        }

    }

    
    public function deconnexion(): void
    {

        session_destroy();
        \Http::redirect("index.php");
    }

    
    public function compte()
    {
        if (isset($_SESSION['id']) && isset($_SESSION['email']))  {
        
            $pageTitle= 'Compte';
            \Renderer::render('compte', compact('pageTitle'));
        }
    }

}