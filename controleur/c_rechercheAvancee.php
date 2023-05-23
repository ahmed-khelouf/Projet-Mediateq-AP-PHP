

<?php

$titre = "Recherche - Catalogue - Mediateq";

$vues = array(); // tableau des vues à appeler

// LIVRE
if (isset($_POST['rechercheAvancee'])) {
    // Récupération des valeurs des champs de recherche
    $texte = htmlentities($_POST['searchText']);
    $typeDoc = htmlentities($_POST['searchType']);
    $typeDoc2 = htmlentities($_POST['searchType2']);
    $option2 = htmlentities($_POST['searchOption2']);
    $texte2 = htmlentities($_POST['searchText2']);
    $typeDoc3 = htmlentities($_POST['searchType3']);
    $option3 = htmlentities($_POST['searchOption3']);
    $texte3 = htmlentities($_POST['searchText3']);

    // Construction de la chaîne de recherche
    $recherche = "Recherche des livres contenant \"" . $texte . "\"";

    // Appel à la méthode de recherche avancée de livres
    $livreManager = new livreManager();
    $livres = $livreManager->getLivreCritereAvancee($texte, $typeDoc, $option2, $texte2, $typeDoc2, $option3, $texte3, $typeDoc3);
    
    // Ajout de la vue de résultat de recherche à la liste des vues
    array_push($vues, "$racine/vue/v_resultatRechercheSimpleLivre.php");
   
} else {
    // Ajout de la vue de recherche avancée à la liste des vues
    array_push($vues, "$racine/vue/v_rechercheAvancee.php");
}

// DVD 
if (isset($_POST['rechercheAvancee'])) {
    // Récupération des valeurs des champs de recherche
    $texte = htmlentities($_POST['searchText']);
    $typeDoc = htmlentities($_POST['searchType']);
    $typeDoc2 = htmlentities($_POST['searchType2']);
    $option2 = htmlentities($_POST['searchOption2']);
    $texte2 = htmlentities($_POST['searchText2']);
    $typeDoc3 = htmlentities($_POST['searchType3']);
    $option3 = htmlentities($_POST['searchOption3']);
    $texte3 = htmlentities($_POST['searchText3']);

    // Construction de la chaîne de recherche
    $recherche = "Recherche des dvd contenant \"" . $texte . "\"";

    $dvdManager = new dvdManager();
    $disques = $dvdManager->getDvdCritereAvancee($texte, $typeDoc, $option2, $texte2, $typeDoc2, $option3, $texte3, $typeDoc3);
    
    // Ajout de la vue de résultat de recherche à la liste des vues
    array_push($vues, "$racine/vue/v_resultatRechercheSimpleDvd.php");
   
} 

// REVUE
if (isset($_POST['rechercheAvancee'])) {
    // Récupération des valeurs des champs de recherche
    $texte = htmlentities($_POST['searchText']);
    $typeDoc = htmlentities($_POST['searchType']);
    $typeDoc2 = htmlentities($_POST['searchType2']);
    $option2 = htmlentities($_POST['searchOption2']);
    $texte2 = htmlentities($_POST['searchText2']);
    $typeDoc3 = htmlentities($_POST['searchType3']);
    $option3 = htmlentities($_POST['searchOption3']);
    $texte3 = htmlentities($_POST['searchText3']);

    // Construction de la chaîne de recherche
    $recherche = "Recherche des dvd contenant \"" . $texte . "\"";

    $revueManager = new RevueManager();
    $revues = $revueManager->getRevueCritereAvancee($texte, $typeDoc, $option2, $texte2, $typeDoc2, $option3, $texte3, $typeDoc3);
    
    // Ajout de la vue de résultat de recherche à la liste des vues
    array_push($vues, "$racine/vue/v_resultatRechercheSimpleRevue.php");
   
} 

// appel du script de vue qui permet de gérer l'affichage des données
include "$racine/vue/header.php";
foreach ($vues as $vue) {
    include $vue;
}



include "$racine/vue/footer.php";
?>
