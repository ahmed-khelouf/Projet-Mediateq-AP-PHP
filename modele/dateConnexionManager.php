<?php

class DateConnexionManager extends Manager {

     /**
     * Renvoie un tableau associatif contenant l'ensemble des objets dateConnexion
     *
     * @return array
     */
    public function getList(): array
    {
        try {
            $q = $this->getPDO()->prepare('SELECT * FROM date_connexion');
            $q->execute();
            $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
            $lesDateConnexion = array();
            foreach ($r1 as $uneDateConnexion) {
                $lesDateConnexion[$uneDateConnexion['id']] = new DateConnexion($uneDateConnexion ['id'], $uneDateConnexion['utilisateur_id'], $uneDateConnexion['date_connexion']);
            }
            return $lesDateConnexion;
        } catch (PDOException $e) {
            echo ("une erreur s'est produite lors de la récupération des date de connexion : " . $e->getMessage());
        }
    }

    public function historiserConnexion($idUtilisateur, $dateConnexion, $navigateur) {
        try {
            $dateConnexionObj = DateTime::createFromFormat('Y-m-d H:i:s', $dateConnexion);
            $req = $this->getPDO()->prepare ('INSERT INTO date_connexion (utilisateur_id, date_connexion, navigateur) VALUES (:id_utilisateur, :date_connexion, :navigateur)');
            $req->bindParam(':id_utilisateur', $idUtilisateur, PDO::PARAM_INT);
            $req->bindParam(':date_connexion', $dateConnexion, PDO::PARAM_STR);
            $req->bindParam(':navigateur', $navigateur, PDO::PARAM_STR);
            $resultat = $req->execute();
            return $resultat;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }
    
    
}
