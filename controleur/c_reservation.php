<?php
//Titre de la page
$titre = "Réservation - Mediateq";

//Création d'un objet manager de reservationExemplaire
$reservationExemplaireManager = new ReservationExemplaireManager();
$reservationsExemplairesLivres = $reservationExemplaireManager->getListLivres();
$reservationsExemplairesDVD = $reservationExemplaireManager->getListDVD();

//Création d'un objet manager de reservationParution
$reservationParutionManager = new ReservationParutionManager();
$reservationsParutions = $reservationParutionManager->getList();

// Création d'un objet manager de reservation
$reservationManager = new ReservationManager();

//Création d'un objet manager de livre
$livreManager = new LivreManager();
$livres = $livreManager->getList();

//Création d'un objet manager de DVD
$DvdManager = new DvdManager();
$disques = $DvdManager->getList();

//Création d'un objet manager de revue
$revueManager = new RevueManager();
$revues = $revueManager->getList();

//Création d'un objet manager de connexion
$connexionManager = new ConnexionManager();

//Création d'un objet manager de abonne
$abonneManager = new abonneManager();
$abo = $abonneManager->getList();

//Création d'un objet manager de historiqueParution
$historiqueParutionManager = new HistoriqueParutionManager();

//Création d'un objet manager de historiqueExemplaire
$historiqueExemplaireManager = new HistoriqueExemplaireManager();

//Vérifie si un utilisateur est connecté et récupère les informations de l'utilisateur connecté
if ($connexionManager->isLoggedOn()) {
    $unAbonne = $abonneManager->getUtilisateurByMailU($_SESSION['mailU']);
}

//Permet d'ajouter une nouvelle réservation d'exemplaire
if (isset($_POST['add'])) {
    $idDoc = $_POST['idDoc'];
    $idAbonne = $_POST['idAbonne'];
    $rang = $_POST['rang'];
    $numeroExemplaire = $_POST["numeroExemplaire"];
    $reservationExemplaireManager->addReservation($idDoc, $idAbonne, $rang, $numeroExemplaire);
    $historiqueExemplaireManager->addHistorique($idAbonne , $idDoc , $numeroExemplaire);
    header('location: index.php?action=reservation');
}

//Permet de supprimer une réservation d'exemplaire
if (isset($_POST['supr'])) {
    $idR = $_POST['idR'];
    $idDoc = $_POST['idDoc'];
    $rang = $_POST['rang'];
    $numeroExemplaire = $_POST["numeroExemplaire"];
    $reservationExemplaireManager->supReservation($idR, $idDoc, $rang, $numeroExemplaire);
    header('location: index.php?action=reservation');
}

//Permet d'ajouter une nouvelle réservation de parution
if (isset($_POST['addRevue'])) {
    $idRevue = $_POST['idRevue'];
    $idAbonne = $_POST['idAbonne'];
    $rang = $_POST['rang'];
    $numeroParution = $_POST["numeroParution"];
    $reservationParutionManager->addReservation($idRevue, $idAbonne, $rang, $numeroParution);
    $historiqueParutionManager->addHistorique($idAbonne , $idRevue , $numeroParution);
    header('location: index.php?action=reservation');
}

//Permet de supprimer une réservation de parution
if (isset($_POST['supr'])) {
    $idR = $_POST['idR'];
    $idRevue = $_POST['idRevue'];
    $rang = $_POST['rang'];
    $numeroParution = $_POST["numeroParution"];
    $reservationParutionManager->supReservation($idR, $idRevue, $rang, $numeroParution);
    header('location: index.php?action=reservation');
}

// inclure la vue en lui transmettant les données nécessaires
include "$racine/vue/header.php";
include "$racine/vue/v_reservation.php";
include "$racine/vue/footer.php";
