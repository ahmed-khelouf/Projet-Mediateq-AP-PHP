<?php

$connexionManager = new ConnexionManager();

$abonneManager = new abonneManager();
$abonnes = $abonneManager->getList();

$empruntManager = new EmpruntExemplaireManager();
$empruntParutionManager = new EmpruntParutionManager();


// recuperation des donnees GET, POST, et SESSION
if (isset($_POST["mailU"]) && isset($_POST["mdpU"])){
    $mailU=$_POST["mailU"];
    $mdpU=$_POST["mdpU"];
    $connexionManager->login($mailU,$mdpU);
}


if(isset($_SESSION['mailU'])){
    include "$racine/vue/v_accueil.php";
}else{
    include "$racine/vue/header.php";
    include "$racine/vue/vueConnexion.php";
    include "$racine/vue/footer.php";
}


// ATTENDRE QUE PAGE PROFIL -> JULIEN
if ($connexionManager->isLoggedOn()){ // si l'utilisateur est connecté on redirige vers le controleur monProfil
    
    $empruntManager->updateFraisDeRetard();
    $empruntParutionManager->updateFraisDeRetard();
    
    include "$racine/controleur/reservation.php"; 
        
        
    }



?>