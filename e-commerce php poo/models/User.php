<?php
namespace Models;


class User extends Model
{
    

    //Inscription de l'utilisateur
    public function inscription(string $nom, string $prenom, string $email, string $password): void
    {
	    $q = $this->pdo->prepare('INSERT INTO users(nom,prenom,email,password) VALUES (:nom,:prenom,:email,:password)');
	    $q->execute(['nom'=>$nom,
		            'prenom'=>$prenom,
			        'email'=>$email,
				    'password'=>$password]);
        
    }


    //Connexion de l'utilisateur
    public function connexion($email,$password)
    {
	    $q=$this->pdo->prepare("SELECT * FROM users WHERE (email=:email)");
	    $q->execute(['email'=>$email]);
        $userHasBeenFound=$q->rowCount();
	    $user=$q->fetch();

        if ($userHasBeenFound and password_verify($password,$user['password'] ))
	    {
            $_SESSION['id']=$user['id_user'] ;
            $_SESSION['nom']=$user['nom'] ;
            $_SESSION['prenom']=$user['prenom'] ;
		    $_SESSION['email']=$user['email'] ;	
            $_SESSION['role']=$user['role'];
            $_SESSION['numero_rue']=$user['numero_rue'];
            $_SESSION['rue']=$user['rue'];
            $_SESSION['code_postal']=$user['code_postal'];
            $_SESSION['ville']=$user['ville'];
            $_SESSION['pays']=$user['pays'];

            
	    }
        
	   
    }


    public function infoCommandeEnCoursClient()
    {
        $r= $this->pdo->query('SET lc_time_names = \'fr_FR\'');
        $r = $this->pdo->prepare('SELECT * , DATE_FORMAT(date,"%W %d %M %Y") AS date FROM commande, users WHERE users.id_user = commande.id_user AND users.id_user = :userSession  ORDER BY commande.date DESC');
        $r->execute(['userSession'=>$_SESSION['id']]);
        $infs = $r->fetchAll();

        return $infs;

        
    }

}