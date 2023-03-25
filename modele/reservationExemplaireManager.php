<?php

class ReservationExemplaireManager extends Manager
{
        /**
         * Renvoie un tableau associatif contenant l'ensemble des objets Reservation
         *
         * @return array
         */
        public function getList(): array
        {
                try {
                        $documentManager = new DocumentManager();
                        $documents = $documentManager->getList();

                        $abonneManager = new AbonneManager();
                        $abonnes = $abonneManager->getList();

                        $statutManager = new StatutManager();
                        $statuts = $statutManager->getList();

                        $q = $this->getPDO()->prepare('SELECT * FROM reservation_exemplaire order by dateReservation desc');
                        $q->execute();
                        //  fetchAll(PDO::FETCH_ASSOC) est une méthode de l'objet PDOStatement qui permet de récupérer le résultat d'une requête SQL sous forme de tableau associatif. Chaque ligne du résultat est représentée par un tableau associatif dont les clés correspondent aux noms des colonnes de la table et les valeurs correspondent aux valeurs des champs de chaque ligne.
                        $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
                        $lesReservations = array();
                        foreach ($r1 as $uneReservation) {
                                $document = $documents[$uneReservation['idDoc']];
                                $abonne = $abonnes[$uneReservation['idAbonne']];
                                $statut = $statuts[$uneReservation['idStatut']];
                                $lesReservations[$uneReservation['idR']] = new ReservationExemplaire($uneReservation['idR'], $document, $abonne, $uneReservation['rang'], $statut, $uneReservation['dateReservation'], $uneReservation['numeroExemplaire']);
                        }
                        return $lesReservations;
                } catch (PDOException $e) {
                        echo ("une erreur s'est produite lors de la récupération des réservations : " . $e->getMessage());
                }
        }

        /**
         * Retourne le rang d'une reservation pour un document selon l'exemplaire dans la base de données si elle existe
         */
        function getRang($idDoc, $numeroExemplaire)
        {
                try {
                        $q = $this->getPDO()->prepare('SELECT rang FROM reservation_exemplaire WHERE idDoc = :idDoc  AND numeroExemplaire = :numeroExemplaire');
                        $q->bindParam(':idDoc', $idDoc, PDO::PARAM_STR);
                        $q->bindParam(':numeroExemplaire', $numeroExemplaire, PDO::PARAM_INT);
                        $q->execute();
                        // fetchColumn est utilisé pour récupérer la valeur d'une seule colonne de la première ligne d'un résultat
                        return $q->fetchColumn();
                } catch (PDOException $e) {
                        echo ("une erreur s'est produite : " . $e->getMessage());
                }
        }

        /**
         * recupere et retourne le rang le plus élevé pour un document selon l'exemplaire reservé
         */
        function recupMaxRang($idDoc, $numeroExemplaire)
        {
                try {
                        $q = $this->getPDO()->prepare('SELECT MAX(rang) FROM reservation_exemplaire WHERE idDoc = :idDoc AND numeroExemplaire = :numeroExemplaire');
                        $q->bindParam(':idDoc', $idDoc, PDO::PARAM_STR);
                        $q->bindParam(':numeroExemplaire', $numeroExemplaire, PDO::PARAM_INT);
                        $q->execute();
                        // fetchColumn est utilisé pour récupérer la valeur d'une seule colonne de la première ligne d'un résultat
                        return $q->fetchColumn();
                } catch (PDOException $e) {
                        echo ("une erreur s'est produite : " . $e->getMessage());
                }
        }

        /**
         * modifie le rang (-1) pour les reservations donc le rang est supérieur au rang renseigné selon l'exemplaire du document 
         */
        function UpdateRang($idDoc, $rang, $numeroExemplaire)
        {
                try {
                        $q = $this->getPDO()->prepare('UPDATE reservation_exemplaire set rang = rang - 1 where idDoc = :idDoc AND numeroExemplaire=:numeroExemplaire AND rang > :rang ');
                        $q->bindParam(':idDoc', $idDoc, PDO::PARAM_STR);
                        $q->bindParam(':rang', $rang, PDO::PARAM_INT);
                        $q->bindParam(':numeroExemplaire', $numeroExemplaire, PDO::PARAM_INT);
                        $q->execute();
                } catch (PDOException $e) {
                        echo ("Une erreur s'est produite lors de la mise à jour du rang : " . $e->getMessage());
                }
        }

        /**
         * modifie le statut pour les réservations dont le rang vient tout juste de passer à 1
         */
        function UpdateStatut($idDoc, $rang, $numeroExemplaire)
        {
                try {
                        if ($rang = 1) {
                                $q = $this->getPDO()->prepare('UPDATE reservation_exemplaire set idStatut =  1 where idDoc=:idDoc AND numeroExemplaire=:numeroExemplaire AND rang = :rang');
                        }
                        $q->bindParam(':idDoc', $idDoc, PDO::PARAM_STR);
                        $q->bindParam(':rang', $rang, PDO::PARAM_INT);
                        $q->bindParam(':numeroExemplaire', $numeroExemplaire, PDO::PARAM_INT);
                        $q->execute();
                } catch (PDOException $e) {
                        echo ("Une erreur s'est produite lors de la mise à jour du statut " . $e->getMessage());
                }
        }

        /**
         * insertion d'une reservation dans la base de données
         */
        function addReservation($idDoc, $idAbonne, $rang, $numeroExemplaire)
        {
                try {
                        if ($rang > 1) {
                                $idStatut = 2;
                        } else {
                                $idStatut = 1;
                        }
                        $q = $this->getPDO()->prepare('INSERT INTO reservation_exemplaire (idDoc , dateReservation , idAbonne , rang , idStatut , numeroExemplaire ) VALUES (:idDoc , Current_Date , :idAbonne , :rang , :idStatut , :numeroExemplaire )');
                        $q->bindParam(':idDoc', $idDoc, PDO::PARAM_STR);
                        $q->bindParam(':idAbonne', $idAbonne, PDO::PARAM_INT);
                        $q->bindParam(':rang', $rang, PDO::PARAM_INT);
                        $q->bindParam(':idStatut', $idStatut, PDO::PARAM_INT);
                        $q->bindParam(':numeroExemplaire', $numeroExemplaire, PDO::PARAM_INT);
                        $q->execute();
                } catch (PDOException $e) {
                        echo ("Une erreur s'est produite lors de l'ajout de la réservation : " . $e->getMessage());
                }
        }

        /**
         * suppression d'une reservation dans la base de données
         */
        function supReservation($idR, $idDoc, $rang, $numeroExemplaire)
        {
                try {
                        $q = $this->getPDO()->prepare('DELETE FROM reservation_exemplaire WHERE idR = :idR');
                        $q->bindParam(':idR', $idR, PDO::PARAM_STR);
                        $success = $q->execute();
                        if ($success) {
                                $maxRangReservation = $this->recupMaxRang($idDoc, $numeroExemplaire);
                                if ($maxRangReservation > $rang) {
                                        $this->UpdateRang($idDoc, $rang, $numeroExemplaire);
                                }
                                $this->UpdateStatut($idDoc, $rang, $numeroExemplaire);
                        }
                } catch (PDOException $e) {
                        echo ("Une erreur s'est produite lors de la suppression : " . $e->getMessage());
                }
        }

        /**
         * retourne le nombre de réservation pour chaque abonne
         */
        function nombreReservation($idAbonne)
        {
                try {
                        $q = $this->getPDO()->prepare('SELECT count(reservation_exemplaire.idR) from reservation_exemplaire where idAbonne=:idAbonne');
                        $q->bindParam(':idAbonne', $idAbonne, PDO::PARAM_INT);
                        $q->execute();
                        // fetchColumn est utilisé pour récupérer la valeur d'une seule colonne de la première ligne d'un résultat
                        return $q->fetchColumn();
                } catch (PDOException $e) {
                        echo ("Une erreur s'est produite : " . $e->getMessage());
                }
        }

        /**
         * Afficher le bouton seulement si l'abonné n'a pas reservé l'exemplaire du document
         */
        function AfficherBouton($idAbonne, $idDoc, $numeroExemplaire)
        {
                try {
                        $q = $this->getPDO()->prepare('SELECT numeroExemplaire from reservation_exemplaire where idAbonne= :idAbonne AND idDoc = :idDoc');
                        $q->bindParam(':idAbonne', $idAbonne, PDO::PARAM_INT);
                        $q->bindParam(':idDoc', $idDoc, PDO::PARAM_STR);
                        $q->execute();
                        //  fetchAll(PDO::FETCH_COLUMN) retournera un tableau contenant tous les idRevue pour l'abonné en question 
                        $reservations = $q->fetchAll(PDO::FETCH_COLUMN);

                        // Vérifie si l'abonné a déjà réservé la revue
                        // in_array est une fonction PHP qui permet de vérifier si une valeur donnée se trouve dans un tableau. Elle prend deux paramètres : la valeur à rechercher ($numeroParution) et le tableau dans lequel effectuer la recherche ($reservations)
                        if (in_array($numeroExemplaire, $reservations)) {
                                return false;
                        } else {
                                return true;
                        }
                } catch (PDOException $e) {
                        echo ("Une erreur s'est produite : " . $e->getMessage());
                }
        }
}
?>
