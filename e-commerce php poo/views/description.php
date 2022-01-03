


<div class="container description_produit mt-5"> 

    <div class="photo col-6">
        <img src="assets/image_produits/<?= $article['modele'] ?>.jpg" class="img-fluid" >
    </div>

    <div class="detail col-6">
        <div>
            <p class="detail_modele"><?= $article['modele'] ?></p>
            <p class="detail_detail"><?= $article['detail_modele'] ?></p>
            <div class="card-action row">
            <form method="POST" action="index.php?controller=panier&task=add&id=<?= $article['id_article'] ?>">
                <input type="submit" class="btn btn-primary" name="ajout_panier" value="Ajouter au panier"></input>
                <input type="hidden" name="id_article"  value="<?php echo $article['id_article']; ?>" >
            </form>
    </div>
        </div>
        <div>
            <p class="detail_prix"><?= number_format($article['prix'], 2, ',', ' ') ?> €</p>
        </div>
        
    </div>
    

</div>










