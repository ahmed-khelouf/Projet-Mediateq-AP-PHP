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
    $reservationManager->addReservation($idRevue , $idAbonne );

    // Modification du rang apres avoir ajouté un nouvelle réservation
    $id = $_POST['id'];
    $rang = $_POST['reservationRang'];
    $revueManager ->updateRangReservation($id , $rang);
    
    echo "La reservation bien été ajoutée";
}

if(isset($_POST['supr'])){
    $id = $_POST['idR'];
    $reservationManager ->supReservation($id);

    $id = $_POST['id'];
    $rang = $_POST['reservationRang'];
    $revueManager ->updateRangReservationMoins($id , $rang);

    echo "La reservation est sup";
}



include "$racine/vue/header.php";
include "$racine/vue/vueReservation.php";
include "$racine/vue/footer.php";
