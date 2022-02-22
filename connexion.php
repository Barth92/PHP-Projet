<?php 
require_once "inc/init.inc.php";
//------------------------------------- TRAITEMENT PHP ------------------------------------//
if(isset($_GET['action']) && $_GET['action'] == "deconnexion")
{
    session_destroy();
}
if(internauteEstConnecte())
{
    header("location:profil.php");
}
if($_POST)
{
    $resultat = executeRequete("SELECT * FROM membre WHERE pseudo ='$_POST[pseudo]' ");
    if($resultat->num_rows != 0)
    {
        $membre = $resultat->fetch_assoc();
        if(password_verify($_POST['mdp'], $membre['mdp']))
        {
            foreach($membre AS $indice => $element)
            {
                if($indice != 'mdp')
                {
                    $_SESSION['membre'][$indice] = $element;
                }
            }
            header("location:profil.php");
        }
        else
        {
            $contenu .= "<div class='alert alert-danger'>❌ Identifiants invalide !</div>";
        }
    }
    else
    {
        $contenu .= "<div class='alert alert-danger'>❌ Identifiants invalide !</div>";
    }
}
//------------------------------------- AFFICHAGE HTML ------------------------------------//
require_once "inc/haut.inc.php";
echo $contenu;
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