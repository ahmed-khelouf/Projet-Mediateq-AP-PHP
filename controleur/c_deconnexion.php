<?php 

$connexionManager = new ConnexionManager();
$connexionManager->logout();

include "$racine/vue/header.php";
include "$racine/vue/v_connexion.php";
include "$racine/vue/footer.php";

?>