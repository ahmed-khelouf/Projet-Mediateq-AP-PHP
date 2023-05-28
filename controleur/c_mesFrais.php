<?php
if(!isset($_SESSION['mailU'])){ 
    header('location: ?action=defaut');
}

$titre = "Frais - Mediateq";

$vues = array(); 

// Recupération de l'objet étudiant
if(isset($_SESSION['mailU'])){
    $abonneManager = new abonneManager();
    $abonne = $abonneManager->getUtilisateurByMailU($_SESSION['mailU']);
}

// Récupération des objets Emprunts d'exemplaires et Emprunts de parutions (seulement les éléments non-archivés)
$empruntManager = new EmpruntExemplaireManager();
$emprunts = $empruntManager->getListOverdue();

$empruntParutionManager = new EmpruntParutionManager();
$empruntsParution = $empruntParutionManager->getListOverdue();

$reservationsExemplaires = [];
$reservationsParutions = [];

if (isset($_POST['payer_frais'])) {

    $abonneManager->payerFrais($abonne);
    header('location: index.php?action=mesFrais');
}

$frais_retard = $abonne->getFrais();

array_push($vues, "$racine/vue/v_mesFrais.php");
array_push($vues, "$racine/vue/v_mesPrets.php");

// appel du script de vue qui permet de gerer l'affichage des donnees
include "$racine/vue/header.php";
foreach($vues as $vue){
    include $vue;
}
include "$racine/vue/footer.php";
?>