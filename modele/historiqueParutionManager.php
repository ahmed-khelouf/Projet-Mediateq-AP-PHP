<?php

class HistoriqueParutionManager extends Manager
{

    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets HistoriqueParution
     *
     * @return array
     */
    public function getList(): array
    {
        try {
            $revueManager = new RevueManager();
            $revues = $revueManager->getList();

            $abonneManager = new AbonneManager();
            $abonnes = $abonneManager->getList();

            $parutionManager = new ParutionManager();
            $parutions = $parutionManager->getList();

            $q = $this->getPDO()->prepare('SELECT * FROM historiqueParution order by dateReservation desc');
            $q->execute();
            //  fetchAll(PDO::FETCH_ASSOC) est une méthode de l'objet PDOStatement qui permet de récupérer le résultat d'une requête SQL sous forme de tableau associatif. Chaque ligne du résultat est représentée par un tableau associatif dont les clés correspondent aux noms des colonnes de la table et les valeurs correspondent aux valeurs des champs de chaque ligne.
            $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
            $lesHistoriques = array();
            foreach ($r1 as $unHistorique) {
                $revue = $revues[$unHistorique['idRevue']];
                $abonne = $abonnes[$unHistorique['idAbonne']];
                $parution = $parutions[$unHistorique['numeroParution']];
                $lesHistoriques[$unHistorique['id']] = new HistoriqueParution($unHistorique['id'], $revue, $abonne,  $unHistorique['dateReservation'], $parution);
            }
            return $lesHistoriques;
        } catch (PDOException $e) {
            echo ("une erreur s'est produite lors de la récupération des historiquesParutions : " . $e->getMessage());
        }
    }

    /**
     * insertion historique d'une reservation dans la base de données
     * @param int idAbonne
     * @param string idRevue
     * @param string numeroParution
     * @return void 
     */
    function addHistorique($idAbonne, $idRevue, $numeroParution)
    {
        try {
            $q = $this->getPDO()->prepare('INSERT INTO historiqueParution (idAbonne,  dateReservation , idRevue , numeroParution) VALUES (:idAbonne, CURRENT_TIMESTAMP() , :idRevue , :numeroParution)');
            $q->bindParam(':idAbonne', $idAbonne, PDO::PARAM_INT);
            $q->bindParam(':idRevue', $idRevue, PDO::PARAM_STR);
            $q->bindParam(':numeroParution', $numeroParution, PDO::PARAM_INT);
            $q->execute();
        } catch (PDOException $e) {
            echo ("Une erreur s'est produite lors de l'ajout de l'historique : " . $e->getMessage());
        }
    }
}
