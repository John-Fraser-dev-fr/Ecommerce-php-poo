<div>

  <!-- menu -->
  <div class="sidebar col-2">
    <!--profile image & text-->
    <div class="profile">
      <img src="./assets/avatar/eric-cartman.png" alt="profile_picture">
      <h4>Administrateur</h4>
    </div>
    <!-- menu item -->
    <ul>
      <li>
        <a href="#" onclick="show('Page1')">
          <span class="icon"><i class="fas fa-tachometer-alt"></i></span>
          <span class="item">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="#" onclick="show('Page2');">
          <span class="icon"><i class="fas fa-box"></i></i></span>
          <span class="item">Commandes</span>
        </a>
      </li>
      <li>
        <a href="#" onclick="show('Page3');">
          <span class="icon"><i class="fas fa-th"></i></span>
          <span class="item">Produits</span>
        </a>
      </li>
    </ul>
  </div>

 

  <div class="container col-10" style="margin-left: 16.7%;padding-top: 10%;padding-left: 5%;">

    <!-- PAGE 1 (dashboard) -->
    <div id="Page1" class="page">
      <div class="cards-list">
        <div class="cardAdmin 1" style="background-color: rgb(78, 158, 188);">
          <div class="card_title text-white">
            <p>Commande en cours</p>
            <p style="font-size: xxx-large;margin-top: revert;"><?= $commandeEnCours ?></p>
          </div>
        </div>
        <div class="cardAdmin 2" style="background-color: #252526">
          <div class="card_title text-white" style="color:rgb(78, 158, 188);">
            <p>Commande terminées</p>
            <p style="font-size: xxx-large;margin-top: revert;"><?= $commandeTermine ?></p>
          </div>
        </div>
        <div class="cardAdmin 3" style="background-color: rgb(78, 158, 188);">
          <div class="card_title text-white">
            <p>Nombre d'utilisateurs</p>
            <p style="font-size: xxx-large;margin-top: revert;"><?= $nbUser?></p>
          </div>
        </div>
      </div>
    </div>

    <!-- PAGE 2 (commande)-->
    <div id="Page2" class="page" style="display:none">
      <h4 class="mb-3">Commandes en cours :</h4>
      <!-- tableau commande en cours -->
      <table class="table table-hover mb-5">
        <thead>
	        <tr style="background-color: rgb(78, 158, 188); text-align: center">
		        <th class="text-white" scope="col">Commande n°</th>
            <th class="text-white" scope="col">Client</th>
		        <th class="text-white" scope="col">Date</th>
            <th class="text-white" scope="col">Total</th>
            <th class="text-white" scope="col">Paiement</th>
            <th class="text-white" scope="col">Etat</th>
            <th class="text-white" scope="col">Actions</th>
            <th class="text-white" scope="col">Infos</th>
          </tr>
        </thead>
        <tbody>

	      <?php foreach ($commandes as $commande) : 
          $status = '';
          
          if ($commande['status'] == 0)
          {
            $status = "<div style='padding: 1px 6px; border-radius: 4px; background-color:rgb(255, 231, 242); color:rgb(179, 6, 61)'><p style='margin:0'>En attente de validation</p></div>";
          }
          else if ($commande['status'] == 1)
          {
            $status = "<div style='padding: 1px 6px; border-radius: 4px; background-color:rgb(255, 246, 170); color:rgb(127, 127, 8)'><p style='margin:0'>Validée</p></div>";
          }
          else if ($commande['status'] == 2)
          {
            $status = "<div style='padding: 1px 6px; border-radius: 4px; background-color:rgb(255, 219, 163); color:rgb(146, 99, 11)'><p style='margin:0'>En préparation</p></div>";
          }
          

          if ($commande['status'] < 3)
          {
            
            echo "<tr style='text-align:center'>";
              echo "<th scope='row'>" . $commande['id_commande']. "</ th>";
              echo "<th scope='row'>" . $commande['nom'].' '.$commande['prenom']. "</ th>";
              echo "<td>" . $commande['date'] . "</td>";
              echo "<td>" . number_format($commande['montant'], 2, ',','') . " €</td>";
              if($commande['paiement'] == "succeeded")
              {
               echo "<td><div style='padding: 1px 6px; border-radius: 4px; background-color:rgb(215, 247, 194); color:rgb(5, 105, 13)'>Réussi</div></td>";
              }
              else if ($commande['paiement'] == "requires_payment_method")
              {
                echo "<td><div style='padding: 1px 6px; border-radius: 4px; background-color:rgb(235, 238, 241);color:rgb(84, 90, 105);'>Incomplet</div></td>";
              }
              else if ($commande['paiement'] != "requires_payment_method" && $commande['paiement'] != "succeeded")
              {
                echo "<td><div style='padding: 1px 6px; border-radius: 4px; background-color:rgb(215, 247, 194); color:rgb(5, 105, 13)'>Réussi</div></td>";
              }

              echo "<td>" . $status . "</td>";
              echo "<td><button type='button' style='display: contents' data-bs-toggle='modal' data-bs-target='#Modal". $commande['id_commande'] ."'><i class='fas fa-pen' style='margin-right: 15%'></i></button>
              <button type='button' style='display: contents' data-bs-toggle='modal' data-bs-target='#ModalSupprimer". $commande['id_commande'] ."'><i class='fas fa-trash'></i></button></td>";  
              echo "<td><button type='button' style='display: contents' data-bs-toggle='modal' data-bs-target='#ModalInformation". $commande['id_commande'] ."'><i class='fas fa-info-circle'></i></button></td>"; 
              echo "</td>";
    
              echo'<div class="modal fade" id="Modal'. $commande['id_commande'] .'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Commande N°'. $commande['id_commande'] .'</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                  <div class="modal-body">
                    <div class=" ">
                      <h5>Modifier l\'état de la commande</h5>
                    </div>
                    <form method="POST" action="index.php?controller=admin&task=changeStatus">
                      <select class="form-select" style="margin-top: 16px" name="changementStatus">
                        <option value="">' . $status . '</option>
                        <option value="0">En attente de validation</option>
                        <option value="1">Validée</option>
                        <option value="2">En préparation</option>
                        <option value="3">Expédiée</option>
                      </select>
                      <div>
                        <button type="submit" class="btn btn-primary" name="status" style="width: 100%; margin-top: 1rem;">Valider</button>
                        <input type="hidden" class="btn btn-primary" name="id_commande" value="'. $commande['id_commande'] .'"></input>
                      </div>
                    </form> 
                  </div>
                  
                </div>
              </div>';

              

              
            }else{}

        endforeach ?>

        </tbody>
      </table>

      <!--tableau commande terminées -->
      <h4 class="mt-5 mb-3">Commandes terminées :</h4>
      
      <table class="table table-hover">
        <thead>
	        <tr style="background-color: rgb(78, 158, 188); text-align: center">
		        <th class="text-white" scope="col">Commande n°</th>
            <th class="text-white" scope="col">Client</th>
		        <th class="text-white" scope="col">Date</th>
            <th class="text-white" scope="col">Total</th>
            <th class="text-white" scope="col">Etat</th>
            <th class="text-white" scope="col">Actions</th>
            <th class="text-white" scope="col">Infos</th>
          </tr>
        </thead>
        <tbody>

	      <?php foreach ($commandes as $commande) : 
          $status = '';
        
          if ($commande['status'] == 3)
          {
            $status = "<div style='padding: 1px 6px; border-radius: 4px; background-color:rgb(215, 247, 194); color:rgb(5, 105, 13)'>Expédiée</div>";

            echo "<tr style='text-align:center'>";
              echo "<th scope='row'>" . $commande['id_commande']. "</ th>";
              echo "<th scope='row'>" . $commande['nom'].' '.$commande['prenom']. "</ th>";
              echo "<td>" . $commande['date'] . "</td>";
              echo "<td>" . number_format($commande['montant'], 2, ',','') . " €</td>";
              echo "<td>" . $status . " </td>";
              echo "<td><button type='button' style='display: contents' data-bs-toggle='modal' data-bs-target='#Modal2". $commande['id_commande'] ."'><i class='fas fa-pen' style='margin-right: 15%'></i></button>
              <button type='button' style='display: contents' data-bs-toggle='modal' data-bs-target='#ModalSupprimer". $commande['id_commande']. "'><i class='fas fa-trash'></i></button></td>";   
              echo "<td><button type='button' style='display: contents' data-bs-toggle='modal' data-bs-target='#ModalInformation". $commande['id_commande'] ."'><i class='fas fa-info-circle'></i></button></td>";      
              echo "</td>";
    
              echo'<div class="modal fade" id="Modal2'. $commande['id_commande'] .'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Commande N°'. $commande['id_commande'] .'</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class=" mb-5">
                      <h5>Modifier l\'état de la commande</h5>
                    </div>
                    <form method="POST" action="index.php?controller=admin&task=changeStatus">
                      <select class="form-select"   name="changementStatus">
                        <option value="">' . $status . '</option>
                        <option value="0">En attente de validation</option>
                        <option value="1">Validée</option>
                        <option value="2">En préparation</option>
                        <option value="3">Expédiée</option>
                      </select>
                      <div>
                        <button type="submit" class="btn btn-primary" name="status" style="width: 100%; margin-top: 1rem;">Valider</button>
                        <input type="hidden" class="btn btn-primary" name="id_commande" value="'. $commande['id_commande'] .'"></input>
                      </div>
                    </form> 
                  </div>
                  
                </div>
              </div>';
              
              
          }
          else{}
          
       
          

        endforeach ?>

        </tbody>
      </table>

     
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
                    <div>
                      <p><b><u>Adresse : </u></b></p>
                      <p><?= $infoLivraison['nom']?> <?= $infoLivraison['prenom']?> </p>
                      <p style="margin-bottom: 0"><?= $infoLivraison['numero_rue']?>, <?= $infoLivraison['rue']?> </p>
                      <p><?= $infoLivraison['code_postal']?> <?= $infoLivraison['ville']?> </p>
                     
                    </div>

                    <div style="margin-top: 10%">
                      <p><b><u>Articles :</u></b></p>

                      

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



            <!-- modal supprimer-->
            <div class="modal fade" id="ModalSupprimer<?= $infoLivraison['id_commande']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Commande N° <?= $infoLivraison['id_commande']?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class=" mb-5">
                      <h5>Etes-vous sur de vouloir supprimer cette commande ?</h5>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <form method="POST" action="index.php?controller=admin&task=suppCommande">
                      <button type="submit" class="btn btn-primary" name="suppCom" style="background-color: black">Supprimer</button>
                      <input type="hidden" name="id_commande_supp"  value="<?= $infoLivraison['id_commande']?>"></input>
                    </form>
                  </div>
                </div>
              </div>
            </div>

    
            <?php endforeach ?>
       
         
    </div>

    <!-- PAGE 3 (produits) -->
    <div id="Page3" class="page" style="display:none">
      <h4 class="mt-5">Voici les produits mise en ligne :</h4>
      <!--Tableau des produits mis en ligne-->
      <table class="table table-hover">
        <thead>
	        <tr style='background-color: rgb(78, 158, 188)'>
		        <th class="text-white" scope="col">Marque</th>
            <th class="text-white" scope="col">Modèle</th>
            <th class="text-white" scope="col">Détails</th>
            <th class="text-white" scope="col">Prix</th>
            <th class="text-white" scope="col">Image</th>
            <th></th>
            <th class="text-white" scope="col">Actions</th>
		      </tr>
        </thead>	
        <tbody>

          <?php foreach ($articles as $article) : 

            echo "<tr>";
              echo "<td>" . $article['marque'] . "</ td>";
              echo "<td>" . $article['modele']  . "</ td>";
              echo "<td>" . $article['detail_modele']  . "</ td>";
              echo "<td>" . number_format($article['prix'], 2, ',','') . " €</td>";
              echo'<td style="background-color:white;text-align:center"><img src="assets/image_produits/'. $article['photo_produit']  . '" class="img-fluid" style="width:50px; height: auto;"></td>';
              echo'<td></td>';
              echo "<td><button type='button' style='display: contents' data-bs-toggle='modal' data-bs-target='#ModalModif". $article['id_article'] ."'><i class='fas fa-pen' style='margin-right: 15%'></i></button>
              <button type='button' style='display: contents' data-bs-toggle='modal' data-bs-target='#ModalSuppArt". $article['id_article'] ."'><i class='fas fa-trash'></i></button></td>";  
              

              echo'<div class="modal fade" id="ModalModif'. $article['id_article'] .'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modifier votre produit</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="index.php?controller=admin&task=Updateproduit" enctype="multipart/form-data">
                    <div class="form-group">
                       <label>Marque</label>
                        <input type="text" class="form_finalisation form-control" value="'.$article['marque'].'" name="modif_marque" required>
                    </div>
                    <div class="form-group">
                      <label>Modéle</label>
                      <input type="text" class="form_finalisation form-control" value="'.$article['modele'].'" name="modif_modele" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea" class="form-label">Détails</label>
                      <textarea class="form-control" id="exampleTextarea" rows="3" name="modif_detailModele" >'.$article['detail_modele'].'</textarea>
                    </div>
                    <div class="form-group">
                      <label >Prix</label>
                      <input type="number" step="0.01" class="form-control" value="'.$article['prix'].'" name="modif_prix">
                    </div>
                    <div class="form-group">
                      <label for="formFile" class="form-label">Photo produit</label>
                      <input class="form-control" type="file" name="photoProduitModif" id="formFile">
                    </div>
                            
                    <div class="d-grid gap-2" style="justify-content: center;">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                      <button type="submit" class="btn btn-primary" name="modifArt" >Modifier</button>
                      <input type="hidden" name="id_art_modif"  value="'. $article['id_article'] .'"></input>
                    </div>
                  </form>
                </div>
                
              </div>
            </div>';

            

          endforeach ?>
        
        </tbody>
      </table>

      <!-- Ajout produit -->
      <div class="mt-5">
        <h4>Ajouter produits :</h4>
        <div id="formulaireAjoutProduit" class="d-flex" style="width: 150%">
          <form method="POST" enctype="multipart/form-data" action="index.php?controller=admin&task=ajoutProduit"class="col-3" >
            <div class="form-group">
              <label>Marque</label>
              <input type="text" class="form-control" name="marque" >
            </div>
            <div class="form-group">
              <label>Modèle</label>
              <input type="text" class="form-control" name="modele">
            </div>
            <div class="form-group">
              <label>Détails</label>
              <input type="text" class="form-control" name="detail_modele">
            </div>
            <div class="form-group">
              <label >Prix</label>
              <input type="number" step="0.01" class="form-control" name="prix">
            </div>
            <div class="form-group" style="display:flex">
              <div style="width:100%">
                <label for="formFile" class="form-label">Photo produit</label>
                <input class="form-control" type="file" name="photoProduit" id="formFile">
              </div>
              <div style="align-self: self-end;padding-bottom: 1.5%;padding-left: 1%;" onclick="">
             
                  <span><a id="target3" class="nav-icon"><i class="fas fa-info-circle" style="color:rgb(78, 158, 188);"></i></a></span>
              
                
                
              </div>
              
            </div>
      
            <div>
            <button type="submit" onclick="" class="btn btn-primary mb-5 mt-3" style="width: 100%" name="ajoutProduit">Valider</button>
            </div>
           
          </form>
        </div>
      </div>

     

      <!--popover info photo upload -->
      <div id='upPhotoPop' class="container">
            
              <p>Le nom du fichier doit être le même que celui du modèle</p>
            
      </div>
    
    
    
</div>
  


      <?php foreach ($articles as $article) { ?>
      <div class="modal fade" id="ModalSuppArt<?=$article['id_article']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Etes-vous sur de vouloir supprimer ce produit ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class=" mb-5">
                      <h5><?= $article['marque']?> <?=$article['modele']?></h5>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <form method="POST" action="index.php?controller=admin&task=suppProduit">
                  <input type="submit" class="btn btn-primary" name="suppArt"  value="Supprimer"></input>
                  <input type="hidden" name="article_supp"  value="<?=$article['id_article']?>"></input>
                  <input type="hidden" name="nom_photo"  value="<?=$article['photo_produit']?>"></input>
                </form>
                  </div>
                </div>
              </div>
            </div>

        <?php } ?>
   
    </div>

  </div>
</div>

















