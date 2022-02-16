<?php

$in = new \Models\Panier;
$infosUsers = $in -> infoUtilisateur();

$t = new \Models\Admin;
$infoLivraisons = $t -> infoLivraison();

?>

<div class="container" id="info_compte">

    <h4 style="text-align: center;margin-top:5%;margin-bottom:5%">Bonjour <?php echo $_SESSION['prenom'];?> <?php echo $_SESSION['nom'];?></h4> 

    <h4 style="margin-bottom: 2%;">Historique des commandes :</h4>

    <table class="table table-hover">
        <thead>
	        <tr style="background-color: rgb(78, 158, 188); text-align: center">
		        <th class="text-white" scope="col">Commande n°</th>
		        <th class="text-white" scope="col">Date</th>
                <th class="text-white" scope="col">Total</th>
                <th class="text-white" scope="col">Etat</th>
                <th class="text-white" scope="col">Détails</th>
          </tr>
        </thead>

        <tbody>
        <?php foreach($infs as $inf){
            $status= '';
            if ($inf['status'] == 0)
            {
              $status = "<div style='padding: 1px 6px; border-radius: 4px; background-color:rgb(255, 231, 242); color:rgb(179, 6, 61)'><p style='margin:0'>En attente de validation</p></div>";
            }
            else if ($inf['status'] == 1)
            {
              $status = "<div style='padding: 1px 6px; border-radius: 4px; background-color:rgb(255, 246, 170); color:rgb(127, 127, 8)'><p style='margin:0'>Validée</p></div>";
            }
            else if ($inf['status'] == 2)
            {
              $status = "<div style='padding: 1px 6px; border-radius: 4px; background-color:rgb(255, 219, 163); color:rgb(146, 99, 11)'><p style='margin:0'>En préparation</p></div>";
            }
            else if ($inf['status'] == 3)
            {
              $status = "<div style='padding: 1px 6px; border-radius: 4px; background-color:rgb(215, 247, 194); color:rgb(5, 105, 13)'>Expédiée</div>";
            }
            ?>

            <tr style='text-align:center'>
                <th scope='row'><?=$inf['id_commande']?></th>
                <td scope='row'><?=$inf['date']?></td>
                <td scope='row'><?=number_format($inf['montant'], 2, ',','')?> €</td>
                <td scope='row'><?=$status?></td>
                <td><button type='button' style='display: contents' data-bs-toggle='modal' data-bs-target='#ModalInformation<?=$inf['id_commande']?>'><i class='fas fa-info-circle'></i></button></td>
            </tr>

        <?php } ?>
        </tbody>
    </table>
    <br>

    <h4 style="margin-top: 5%;margin-bottom: 2%;">Informations du profil :</h4>

  <div style="display:flex">
    <div class="accordion col-4" id="accordion1">
        <div class="accordion-item">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="display:grid">
                <h5 class="accordion-header" id="headingOne">Mes informations</h5><br>
                <p class="info_accordeon" ><?= $infosUsers['prenom'];?> <?= $infosUsers['nom'];?></p>
                <p class="info_accordeon" style="padding-bottom: 12.7%;"><?= $infosUsers['email'];?></p>
            </button>
                
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" >
                <div class="accordion-body">
                    <form method="POST" action="index.php?controller=panier&task=modifInfo" >
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" class="form_finalisation form-control" value="<?= $infosUsers['nom'];?>" name="nom" required>
                        </div>
                        <div class="form-group">
                            <label>Prénom</label>
                            <input type="text" class="form_finalisation form-control" value="<?= $infosUsers['prenom'];?>" name="prenom" required>
                        </div>
                        <div class="form-group">
                            <label >Email </label>
                            <input type="email" class="form_finalisation form-control" value="<?= $infosUsers['email'];?>" name="email" required>
                        </div>
                        <div class="d-grid gap-2" style="justify-content: center;">
                            <button type="submit" class="btn  btn-primary" name="modifInfo">Enregistrer</button>
                            <input type="hidden" name="id_user" value="<?php echo $_SESSION['id'];?>"/>
                            <input type="hidden" class="btn btn-primary" name="id_commande" value="<?=$id_commande?>"></input>
                            <button class="btn btn-primary btn-accordeon-annuler accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" >Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-1"></div>


    <div class="accordion col-4" id="accordion2">
        <div class="accordion-item">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="display:grid">
                <h5 class="accordion-header" id="headingTwo">Adresse de livraison</h5><br>
                <p class="info_accordeon"><?= $infosUsers['prenom'];?> <?= $infosUsers['nom'];?></p>
                <p class="info_accordeon"><?= $infosUsers['numero_rue'];?> <?= $infosUsers['rue'];?></p>
                <p class="info_accordeon"><?= $infosUsers['code_postal'];?> <?= $infosUsers['ville'];?></p>
                <p class="info_accordeon"><?= $infosUsers['pays'];?></p>
            </button>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" >
            <div class="accordion-body">
                <form method="POST" action= "index.php?controller=panier&task=modifAdresse">
                    <div class="form-group">
                        <label>Numéro</label>
                        <input type="number" class="form_finalisation form-control" value="<?= $infosUsers['numero_rue'];?>" name="numero_rue" required>
                    </div>
                    <div class="form-group">
                        <label>Rue</label>
                        <input type="text" class="form_finalisation form-control" value="<?= $infosUsers['rue'];?>" name="rue" required>
                    </div>
                    <div class="form-group">
                        <label >Code postal</label>
                        <input type="number" class="form_finalisation form-control" value="<?= $infosUsers['code_postal'];?>" name="code_postal" required>
                    </div>
                    <div class="form-group">
                        <label >Ville</label>
                        <input type="text" class="form_finalisation form-control" value="<?= $infosUsers['ville'];?>" name="ville" required>
                    </div>
                    <div class="form-group">
                        <label >Pays</label>
                        <input type="text" class="form_finalisation form-control" value="<?= $infosUsers['pays'];?>" name="pays" required>
                    </div>
                    <div class="d-grid gap-2" style="justify-content: center;">
                        <button type="submit" class="btn  btn-primary" name="modif_adresse">Enregistrer</button>
                        <input type="hidden" name="id_user2" value="<?php echo $_SESSION['id'];?>"/>
                        <button class="btn btn-primary btn-accordeon-annuler accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" >Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
  </div>
    

    
    



    <?php foreach ($infoLivraisons as $infoLivraison) : ?>
   
   <!-- modal informations-->
   <div class="modal fade" id="ModalInformation<?= $infoLivraison['id_commande']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Commande n° <?= $infoLivraison['id_commande']?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><b><u>Détails:</u></b></p>

                   

                   <?php $array_produits=explode( ',', $infoLivraison['articleByUser'])?>
                   <?php $array_produits2=explode( ',', $infoLivraison['qttByArt'])?>

                   <?php if(count($array_produits) == 1) {?>
                     <p class="info_accordeon">1 article</p>
                   <?php }else{?>
                     <p class="info_accordeon"><?php echo array_sum($array_produits2);?> articles</p>
                   <?php } ?>


                   <div class="details_commande_produits">
                     <?php for ($i=0 ;$i < count($array_produits) ; $i++){ ?>
                       <div class="commande_produit">
                         <div class="img_produit">
                           <img src="assets/image_produits/<?= $array_produits[$i]?>.jpg" class="img-fluid" style="width:100px; height: 100px">
                         </div>
                         <div class="details_commande_description">
                           <p style="line-height: 1.5;font-size: 0.6rem; text-align:center; margin-bottom: 0.2rem;"><b><?= $array_produits[$i] ?> </b></p>
                           <p style="line-height: 1.5;font-size: 0.5rem; text-align:center">Quantité : <?= $array_produits2[$i]?> </p> </p>
                         </div>
                       </div>
                     <?php } ?>
                   </div>
                </div>
                
            </div>
               
        </div>
    </div>
</div>
<?php endforeach ?>
       



    
    
</div>