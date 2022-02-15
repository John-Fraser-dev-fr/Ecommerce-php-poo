




<div class="mt-5 mb-5">
    <h2 style="text-align:center">Terminer ma commande</h2>
</div>


<div class="container container_finalisation mt-5">


    <?php if (!isset($_SESSION['id']) && !isset($_SESSION['email']))  { ?>

    <div class="container finalisation">

        <div class="container client col-5">
            <h4>Déjà client</h4>      
            <form method="POST" action="index.php?controller=user&task=connexionFinalisation">
                <div class="form-group">
                    <label >Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mot de passe</label>
                    <input type="password" class="form-control" name="password" >
                </div>
                <button type="submit" class="btn btn-primary mt-2" name="login">Terminer ma commande</button>
            </form>
        </div>

        <div class=" col-2"></div>

        <div class="container nouveau col-5">
            <h4>Nouveau client</h4>
            <p style="line-height: 1.5; font-size: .8125rem;margin-top:1rem">Devenez membre dès aujourd'hui – C'est rapide et gratuit !</p>
            <a href="index.php?controller=user&task=inscription"> <button class="btn " style="width:100%;margin-top: 2rem" type="button">Inscrivez-vous</button></a>
        </div>

    </div>

    <?php }else if(isset($_SESSION['id']) && isset($_SESSION['panier']) ) { 

    $total ='0';
    $montantTotal = '0';

    for ($i=0 ;$i < count($_SESSION['panier']['modele']) ; $i++){ 

        $total = $_SESSION['panier']['qte_produit'][$i] * $_SESSION['panier']['prix'][$i];
        $montantTotal += $total; 
    } 
    
    $in = new \Models\Panier;

    $infosUsers = $in -> infoUtilisateur();

    
    ?>

          
        
    <div class="col-6">
    
        

        <div class="accordion">
            <div class="accordion-item" style="padding: 20px 20px">
                <h5 class="accordion-header" id="headingTwo">Adresse de livraison</h5><br>
                <p class="info_accordeon"><?= $infosUsers['prenom'];?> <?= $infosUsers['nom'];?></p>
                <p class="info_accordeon"><?= $infosUsers['numero_rue'];?> <?= $infosUsers['rue'];?></p>
                <p class="info_accordeon"><?= $infosUsers['code_postal'];?> <?= $infosUsers['ville'];?></p>
                <p class="info_accordeon"><?= $infosUsers['pays'];?></p>
            </div>
        </div>

        <?php } ?>

        <div class="details_commande">
            <h5>Détails de votre commande</h5><br>
            <?php if(array_sum($_SESSION['panier']['qte_produit']) == 1) {?>
            <p class="info_accordeon">1 article</p>
            <?php }else{?>
            <p class="info_accordeon"><?php echo array_sum($_SESSION['panier']['qte_produit']);?> articles</p>
            <?php } ?>
       
            <div class="details_commande_produits">
                <?php for ($i=0 ;$i < count($_SESSION['panier']['modele']) ; $i++){ ?>
                <div class="commande_produit">
                    <div class="img_produit">
                        <img src="assets/image_produits/<?= $_SESSION['panier']['modele'][$i] ?>.jpg" class="img-fluid" style="width:100px; height: 100px">
                    </div>
                    <div class="details_commande_description">
                    <p style="line-height: 1.5;font-size: 0.6rem; text-align:center; margin-bottom: 0.2rem;"><b><?= htmlspecialchars($_SESSION['panier']['modele'][$i])?> </b></p>
                        <p style="line-height: 1.5;font-size: 0.5rem; text-align:center">Quantité : <?= htmlspecialchars($_SESSION['panier']['qte_produit'][$i])?> </p>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
                        
        <div class="detail_paiement">
            <h5>Paiement</h5><br>
   
                <form method="POST">
                    <!-- Contient les messages d'erreur de paiement -->
                    <div id="errors"></div>
                    <input type="text" id="cardholder-name" placeholder="Titulaire de la carte">
                    <!-- Contient le formulaire de saisie des informztions de carte -->
                    <div id="card-elements"></div>
                    <!-- Contient les erreurs de la carte  -->
                    <div id="card-errors" role="alert"></div>
                    

                </form>
         
        </div>
        
    </div>      

    <div class="col-2">

    </div>


    <div class="paiement_panier col-4" style="height: 275px;">
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
                <?php if($montantTotal >= 99){?>
                <p style="font-size: 12px">Gratuit</p>
                <?php } else if ($montantTotal < 99) {?>
                <p style="font-size: 12px">12,99 €</p>
                <?php }?>
            </div>
        </div>
        <div class="solid-black"></div>
        <div class="total">
            <div>
                <p><b>Total de la commande :  </b></p>
            </div>
            <div>
                <?php 
                if ($montantTotal == 0) {?>
                <p><b>0,00 €</b></p>
                <?php }else if($montantTotal < 99){ ?>
                <p><b><?= number_format($montantTotal += 12.99, 2, ',', ' ')?> €</b></p>
                <?php }else if($montantTotal >= 99){ ?>
                <p><b><?= number_format($montantTotal, 2, ',', ' ')?> €</b></p>
                <?php } ?>
           </div>
        </div>
       


        <form method="POST">
            <button class="btn btn-light mb-2 btn_commande"  id="card-button" type="button" data-secret="<?= $intention['client_secret'] ?> " >Procéder au paiement</button>
            

        </form>   

      
    </div>
</div>
          






<div class="modal fade" id="modalFinalPaiement" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-body">
                <div id="textModalFinalPaiement" data-nomsecteur="" data-idajout="">
                </div>
                <div id="textModalFinalPaiement2" class="mt-3" data-nomsecteur="" data-idajout="">
                </div>
            </div>
            <div class="modal-footer">
                <form method="POST" action="index.php?controller=panier&task=MiseAjourStatus">
                    <input type="submit" class="btn btn-light btn_commande" name="delete" value="Terminer"></input>
                    <input type="hidden" class="btn btn-primary" name="id_commande" value="<?=$id_commande?>"></input>
                    <input type="hidden" class="btn btn-primary" id="status_stripe" name="status_stripe" ></input>
                </form>
            </div>
        </div>
    </div>
</div>








