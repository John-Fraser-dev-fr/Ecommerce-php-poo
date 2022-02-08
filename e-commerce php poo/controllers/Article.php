<?php
namespace Controllers;



class Article extends Controller
{
    protected $modelName = \Models\Article::class;
    

    public function index()
    {
       
        $articles=$this->model->findAll();

        

        $pageTitle = "Accueil";
        \Renderer::render('accueil', compact('pageTitle', 'articles'));
    }


    public function show()
    {

        
        $article_id = null;

        if (!empty($_GET['id']) && ctype_digit($_GET['id']))
        {
            $article_id = $_GET['id'];
        }

        if (!$article_id)
        {
            die("Vous devez préciser un paramètre `id` dans l'URL !");
        }

        $article=$this->model->find($article_id);

        $pageTitle = $article['marque'];
        \Renderer::render('description', compact('pageTitle', 'article', 'article_id'));
    }
}