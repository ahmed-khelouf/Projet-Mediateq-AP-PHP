<?php

class ConnexionManager extends Manager
{



    function login($mailU, $mdpU) {
        if (!isset($_SESSION)) {
           session_start();
       }
        $abonneManager = new abonneManager();
        $util = $abonneManager->getUtilisateurByMailU($mailU);
        if( !is_null($util)){
            $mdpBD = $util->getMdpU();
            //Penser a hasher le mdp avant de le comparer pour plus tard !!!
            if (trim($mdpBD) == trim($mdpU)) {
            // if (trim($mdpBD) == trim(crypt($mdpU, $mdpBD))) {
                
                // le mot de passe est celui de l'utilisateur dans la base de donnees
                $_SESSION["mailU"] = $mailU;
                $_SESSION["mdpU"] = $mdpBD;
            }
        }
    }

    function logout() {
        if (!isset($_SESSION)) {
            session_start();
        }
        unset($_SESSION["mailU"]);
        unset($_SESSION["mdpU"]);
    }


     function isLoggedOn() {
        if (!isset($_SESSION)) {
            session_start();
        }
        $ret = false;
    
        if (isset($_SESSION["mailU"])) {
            $abonneManager = new abonneManager();
            $util = $abonneManager->getUtilisateurByMailU($_SESSION["mailU"]);
            if ($util->getMailU() == $_SESSION["mailU"] && $util->getMdpU() == $_SESSION["mdpU"]
            ) {
                $ret = true;
            }
        }
        return $ret;
    }

   
    
       

}
