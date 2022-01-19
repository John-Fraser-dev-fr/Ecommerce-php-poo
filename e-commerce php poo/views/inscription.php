<div id="container_inscription">

  <div id="inscription">

    <div id="titre_inscription">
      <h2 style="text-align:center">Inscription</h2>
    </div>

    <div id="formulaire_inscription" class="d-flex justify-content-center">
      <form method="POST" class="col-4" >
        <div class="form-group">
          <label>Nom</label>
          <input type="text" class="form-control" name="nom" required>
        </div>
        <div class="form-group">
          <label>Prénom</label>
          <input type="text" class="form-control" name="prenom" required>
        </div>
        <div class="form-group">
          <label >Email </label>
          <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Mot de passe</label>
          <input type="password" class="form-control" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary" name="register">Inscription</button>
      </form>
    </div>

  </div>

</div>