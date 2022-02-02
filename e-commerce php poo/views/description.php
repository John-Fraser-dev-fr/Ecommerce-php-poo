


<div class="container description_produit mt-5"> 

    <div class="photo col-6">
        <img src="assets/image_produits/<?= $article['photo_produit'] ?>" class="photo_desc img-fluid" >
    </div>

    <div class="detail col-6">
        <div>
            <p class="detail_modele"><?= $article['modele'] ?></p>
            <p class="detail_prix"><?= number_format($article['prix'], 2, ',', ' ') ?> €</p>
            <p class="detail_detail"><?= $article['detail_modele'] ?></p>
            <div class="d-grid gap-2">
                <form method="POST" action="index.php?controller=panier&task=add&id=<?= $article['id_article'] ?>">
                    <button type="submit" class="btn" name="ajout_panier" value="Ajouter au panier" >Ajouter au panier</button>
                    <input type="hidden" name="id_article"  value="<?php echo $article['id_article']; ?>" >
                </form>
                <a href="index.php?controller=article&task=index"> <button class="btn" type="button">Continuez vos achats</button></a>
            </div>    
           
    
        </div>
        
           
        
        
    </div>
    

</div>













