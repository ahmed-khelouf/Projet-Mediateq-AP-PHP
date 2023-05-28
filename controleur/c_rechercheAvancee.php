<?php

$titre = "Recherche - Catalogue - Mediateq";

$vues = array(); // tableau des vues à appeler

// Création d'un objet manager de connexion
$connexionManager = new ConnexionManager;

// variable message à vide 
$message = "";

if (isset($_POST['rechercheAvancee'])) {
    // Récupération des valeurs des champs de recherche
    $texte = htmlspecialchars($_POST['searchText']); // htmlspecialchars permet de sécuriser les données rentrées par l'utilisateur (évite les injections de code)
    $typeDoc = htmlentities($_POST['searchType']);
    $typeDoc2 = htmlentities($_POST['searchType2']);
    $option2 = htmlentities($_POST['searchOption2']);
    $texte2 = htmlspecialchars($_POST['searchText2']);
    $typeDoc3 = htmlentities($_POST['searchType3']);
    $option3 = htmlentities($_POST['searchOption3']);
    $texte3 = htmlspecialchars($_POST['searchText3']);

    array_push($vues, "$racine/vue/v_resultatRechercheAvancee.php");

    // affichage message de recherche
    if ($texte != null && $texte2 == null && $texte3 == null) {
        $recherche = "Recherche de  $typeDoc contenant \"" . $texte . "\" ";
    } elseif ($texte != null && $texte2 != null && $texte3 == null) {
        $recherche = "Recherche de  $typeDoc  contenant \"" . $texte . "\" $option2  $typeDoc2   contenant \"" . $texte2 . "\" ";
    } elseif ($texte != null && $texte2 != null && $texte3 != null) {
        $recherche = "Recherche de $typeDoc  contenant \"" . $texte . "\" $option2  $typeDoc2   contenant \"" . $texte2 . "\" $option3 $typeDoc3 contenant \"" . $texte3 . "\" ";
    } else {
        $recherche = "Recherche contenant tout ";
    }

    // Appel à la méthode de recherche avancée de livres
    $livreManager = new livreManager();
    $livres = $livreManager->getLivreCritereAvancee($texte, $typeDoc, $option2, $texte2, $typeDoc2, $option3, $texte3, $typeDoc3);

    // Ajout de la vue de résultat de recherche à la liste des vues (utilisation de la meme vue d'affichage que la recherche simple)
    array_push($vues, "$racine/vue/v_resultatRechercheSimpleLivre.php");

    // Appel à la méthode de recherche avancée de dvd
    $dvdManager = new dvdManager();
    $disques = $dvdManager->getDvdCritereAvancee($texte, $typeDoc, $option2, $texte2, $typeDoc2, $option3, $texte3, $typeDoc3);

    // Ajout de la vue de résultat de recherche à la liste des vues (utilisation de la meme vue d'affichage que la recherche simple)
    array_push($vues, "$racine/vue/v_resultatRechercheSimpleDvd.php");

    // Appel à la méthode de recherche avancée de revue
    $revueManager = new RevueManager();
    $revues = $revueManager->getRevueCritereAvancee($texte, $typeDoc, $option2, $texte2, $typeDoc2, $option3, $texte3, $typeDoc3);

    // Ajout de la vue de résultat de recherche à la liste des vues (utilisation de la meme vue d'affichage que la recherche simple)
    array_push($vues, "$racine/vue/v_resultatRechercheSimpleRevue.php");

    $nbRecherche = count($livres) + count($disques) + count($revues);

    // Vérifier si aucun résultat n'a été trouvé
if ($nbRecherche == 0) {
    $message = "Aucun résultat trouvé vérifier l'orthographe ou la combinaison de la recherche.";
}

    //Création d'un objet manager de abonne
    $abonneManager = new abonneManager;

    //Vérifie si un utilisateur est connecté et récupère les informations de l'utilisateur connecté
    if ($connexionManager->isLoggedOn()) {
        $unAbonne = $abonneManager->getUtilisateurByMailU($_SESSION['mailU']);
        $rechercheAvanceeManager = new RechercheAvanceeManager();
        $rechercheAvanceeManager->addHistoriqueRechercheAvancee($nbRecherche, $unAbonne->getId(), $typeDoc, $texte, $option2, $typeDoc2, $texte2, $option3, $typeDoc3, $texte3);
    }

   
} else {
    // Ajout de la vue de recherche avancée à la liste des vues
    array_push($vues, "$racine/vue/v_rechercheAvancee.php");
}

// appel du script de vue qui permet de gérer l'affichage des données
include "$racine/vue/header.php";
foreach ($vues as $vue) {
    include $vue;
}



include "$racine/vue/footer.php";
