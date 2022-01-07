
<div class="container">

  <div id="articles_panier" class="container">
    <h6><b>Votre Panier</b></h6>

    <?php if (!isset($_SESSION['panier'])) : ?>

    <p>Votre panier est vide</p>

    <?php else : 
    $total ='0';
    $montantTotal = '0';

    for ($i=0 ;$i < count($_SESSION['panier']['modele']) ; $i++){ ?>

    <ul>
      <li>
        <div class="panier_produit">
          <div class="col-3">
            <img src="assets/image_produits/<?= $_SESSION['panier']['modele'][$i] ?>.jpg" class="img-fluid" style="width:60px; height: auto;">
          </div>
          <div class="panier_description col-6">
            <p style="margin-bottom: 0"><b><?= htmlspecialchars($_SESSION['panier']['modele'][$i])?></b></p>
            <p style="margin-bottom: 0"><?= number_format($_SESSION['panier']['prix'][$i], 2, ',','')?> € </p>
            <p style="font-size: 12px">Quantité : <?= htmlspecialchars($_SESSION['panier']['qte_produit'][$i])?> </p>
          </div>
          <div class="panier_total col-4">

            <?php 
            $total = $_SESSION['panier']['qte_produit'][$i] * $_SESSION['panier']['prix'][$i];
            $montantTotal += $total;?>

            <p><?= number_format($total, 2, ',','')?> €</p>
          </div>
        </div>
      </li>
    </ul>
                  
    <?php } ?>
    <div class="total">
      <div>
        <h5>Total : </h5>
      </div>
      <div>
          <h5><?= number_format($montantTotal, 2, ',', ' ')?> €</h5>
      </div>
    </div>
  </div>

  <form method="POST" action="index.php?controller=panier&task=validate">
    <input type="submit" class="btn btn-light mb-2" name="validate" value="Valider votre commande"></input>
  </form>
  <form method="POST" action="index.php?controller=panier&task=delete">
    <input type="submit" class="btn btn-light" name="delete" value="Annuler votre commande"></input>
  </form>
              
  <?php endif ?>

</div>

