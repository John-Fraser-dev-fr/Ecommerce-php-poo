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
      <a class="navbar-brand" href="index.php"><img class="logo_light" src="assets/image_produits/logo.png" alt="logo" style="height: 40px; width: auto;">  </a>
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
          
            <a id="target2" class="nav-icon" href='#'><i class="fas fa-user-alt"></i></a>
            <a  id="target" class="nav-icon" href='#'><i class="fas fa-shopping-cart"></i></a>  
           

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
                          <img src="assets/image_produits/<?= $_SESSION['panier']['modele'][$i] ?>.jpg" class="img-fluid" style="width:60px; height: auto;">
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
              <a href="#" ><button class="btn-pop" type="button" >Confirmer la commande</button></a>
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
          <input type="email" class="form-control" name="email">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Mot de passe</label>
          <input type="password" class="form-control" name="password" >
        </div>
        <button type="submit" class="btn btn-primary mt-1" name="login">Connexion</button>
      </form>
    </div>
    <div class="dropdown-divider"></div>
              
           <p>Pas encore de compte ? <a href="index.php?controller=user&task=inscription">Inscrivez-vous</a></p>
          
         

<?php }else{?>
    <h6>Bonjour <?php echo $_SESSION['prenom'];?> <?php echo $_SESSION['nom'];?></h6> 
 
    
    <a class="nav-link" href="index.php?controller=user&task=deconnexion">Deconnexion</a>
</div>
      <?php } ?>      </div>

          
          </li>
        </div>
        
              
    </div>
  </div>
                  
                 

  
</nav>



<div class="modal fade" id="modalFinalPaiement" data-bs-backdrop="static" role="dialog">
        <div class="modal-dialog modal-fullscreen-sm-down">

            <!-- Modal erreur-->
            <div class="modal-content">
                <div class="modal-body">
                    <div id="textModalFinalPaiement" data-nomsecteur="" data-idajout="">
                    </div>
                    <div id="textModalFinalPaiement2" class="mt-3" data-nomsecteur="" data-idajout="">
                    </div>
                </div>
                <div class="modal-footer">
                <form method="POST" action="index.php?controller=panier&task=delete">
                    <input type="submit" class="btn btn-light btn_commande" name="delete" value="Terminer"></input>
                </form>
                </div>
            </div>
        </div>
    </div>





 <?= $pageContent ?>
 





  <script src="https://js.stripe.com/v3/"></script>
  <script src="templates/script.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    
</body>

</html>