<?php 
require_once "inc/init.inc.php";
//------------------------------------- TRAITEMENTS PHP ------------------------------------//
if($_POST)
{
    debug($_POST);
    $verif_caractere = preg_match('#^[a-zA-Z0-9._-]+$#', $_POST['pseudo']);
    if(!$verif_caractere || (iconv_strlen($_POST['pseudo']) < 5 || iconv_strlen($_POST['pseudo']) > 20))
    {
        $contenu .= "<div class='alert alert-danger'>❌ Une erreur s'est produite ! Le pseudo doit contenir entre 5 et 20 caractères inclus. <br> Caractères acceptés : Lettres de A à Z et Chiffre de 0 à 9 </div>";
    }
    else
    {
        $membre = executeRequete("SELECT * FROM membre WHERE pseudo ='$_POST[pseudo]'");
        if($membre->num_rows > 0)
        {
            $contenu .= "<div class='alert alert-danger'>❌ Pseudo indisponible. Veuillez choisir un autre pseudo svp.</div>";
        }
        else
        {
            $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
            foreach($_POST AS $indice => $valeur)
            {
                $_POST[$indice] = htmlentities(addslashes($valeur));
            }
            executeRequete("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse) VALUES ('$_POST[pseudo]', '$mdp', '$_POST[nom]', '$_POST[prenom]', '$_POST[email]', '$_POST[civilite]', '$_POST[ville]', '$_POST[code_postal]', '$_POST[adresse]')");
            $contenu .= "<div class='alert alert-success'>✅ Félicitation ! Vous êtes maintenant inscrit sur notre site. <a href=\"connexion.php\" class=\"btn btn-success\">Cliquez ici pour vous connecter</a></div>";
        }
    }
}
//------------------------------------- AFFICHAGE HTML ------------------------------------//


require_once "inc/haut.inc.php";
echo $contenu;
?>
<div class="container">
    <form action="" method="post">
        <div class="mb-3">
            <label for="pseudo" class="form-label">Pseudo</label>
            <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Choississez un Pseudo" pattern="[a-zA-Z0-9-_.]{1,20}" title="caractères autorisés : a-zA-Z0-9-_." required="required">
        </div>
        <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="mdp" id="mdp" required="required" placeholder="Choisissez un Mot De Passe">
        </div>
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" name="nom" id="nom" placeholder="Indiquez votre Nom">
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Indiquez votre Prénom">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Exemple : monemail@gmail.com">
        </div>
        <div class="mb-3">
            <label for="civilite" class="form-label">Civilité</label><br>
            <input type="radio" name="civilite" value="m" checked=""> Homme<br>
            <input type="radio" name="civilite" value="f"> Femme<br>
        </div>
        <div class="mb-3">
            <label for="ville" class="form-label">Ville</label>
            <input type="text" class="form-control" name="ville" id="ville" pattern="[a-zA-Z0-9-_.]{1,40}" title="caractères autorisés : a-zA-Z0-9-_." placeholder="Indiquez votre Ville">
        </div>
        <div class="mb-3">
            <label for="code_postal" class="form-label">Code Postal</label>
            <input type="text" class="form-control" name="code_postal" id="code_postal" placeholder="Exemple : 75013" pattern="[0-9]{5}" title="5 Chiffres requis : 0-9">
        </div>
        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <textarea class="form-control" name="adresse" id="adresse" cols="30" rows="10" placeholder="Indiquez votre adresse de domicile" pattern="[a-zA-Z0-9-_.]{1,50}" title="caractères autorisés : a-zA-Z0-9-_."></textarea>
        </div>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-lg">Valider</button>
        </div>
    </form>
</div>

<?php require_once "inc/bas.inc.php"; ?>