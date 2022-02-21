<?php

//-------------------- BDD
$mysqli = new mysqli("localhost", "root", "", "site");
if($mysqli->connect_error)
{
    die('Un problème est survenu lors de la tentative de connexion à la base de données : ' . $mysqli->connect_error);
}

//-------------------- SESSION
session_start();

//-------------------- CHEMIN
define("RACINE_SITE", "/site/");

//-------------------- VARIABLE
$contenu = '';

//-------------------- AUTRES INCLUSIONS
require_once "fonction.inc.php";