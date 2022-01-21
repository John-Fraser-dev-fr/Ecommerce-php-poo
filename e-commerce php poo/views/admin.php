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
        <a href="#" class="active" onclick="show('Page1')">
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
            <th class="text-white" scope="col">Etat</th>
            <th class="text-white" scope="col">Action</th>
            <th class="text-white" scope="col">Infos</th>
          </tr>
        </thead>
        <tbody>

	      <?php foreach ($commandes as $commande) : 
          $status = '';
          
          if ($commande['status'] == 0)
          {
            $status = "<p style='color:red'>En attente de validation</p>";
          }
          else if ($commande['status'] == 1)
          {
            $status = "<p style='color:orange'>Validée";
          }
          else if ($commande['status'] == 2)
          {
            $status = "<p style='color:green'>En préparation";
          }
          else if ($commande['status'] == 3)
          {
            $status = '<p>Expédiée</p>';
          }

          if ($commande['status'] < 3)
          {
            echo "<tr style='text-align:center'>";
              echo "<th scope='row'>" . $commande['id_commande']. "</ th>";
              echo "<th scope='row'>" . $commande['nom'].' '.$commande['prenom']. "</ th>";
              echo "<td>" . $commande['date'] . "</td>";
              echo "<td>" . number_format($commande['montant'], 2, ',','') . " €</td>";
              echo "<td>" . $status . " </td>";
              echo "<td><button type='button' style='display: contents' data-bs-toggle='modal' data-bs-target='#Modal". $commande['id_commande'] ."'><i class='fas fa-pen'></i></button></td>";  
              echo "<td><button type='button' style='display: contents' data-bs-toggle='modal' data-bs-target='#ModalInfo". $commande['id_commande'] ."'><i class='fas fa-info-circle'></i></button></td>";              
              echo "</td>";
    
              echo'<div class="modal fade" id="Modal'. $commande['id_commande'] .'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

              echo'<div class="modal fade" id="ModalInfo'. $commande['id_commande'] .'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Test</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                  <div class="modal-body">
                    <div class=" mb-5">
                      <h5>Modifier l\'état de la commande</h5>
                    </div>
                    
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
            <th class="text-white" scope="col">Action</th>
          </tr>
        </thead>
        <tbody>

	      <?php foreach ($commandes as $commande) : 
          $status = '';
        
          if ($commande['status'] == 3)
          {
            $status = '<p>Expédiée</p>';

            echo "<tr style='text-align:center'>";
              echo "<th scope='row'>" . $commande['id_commande']. "</ th>";
              echo "<th scope='row'>" . $commande['nom'].' '.$commande['prenom']. "</ th>";
              echo "<td>" . $commande['date'] . "</td>";
              echo "<td>" . number_format($commande['montant'], 2, ',','') . " €</td>";
              echo "<td>" . $status . " </td>";
              echo "<td><button type='button' style='display: contents' data-bs-toggle='modal' data-bs-target='#Modal". $commande['id_commande'] ."'><i class='fas fa-pen'></i></button></td>";        
              echo "</td>";
    
              echo'<div class="modal fade" id="Modal'. $commande['id_commande'] .'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

    </div>

    <!-- PAGE 3 (produits) -->
    <div id="Page3" class="page" style="display:none">
      <h4 class="mt-5">Voici les produits mise en ligne :</h4>
      <!--Tableau des produits mis en ligne-->
      <table class="table table-hover">
        <thead>
	        <tr>
		        <th scope="col">Marque</th>
            <th scope="col">Modèle</th>
            <th scope="col">Prix</th>
		      </tr>
        </thead>	
        <tbody>

          <?php foreach ($articles as $article) : 

            echo "<tr>";
              echo "<td>" . $article['marque'] . "</ td>";
              echo "<td>" . $article['modele']  . "</ td>";
              echo "<td>" . number_format($article['prix'], 2, ',','') . " €</td>";
              echo '<td>
                <form method="POST" action="index.php?controller=admin&task=suppProduit">
                  <input type="submit" class="btn btn-primary" name="suppArt"  value="Supprimer"></input>
                  <input type="hidden" name="article_supp"  value="'. $article['id_article'] .'"></input>
                </form>
              </td>';
            echo "<tr>";

          endforeach ?>
        
        </tbody>
      </table>

      <!-- Ajout produit -->
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
            <button type="submit" class="btn btn-primary" name="ajoutProduit">Valider</button>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>

















