<?php

class RechercheAvanceeManager extends Manager
{
        /**
         * Renvoie un tableau associatif contenant l'ensemble des objets RechercheAvancee
         *
         * @return array
         */
        public function getListRechercheAvancee(): array
        {
                try {
                        $abonneManager = new AbonneManager();
                        $abonnes = $abonneManager->getList();

                        $q = $this->getPDO()->prepare('SELECT * FROM historiqueRechercheAvancee  order by dateRecherche desc');
                        $q->execute();
                        //  fetchAll(PDO::FETCH_ASSOC) est une méthode de l'objet PDOStatement qui permet de récupérer le résultat d'une requête SQL sous forme de tableau associatif. Chaque ligne du résultat est représentée par un tableau associatif dont les clés correspondent aux noms des colonnes de la table et les valeurs correspondent aux valeurs des champs de chaque ligne.
                        $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
                        $lesRecherchesAvancee = array();
                        foreach ($r1 as $uneRecherche) {
                                $abonne = $abonnes[$uneRecherche['idAbonne']];
                                $lesRecherchesAvancee[$uneRecherche['id']] = new RechercheAvancee($uneRecherche['id'],   $uneRecherche['nbResultat'], $uneRecherche['dateRecherche'], $abonne,  $uneRecherche['type1'], $uneRecherche['texte'], $uneRecherche['connecteur'], $uneRecherche['type2'], $uneRecherche['texte2'], $uneRecherche['connecteur2'], $uneRecherche['type3'], $uneRecherche['texte3']);
                        }
                        return $lesRecherchesAvancee;
                } catch (PDOException $e) {
                        echo ("une erreur s'est produite lors de la récupération des recherches avancee : " . $e->getMessage());
                }
        }

        /**
         * insertion historique recherche dans la base de données
         */
        function addHistoriqueRechercheAvancee($nbResultats, $idAbonne, $type, $texte, $connecteur, $type2, $texte2, $connecteur2, $type3, $texte3)
        {
                try {
                        $q = $this->getPDO()->prepare('INSERT INTO historiqueRechercheAvancee (nbResultat,  dateRecherche , idAbonne , type1 , texte , connecteur , type2 ,  texte2 , connecteur2 , type3 , texte3 ) VALUES (:nbResultat,  CURRENT_TIMESTAMP() , :idAbonne , :type1 , :texte , :connecteur , :type2 ,  :texte2 , :connecteur2 , :type3 , :texte3 )');
                        $q->bindParam(':idAbonne', $idAbonne, PDO::PARAM_INT);
                        $q->bindParam(':nbResultat', $nbResultats, PDO::PARAM_INT);
                        $q->bindParam(':type1', $type, PDO::PARAM_STR);
                        $q->bindParam(':texte', $texte, PDO::PARAM_STR);
                        $q->bindParam(':connecteur', $connecteur, PDO::PARAM_STR);
                        $q->bindParam(':type2', $type2, PDO::PARAM_STR);
                        $q->bindParam(':texte2', $texte2, PDO::PARAM_STR);
                        $q->bindParam(':connecteur2', $connecteur2, PDO::PARAM_STR);
                        $q->bindParam(':type3', $type3, PDO::PARAM_STR);
                        $q->bindParam(':texte3', $texte3, PDO::PARAM_STR);
                        $q->execute();
                } catch (PDOException $e) {
                        echo ("Une erreur s'est produite lors de l'ajout de l'historique recherche: " . $e->getMessage());
                }
        }

        /**
         * suppression d'une recherche avancée dans la base de données
         */
        function supHistoriqueRechercheAvancee($id)
        {
                try {
                        $q = $this->getPDO()->prepare('DELETE FROM historiqueRechercheAvancee WHERE id = :id');
                        $q->bindParam(':id', $id, PDO::PARAM_INT);
                        $q->execute();
                } catch (PDOException $e) {
                        echo ("Une erreur s'est produite lors de la suppression de l'historique recherche: " . $e->getMessage());
                }
        }

        /**
         * suppression de l'ensemble des recherches avancées d'un abonné dans la base de données
         */
        function supHistoriqueRechercheAvanceeAll($idAbonne)
        {
                try {
                        $q = $this->getPDO()->prepare('DELETE FROM historiqueRechercheAvancee WHERE idAbonne = :idAbonne');
                        $q->bindParam(':idAbonne', $idAbonne, PDO::PARAM_INT);
                        $q->execute();
                } catch (PDOException $e) {
                        echo ("Une erreur s'est produite lors de la suppression de l'historique recherche: " . $e->getMessage());
                }
        }

        function nbHistoriqueRechercheAvancee($idAbonne)
        {
                try {
                        $q = $this->getPDO()->prepare('SELECT count(*) as nb FROM historiqueRechercheAvancee WHERE idAbonne = :idAbonne');
                        $q->bindParam(':idAbonne', $idAbonne, PDO::PARAM_INT);
                        $q->execute();
                        $r = $q->fetch(PDO::FETCH_ASSOC);
                        return $r['nb'];
                } catch (PDOException $e) {
                        echo ("Une erreur s'est produite lors de la suppression de l'historique recherche: " . $e->getMessage());
                }
        }
}
