<h1>Partie Administrateur</h1>





<h4 id="titre">Voici les commandes en cours :</h4>
<table class="table table-hover">
<thead>
	<tr>
		<th scope="col">Nom</th>
        <th scope="col">Prénom</th>
        <th scope="col">Commande N°</th>
		<th scope="col">Total</th>
        <th scope="col">Status</th>
        <th scope="col">Date</th>
       
        <th scope="col"></th>
        
	</tr>
</thead>
	
<tbody>

	<?php foreach ($commandes as $commande) : 



$status_1 = '';
$status_2 = '';
$status_3 = '';
$status_4 = '';

if ($commande['status'] == 1)
{
 $status_1 = 'En attente de validation';
}
else if ($commande['status'] == 2)
{
  $status_2 = 'Validée';
}
else if ($commande['status'] == 3)
{
  $status_3 = 'En préparation';
}
else if ($commande['status'] == 4)
{
  $status_4 = 'Expédiée';
}

    echo "<tr>";
            echo "<td>" . $commande['nom'] . "</ td>";
            echo "<td>" . $commande['prenom']  . "</ td>";
            echo "<td>" . $commande['id_commande'] . "</td>";
            echo "<td>" . number_format($commande['montant'], 2, ',','') . " €</td>";
           
           
            echo '<td>
            <div class="Ajout">

            <form method="POST" action="index.php?controller=admin&task=changeStatus">
              <select name="changementStatus">
               
              
                <option value="">' . $status_1 .  $status_2 . $status_3 . $status_4 . '</option>
                <option value="1">En attente de validation</option>
                <option value="2">Validée</option>
                <option value="3">En préparation</option>
                <option value="4">Expédiée</option>
               
              </select>
              <button type="submit" class="btn btn-primary" name="status">ok</button>
              <input type="hidden" class="btn btn-primary" name="id_commande" value="'. $commande['id_commande'] .'"></input>
            </form> 
                  </ td>';
                  echo "<td>" . $commande['date'] . "</td>";
                  echo "<td><button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#Modal". $commande['id_commande'] ."'>
                  + d'infos
                </button></td>";
                
    echo "</tr>";
    
           
   
    
    echo'<div class="modal fade" id="Modal'. $commande['id_commande'] .'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Commande N°'. $commande['id_commande'] .'</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
          <div class="modal-body">
            <u><p>Adresse de livraison :</p></u>
            <p>'. $commande['nom'].' '.$commande['prenom'].'</p>
            <p>'. $commande['numero_rue'].' '.$commande['rue'].'</p>
            <p>'. $commande['code_postal'].' '.$commande['ville'].', '. $commande['pays'].' </p>
            
            
          </div>
          
          
        </div>
      </div>
    </div>';

     endforeach ?>

          
</tbody>
</table>



<h4 class="mt-5">Voici les produits mise en ligne :</h4>
<table class="table table-hover">
<thead>
	<tr>
		<th scope="col">Marque</th>
    <th scope="col">Modèle</th>
    <th scope="col">Prix</th>
		<th scope="col">Stock</th>
        
	</tr>
</thead>
	
<tbody>


<?php foreach ($articles as $article) : 

echo "<tr>";
echo "<td>" . $article['marque'] . "</ td>";
echo "<td>" . $article['modele']  . "</ td>";
echo "<td>" . number_format($article['prix'], 2, ',','') . " €</td>";
echo "<td>" . $article['stock'] . "</ td>";
echo '<td>
<form method="POST" action="index.php?controller=admin&task=suppProduit">
<input type="submit" class="btn btn-primary" name="suppArt"  value="Supprimer"></input>
<input type="hidden" name="article_supp"  value="'. $article['id_article'] .'"></input>
</form></ td>';
echo "<tr>";


 

endforeach ?>

          
</tbody>
</table>



  <div class="mt-5">

    
      <h4>Ajouter produits :</h4>
    

    <div id="formulaireAjoutProduit" class="d-flex">
      <form method="POST" action="index.php?controller=admin&task=ajoutProduit"class="col-3" >
        <div class="form-group">
          <label>Marque</label>
          <input type="text" class="form-control" name="marque" >
        </div>
        <div class="form-group">
          <label>Modèle</label>
          <input type="text" class="form-control" name="modele">
        </div>
        <div class="form-group">
          <label >Prix</label>
          <input type="number" step="0.01" class="form-control" name="prix">
        </div>
        <div class="form-group">
          <label >Stock</label>
          <input type="number" class="form-control" name="stock">
        </div>
        <button type="submit" class="btn btn-primary" name="ajoutProduit">Valider</button>
      </form>
    </div>

  </div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>