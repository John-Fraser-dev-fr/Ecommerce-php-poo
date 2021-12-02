<h1>Partie Administrateur</h1>





<h4>Voici les commandes en cours :</h4>
<table class="table table-hover">
<thead>
	<tr>
		<th scope="col">Nom</th>
        <th scope="col">Prénom</th>
        <th scope="col">Commande N°</th>
		<th scope="col">Total</th>
        <th scope="col">Status</th>
        <th scope="col">Changement status</th>
        <th scope="col">Supprimer Commande</th>
        
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
            echo "<td>" . $status_1 .  $status_2 . $status_3 . $status_4 . "</td>";
           
            echo '<td>
            <div class="Ajout">

            <form method="POST" action="index.php?controller=admin&task=changeStatus">
              <select name="changementStatus">
               
              
                <option value=""></option>
                <option value="1">En attente de validation</option>
                <option value="2">Validée</option>
                <option value="3">En préparation</option>
                <option value="4">Expédiée</option>
               
              </select>
              <button type="submit" class="btn btn-primary" name="status">ok</button>
              <input type="hidden" class="btn btn-primary" name="id_commande" value="'. $commande['id_commande'] .'"></input>
            </form> 
                  </ td>';
                echo '<td>
                <form method="POST" action="index.php?controller=admin&task=suppCommande">
                <input type="submit" class="btn btn-primary" name="sup_com"  value="Supprimer"></input>
                <input type="hidden" name="id_commande_supp"  value="'. $commande['id_commande'] .'"></input>
                </form></ td>';
    echo "</tr>";
    
           
   
 

     endforeach ?>

          
</tbody>
</table>




 

