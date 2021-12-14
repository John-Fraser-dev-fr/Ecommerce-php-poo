<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://bootswatch.com/5/flatly/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="templates/style.css">
    <link type="text/javascript" href="templates/script.js">

    
  
    <script src="https://kit.fontawesome.com/66317f2d03.js" crossorigin="anonymous"></script>
  

    <script type="text/javascript"
        src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    



    


    
    
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
       <a class="nav-link active" href="index.php?controller=panier&task=show"><i class="fas fa-shopping-cart"></i></a>
          </li>
          <li class="nav-item">
          <button type="button" id="bulk_actions_btn"
        class="btn btn-default has-spinner-two"
        data-toggle="popover"
        data-placement="bottom" data-original-title=""
        data-content="Click any question mark icon to get help and tips with specific tasks"
        aria-describedby="popover335446"> Apply
</button>
          </li>
        </div>
   
  
      </ul>
    
    </div>
  </div>
</nav>









    <?= $pageContent ?>





    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    
</body>

</html>