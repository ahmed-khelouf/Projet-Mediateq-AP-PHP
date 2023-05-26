<?php

// Titre de la page
$titre = "Historique de recherche avancée- Mediateq";

// Création d'un objet manager de connexion
$connexionManager = new ConnexionManager;

$vues = array(); // tableau des vues à appeler


// Appel à la méthode de recherche avancée de livres
$rechercheManager = new RechercheAvanceeManager;
$rechercheAvancee= $rechercheManager->getListRechercheAvancee();


//Création d'un objet manager de abonne
$abonneManager = new abonneManager;


//Vérifie si un utilisateur est connecté et récupère les informations de l'utilisateur connecté
if ($connexionManager->isLoggedOn()) {
    $unAbonne = $abonneManager->getUtilisateurByMailU($_SESSION['mailU']);
}

$nbHistoriqueRechercheAvancee = $rechercheManager->nbHistoriqueRechercheAvancee($unAbonne->getId());

//Permet d'ajouter une nouvelle réservation d'exemplaire
if (isset($_POST['historiqueRechercheAvancee'])) {
    $type1= $_POST['type1'];
    $type2= $_POST['type2'];
    $type3= $_POST['type3'];
    $texte= $_POST['texte'];
    $texte2= $_POST['texte2'];
    $texte3= $_POST['texte3'];
    $connecteur = $_POST['connecteur'];
    $connecteur2 = $_POST['connecteur2'];

    // affichage message de recherche
    if ($texte != null && $texte2 == null && $texte3 == null) {
        $recherche = "Recherche de  $type1 contenant \"" . $texte . "\" ";
    } elseif ($texte != null && $texte2 != null && $texte3 == null) {
        $recherche = "Recherche de  $type1  contenant \"" . $texte . "\" $connecteur  $type2   contenant \"" . $texte2 . "\" ";
    } elseif ($texte != null && $texte2 != null && $texte3 != null) {
        $recherche = "Recherche de $type1  contenant \"" . $texte . "\" $connecteur  $type2   contenant \"" . $texte2 . "\" $connecteur $type3 contenant \"" . $texte3 . "\" ";
    } else {
        $recherche = "Recherche contenant tout ";
    }

    array_push($vues, "$racine/vue/v_resultatRechercheSimple.php");
    
    // Appel à la méthode de recherche avancée de livres
    $livreManager = new livreManager();
    $livres = $livreManager->getLivreCritereAvancee($texte , $type1 , $connecteur , $texte2 , $type2 , $connecteur2 , $texte3 , $type3);

    // Ajout de la vue de résultat de recherche à la liste des vues (utilisation de la meme vue d'affichage que la recherche simple)
    array_push($vues, "$racine/vue/v_resultatRechercheSimpleLivre.php");

    // Appel à la méthode de recherche avancée de dvd
    $dvdManager = new dvdManager();
    $disques = $dvdManager->getDvdCritereAvancee($texte , $type1 , $connecteur , $texte2 , $type2 , $connecteur2 , $texte3 , $type3);

    // Ajout de la vue de résultat de recherche à la liste des vues (utilisation de la meme vue d'affichage que la recherche simple)
    array_push($vues, "$racine/vue/v_resultatRechercheSimpleDvd.php");

    // Appel à la méthode de recherche avancée de revue
    $revueManager = new RevueManager();
    $revues = $revueManager->getRevueCritereAvancee($texte , $type1 , $connecteur , $texte2 , $type2 , $connecteur2 , $texte3 , $type3);

    
    // Ajout de la vue de résultat de recherche à la liste des vues (utilisation de la meme vue d'affichage que la recherche simple)
    array_push($vues, "$racine/vue/v_resultatRechercheSimpleRevue.php");
}else{
    array_push ($vues , "$racine/vue/v_historiqueRechercheAvancee.php");
}

if (isset($_POST['supr'])) {
    $id = $_POST['id'];
    $rechercheManager->supHistoriqueRechercheAvancee($id);
    header('Location: ?action=historiqueRechercheAvancee');
}

if (isset($_POST['suprAll'])) {
    $idAbonne = $_POST['idAbonne'];
    $rechercheManager->supHistoriqueRechercheAvanceeAll($unAbonne->getId());
    header('Location: ?action=historiqueRechercheAvancee');
}


// inclure la vue en lui transmettant les données nécessaires
include "$racine/vue/header.php";

foreach ($vues as $vue) {
    include $vue;
}
include "$racine/vue/footer.php";



?>