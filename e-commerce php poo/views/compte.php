
<div id="info_compte">
    <h4>Bonjour <?php echo $_SESSION['prenom'];?> <?php echo $_SESSION['nom'];?></h4> 
 
    <br>
    <h3>Voici vos informations de profil</h3>
    <p>Votre Email : <?php echo $_SESSION['email'];?></p>

    <br>
    <h3>Etat des commandes :</h3>
    <p>Aucune commande en cours</p>
    <a class="nav-link" href="index.php?controller=user&task=deconnexion">Deconnexion</a>
</div>