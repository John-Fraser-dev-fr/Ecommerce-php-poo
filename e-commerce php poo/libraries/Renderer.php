<?php

class Renderer
{
    public static function render(string $path, array $variables = []): void
    {
        //Tableau associatif => variables
        extract($variables);

        ob_start();
        
        require('Views/' .$path. '.php');

        $pageContent = ob_get_clean();
        

        require('templates/layout.php');
        
       
    }

}