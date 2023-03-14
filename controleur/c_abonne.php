<?php
 $titre="monDossier";
 include "$racine/vue/header.php";

 $abonneManager = new abonneManager(); // Création d'un objet manager de abonnés
 $unAbonne = $abonneManager->getUtilisateurByMailU($_SESSION['mailU']); // Appel d'une fonction de cet objet
 


var_dump($unAbonne);

var_dump($_POST);

  $abonneManager= new AbonneManager;

  

  

include "$racine/vue/v_monDossier.php";
include "$racine/vue/footer.php";