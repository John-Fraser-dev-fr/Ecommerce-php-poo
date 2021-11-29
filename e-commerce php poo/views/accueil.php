<h1>Nos produits hi-tech</h1>
<div class="row">


<?php foreach ($articles as $article) : ?>

    
        <div class="card border-primary mb-3 col-sm-4" style="max-width: 20rem;" id="list_products">
            <div class="card-header">
                <h4><?= $article['marque'] ?></h4>
            </div>
            <div class="card-body">
                <p><?= number_format($article['prix'], 2, ',', ' ') ?> €</p>
                <p class="card-text"><?= $article['modele'] ?></p>
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