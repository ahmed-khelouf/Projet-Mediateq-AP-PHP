<?php
if(!isset($_SESSION['mailU'])){ 
    header('location: ?action=defaut');
}

$titre = "Nouveautés - Catalogue - Mediateq";

$vues = array(); // tableau des vues à appeler
//array_push($vues, "$racine/vue/v_mesPretsEnCours.php");
//array_push($vues, "$racine/vue/v_nouveautes.php");
//var_dump($_SESSION);

if(isset($_SESSION['mailU'])){
    $abonneManager = new abonneManager();
    $abonne = $abonneManager->getUtilisateurByMailU($_SESSION['mailU']);
}

$empruntManager = new EmpruntManager();

//var_dump($empruntManager);
$emprunts = $empruntManager->getList();
//var_dump($emprunts);

array_push($vues, "$racine/vue/v_mesPretsEnCours.php");

// appel du script de vue qui permet de gerer l'affichage des donnees
include "$racine/vue/header.php";
foreach($vues as $vue){
    include $vue;
}
include "$racine/vue/footer.php";
?>