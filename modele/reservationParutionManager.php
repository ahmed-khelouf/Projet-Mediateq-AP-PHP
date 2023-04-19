<?php

class ReservationParutionManager extends Manager
{
        /**
         * Renvoie un tableau associatif contenant l'ensemble des objets Reservation
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

                        $statutManager = new StatutManager();
                        $statuts = $statutManager->getList();

                        $parutionManager = new ParutionManager();
                        $parutions = $parutionManager->getList();

                        $q = $this->getPDO()->prepare('SELECT * FROM reservationParution order by dateReservation desc');
                        $q->execute();
                        //  fetchAll(PDO::FETCH_ASSOC) est une méthode de l'objet PDOStatement qui permet de récupérer le résultat d'une requête SQL sous forme de tableau associatif. Chaque ligne du résultat est représentée par un tableau associatif dont les clés correspondent aux noms des colonnes de la table et les valeurs correspondent aux valeurs des champs de chaque ligne.
                        $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
                        $lesReservations = array();
                        foreach ($r1 as $uneReservation) {
                                $revue = $revues[$uneReservation['idRevue']];
                                $abonne = $abonnes[$uneReservation['idAbonne']];
                                $statut = $statuts[$uneReservation['idStatut']];
                                $parution = $parutions[$uneReservation['numeroParution']];
                                $lesReservations[$uneReservation['idR']] = new ReservationParution($uneReservation['idR'], $revue, $abonne, $uneReservation['rang'], $statut, $uneReservation['dateReservation'], $parution );
                        }
                        return $lesReservations;
                } catch (PDOException $e) {
                        echo ("une erreur s'est produite lors de la récupération des réservations : " . $e->getMessage());
                }
        }

        /**
         * Retourne le rang d'une reservation pour une revue selon son numero dans la base de données si elle existe
         */
        function getRang($idRevue, $numeroParution)
        {
                try {
                        $q = $this->getPDO()->prepare('SELECT rang FROM reservationParution  WHERE idRevue = :idRevue  AND numeroParution = :numeroParution');
                        $q->bindParam(':idRevue', $idRevue, PDO::PARAM_STR);
                        $q->bindParam(':numeroParution', $numeroParution, PDO::PARAM_INT);
                        $q->execute();
                        // fetchColumn est utilisé pour récupérer la valeur d'une seule colonne de la première ligne d'un résultat
                        return $q->fetchColumn();
                } catch (PDOException $e) {
                        echo ("une erreur s'est produite : " . $e->getMessage());
                }
        }

        /**
         * recupere et retourne le rang le plus élevé pour une revue selon son numero reservé
         */
        function recupMaxRang($idRevue, $numeroParution)
        {
                try {
                        $q = $this->getPDO()->prepare('SELECT MAX(rang) FROM reservationParution  WHERE idRevue = :idRevue AND numeroParution = :numeroParution');
                        $q->bindParam(':idRevue', $idRevue, PDO::PARAM_INT);
                        $q->bindParam(':numeroParution', $numeroParution, PDO::PARAM_INT);
                        $q->execute();
                        // fetchColumn est utilisé pour récupérer la valeur d'une seule colonne de la première ligne d'un résultat
                        return $q->fetchColumn();
                } catch (PDOException $e) {
                        echo ("une erreur s'est produite : " . $e->getMessage());
                }
        }

        /**
         * modifie le rang (-1) pour les reservations donc le rang est supérieur au rang renseigné selon le numero de la revue 
         */
        function UpdateRang($idRevue, $rang, $numeroParution )
        {
                try {
                        $q = $this->getPDO()->prepare('UPDATE reservationParution set rang = rang - 1 where idRevue = :idRevue AND numeroParution=:numeroParution AND rang > :rang ');
                        $q->bindParam(':idRevue', $idRevue, PDO::PARAM_STR);
                        $q->bindParam(':rang', $rang, PDO::PARAM_INT);
                        $q->bindParam(':numeroParution', $numeroParution, PDO::PARAM_INT);
                        $q->execute();
                } catch (PDOException $e) {
                        echo ("Une erreur s'est produite lors de la mise à jour du rang : " . $e->getMessage());
                }
        }

        /**
         * modifie le statut pour les réservations dont le rang vient tout juste de passer à 1
         */
        function UpdateStatut($idRevue, $rang, $numeroParution)
        {
                try {
                        if ($rang = 1) {
                                $q = $this->getPDO()->prepare('UPDATE reservationParution set idStatut =  1 where idRevue=:idRevue AND numeroParution=:numeroParution AND rang = :rang');
                        }
                        $q->bindParam(':idRevue', $idRevue, PDO::PARAM_STR);
                        $q->bindParam(':rang', $rang, PDO::PARAM_INT);
                        $q->bindParam(':numeroParution', $numeroParution, PDO::PARAM_INT);
                        $q->execute();
                } catch (PDOException $e) {
                        echo ("Une erreur s'est produite lors de la mise à jour du statut " . $e->getMessage());
                }
        }

        /**
         * insertion d'une reservation dans la base de données
         */
        function addReservation($idRevue, $idAbonne, $rang, $numeroParution)
        {
                try {
                        $idR = uniqid(); // Générer un ID unique
                        if ($rang > 1) {
                                $idStatut = 2;
                        } else {
                                $idStatut = 1;
                        }
                        $q = $this->getPDO()->prepare('INSERT INTO reservationParution (idR , idAbonne, rang, idStatut, dateReservation , idRevue , numeroParution) VALUES (:idR , :idAbonne, :rang, :idStatut, CURRENT_TIMESTAMP() , :idRevue , :numeroParution )');
                        $q->bindParam(':idR', $idR, PDO::PARAM_STR);
                        $q->bindParam(':idAbonne', $idAbonne, PDO::PARAM_INT);
                        $q->bindParam(':rang', $rang, PDO::PARAM_INT);
                        $q->bindParam(':idStatut', $idStatut, PDO::PARAM_INT);
                        $q->bindParam(':idRevue', $idRevue, PDO::PARAM_STR);
                        $q->bindParam(':numeroParution', $numeroParution, PDO::PARAM_INT);
                        $q->execute();
                } catch (PDOException $e) {
                        echo ("Une erreur s'est produite lors de l'ajout de la réservation : " . $e->getMessage());
                }
        }

        /**
         * suppression d'une reservation dans la base de données
         */
        function supReservation($idR, $idRevue, $rang, $numeroParution)
        {
                try {
                        $q = $this->getPDO()->prepare('DELETE FROM reservationParution WHERE idR = :idR');
                        $q->bindParam(':idR', $idR, PDO::PARAM_STR);
                        $success = $q->execute();
                        if ($success ) {
                                $maxRangReservation = $this->recupMaxRang($idRevue, $numeroParution);
                                if ($maxRangReservation > $rang) {
                                        $this->UpdateRang($idRevue, $rang, $numeroParution);
                                }
                                $this->UpdateStatut($idRevue, $rang, $numeroParution);
                        }
                } catch (PDOException $e) {
                        echo ("Une erreur s'est produite lors de la suppression : " . $e->getMessage());
                }
        }

        /**
         * Afficher le bouton seulement si l'abonné n'a pas reservé la parution d'une revue
         */
        function AfficherBouton($idAbonne, $idRevue, $numeroParution)
        {
                try {
                        $q = $this->getPDO()->prepare('SELECT numeroParution from reservationParution where idAbonne= :idAbonne AND idRevue = :idRevue');
                        $q->bindParam(':idAbonne', $idAbonne, PDO::PARAM_INT);
                        $q->bindParam(':idRevue', $idRevue, PDO::PARAM_STR);
                        $q->execute();
                        //  fetchAll(PDO::FETCH_COLUMN) retournera un tableau contenant tous les idRevue pour l'abonné en question 
                        $reservations = $q->fetchAll(PDO::FETCH_COLUMN);

                        // Vérifie si l'abonné a déjà réservé la revue
                        // in_array est une fonction PHP qui permet de vérifier si une valeur donnée se trouve dans un tableau. Elle prend deux paramètres : la valeur à rechercher ($numeroParution) et le tableau dans lequel effectuer la recherche ($reservations)
                        if (in_array($numeroParution, $reservations)) {
                                return false;
                        } else {
                                return true;
                        }
                } catch (PDOException $e) {
                        echo ("Une erreur s'est produite : " . $e->getMessage());
                }
        }
}
