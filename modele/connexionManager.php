<?php

class ConnexionManager extends Manager
{
    function login($mailU, $mdpU)
{
    if (!isset($_SESSION)) {
        session_start();
    }
    try {
        $abonneManager = new abonneManager();
        $util = $abonneManager->getUtilisateurByMailU($mailU);
        if (!is_null($util)) {
            $mdpBD = $util->getMdpU();
            if (password_verify($mdpU, $mdpBD)) {
                // le mot de passe est correct
                $_SESSION["mailU"] = $mailU;
                $_SESSION["mdpU"] = $mdpBD;
                // Générer un token de connexion
                $token = bin2hex(random_bytes(32));
                $_SESSION["token"] = $token;
                // Retourner le token
                return $token;
            } else {
                // le mot de passe est incorrect
                echo "Mot de passe ou identifiant incorrect";
            }
        } else {
            // l'utilisateur n'existe pas en base de données
            echo "Utilisateur inexistant";
        }
    } catch (Exception $e) {
        echo "Erreur lors de la connexion : " . $e->getMessage();
    }
}


    function comparePassword($mailU, $mdpU) {
        try {
            $abonneManager = new abonneManager();
            $util = $abonneManager->getUtilisateurByMailU($mailU);
            if (!is_null($util)) {
                $mdpBD = $util->getMdpU();
                if (password_verify($mdpU, $mdpBD)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
    

    function logout()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        try {
            unset($_SESSION["mailU"]);
            unset($_SESSION["mdpU"]);
        } catch (Exception $e) {
            echo "Une erreur est survenue  : " . $e->getMessage();
        }
    }


    function isLoggedOn()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $ret = false;
        try {
            if (isset($_SESSION["mailU"])) {
                $abonneManager = new abonneManager();
                $util = $abonneManager->getUtilisateurByMailU($_SESSION["mailU"]);
                if (
                    $util->getMailU() == $_SESSION["mailU"] && $util->getMdpU() == $_SESSION["mdpU"]
                ) {
                    $ret = true;
                }
            }
        } catch (PDOException $e) {
            echo "Une erreur est survenue  : " . $e->getMessage();
        }
        return $ret;
    }
}
?>
