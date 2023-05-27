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

$frais_retard = $empruntManager->getFraisDeRetard($abonne->getId());
$frais_retard += $empruntParutionManager->getFraisDeRetard($abonne->getId());

array_push($vues, "$racine/vue/v_mesFrais.php");
array_push($vues, "$racine/vue/v_mesPrets.php");

// appel du script de vue qui permet de gerer l'affichage des donnees
include "$racine/vue/header.php";
foreach($vues as $vue){
    include $vue;
}
include "$racine/vue/footer.php";
?>