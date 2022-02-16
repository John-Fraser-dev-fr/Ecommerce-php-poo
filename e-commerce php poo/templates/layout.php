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
      <a class="navbar-brand" href="index.php"><img class="logo_light" src="assets/logo/logo.png" alt="logo" style="height: 40px; width: auto;">  </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav ms-auto">
    
    
        <?php  if (isset($_SESSION['role']) && $_SESSION['role'] == 1)   {?>

        <li class="nav-item">
          <a class="nav-link" href="index.php?controller=admin&task=show">Administrateur</a>
        </li>
      </ul>

        <?php }else{} ?>

        
       <ul>
        
          <li class="nav-icons">
          
            <a id="target2" class="nav-icon" ><i class="fas fa-user-alt"></i></a>
            <a  id="target" class="nav-icon"><i class="fas fa-shopping-cart"></i></a>  
           

              <?php
              if (isset($_SESSION['panier']['qte_produit'])){ 
              $totalArticle = array_sum($_SESSION['panier']['qte_produit']); ?>
            
            <div id="nombre_article">


              <div class="nombre"><?= $totalArticle?></div>

              <?php }else if(!isset($_SESSION['panier']['qte_produit'])){ ?>

              

              <?php }?>
            
            </div>
          </li>
      </ul>



      
            <!-- Contenu du Popover Panier -->
            <div id='panier_pop' class="container">
             
  

              <?php if (!isset($_SESSION['panier'])) : ?>
              <p><b>Votre panier est vide</b></p>
              <div class="solid-grey"></div>
                  <div class="valeur_com" style=" margin-top: 1rem;">
                    <div>
                      <p style="font-size: 12px; color: grey;">Valeur de la commande</p>
                    </div>
                    <div>
                      <p style="font-size: 12px">0,00 €</p>
                    </div>
                  </div>
                  <div class="solid-black">
                  <div class="pop_total">
                    <div>
                      <p><b>Total de la commande : </b></p>
                    </div>
                    <div>
                      <p><b>0,00 €</b></p>
                    </div>
                  </div>
                  

              <?php else : ?>

             

                  <?php
                  $total ='0';
                  $montantTotal = '0';
               
                  

                  for ($i=0 ;$i < count($_SESSION['panier']['modele']) ; $i++){ 
                    ?>

                  <ul>
                    <li>
                      
                      <div class="pop_panier_produit">

                        <div class="col-3">
                          <img src="assets/image_produits/<?= $_SESSION['panier']['modele'][$i]?>.jpg" class="img-fluid" style="width:60px; height: auto;">
                        </div>

                        <div class="pop_panier_description col-6">
                          <p style="margin-bottom: 0"><b><?= htmlspecialchars($_SESSION['panier']['modele'][$i])?></b></p>
                          <p style="margin-bottom: 0"><?= number_format($_SESSION['panier']['prix'][$i], 2, ',','')?> € </p>
                          <p style="font-size: 12px">Quantité : <?= htmlspecialchars($_SESSION['panier']['qte_produit'][$i])?> </p>
                        </div>

                        

                        <div class="pop_panier_total col-4">
          
                        <?php 
                           $total = $_SESSION['panier']['qte_produit'][$i] * $_SESSION['panier']['prix'][$i];
                           $montantTotal += $total;
                          ?>
                          <p><?= number_format($total, 2, ',','')?> €</p>
                        </div>

                      </div>
                      
                    </li>

                   
                
                  
                    

                    


                  </ul>
                  
                 
                  <?php } ?>
                  <div class="solid-grey"></div>
                  <div class="valeur_com" style=" margin-top: 1rem;">
                    <div>
                      <p style="font-size: 12px; color: grey;">Valeur de la commande</p>
                    </div>
                    <div>
                      <p style="font-size: 12px"><?= number_format($montantTotal, 2, ',', ' ')?> €</p>
                    </div>
                  </div>
                  
                  <div class="livraison">
                    <div>
                      <p style="font-size: 12px; color:grey">Livraison</p>
                    </div>
                    <div>
                    <?php if($montantTotal > 99){?>
                    <p style="font-size: 12px">Gratuit</p>
                    <?php } else if ($montantTotal < 99) {?>
                    <p style="font-size: 12px">12,99 €</p>
                    <?php } ?>

                 </div>
    </div>
    <div class="solid-black">
                  <div class="pop_total">
                    <div>
                      <p><b>Total de la commande : </b></p>
                    </div>
                    <?php $montantTotalAvecLivraison = $montantTotal + 12.99; ?>
                    <div>
                      <?php if ($montantTotal <= 12.99) {?>
                      <p><b>0,00 €</b></p>
                      <?php }else if($montantTotal <= 99 && $montantTotal > 12.99){ ?>
                      <p><b><?= number_format($montantTotalAvecLivraison, 2, ',', ' ')?> €</b></p>
                      <?php }else if($montantTotal >= 99){ ?>
                    <p><b><?= number_format($montantTotal, 2, ',', ' ')?> €</b></p>
                    <?php } ?>
                    </div>
                  </div>
              
                  <div class="d-grid gap-2 mt-2">
              
              <a href="index.php?controller=panier&task=show" ><button class="btn-pop" type="button" >Panier</button></a>
             
</div>
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
          <input type="email" class="form-control" name="email" required>
        </div>
        <div id="errors_form"></div>
        <div class="form-group">
          <label for="exampleInputPassword1">Mot de passe</label>
          <input type="password" class="form-control" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary mt-1" name="login">Connexion</button>
      </form>
    </div>
    <div class="dropdown-divider"></div>
              
           <p>Pas encore de compte ? <a href="index.php?controller=user&task=inscription">Inscrivez-vous</a></p>
           
          
         

<?php }else{?>
    <h5 style="text-align: center;margin-bottom: 5%;">Bonjour <?php echo $_SESSION['prenom'];?> <?php echo $_SESSION['nom'];?></h5> 
 
    <a href="index.php?controller=user&task=showCompte"><button class="btn-pop" type="button" >Accedez à votre compte</button></a>
    <a class="nav-link" href="index.php?controller=user&task=deconnexion" style="padding: 0;margin-top: 2%;"><button class="btn-pop" type="button" style="background-color: black;">Deconnexion</button></a>
</div>
      <?php } ?>      </div>

          
          </li>
        </div>
        
              
    </div>
  </div>
                  
                 

  
</nav>













    

 <?= $pageContent  ?>
 


 
<!-- Footer -->
<footer class="text-center text-lg-start text-muted">
  

  <!-- Section: Links  -->
  <section class="" style="background-color: rgba(0, 0, 0, 0.9); color:white">
    <div class="container text-center text-md-start " style="padding-top: 2%;">
      <!-- Grid row -->
      <div class="row">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4" style="color: rgb(78, 158, 188)">
          <img class="logo_light" src="assets/logo/logo.png" alt="logo" style="height: 20px; width: auto;padding-right: 1%;"> E-Shop
          </h6>
          <p>
          Hello, nous sommes E-Shop, le marché dédiée aux produits Hi-Tech. 
          Notre mission ? Vous apporter notre meilleure sélection de produits. 
          </p>
        </div>
        <!-- Grid column -->

        
       

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4" style="color: rgb(78, 158, 188)">
            Liens Utiles
          </h6>
          <p>
            <a  style="text-decoration: none" href="#" class="text-reset">Confidentialité</a>
          </p>
          <p>
            <a style="text-decoration: none" href="#" class="text-reset">Aide & Assistance</a>
          </p>
          <p>
            <a style="text-decoration: none" href="#" class="text-reset">FAQ</a>
          </p>
          <p>
            <a style="text-decoration: none" href="#" class="text-reset">Paiement</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4" style="color: rgb(78, 158, 188)">
            Contact
          </h6>
          <p style="margin-bottom: 0;"><i class="fas fa-home me-3" style="color: rgb(78, 158, 188)"></i>8, rue de l'Hermitage</p><p style="padding-left: 13%;">75016 PARIS</p>
          <p>
            <i class="fas fa-envelope me-3" style="color: rgb(78, 158, 188)"></i>
            e-shop@example.com
          </p>
          <p><i class="fas fa-phone me-3" style="color: rgb(78, 158, 188)"></i> + 01 234 567 88</p>
          
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.9); color: rgb(78, 158, 188)"">
    © 2022 Copyright
    <a class="text-reset fw-bold" style="text-decoration:none;color: rgb(78, 158, 188)"" href="https://github.com/John-Fraser-dev-fr">John Fraser</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->

  <script src="https://js.stripe.com/v3/"></script>
  <script src="templates/script.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    
</body>

</html>