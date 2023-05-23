<?php
function controleurPrincipal($action) {
    $lesActions = array();
    $lesActions["rechercheSimple"] = "c_rechercheSimple.php";
    $lesActions["rechercheAvancee"] = "c_rechercheAvancee.php";
    $lesActions["reservation"] = "c_reservation.php";
    $lesActions["nouveautes"] = "c_nouveautes.php";
    $lesActions["faq"] = "c_faq.php";
    $lesActions["connexion"] = "c_connexion.php";
    $lesActions["deconnexion"] = "c_deconnexion.php";
    $lesActions["accueil"] = $lesActions["rechercheSimple"] ;
    $lesActions["defaut"] = $lesActions["accueil"];
    $lesActions["mesPretsEnCours"] = "c_mesPretsEnCours.php";
    $lesActions["mesPretsHistorique"] = "c_mesPretsHistorique.php";
    $lesActions["revue"] = "c_revue.php";
    $lesActions["livre"] = "c_livre.php";
    $lesActions["dvd"] = "c_dvd.php";
    $lesActions["historiqueReservations"] = "c_historiqueReservations.php";
    $lesActions["monDossier"] = "c_abonne.php";
    $lesActions["inscription"] = "c_inscription.php";
    $lesActions["accueil"] = $lesActions["rechercheSimple"] ;
    
    if (array_key_exists($action, $lesActions)) {
        return $lesActions[$action];
    } else {
        return $lesActions["defaut"];
    }
}


function chargerModeles($racine){
    
    require_once("$racine/modele/Manager.php");
    require_once("$racine/modele/Document.php");
    require_once("$racine/modele/DocumentManager.php");
    require_once("$racine/modele/Livre.php");
    require_once("$racine/modele/Dvd.php");
    require_once("$racine/modele/Exemplaire.php");
    require_once("$racine/modele/exemplaireManager.php");
    require_once("$racine/modele/Parution.php");
    require_once("$racine/modele/parutionManager.php");
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
    require_once("$racine/modele/reservationParution.php");
    require_once("$racine/modele/reservationParutionManager.php");
    require_once("$racine/modele/reservationExemplaire.php");
    require_once("$racine/modele/reservationExemplaireManager.php");
    require_once("$racine/modele/abonne.php");
    require_once("$racine/modele/abonneManager.php");
    require_once("$racine/modele/connexionManager.php");
    require_once("$racine/modele/descripteur.php");
    require_once("$racine/modele/descripteurManager.php");
    require_once("$racine/modele/statut.php");
    require_once("$racine/modele/statutManager.php");
    require_once("$racine/modele/emprunt.php");
    require_once("$racine/modele/empruntParution.php");
    require_once("$racine/modele/empruntExemplaire.php");
    require_once("$racine/modele/empruntParutionManager.php");
    require_once("$racine/modele/empruntExemplaireManager.php");
    require_once("$racine/modele/historique.php");
    require_once("$racine/modele/historiqueManager.php");
    require_once("$racine/modele/historiqueParution.php");
    require_once("$racine/modele/historiqueParutionManager.php");
    require_once("$racine/modele/historiqueExemplaire.php");
    require_once("$racine/modele/historiqueExemplaireManager.php");
    require_once("$racine/modele/dateConnexion.php");
    require_once("$racine/modele/dateConnexionManager.php");
    require_once("$racine/modele/typeAbonnement.php");
    require_once("$racine/modele/typeAbonnementManager.php");
}
?>

