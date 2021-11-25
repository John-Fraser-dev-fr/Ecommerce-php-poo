


<h1><?= $article['marque'] ?></h1>

<p><?= $article['modele'] ?></p>

<p><?= number_format($article['prix'], 2, ',', ' ') ?> €</p>


<div class="card-action row">
<form method="POST" action="index.php?controller=panier&task=add&id=<?= $article['id_article'] ?>">

<input type="submit" class="btn btn-primary" name="ajout_panier" value="Ajouter au panier"></input>
<input type="hidden" name="id_article"  value="<?php echo $article['id_article']; ?>" >

       
    
</form>
</div>



