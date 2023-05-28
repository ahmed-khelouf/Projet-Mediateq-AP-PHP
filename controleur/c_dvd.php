<?php
//inclusion du fichier config.php
include 'config.php';

// Titre de la page
$titre = "DVD - Mediateq";

//Création d'un objet manager de logs
$logsManager = new LogsManager();

// Création d'un objet manager de abonne
$abonneManager = new abonneManager;
$abo = $abonneManager->getList();

// Création d'un objet manager de reservation
$reservationExemplaireManager = new ReservationExemplaireManager;

// Création d'un objet manager de reservation
$reservationManager = new ReservationManager();

// Création d'un objet manager de connexion
$connexionManager = new ConnexionManager;

// Récupérer l'ID du document à afficher à partir de la variable $_GET
$idDoc = $_GET['id'];

// Création d'un objet manager de dvd
$dvdManager = new DvdManager();

// Récupérer les données de la revue à afficher à partir de l'ID récupéré avec la méthode "getDvdById()" de la classe "DvdManager"
$unDvd = $dvdManager->getDvdById($idDoc);

// Si l'utilisateur est connecté, récupérez ses informations à partir de la session
if (isset($_SESSION['mailU'])) {
    $unAbonne = $abonneManager->getUtilisateurByMailU($_SESSION['mailU']);
}

//appel de la fonction qui logs en bdd
if (defined('LOGS_ENABLED') && LOGS_ENABLED && isset($_SESSION['mailU'])) {
    $idAbonne = $unAbonne->getId();
    $pageConsultee = $titre; // Utilisez la variable $titre actuelle pour obtenir le nom de la page consultée
    $dateConsultation = date('Y-m-d H:i:s');
    $logsManager->logPageConsultee($idAbonne, $pageConsultee, $dateConsultation);
}

// inclure la vue en lui transmettant les données nécessaires
include "$racine/vue/header.php";
include "$racine/vue/v_dvd.php";
include "$racine/vue/footer.php";
