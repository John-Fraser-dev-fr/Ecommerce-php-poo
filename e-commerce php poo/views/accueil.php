<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <img src="assets/image_produits/iphone_header.jpg" class=" w-100 img-fluid">
        <h1 class="display-4">Fluid jumbotron</h1>
        <p class="lead">...</p>
    </div>
</div>


<div class="container">
   <h3>Nos meilleures ventes</h3>
   <p>...</p>
   <p>...</p>
   <p>...</p>
</div>
<div class="container">
<h3>Nos produits</h3>
<div class="row">


<?php foreach ($articles as $article) : ?>

    
        <div class="card border-primary m-3 col-sm-4 list_products" style="max-width: 20rem">
            <div class="card-header">
                <h4><?= $article['marque'] ?></h4>
            </div>
            <div class="card-body">
            <img src="assets/image_produits/<?= $article['modele'] ?>.jpg" class="img-fluid">
                <p><?= number_format($article['prix'], 2, ',', ' ') ?> €</p>
                <p class="card-text"><?= $article['modele'] ?></p>
                <p class="card-text"><?= $article['detail_modele'] ?></p>
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
