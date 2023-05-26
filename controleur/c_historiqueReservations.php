<?php
// Titre de la page
$titre = "Historique des réservations - Mediateq";

// Création d'un objet manager de connexion
$connexionManager = new ConnexionManager;

// Création d'un objet manager de HistoriqueExemplaire
$historiqueExemplaireManager = new HistoriqueExemplaireManager;
$historiqueDVD = $historiqueExemplaireManager->getListDVD();
$historiqueLivre = $historiqueExemplaireManager->getListLivres();


// Création d'un objet manager de HistoriqueParution
$historiqueParutionManager = new HistoriqueParutionManager;
$historiqueParution = $historiqueParutionManager->getList();


//Création d'un objet manager de abonne
$abonneManager = new abonneManager;

//Vérifie si un utilisateur est connecté et récupère les informations de l'utilisateur connecté
if ($connexionManager->isLoggedOn()) {
    $unAbonne = $abonneManager->getUtilisateurByMailU($_SESSION['mailU']);
}

// Création d'un objet manager de historique
$HistoriqueManager = new HistoriqueManager();
$nbHistorique = $HistoriqueManager->nombreHistorique($unAbonne->getId());


// inclure la vue en lui transmettant les données nécessaires
include "$racine/vue/header.php";
include "$racine/vue/v_historiqueReservations.php";
include "$racine/vue/footer.php";
