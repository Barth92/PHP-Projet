<?php 
require_once "inc/init.inc.php";
//------------------------------------- TRAITEMENT PHP ------------------------------------//







//------------------------------------- AFFICHAGE HTML ------------------------------------//
require_once "inc/haut.inc.php";

?>
<div class="jumbotron text-center mt-4">
    <h2>Connexion</h2>
</div>

<div class="container mt-4">
    <form action="" method="post">
        <div class="mb-3">
            <label for="pseudo" class="form-label">Pseudo</label>
            <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Veuillez renseigner votre Pseudo">
        </div>
        <div class="mb-3">
            <label for="mdp" class="form-label">Mot de Passe</label>
            <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Veuillez renseigner votre Mot de Passe">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg">Se connecter</button>
        </div>

    </form>
</div>
<?php require_once "inc/bas.inc.php";