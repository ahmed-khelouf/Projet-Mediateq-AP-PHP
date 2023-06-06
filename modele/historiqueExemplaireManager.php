<?php

class HistoriqueExemplaireManager extends Manager
{

    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets historiqueExemplaire Livre
     *
     * @return array
     */
    public function getListLivres(): array
    {
        try {
            $documentManager = new DocumentManager();
            $documents = $documentManager->getList();

            $abonneManager = new AbonneManager();
            $abonnes = $abonneManager->getList();

            $exemplaireManager = new ExemplaireManager();
            $exemplaires = $exemplaireManager->getList();

            $q = $this->getPDO()->prepare('SELECT * FROM historiqueExemplaire inner join  exemplaire on exemplaire.idDocument=historiqueExemplaire.idDoc inner join livre on livre.idDocument=historiqueExemplaire.idDoc group by historiqueExemplaire.id order by dateReservation desc');
            $q->execute();
            //  fetchAll(PDO::FETCH_ASSOC) est une méthode de l'objet PDOStatement qui permet de récupérer le résultat d'une requête SQL sous forme de tableau associatif. Chaque ligne du résultat est représentée par un tableau associatif dont les clés correspondent aux noms des colonnes de la table et les valeurs correspondent aux valeurs des champs de chaque ligne.
            $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
            $lesHistoriques = array();
            foreach ($r1 as $unHistorique) {
                $document = $documents[$unHistorique['idDoc']];
                $abonne = $abonnes[$unHistorique['idAbonne']];
                $exemplaire = $exemplaires[$unHistorique['numeroExemplaire']];
                $lesHistoriques[$unHistorique['id']] = new HistoriqueExemplaire($unHistorique['id'], $document, $abonne, $unHistorique['dateReservation'], $exemplaire);
            }
            return $lesHistoriques;
        } catch (PDOException $e) {
            echo ("une erreur s'est produite lors de la récupération de historiqueExemplaire  : " . $e->getMessage());
        }
    }

    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets historiqueExemplaire Livre
     *
     * @return array
     */
    public function getListDVD(): array
    {
        try {
            $documentManager = new DocumentManager();
            $documents = $documentManager->getList();

            $abonneManager = new AbonneManager();
            $abonnes = $abonneManager->getList();

            $exemplaireManager = new ExemplaireManager();
            $exemplaires = $exemplaireManager->getList();

            $q = $this->getPDO()->prepare('SELECT * FROM historiqueExemplaire inner join  exemplaire on exemplaire.idDocument=historiqueExemplaire.idDoc inner join dvd on dvd.idDocument=historiqueExemplaire.idDoc group by historiqueExemplaire.id order by dateReservation desc');
            $q->execute();
            //  fetchAll(PDO::FETCH_ASSOC) est une méthode de l'objet PDOStatement qui permet de récupérer le résultat d'une requête SQL sous forme de tableau associatif. Chaque ligne du résultat est représentée par un tableau associatif dont les clés correspondent aux noms des colonnes de la table et les valeurs correspondent aux valeurs des champs de chaque ligne.
            $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
            $lesHistoriques = array();
            foreach ($r1 as $unHistorique) {
                $document = $documents[$unHistorique['idDoc']];
                $abonne = $abonnes[$unHistorique['idAbonne']];
                $exemplaire = $exemplaires[$unHistorique['numeroExemplaire']];
                $lesHistoriques[$unHistorique['id']] = new HistoriqueExemplaire($unHistorique['id'], $document, $abonne, $unHistorique['dateReservation'], $exemplaire);
            }
            return $lesHistoriques;
        } catch (PDOException $e) {
            echo ("une erreur s'est produite lors de la récupération de historiqueExemplaire : " . $e->getMessage());
        }
    }

    /**
     * insertion historique d'une reservation dans la base de données
     * @param int idAbonne
     * @param string idDoc
     * @param int numeroExemplaire
     * @return void
     */
    function addHistorique($idAbonne, $idDoc, $numeroExemplaire)
    {
        try {
            $q = $this->getPDO()->prepare('INSERT INTO historiqueExemplaire (idAbonne,  dateReservation , idDoc , numeroExemplaire) VALUES (:idAbonne,  CURRENT_TIMESTAMP() , :idDoc , :numeroExemplaire)');
            $q->bindParam(':idAbonne', $idAbonne, PDO::PARAM_INT);
            $q->bindParam(':idDoc', $idDoc, PDO::PARAM_STR);
            $q->bindParam(':numeroExemplaire', $numeroExemplaire, PDO::PARAM_INT);
            $q->execute();
        } catch (PDOException $e) {
            echo ("Une erreur s'est produite lors de l'ajout de l'historique : " . $e->getMessage());
        }
    }
}
