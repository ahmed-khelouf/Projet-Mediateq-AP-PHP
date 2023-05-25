<?php

$titre = "Recherche Avancée - Catalogue - Mediateq";

$vues = array(); 

array_push($vues, "$racine/vue/v_rechercheAvancee.php");

// appel du script de vue qui permet de gerer l'affichage des donnees
include "$racine/vue/header.php";
foreach($vues as $vue){
    include $vue;
}
include "$racine/vue/footer.php";
?>

