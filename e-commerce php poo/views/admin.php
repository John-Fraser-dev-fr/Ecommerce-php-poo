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
        <th scope="col">Description</th>
	</tr>
</thead>
	
<tbody>

	<?php foreach ($commandes as $commande) : ?>

    <tr>
        <td><?= $commande['nom'] ?></td>
        <td><?= $commande['prenom'] ?></td>
        <td><?= $commande['id_commande'] ?></td>
        <td><?= $commande['montant'] ?></td>
        <td> En cours...</td>
        <td> 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="<?php echo $commande ['id_commande'] ?>">
                + d'infos
            </button>
        </td>  
    </tr>





    <!-- Modal -->
<div class="modal fade" id="<?php echo $commande ['id_commande'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    <?php endforeach ?>

            
</tbody>
</table>


<table class="table table-hover">
<thead>
	<tr>
		<th scope="col">Id_commande</th>
        <th scope="col">Marque</th>
        <th scope="col">Modèle</th>
		<th scope="col">Quantité</th>
        <th scope="col">Prix</th>
	</tr>
</thead>
	
<tbody>

	<?php foreach ($commandeDetails as $commandeDetail) : ?>

    <tr>
        <td><?= $commandeDetail['id_commande'] ?></td>
        <td><?= $commandeDetail['marque'] ?></td>
        <td><?= $commandeDetail['modele'] ?></td>
        <td><?= $commandeDetail['quantite'] ?></td>
        <td> <?= $commandeDetail['prix'] ?></td> 
    </tr>
    <?php endforeach ?>

            
</tbody>
</table>





<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>