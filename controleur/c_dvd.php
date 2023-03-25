<?php

// Création d'un objet manager de abonne
$abonneManager = new abonneManager;
$abo = $abonneManager->getList();

// Création d'un objet manager de reservation
$reservationExemplaireManager = new ReservationExemplaireManager;

// Création d'un objet manager de connexion
$connexionManager = new ConnexionManager;

// Récupérer l'ID du document à afficher à partir de la variable $_GET
$idDoc = $_GET['id'];

// Création d'un objet manager de dvd
$dvdManager = new DvdManager();

// Récupérer les données de la revue à afficher à partir de l'ID récupéré avec la méthode "getDvdById()" de la classe "DvdManager"
$unDvd = $dvdManager->getDvdById($idDoc);

// inclure la vue en lui transmettant les données nécessaires
include "$racine/vue/header.php";
include "$racine/vue/v_dvd.php";
include "$racine/vue/footer.php";

?>