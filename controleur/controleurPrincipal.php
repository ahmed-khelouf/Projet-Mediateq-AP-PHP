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
    $lesActions["mesFrais"] = "c_mesFrais.php";
    $lesActions["mesPretsHistorique"] = "c_mesPretsHistorique.php";
    $lesActions["revue"] = "c_revue.php";
    $lesActions["livre"] = "c_livre.php";
    $lesActions["dvd"] = "c_dvd.php";
    $lesActions["historiqueReservations"] = "c_historiqueReservations.php";
    $lesActions["monDossier"] = "c_abonne.php";
    $lesActions["inscription"] = "c_inscription.php";
    $lesActions["accueil"] = $lesActions["rechercheSimple"] ;
    $lesActions["historiqueRechercheAvancee"] = "c_historiqueRechercheAvancee.php" ;
    $lesActions["mesFrais"] = "c_mesFrais.php";
    
    if (array_key_exists($action, $lesActions)) {
        return $lesActions[$action];
    } else {
        return $lesActions["defaut"];
    }
}


function chargerModeles($racine){
    
    require_once("$racine/modele/manager.php");
    require_once("$racine/modele/document.php");
    require_once("$racine/modele/documentManager.php");
    require_once("$racine/modele/livre.php");
    require_once("$racine/modele/dvd.php");
    require_once("$racine/modele/exemplaire.php");
    require_once("$racine/modele/exemplaireManager.php");
    require_once("$racine/modele/parution.php");
    require_once("$racine/modele/parutionManager.php");
    require_once("$racine/modele/livreManager.php");
    require_once("$racine/modele/dvdManager.php");
    require_once("$racine/modele/etat.php");
    require_once("$racine/modele/etatManager.php");
    require_once("$racine/modele/rayon.php");
    require_once("$racine/modele/rayonManager.php");
    require_once("$racine/modele/revue.php");
    require_once("$racine/modele/revueManager.php");
    require_once("$racine/modele/typePublic.php");
    require_once("$racine/modele/typePublicManager.php");
    require_once("$racine/modele/reservation.php");
    require_once("$racine/modele/reservationManager.php");
    require_once("$racine/modele/reservationParution.php");
    require_once("$racine/modele/reservationParutionManager.php");
    require_once("$racine/modele/reservationExemplaire.php");
    require_once("$racine/modele/reservationExemplaireManager.php");
    require_once("$racine/modele/abonne.php");
    require_once("$racine/modele/abonneManager.php");
    require_once("$racine/modele/empruntManager.php");
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
    require_once("$racine/modele/logs.php");
    require_once("$racine/modele/logsManager.php");
    require_once("$racine/modele/logsMdp.php");
    require_once("$racine/modele/logsMdpManager.php");
    require_once("$racine/modele/typeAbonnement.php");
    require_once("$racine/modele/typeAbonnementManager.php");
    require_once("$racine/modele/rechercheAvancee.php");
    require_once("$racine/modele/rechercheAvanceeManager.php");
}
?>

