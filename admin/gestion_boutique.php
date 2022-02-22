<?php 
require_once "../inc/init.inc.php";
//------------------------------------- VERIFICATION CONNEXION -----------------------------//
if(!internauteEstConnecteEtEstAdmin())
{
    header("location: ../connexion.php");
    exit();
}
//------------------------------------- ENREGISTREMENT PRODUIT -----------------------------//
if(!empty($_POST))
{
    $photo_bdd = "";
    if(!empty($_FILES['photo']['name']))
    {
        $nom_photo = $_POST['reference'] . '_' . $_FILES['photo']['name'];
        $photo_bdd = RACINE_SITE . "photo/$nom_photo";
        $photo_dossier = $_SERVER['DOCUMENT_ROOT'] . RACINE_SITE . "/photo/$nom_photo";
        copy($_FILES['photo']['tmp_name'], $photo_dossier);
    }
    foreach($_POST AS $indice => $valeur)
    {
        $_POST[$indice] = htmlentities(addslashes($valeur));
    }
    executeRequete("INSERT INTO produit (id_produit, reference, categorie, titre, description, couleur, taille, public, photo, prix, stock) VALUES ('', '$_POST[reference]', '$_POST[categorie]', '$_POST[titre]', '$_POST[description]', '$_POST[couleur]', '$_POST[taille]', '$_POST[public]', '$photo_bdd', '$_POST[prix]', '$_POST[stock]')");
    $contenu .= '<div class="alert alert-success text-center" role="alert">✅ Votre produit à bien été enregistré en base de données !</div>';
}
//------------------------------------- AFFICHAGE HTML ------------------------------------//
require_once "../inc/haut.inc.php";
echo $contenu;
?>


<div class="jumbotron text-center">
    <h2>Gestion des produits</h2>
</div>

<form action="" method="post" enctype="multipart/form-data">

    <div class="mb-3">
        <label for="reference" class="form-label">Référence</label>
        <input type="text" class="form-control" name="reference" id="reference" placeholder="Lé référence du produit">
    </div>
    <div class="mb-3">
        <label for="categorie" class="form-label">Catégorie</label>
        <input type="text" class="form-control" name="categorie" id="categorie" placeholder="La catégorie du produit">
    </div>
    <div class="mb-3">
        <label for="titre" class="form-label">Titre</label>
        <input type="text" class="form-control" name="titre" id="titre" placeholder="Le titre du produit">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="La description du produit"></textarea>
    </div>
    <div class="mb-3">
        <label for="couleur" class="form-label">Couleur</label>
        <input type="text" class="form-control" name="couleur" id="couleur" placeholder="La couleur du produit">
    </div>
    <div class="mb-3">
        <label for="taille" class="form-label">Taille</label>
        <select name="taille" id="taille" class="form-select">
            <option selected>Choisir une taille</option>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
        </select>    
    </div>
    <div class="mb-3">
        <label for="public" class="form-label">Public</label><br>
        <input type="radio" name="public" value="m"> Homme <br>
        <input type="radio" name="public" value="f"> Femme <br>
        <input type="radio" name="public" value="mixte"> Mixte  
    </div>
    <div class="mb-3">
        <label for="photo" class="form-label">Photo</label>
        <input type="file" class="form-control" name="photo" id="photo">
    </div>
    <div class="mb-3">
        <label for="prix" class="form-label">Prix</label>
        <input type="text" class="form-control" name="prix" id="prix" placeholder="Le prix du produit">
    </div>
    <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="text" class="form-control" name="stock" id="stock" placeholder="Le stock disponible pour ce produit">
    </div>
    <div class="text-center mt-5">
        <button type="submit" class="btn btn-primary btn-lg">Enregistrer le produit</button>
    </div>
</form>






<?php require_once "../inc/bas.inc.php";