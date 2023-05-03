<?php

class abonneManager extends Manager
{


     /**
      * Renvoie un tableau associatif contenant l'ensemble des objets Abonne
      *
      * @return abonne
      */
    public function getUtilisateurByMailU($mailU) : ?Abonne
    {

        $typeAbonnementManager = new typeAbonnementManager();
        $types = $typeAbonnementManager->getList();

        $q = $this->getPDO()->prepare('SELECT * FROM abonné where mailU=:mailU');
        $q->bindParam(':mailU',  $mailU, PDO::PARAM_STR);
        $q->execute();
        if($q->rowCount()==1){
            $user = $q->fetch(PDO::FETCH_ASSOC);
            $type = $types[$user['typeAbonnement']];
        $unAbonnee = new Abonne((int)$user['id'], $user['nom'] , $user['prenom'] , $user['dateNaissance'] , $user['adresse'] , $user['numTel'] , $user['finAbonnement'] , $user['mdpU'] , $user['mailU'], $type); 
        
        return $unAbonnee;
        }
        else{
            return null;
        }
    }
    public function getList() : array 
    {

        $typeAbonnementManager = new typeAbonnementManager();
        $types = $typeAbonnementManager->getList();
        
        $q = $this->getPDO()->prepare('SELECT * FROM abonné');
        $q->execute();
        $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
        
        $lesAbonnees = array();
        foreach($r1 as $user)
        {
            $type = $types[$user['typeAbonnement']];
            $lesAbonnees[$user['id']] = new Abonne((int)$user['id'], $user['nom'] , $user['prenom'] , $user['dateNaissance'] , $user['adresse'] , $user['numTel'] , $user['finAbonnement'] , $user['mdpU'] , $user['mailU'], $type); 
        }
        return $lesAbonnees;
        
    }

    function updateMdp($id, $mdpU) {
        try {
            $mdpCrypte = password_hash($mdpU, PASSWORD_DEFAULT);
            $req = $this->getPDO()->prepare('UPDATE abonné SET mdpU = :mdpU WHERE id = :id');
            $req->bindParam(':id', $id, PDO::PARAM_INT);
            $req->bindParam(':mdpU', $mdpCrypte, PDO::PARAM_STR);
            $resultat = $req->execute();
            return $resultat;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }
    

    function insertAbo($nom, $prenom, $dateNaiss, $adresse, $numTel, $finAbo, $mailU, $typeAbonnement) {
        try {
            // Générer le mot de passe par défaut
            $mdpDefaut = date_format(date_create($dateNaiss), "dmY") . strtoupper(substr($nom, 0, 2));
    
            // Crypter le mot de passe par défaut
            $mdpCrypte = password_hash($mdpDefaut, PASSWORD_DEFAULT);
    
            // Insérer les données de l'abonné avec le mot de passe par défaut
            $req = $this->getPDO()->prepare('INSERT INTO abonné (nom, prenom, dateNaissance, adresse, numTel, typeAbonnement, finAbonnement, mdpU, mailU) VALUES (:nom, :prenom, :dateNaissance, :adresse, :numTel, :typeAbonnement, :finAbonnement, :mdpU, :mailU)');
            $req->bindParam(':nom', $nom, PDO::PARAM_STR);
            $req->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $req->bindParam(':dateNaissance', $dateNaiss, PDO::PARAM_STR);
            $req->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $req->bindParam(':numTel', $numTel, PDO::PARAM_STR);
            $req->bindParam(':typeAbonnement', $typeAbonnement, PDO::PARAM_STR);
            $req->bindParam(':finAbonnement', $finAbo, PDO::PARAM_STR);
            $req->bindParam(':mdpU', $mdpCrypte, PDO::PARAM_STR);
            $req->bindParam(':mailU', $mailU, PDO::PARAM_STR);
            $resultat = $req->execute();
            return $resultat;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }
    
    


    function recupid() {

        $ret = false;
    
        if (isset($_SESSION["mailU"])) {
            $abonneeManager = new abonneManager();
            $util = $abonneeManager->getUtilisateurByMailU($_SESSION["mailU"]);
            if ($util->getMailU() == $_SESSION["mailU"] && $util->getId() == $_SESSION["id"]
            ) {
                $ret = true;
            }
        }
        return $ret;
    }

}



