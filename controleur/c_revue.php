<?php
// Titre de la page
$titre = "Revue - Mediateq";

// Création d'un objet manager de abonne
$abonneManager = new abonneManager;
$abo = $abonneManager->getList();

// Création d'un objet manager de reservation
$reservationManager = new ReservationParutionManager;

// Création d'un objet manager de connexion
$connexionManager = new ConnexionManager;

// Récupérer l'ID de la revue à afficher à partir de la variable $_GET
$idRevue = $_GET['id'];

// Création d'un objet manager de revue
$revueManager = new RevueManager();

// Récupérer les données de la revue à afficher à partir de l'ID récupéré avec la méthode "getRevueById()" de la classe "RevueManager"
$uneRevue = $revueManager->getRevueById($idRevue);

// inclure la vue en lui transmettant les données nécessaires
include "$racine/vue/header.php";
include "$racine/vue/v_revue.php";
include "$racine/vue/footer.php";
