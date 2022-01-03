
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/image_produits/ban_Switch.jpeg" class="d-block w-100" alt="nintendo_switch">
      <div class="carousel-caption d-none d-md-block" style="left: 10%; text-align: left;">
      <a class="btn btn-info">Achetez maintenant</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/image_produits/ban_Iphone.jpeg" class="d-block w-100" alt="iphone_13">
      <div class="carousel-caption d-none d-md-block" style="left: 10%; text-align: left;">
      <a class="btn btn-info">Achetez maintenant</a>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>



<div class="container mt-5">
        <div class="row">
            <div class="box col-lg-3 col-sm-6">	
                <div class="icon_box" id="icon_box_livraison">
                    <div class="icon">
                    <i class="fas fa-truck fa-2x"></i>
                    </div>
                    <div class="icon_box_content">
                        <h6><b>Livraison gratuite</b></h6>
                        <p>À partir de 49 €</p>
                    </div>
                </div>
            </div>
            <div class="box col-lg-3 col-sm-6">	
                <div class="icon_box">
                    <div class="icon">
                    <i class="fas fa-certificate fa-2x"></i>
                    </div>
                    <div class="icon_box_content">
                        <h6><b>Extension de garantie</b></h6>
                        <p>2 ans</p>
                    </div>
                </div>
            </div>
            <div class="box col-lg-3 col-sm-6">	
                <div class="icon_box">
                    <div class="icon">
                    <i class="fas fa-hand-holding-usd fa-2x"></i>
                    </div>
                    <div class="icon_box_content">
                        <h6><b>Satisfait ou remboursé</b></h6>
                        <p>Pendant 30 jours</p>
                    </div>
                </div>
            </div>
            
            <div class="box col-lg-3 col-sm-6">	
                <div class="icon_box">
                    <div class="icon">
                    <i class="fas fa-lock fa-2x"></i>
                    </div>
                    <div class="icon_box_content">
                        <h6><b>Payer en toute sécurité</b></h6>
                        <p>100% sécurisé</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="container mt-5">
<h3>test</h3>
<div class="row">





<?php foreach ($articles as $article) : ?>

    
        <div class="card border-primary m-3 col-sm-4 list_products" style="max-width: 20rem">
            
            <div class="card-body product">
            <img src="assets/image_produits/<?= $article['modele'] ?>.jpg" class="img-fluid">
                <p class="card-text"><?= $article['marque'] ?> <?= $article['modele'] ?></p>
                <p class="card-text"><?= $article['detail_modele'] ?></p>
                <p><?= number_format($article['prix'], 2, ',', ' ') ?> €</p>
            </div>
            <a href="index.php?controller=article&task=show&id=<?= $article['id_article'] ?>">description</a>
            <div class="card-action">
            <form method="POST" action="index.php?controller=panier&task=add&id=<?= $article['id_article'] ?>">

            <input type="submit" class="btn btn-primary" name="ajout_panier" value="Ajouter au panier"></input>
            <input type="hidden" name="id_article"  value="<?php echo $article['id_article']; ?>" >
     
                   
                
            </form>
</div>
        </div>

 
    
<?php endforeach ?>

</div>
</div>
