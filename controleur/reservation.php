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
    $reservationManager->addReservation($idRevue , $idAbonne , $rang );

    // Modification du rang apres avoir ajouté une nouvelle réservation
    // $id = $_POST['id'];
    // $rang = $_POST['reservationRang'];
    // $revueManager ->updateRangReservation($id , $rang);
    
    header('location: index.php?action=reservation');
}

if(isset($_POST['supr'])){
    // Supression d'une réservation
    $id = $_POST['idR'];
    $reservationManager ->supReservation($id);

    // Modification du rang apres avoir supprimé une réservation
    $id = $_POST['id'];
    $rang = $_POST['reservationRang'];
    $revueManager ->updateRangReservationMoins($id , $rang);

    header('location: index.php?action=reservation');
}

include "$racine/vue/header.php";
include "$racine/vue/vueReservation.php";
include "$racine/vue/footer.php";

?>