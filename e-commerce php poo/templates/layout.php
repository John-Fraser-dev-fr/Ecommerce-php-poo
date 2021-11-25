<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://bootswatch.com/5/flatly/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="templates/style.css">
    <script src="https://kit.fontawesome.com/66317f2d03.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="templates/script.js"></script>
    
    <title>New projet - <?= $pageTitle ?></title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">New Projet</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php?controller=article&task=index">Accueil
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
        <?php if (!isset($_SESSION['id']) && !isset($_SESSION['email']))  { ?>
        <li class="nav-item">
          <a class="nav-link" href="index.php?controller=user&task=inscription">Inscription</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?controller=user&task=connexion">Connexion</a>
        </li>
        <?php }else{}?>

       <?php if (isset($_SESSION['id']) && isset($_SESSION['email']))  {?>
       
       
            <a class="nav-link active" href='index.php?controller=user&task=compte'><i class="fas fa-user-alt"></i></a>
            <a class="nav-link active" href="index.php?controller=panier&task=show"><i class="fas fa-shopping-cart"></i></a>
        
        <?php }else{} ?>
        
      </ul>
     
    </div>
  </div>
</nav>
    <?= $pageContent ?>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>