<?php
if(!isset($_SESSION['mailU'])){ 
    header('location: ?action=defaut');
}

$titre = "Nouveautés - Catalogue - Mediateq";

$vues = array(); 

// Recupération de l'objet étudiant
if(isset($_SESSION['mailU'])){
    $abonneManager = new abonneManager();
    $abonne = $abonneManager->getUtilisateurByMailU($_SESSION['mailU']);
}

// Récupération des objets Emprunts d'exemplaires et Emprunts de parutions
$empruntManager = new EmpruntExemplaireManager();
$emprunts = $empruntManager->getList();

$empruntParutionManager = new EmpruntParutionManager();
$empruntsParution = $empruntParutionManager->getList();

array_push($vues, "$racine/vue/v_mesPretsHistorique.php");

// appel du script de vue qui permet de gerer l'affichage des donnees
include "$racine/vue/header.php";
foreach($vues as $vue){
    include $vue;
}
include "$racine/vue/footer.php";
?>