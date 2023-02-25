<?php 

include "$racine/vue/header.php";


$connexionManager = new ConnexionManager();
 $connexionManager->logout();

 include "$racine/vue/vueConnexion.php";
include "$racine/vue/footer.php";