<?php

class ReservationManager extends Manager
{
        /**
         * Renvoie un tableau associatif contenant l'ensemble des objets Reservation
         *
         * @return array
         */
        public function getList(): array
        {
                $revueManager = new RevueManager();
                $revues = $revueManager->getList();

                $abonneManager = new AbonneManager();
                $abonnes = $abonneManager->getList();

                $statutManager = new StatutManager();
                $statuts = $statutManager->getList();



                $q = $this->getPDO()->prepare('SELECT * FROM reservation');
                $q->execute();
                //  fetchAll(PDO::FETCH_ASSOC) est une méthode de l'objet PDOStatement qui permet de récupérer le résultat d'une requête SQL sous forme de tableau associatif. Chaque ligne du résultat est représentée par un tableau associatif dont les clés correspondent aux noms des colonnes de la table et les valeurs correspondent aux valeurs des champs de chaque ligne.
                $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
                $lesReservations = array();
                foreach ($r1 as $uneReservation) {
                        $revue = $revues[$uneReservation['idRevue']];
                        $abonne = $abonnes[$uneReservation['idAbonne']];
                        $statut = $statuts[$uneReservation['idStatut']];
                        $lesReservations[$uneReservation['idR']] = new Reservation($uneReservation['idR'], $revue, $abonne, $uneReservation['rang'], $statut , $uneReservation['dateReservation'] , $uneReservation['numeroParution'] );
                }
                return $lesReservations;
        }

        /**
         * Retourne le rang d'une reservation pour une revue dans la base de données si elle existe
         */
        function getRang($idRevue , $numeroParution)
        {
                $q = $this->getPDO()->prepare('SELECT rang FROM reservation WHERE idRevue = :idRevue  AND numeroParution = :numeroParution');
                $q->bindParam(':idRevue', $idRevue, PDO::PARAM_STR);
                $q->bindParam(':numeroParution', $numeroParution, PDO::PARAM_INT);
                $q->execute();
                 // fetchColumn est utilisé pour récupérer la valeur d'une seule colonne de la première ligne d'un résultat
                return $q->fetchColumn();
        }

        /**
         * recupere et retourne le rang le plus élevé pour une revue reserver
         */
        function recupMaxRang($idRevue , $numeroParution)
        {
                $q = $this->getPDO()->prepare('SELECT MAX(rang) FROM reservation WHERE idRevue = :idRevue AND numeroParution = :numeroParution');
                $q->bindParam(':idRevue', $idRevue, PDO::PARAM_INT);
                $q->bindParam(':numeroParution', $numeroParution, PDO::PARAM_INT);
                $q->execute();
                // fetchColumn est utilisé pour récupérer la valeur d'une seule colonne de la première ligne d'un résultat
                return $q->fetchColumn();
        }

        /**
         * modifie le rang (-1) pour les reservations donc le rang est supérieur au rang renseigné selon une revue 
         */
        function UpdateRang($idRevue ,$rang , $numeroParution)
        {
                $q = $this->getPDO()->prepare('UPDATE reservation set rang = rang - 1 where idRevue = :idRevue AND numeroParution=:numeroParution AND rang > :rang ');
                $q->bindParam(':idRevue', $idRevue, PDO::PARAM_STR);
                $q->bindParam(':rang', $rang, PDO::PARAM_INT);
                $q->bindParam(':numeroParution', $numeroParution, PDO::PARAM_INT);
                $q->execute();
        }

        /**
         * modifie le statut pour les réservations dont le rang vient tout juste de passer à 1
         */
        function UpdateStatut($idRevue , $rang , $numeroParution )
        {
                if ($rang = 1) {
                        $q = $this->getPDO()->prepare('UPDATE reservation set idStatut =  1 where idRevue=:idRevue AND numeroParution=:numeroParution AND rang = :rang' );
                }
                $q->bindParam(':idRevue', $idRevue, PDO::PARAM_STR);
                $q->bindParam(':rang', $rang, PDO::PARAM_INT);
                $q->bindParam(':numeroParution', $numeroParution, PDO::PARAM_INT);
                $q->execute();
        }

        /**
         * insert une reservation dans la base de données
         */
        function addReservation($idRevue, $idAbonne, $rang ,$numeroParution)
        {
                if ($rang > 1) {
                        $idStatut = 2;
                } else {
                        $idStatut = 1;
                }
                $q = $this->getPDO()->prepare('INSERT INTO reservation (idRevue , dateReservation , idAbonne , rang , idStatut , numeroParution ) VALUES (:idRevue , Current_Date , :idAbonne , :rang , :idStatut , :numeroParution )');
                $q->bindParam(':idRevue', $idRevue, PDO::PARAM_STR);
                $q->bindParam(':idAbonne', $idAbonne, PDO::PARAM_INT);
                $q->bindParam(':rang', $rang, PDO::PARAM_INT);
                $q->bindParam(':idStatut', $idStatut, PDO::PARAM_INT);
                $q->bindParam(':numeroParution', $numeroParution, PDO::PARAM_INT);
                $q->execute();
        }

        /**
         * supprime une reservation dans la base de données
         */
        function supReservation($idR, $idRevue, $rang , $numeroParution)
        {
                $q = $this->getPDO()->prepare('DELETE FROM reservation WHERE idR = :idR');
                $q->bindParam(':idR', $idR, PDO::PARAM_STR);
                $success = $q->execute();
                if($success){
                $maxRangReservation = $this->recupMaxRang($idRevue , $numeroParution);
                if ($maxRangReservation > $rang) {
                        $this->UpdateRang($idRevue, $rang , $numeroParution);
                }
                $this->UpdateStatut($idRevue , $rang , $numeroParution);
        }
        }

        /**
         * retourne le nombre de réservation pour chaque abonne
         */
        function nombreReservation($idAbonne)
        {
                $q = $this->getPDO()->prepare('SELECT count(reservation.idR) from reservation where idAbonne=:idAbonne');
                $q->bindParam(':idAbonne', $idAbonne, PDO::PARAM_INT);
                $q->execute();
                // fetchColumn est utilisé pour récupérer la valeur d'une seule colonne de la première ligne d'un résultat
                return $q->fetchColumn();
        }

        /**
         * Afficher le bouton seulement pour les revues pas reservé pour un abonné
         */
        function AfficherBouton($idAbonne, $idRevue , $numeroParution)
        {
                $q = $this->getPDO()->prepare('SELECT numeroParution from reservation where idAbonne= :idAbonne AND idRevue = :idRevue');
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
        }
}
