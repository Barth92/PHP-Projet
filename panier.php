<?php
require_once 'inc/init.inc.php';
//------------------------------------- AJOUT PANIER ----------------------------------------//
if(isset($_POST['ajout_panier']))
{
    $resultat = executeRequete("SELECT * FROM produit WHERE id_produit = '$_POST[id_produit]'");
    $produit = $resultat->fetch_assoc();
    ajouterProduitDansPanier($produit['titre'], $_POST['id_produit'], $_POST['quantite'], $produit['prix']);
}
//------------------------------------- VIDER PANIER ---------------------------------------//
if(isset($_GET['action']) && $_GET['action'] == "vider")
{
    unset($_SESSION['panier']);
}
//------------------------------------- PAIEMENT -------------------------------------------//
if(isset($_POST['payer']))
{
    for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
    {
        $resultat = executeRequete("SELECT * FROM produit WHERE id_produit=" . $_SESSION['panier']['id_produit'][$i]);
        $produit = $resultat->fetch_assoc();
        if($produit['stock'] < $_SESSION['panier']['quantite'][$i])
        {
            $contenu .= '<hr><div class="alert alert-warning" role="alert">⚠ Stock Restant : ' . $produit['stock'] . '</div>';
            $contenu .= '<div class="alert alert-warning" role="alert">⚠ Quantite demandée : ' . $_SESSION['panier']['quantite'][$i] . '</div>';
            if($produit['stock'] > 0)
            {
                $contenu .= '<div class="alert alert-info" role="alert">⚠ La quantité du produit ' . $_SESSION['panier']['id_produit'][$i] . ' à été réduite car notre stock était insuffisant, veuillez vérifier vos achats.</div>';
                $_SESSION['panier']['quantite'][$i] = $produit['stock'];
            }
            else
            {
                $contenu .= '<div class="alert alert-info" role="alert">⚠ Le produit ' . $_SESSION['panier']['id_produit'][$i] . ' à été retiré de votre panier car nous sommes en rupture de stock, veuillez vérifier vos achat. </div>';
                retirerProduitDuPanier($_SESSION['panier']['id_produit'][$i]);
                $i--;
            }
            $erreur = true;
        }
    }
    if(!isset($erreur))
    {
        executeRequete("INSERT INTO commande (id_membre, montant, date_enregistrement) VALUES (". $_SESSION['membre']['id_membre'] . "," . montantTotal() . ", NOW())");
        $id_commande = $mysqli->insert_id;
        for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
        {
            executeRequete("INSERT INTO details_commande (id_commande, id_produit, quantite, prix) VALUES ($id_commande, " . $_SESSION['panier']['id_produit'][$i] . "," . $_SESSION['panier']['quantite'][$i] . "," . $_SESSION['panier']['prix'][$i] . ")");
        }
        unset($_SESSION['panier']);
        $contenu .= "<div class='alert alert-success text-center' role='alert'>Merci pour votre commande. Votre numéro de suivi est le n° $id_commande</div>";
    }
}
//------------------------------------- AFFICHAGE HTML -------------------------------------//
require_once 'inc/haut.inc.php';
echo $contenu;
echo "<table class='table table-bordered text-center mt-5'>";
echo "<tr><td colspan='6'>Panier</td></tr>";
echo "<tr><th>Titre</th><th>Produit</th><th>Quantité</th><th>Prix unitaire</th><th>Action</th></tr>";
if(empty($_SESSION['panier']['id_produit']))
{
    echo "<tr><td colspan='6'>Votre panier est vide</td></tr>";
}
else
{
    for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
    {
        echo "<tr>";
            echo "<td>" . $_SESSION['panier']['titre'][$i] . "</td>";
            echo "<td>" . $_SESSION['panier']['id_produit'][$i] . "</td>";
            echo "<td>" . $_SESSION['panier']['quantite'][$i] . "</td>";
            echo "<td>" . $_SESSION['panier']['prix'][$i] . "</td>";
            echo "<td>Retirer</td>";
        echo "</tr>";
    }
    echo "<tr><th colspan='4'>Total</th><td colspan='2'>" . montantTotal() . " €</td></tr>";
    if(internauteEstConnecte())
    {
        echo '<form method="post" action="">';
        echo '<tr><td colspan="6"><input class="btn btn-success" type="submit" name="payer" value="Valider le paiement"></td></tr>';
        echo '</form>';
    }
    else
    {
        echo '<tr><td colspan="6">Veuillez vous <a class="btn btn-primary" href="inscription.php">inscrire</a> ou vous <a class="btn btn-primary" href="connexion.php">connecter</a> afin de pouvoir finaliser votre commande </td></tr>';
    }
    echo "<tr><td colspan='6'><a class='btn btn-danger' href='?action=vider'>Vider mon panier</a></td></tr>";
}
echo "<table><br>";
echo "<i>Règlement par CHEQUE uniquement à l'adresse suivante : 300 rue de vaugirard 75012 PARIS</i><br>";
echo "<hr>Session panier : <br>"; debug($_SESSION);
debug($_POST);


require_once 'inc/bas.inc.php';