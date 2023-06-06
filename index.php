<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "getRacine.php";
include "$racine/controleur/controleurPrincipal.php";
chargerModeles($racine);

if (isset($_GET["action"])){
    $action = $_GET["action"];
}
else{
    $action = "defaut";
}

$fichier = controleurPrincipal($action);
include "$racine/controleur/$fichier";
?>
     