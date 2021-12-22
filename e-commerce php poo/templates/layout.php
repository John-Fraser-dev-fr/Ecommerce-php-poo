<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://bootswatch.com/5/flatly/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="templates/style.css">
   
    <script src="https://kit.fontawesome.com/66317f2d03.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
    <title>New projet - <?= $pageTitle ?></title>
</head>


<body>
  <nav class="navbar navbar-expand-lg navbar-dark " id="navbar">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php?controller=article&task=index"><img class="logo_light" src="assets/image_produits/logo.png" alt="logo" style="height: 40px; width: auto;">  </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="nav-links navbar-nav me-auto">
    
    
        <?php  if (isset($_SESSION['role']) && $_SESSION['role'] == 1)   {?>

        <li class="nav-item">
          <a class="nav-link" href="index.php?controller=admin&task=show">Administrateur</a>
        </li>

        <?php }else{} ?>

        <li class="nav-item">
        </li>
       
        
          <li class="nav-icons">
          <div id="pop2">
            <a id="target2" class="nav-link" href='#'><i class="fas fa-user-alt"></i></a>
          </div>
            <div id="pop">
              <a class="nav-link" id="target" href='#'><i class="fas fa-shopping-cart"></i></a>  
            </div>
          </li>
      </ul>

            <!-- Contenu du Popover Panier -->
            <div id='panier_pop' class="container">
              <h6><b>Votre Panier :</b></h6>

              <?php if (!isset($_SESSION['panier'])) : ?>
              <p>Votre panier est vide</p>
              <?php else : ?>

             

                  <?php
                  $total ='0';
                  $montantTotal = '0';

                  for ($i=0 ;$i < count($_SESSION['panier']['modele']) ; $i++){ ?>

                  <ul>
                    <li>
                      
                      <div>
                        <img src="https://fakeimg.pl/40x40/"> 
                        <?= htmlspecialchars($_SESSION['panier']['marque'][$i])?> 
                        <?= htmlspecialchars($_SESSION['panier']['modele'][$i])?><br>
                        <?= number_format($_SESSION['panier']['prix'][$i], 2, ',','')?> € 
                      </div>
          
                      <span>
                        <?= htmlspecialchars($_SESSION['panier']['qte_produit'][$i])?> x 
                      </span>
                    
                    </li>
                
                  
                    
                   

                    <?php 
                    $total = $_SESSION['panier']['qte_produit'][$i] * $_SESSION['panier']['prix'][$i];
                    $montantTotal += $total;
                    ?>
                    <p><?= number_format($total, 2, ',','')?> €</p>


                  </ul>
                  <hr class="solid">

                  <?php } ?>
            

              <h5>Total : <?= number_format($montantTotal, 2, ',', ' ')?> €</h5>
        
              <?php endif ?>
        
            </div>


            <div id='user_pop' class="container">
            <div id="info_compte">
            <?php if (!isset($_SESSION['id']) && !isset($_SESSION['email']))  { ?>
              <h6>Connexion</h6>
              <div class="dropdown-divider">
                </div>
              <div id="formulaire_connexion" class="d-flex justify-content-center">
              
      <form method="POST" action="index.php?controller=user&task=connexion">
        <div class="form-group">
          <label >Email</label>
          <input type="email" class="form-control" name="email">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Mot de passe</label>
          <input type="password" class="form-control" name="password" >
        </div>
        <button type="submit" class="btn btn-primary" name="login">Connexion</button>
      </form>
    </div>
    <div class="dropdown-divider">
                </div>
              
           <p>Pas encore de compte ? <a class="nav-link" href="index.php?controller=user&task=inscription">Inscrivez-vous</a></p>
          
         

<?php }else{?>
    <h6>Bonjour <?php echo $_SESSION['prenom'];?> <?php echo $_SESSION['nom'];?></h6> 
 
    <br>
    <h6>Voici vos informations de profil</h6>
    <p>Votre Email : <?php echo $_SESSION['email'];?></p>

    <br>
    <h6>Etat des commandes :</h6>
    <p>Aucune commande en cours</p>
    <a class="nav-link" href="index.php?controller=user&task=deconnexion">Deconnexion</a>
</div>
      <?php } ?>      </div>

          
          </li>
        </div>
        
              
    </div>
  </div>
                  
                 

  
</nav>




  <?= $pageContent ?>

  <footer>Design By John Fraser</footer>
  <script type="text/javascript" src="templates/script.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    
</body>

</html>