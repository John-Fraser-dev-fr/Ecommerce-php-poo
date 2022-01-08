<h4><b>Votre Panier</b></h4>
<div id="page_panier" class="container">

  <div id="articles_panier" class="container col-4">
    

    <?php if (!isset($_SESSION['panier'])) : ?>

    <p>Votre panier est vide</p>

    <?php else : 
    $total ='0';
    $montantTotal = '0';

    for ($i=0 ;$i < count($_SESSION['panier']['modele']) ; $i++){ ?>

    
        <div class="panier_produit">
          <div class="">
            <img src="assets/image_produits/<?= $_SESSION['panier']['modele'][$i] ?>.jpg" class="img-fluid" style="width:auto; height: 100px;">
          </div>
          <div class="panier_description">
            <p style="margin-bottom: 0"><b><?= htmlspecialchars($_SESSION['panier']['modele'][$i])?></b></p>
            <p style="margin-bottom: 0"><?= number_format($_SESSION['panier']['prix'][$i], 2, ',','')?> € </p>
            <p style="font-size: 12px">Quantité : <?= htmlspecialchars($_SESSION['panier']['qte_produit'][$i])?> </p>

            <?php 
            $total = $_SESSION['panier']['qte_produit'][$i] * $_SESSION['panier']['prix'][$i];
            $montantTotal += $total;?>

            <p style="font-size: 12px">Total : <?= number_format($total, 2, ',','')?> € </p>
          </div>
          <div class="panier_total">

          

          </div>
        </div>
    
                  
    <?php } ?>
    
  </div>

  <div class="page_panier_milieu col-4">

  </div>


  <div class="paiement_panier col-4">
    <div class="valeur_com">
      <div>
        <p style="font-size: 12px; color: grey">Valeur de la commande</p>
      </div>
      <div>
        <p style="font-size: 12px"><?= number_format($montantTotal, 2, ',', ' ')?> €</p>
      </div>
    </div>
    <div class="livraison">
      <div>
        <p style="font-size: 12px; color:grey">Livraison</p>
      </div>
      <div>
        <p style="font-size: 12px">Gratuit</p>
      </div>
    </div>
    <div class="solid-black">
     
    </div>
    <div class="total">
      <div>
        <p><b>Total de la commande :  </b></p>
      </div>
      <div>
          <p><b><?= number_format($montantTotal, 2, ',', ' ')?> €</b></p>
      </div>
    </div>
    <form method="POST" action="index.php?controller=panier&task=validate">
      <input type="submit"  class="btn btn-light mb-2 btn_commande" name="validate" value="Terminer ma commande"></input>
    </form>
    <form method="POST" action="index.php?controller=panier&task=delete">
      <input type="submit" class="btn btn-light btn_commande" name="delete" value="Annuler ma commande"></input>
    </form>
    <p style="font-size: 13px; margin-top: 5%; margin-bottom: 0;">Nous acceptons</p>
    <div>
      <div id="img_CB">
      <img src="assets/image_CB/visa_mastercard.png" style="height: 35px; width: auto;"/>
      </div>
      
    </div>
    <p style="font-size: 12px; color:grey">Les prix et les frais de livraison ne sont validés que durant la finalisation de la commande.</p>
    <p style="font-size: 12px; color:grey">Délai de rétractation de 30 jours.</p>
  </div>
  </div>
              
  <?php endif ?>

</div>

