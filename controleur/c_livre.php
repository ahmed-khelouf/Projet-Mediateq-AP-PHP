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

// Création d'un objet manager de livre
$livreManager = new LivreManager();

// Récupérer les données de la revue à afficher à partir de l'ID récupéré avec la méthode "getLivreById()" de la classe "LivreManager"
$unLivre = $livreManager->getLivreById($idDoc);

// inclure la vue en lui transmettant les données nécessaires
include "$racine/vue/header.php";
include "$racine/vue/v_livre.php";
include "$racine/vue/footer.php";

?>