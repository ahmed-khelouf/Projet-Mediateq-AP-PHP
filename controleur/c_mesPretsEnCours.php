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

// Récupération des objets Emprunts d'exemplaires et Emprunts de parutions (seulement les éléments non-archivés)
$empruntManager = new EmpruntExemplaireManager();
$empruntParutionManager = new EmpruntParutionManager();

$reservationManager = new reservationExemplaireManager();
$reservationParutionManager = new reservationParutionManager();

$reservationsExemplaires = array_merge($reservationManager->getListLivres(), $reservationManager->getListDVD());
$reservationsParutions = $reservationParutionManager->getList();

if (isset($_POST['prolong_doc'])) {
    $idEmprunt = $_POST['idEmprunt'];

    $empruntManager->prolongerEmprunt($idEmprunt);
    header('location: index.php?action=mesPretsEnCours');
}

if (isset($_POST['prolong_paru'])) {
    $idEmprunt = $_POST['idEmprunt'];

    $empruntParutionManager->prolongerEmprunt($idEmprunt);
    header('location: index.php?action=mesPretsEnCours');
}

if (isset($_POST['prolong_all'])) {

    $empruntManager->prolongerToutEmprunt($abonne);
    $empruntParutionManager->prolongerToutEmprunt($abonne);
    header('location: index.php?action=mesPretsEnCours');
}

$emprunts = $empruntManager->getListActual();
$empruntsParution = $empruntParutionManager->getListActual();


array_push($vues, "$racine/vue/v_mesPretsEnCours.php");
array_push($vues, "$racine/vue/v_mesPrets.php");

// appel du script de vue qui permet de gerer l'affichage des donnees
include "$racine/vue/header.php";
foreach($vues as $vue){
    include $vue;
}
include "$racine/vue/footer.php";
?>