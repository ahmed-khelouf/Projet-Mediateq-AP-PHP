<?php

//incluson du fichier
include 'config.php';


//Création d'un objet manager de logs
$logsManager = new LogsManager();

// Création d'un objet manager de abonne
$abonneManager = new abonneManager();

// Si l'utilisateur est connecté, récupérez ses informations à partir de la session
if (isset($_SESSION['mailU'])) {
    $unAbonne = $abonneManager->getUtilisateurByMailU($_SESSION['mailU']);
}

$titre = "FAQ- Catalogue - Mediateq";

//appel de la fonction qui logs en bdd
if (defined('LOGS_ENABLED') && LOGS_ENABLED && isset($_SESSION['mailU'])) {
    $idAbonne = $unAbonne->getId();
    $pageConsultee = $titre; // Utilisez la variable $titre actuelle pour obtenir le nom de la page consultée
    $dateConsultation = date('Y-m-d H:i:s');
    $logsManager->logPageConsultee($idAbonne, $pageConsultee, $dateConsultation);
}






// appel du script de vue qui permet de gerer l'affichage des donnees
include "$racine/vue/header.php";
include "$racine/vue/v_faq.php";
include "$racine/vue/footer.php";


?>

