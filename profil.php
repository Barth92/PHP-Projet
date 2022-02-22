<?php
require_once "inc/init.inc.php";
//------------------------------------- TRAITEMENT PHP ------------------------------------//
if(!internauteEstConnecte()) header("location:connexion.php");
debug($_SESSION);
//------------------------------------- AFFICHAGE HTML ------------------------------------//
require_once "inc/haut.inc.php";
?>

<div class="container mt-4">
    <div class="jumbotron text-center">
        <?php
            if($_SESSION['membre']['civilite'] == 'm')
            {
               echo '<img src="https://picsum.photos/id/1005/200/200" alt="photo de profil" style="clip-path:ellipse(50% 50%);">';
            }
            else
            {
                echo '<img src="https://picsum.photos/id/1011/200/200" alt="photo de profil" style="clip-path:ellipse(50% 50%);">';
            }
        ?>
        <h2 class="mt-4"><?= $_SESSION['membre']['prenom'] . ' ' . $_SESSION['membre']['nom']; ?></h2>
    </div>
    <div class="container mt-4">
        <div class="alert alert-info text-center">Vous trouverez ci-dessous vos informations personnel</div>
        <table class="table table-bordered mt-4 text-center">
            <thead>
                <tr>
                    <th scope="col">Pseudo</th> 
                    <th scope="col">Email</th> 
                    <th scope="col">Adresse</th> 
                    <th scope="col">Code Postal</th> 
                    <th scope="col">Ville</th> 
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $_SESSION['membre']['pseudo']; ?></td>
                    <td><?= $_SESSION['membre']['email']; ?></td>
                    <td><?= $_SESSION['membre']['adresse']; ?></td>
                    <td><?= $_SESSION['membre']['code_postal']; ?></td>
                    <td><?= $_SESSION['membre']['ville']; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php require_once "inc/bas.inc.php";