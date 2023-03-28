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
        $q = $this->getPDO()->prepare('SELECT * FROM abonné where mailU=:mailU');
        $q->bindParam(':mailU',  $mailU, PDO::PARAM_STR);
        $q->execute();
        if($q->rowCount()==1){
            $user = $q->fetch(PDO::FETCH_ASSOC);
        $unAbonnee = new Abonne((int)$user['id'], $user['nom'] , $user['prenom'] , $user['dateNaissance'] , $user['adresse'] , $user['numTel'] , $user['finAbonnement'] , $user['mdpU'] , $user['mailU']); 
        
        return $unAbonnee;
        }
        else{
            return null;
        }
    }
    public function getList() : array 
    {

        $q = $this->getPDO()->prepare('SELECT * FROM abonné');
        $q->execute();
        $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
        
        $lesAbonnees = array();
        foreach($r1 as $user)
        {
            $lesAbonnees[$user['id']] = new Abonne((int)$user['id'], $user['nom'] , $user['prenom'] , $user['dateNaissance'] , $user['adresse'] , $user['numTel'] , $user['typeAbonnement'] , $user['finAbonnement'] , $user['mdpU'] , $user['mailU']); 
        }
        return $lesAbonnees;
        
    }

    function updateMdp($id, $mdpU) {
	    try {
		// $mdpHash = password_hash($mdpU, PASSWORD_DEFAULT);
		$req = $this->getPDO()->prepare('UPDATE abonné SET mdpU = :mdpU WHERE id = :id');
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		$req->bindParam(':mdpU', $mdpU, PDO::PARAM_STR);
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



