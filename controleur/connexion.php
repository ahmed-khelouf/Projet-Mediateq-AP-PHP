<?php

$connexionManager = new ConnexionManager();
$dateConnexionManager = new DateConnexionManager();

$abonneManager = new abonneManager();
$abonnes = $abonneManager->getList();


// recuperation des donnees GET, POST, et SESSION
if (isset($_POST["mailU"]) && isset($_POST["mdpU"])){
    $mailU=$_POST["mailU"];
    $mdpU=$_POST["mdpU"];
    $connexionManager->login($mailU,$mdpU);
    if ($connexionManager->isLoggedOn()){
        $abo = new abonneManager();
        $idUtilisateur = $abonneManager->getUtilisateurByMailU($mailU);
        var_dump($idUtilisateur->getId());

        $dateConnexion = date('Y-m-d H:i:s');
        $dateConnexionManager-> historiserConnexion($idUtilisateur->getId(), $dateConnexion);
    }
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
    
    include "$racine/controleur/c_abonne.php"; 
        
        
    }
?>
