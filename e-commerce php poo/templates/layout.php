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
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php?controller=article&task=index"><img class="logo_light" src="assets/image_produits/logo.png" alt="logo" style="height: 40px; width: auto;">  </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
    
      <?php if (!isset($_SESSION['id']) && !isset($_SESSION['email']))  { ?>

        <li class="nav-item">
          <a class="nav-link" href="index.php?controller=user&task=inscription">Inscription</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?controller=user&task=connexion">Connexion</a>
        </li>

        <?php }else{}?>
        <?php  if (isset($_SESSION['role']) && $_SESSION['role'] == 1)   {?>

        <li class="nav-item">
          <a class="nav-link" href="index.php?controller=admin&task=show">Administrateur</a>
        </li>

        <?php }else{} ?>

        <li class="nav-item">
        </li>
       
        <div class="nav_compte_panier ">
          <li class="nav-item">
            <a class="nav-link active" href='index.php?controller=user&task=compte'><i class="fas fa-user-alt"></i></a>
          </li>
          <li class="nav-item">
            <div><button id="target">click me</button></div>

            <!-- Contenu du Popover Panier -->
            <div id='panier_pop' class="container">
              <h6><b>Votre Panier :</b></h6>

              <?php if (!isset($_SESSION['panier'])) : ?>
              <p>Votre panier est vide</p>
              <?php else : ?>

              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Marque</th>
                    <th scope="col">Modèle</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Prix</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $total ='0';
                  $montantTotal = '0';
                  //Affichage des elements contenue dans la session panier
                  for ($i=0 ;$i < count($_SESSION['panier']['modele']) ; $i++){ ?>

                  <tr>
                    <td> <?= htmlspecialchars($_SESSION['panier']['marque'][$i])?> </td>
                    <td> <?= htmlspecialchars($_SESSION['panier']['modele'][$i])?> </td>
                    <td> <?= htmlspecialchars($_SESSION['panier']['qte_produit'][$i])?> </td>
                    <td> <?= number_format($_SESSION['panier']['prix'][$i], 2, ',','')?> €</td>
                  </tr>

                  <?php } ?>
                </tbody>
              </table>
        
              <?php endif ?>
        
            </div>
          </li>
        </div>
      </ul>
    </div>
  </div>
</nav>








  <?= $pageContent ?>


  <script type="text/javascript" src="templates/script.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    
</body>

</html>