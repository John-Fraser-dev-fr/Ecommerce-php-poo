
<div class="mt-5 mb-5">
    <h2 style="text-align:center">Terminer ma commande</h2>
</div>


<div class="container container_finalisation mt-5">


    <?php if (!isset($_SESSION['id']) && !isset($_SESSION['email']))  { ?>

    <div class="container finalisation">

        <div class="container client col-5">
            <h4>Déjà client</h4>      
            <form method="POST" action="index.php?controller=user&task=connexion">
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
        $montantTotal += $total; } ?>
          

    <div class="col-6">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="display:grid">
                    <h5 class="accordion-header" id="headingOne">Mes informations</h5><br>
                    <p>blabla</p>
                </button>
                
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" >
                    <div class="accordion-body">
                        <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="display:grid">
                    <h5 class="accordion-header" id="headingTwo">Adresse de livraison</h5><br>
                    <p>blabla</p>
                </button>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" >
                    <div class="accordion-body">
                        <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="display:grid">
                    <h5 class="accordion-header" id="headingThree">Paiement</h5><br>
                    <p>blabla</p>
                </button>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample" >
                    <div class="accordion-body">
                        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                    </div>
                </div>
            </div>
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
                <?php if($montantTotal > 99){?>
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
                <?php $montantTotalAvecLivraison = $montantTotal + 12.99;
                if ($montantTotal <= 12.99) {?>
                <p><b>0,00 €</b></p>
                <?php }else if($montantTotal <= 99 && $montantTotal > 12.99){ ?>
                <p><b><?= number_format($montantTotalAvecLivraison, 2, ',', ' ')?> €</b></p>
                <?php }else if($montantTotal >= 99){ ?>
                <p><b><?= number_format($montantTotal, 2, ',', ' ')?> €</b></p>
                <?php } ?>
           </div>
        </div>

        <form method="POST" action="#">
            <input type="submit"  class="btn btn-light mb-2 btn_commande" name="validate" value="Valider l'achat"></input>
        </form>      
    </div>
</div>
          
<?php } ?>


