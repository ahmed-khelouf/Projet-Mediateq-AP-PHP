<?php
//Création d'un objet manager de reservation
$reservationManager = new ReservationParutionManager(); 
$reservations = $reservationManager->getList();

//Création d'un objet manager de revue
$revueManager = new RevueManager();
$revues= $revueManager->getList();

//Création d'un objet manager de connexion
$connexionManager = new ConnexionManager();

//Création d'un objet manager de abonne
$abonneManager = new abonneManager();
$abo = $abonneManager->getList();

//Vérifie si un utilisateur est connecté et récupère les informations de l'utilisateur connecté
if($connexionManager->isLoggedOn()){
$unAbonne = $abonneManager->getUtilisateurByMailU($_SESSION['mailU']);
}

//Permet d'ajouter une nouvelle réservation de parution
if(isset($_POST['add'])){
    $idRevue = $_POST['idRevue'];
    $idAbonne = $_POST['idAbonne'];
    $rang = $_POST['rang'];
    $numeroParution = $_POST["numeroParution"];
    $reservationManager->addReservation($idRevue , $idAbonne , $rang , $numeroParution);    
    header('location: index.php?action=reservation');
}

//Permet de supprimer une réservation de parution
if(isset($_POST['supr'])){
    $idR = $_POST['idR'];
    $idRevue = $_POST['id'];
    $rang = $_POST['rang'];
    $numeroParution = $_POST["numeroParution"];
    $reservationManager ->supReservation($idR, $idRevue, $rang  , $numeroParution);
    header('location: index.php?action=reservation');
}

// inclure la vue en lui transmettant les données nécessaires
include "$racine/vue/header.php";
include "$racine/vue/v_reservation.php";
include "$racine/vue/footer.php";

?>