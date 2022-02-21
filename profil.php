<?php


$mdp = password_hash('Admin', PASSWORD_DEFAULT);
echo $mdp . '<br><br>';



$hash = $mdp;


if(password_verify('Admin', $hash))
{
    echo 'Le mot de passe est valide';
}
else
{
    echo 'Le mot de passe est invalide';
}