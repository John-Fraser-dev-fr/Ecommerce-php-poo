<div id="container_finalisation">

  

    <div class="mt-5">
      <h2 style="text-align:center">Terminer ma commande</h2>
    </div>


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
                <button type="submit" class="btn btn-primary mt-1" name="login">Connexion</button>
            </form>
        </div>

        <div class=" col-2"></div>

        <div class="container nouveau col-5">
            <h4>Nouveau client</h4>
        </div>

    </div>
    
    

  

</div>