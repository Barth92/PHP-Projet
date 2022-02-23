<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= RACINE_SITE; ?>inc/css/style.css">
    <title>Document</title>
</head>
<body>

    <header>
        <div class="conteneur">
            <span>
                <a href="<?= RACINE_SITE . 'index.php'; ?>" title="Mon Site">Monsite.com</a>
            </span>
            <nav>
                <?php
                if(internauteEstConnecteEtEstAdmin())
                {
                    echo '<a href="' . RACINE_SITE . 'admin/gestion_membre.php">Gestion des membres</a>';
                    echo '<a href="' . RACINE_SITE . 'admin/gestion_commande.php">Gestion des commandes</a>';
                    echo '<a href="' . RACINE_SITE . 'admin/gestion_boutique.php">Gestion des produits</a>';
                }
                
                if(internauteEstConnecte())
                {
                    echo '<a href="' . RACINE_SITE . 'profil.php">Profil</a>';
                    echo '<a href="' . RACINE_SITE . 'panier.php">Panier</a>';
                    echo '<a href="' . RACINE_SITE . 'connexion.php?action=deconnexion">Se déconnecter</a>';
                }
                else
                {
                    echo '<a href="' . RACINE_SITE . 'index.php">Accueil</a>';
                    echo '<a href="' . RACINE_SITE . 'inscription.php">Inscription</a>';
                    echo '<a href="' . RACINE_SITE . 'connexion.php">Connexion</a>';
                    echo '<a href="' . RACINE_SITE . 'panier.php">Panier</a>';    
                }
                ?>
            </nav>
        </div>
    </header>
    <section>
        <div class="conteneur">








