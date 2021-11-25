

<?php if (!isset($_SESSION['panier'])) : ?>

Votre panier est vide



<?php else : ?>
<h3>Votre panier</h3>
<table class="table table-hover">

	<thead>
		<tr>
			<th scope="col">Marque</th>
            <th scope="col">Modèle</th>
            <th scope="col">Quantité</th>
            <th scope="col">Prix</th>

			<th scope="col">Total</th>
      
			
		</tr>

	</thead>
	<tbody>
		<?php 
	
		$total ='0';
        $montantTotal = '0';
       
		//Affichage des elements contenue dans la session panier
		for ($i=0 ;$i < count($_SESSION['panier']['modele']) ; $i++)
            {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($_SESSION['panier']['marque'][$i]) . "</ td>";
            echo "<td>" . htmlspecialchars($_SESSION['panier']['modele'][$i]) . "</ td>";
            echo "<td>" . htmlspecialchars($_SESSION['panier']['qte_produit'][$i]) . "</td>";
            echo "<td>" . number_format($_SESSION['panier']['prix'][$i], 2, ',','') . " €</td>";
          
			
            //Calcul le prix total pour chaque articles
           $total = $_SESSION['panier']['qte_produit'][$i] * $_SESSION['panier']['prix'][$i];

           $montantTotal += $total;

            echo "<td>" . number_format($total, 2, ',', '') . " €</td>";
            
          
  	    echo "</tr>
          </tbody>";
       
	    }	
        echo '<div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
        <div class="card-header">Montant total de votre commande</div>
        <div class="card-body">
          <h4 class="card-title">'.number_format($montantTotal, 2, ',', ' ').' €</h4>
          <form method="POST" action="index.php?controller=panier&task=validate">
          <input type="submit" class="btn btn-light mb-2" name="validate" value="Valider votre commande"></input>
          
          </form>
          <form method="POST" action="index.php?controller=panier&task=delete">
          <input type="submit" class="btn btn-light" name="delete" value="Annuler votre commande"></input>
          </form>
        </div>
      </div>';

     
	    ?>	
	
<?php endif ?>

