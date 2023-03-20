<?php

class abonneManager extends Manager
{


    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets Abonne
     *
     * @return abonne
     */
    public function getUtilisateurByMailU($mailU): ?Abonne
    {
        $q = $this->getPDO()->prepare('SELECT * FROM abonné where mailU=:mailU');
        $q->bindParam(':mailU',  $mailU, PDO::PARAM_STR);
        $q->execute();
        if ($q->rowCount() == 1) {
            $user = $q->fetch(PDO::FETCH_ASSOC);
            $unAbonne = new Abonne((int)$user['id'], $user['nom'], $user['prenom'], $user['dateNaissance'], $user['adresse'], $user['numTel'], $user['typeAbonnement'], $user['finAbonnement'], $user['mdpU'], $user['mailU']);

            return $unAbonne;
        } else {
            return null;
        }
    }


    public function getList(): array
    {

        $q = $this->getPDO()->prepare('SELECT * FROM abonné');
        $q->execute();
        $r1 = $q->fetchAll(PDO::FETCH_ASSOC);

        $lesAbonnes = array();
        foreach ($r1 as $user) {
            $lesAbonnes[$user['id']] = new Abonne((int)$user['id'], $user['nom'], $user['prenom'], $user['dateNaissance'], $user['adresse'], $user['numTel'], $user['typeAbonnement'], $user['finAbonnement'], $user['mdpU'], $user['mailU']);
        }
        return $lesAbonnes;
    }
}
