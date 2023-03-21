<?php
function controleurPrincipal($action) {
    $lesActions = array();
    $lesActions["rechercheSimple"] = "c_rechercheSimple.php";
    $lesActions["rechercheAvancee"] = "c_rechercheAvancee.php";
    $lesActions["reservation"] = "reservation.php";
    $lesActions["nouveautes"] = "c_nouveautes.php";
    $lesActions["faq"] = "c_faq.php";
    $lesActions["connexion"] = "connexion.php";
    $lesActions["deconnexion"] = "deconnexion.php";
    $lesActions["accueil"] = $lesActions["rechercheSimple"] ;
    $lesActions["defaut"] = $lesActions["accueil"];
    $lesActions["mesPretsEnCours"] = "c_mesPretsEnCours.php";
    $lesActions["mesPretsHistorique"] = "c_mesPretsHistorique.php";
    

    if (array_key_exists($action, $lesActions)) {
        return $lesActions[$action];
    } else {
        return $lesActions["defaut"];
    }
}


function chargerModeles($racine){
    require_once("$racine/modele/Manager.php");
    require_once("$racine/modele/Document.php");
    require_once("$racine/modele/Livre.php");
    require_once("$racine/modele/Dvd.php");
    require_once("$racine/modele/Exemplaire.php");
    require_once("$racine/modele/Parution.php");
    require_once("$racine/modele/LivreManager.php");
    require_once("$racine/modele/DvdManager.php");
    require_once("$racine/modele/Etat.php");
    require_once("$racine/modele/EtatManager.php");
    require_once("$racine/modele/Rayon.php");
    require_once("$racine/modele/RayonManager.php");
    require_once("$racine/modele/Revue.php");
    require_once("$racine/modele/RevueManager.php");
    require_once("$racine/modele/TypePublic.php");
    require_once("$racine/modele/TypePublicManager.php");
    require_once("$racine/modele/reservation.php");
    require_once("$racine/modele/reservationManager.php");
    require_once("$racine/modele/abonne.php");
    require_once("$racine/modele/abonneManager.php");
    require_once("$racine/modele/connexionManager.php");
    require_once("$racine/modele/descripteur.php");
    require_once("$racine/modele/descripteurManager.php");
    require_once("$racine/modele/statut.php");
    require_once("$racine/modele/statutManager.php");
    require_once("$racine/modele/emprunt.php");
    require_once("$racine/modele/empruntExemplaire.php");
    require_once("$racine/modele/empruntExemplaireManager.php");
    require_once("$racine/modele/empruntParution.php");
    require_once("$racine/modele/empruntParutionManager.php");
    require_once("$racine/modele/documentManager.php");
    require_once("$racine/modele/parutionManager.php");

}
?>

