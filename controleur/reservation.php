<?php

$reservationManager = new ReservationManager(); 
$reservations = $reservationManager->getList(); 

$revueManager = new RevueManager();
$revues= $revueManager->getList();

$connexionManager = new ConnexionManager();
$abonneManager = new abonneManager;

if($connexionManager->isLoggedOn()){
$unAbonne = $abonneManager->getUtilisateurByMailU($_SESSION['mailU']);
}

if(isset($_POST['add'])){
    // Ajouter une réservation 
    $idRevue = $_POST['idRevue'];
    $idAbonne = $_POST['idAbonne'];
    $rang = $_POST['rang'];
    $numeroParution = $_POST["numeroParution"];
    $reservationManager->addReservation($idRevue , $idAbonne , $rang , $numeroParution );    
    header('location: index.php?action=reservation');
}

if(isset($_POST['supr'])){
    // Supression d'une réservation
    $idR = $_POST['idR'];
    $idRevue = $_POST['id'];
    $rang = $_POST['rang'];
    $numeroParution = $_POST["numeroParution"];
    $reservationManager ->supReservation($idR, $idRevue, $rang  , $numeroParution);
    header('location: index.php?action=reservation');
}

include "$racine/vue/header.php";
include "$racine/vue/vueReservation.php";
include "$racine/vue/footer.php";

?>