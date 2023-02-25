<?php


include "$racine/vue/header.php";

$connexionManager = new ConnexionManager();

$abonneManager = new abonneManager();
$abonnes = $abonneManager->getList();


// recuperation des donnees GET, POST, et SESSION
if (isset($_POST["mailU"]) && isset($_POST["mdpU"])){
    $mailU=$_POST["mailU"];
    $mdpU=$_POST["mdpU"];
    $connexionManager->login($mailU,$mdpU);
}


if(isset($_SESSION['mailU'])){
    include "$racine/vue/v_accueil.php";
}else{
    include "$racine/vue/vueConnexion.php";
}



include "$racine/vue/footer.php";


?>