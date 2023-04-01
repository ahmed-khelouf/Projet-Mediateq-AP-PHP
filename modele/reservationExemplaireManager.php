<?php

class ReservationExemplaireManager extends Manager
{
        /**
         * Renvoie un tableau associatif contenant l'ensemble des objets Reservation Livre
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

                        $statutManager = new StatutManager();
                        $statuts = $statutManager->getList();

                        $q = $this->getPDO()->prepare('SELECT reservation.idR , idDoc , idAbonne , idStatut , rang , dateReservation , numeroExemplaire FROM reservation inner join reservationExemplaire on reservationExemplaire.idR=reservation.idR inner join exemplaire on exemplaire.idDocument=reservationExemplaire.idDoc inner join document on exemplaire.idDocument=document.id inner join livre on livre.idDocument=document.id group by reservation.idR');
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
         * Renvoie un tableau associatif contenant l'ensemble des objets Reservation DVD
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

                        $statutManager = new StatutManager();
                        $statuts = $statutManager->getList();

                        $q = $this->getPDO()->prepare('SELECT reservation.idR , reservationExemplaire.idDoc , reservation.idAbonne , reservation.idStatut , reservation.rang , reservation.dateReservation , reservationExemplaire.numeroExemplaire FROM reservation inner join reservationExemplaire on reservationExemplaire.idR=reservation.idR inner join exemplaire on exemplaire.idDocument=reservationExemplaire.idDoc inner join document on exemplaire.idDocument=document.id inner join dvd on dvd.idDocument=document.id group by reservation.idR ');
                        $q->execute();
                        
                        //  fetchAll(PDO::FETCH_ASSOC) est une méthode de l'objet PDOStatement qui permet de récupérer le résultat d'une requête SQL sous forme de tableau associatif. Chaque ligne du résultat est représentée par un tableau associatif dont les clés correspondent aux noms des colonnes de la table et les valeurs correspondent aux valeurs des champs de chaque ligne.
                        $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
                        $lesReservations = array();
                        // if (array_key_exists('00026', $lesReservations)) {
                        //         // faire quelque chose si la clé existe
                        //         echo("la clé existe");
                        //      } else {
                        //         // faire quelque chose si la clé n'existe pas
                        //         echo("la clé n'existe pas");
                        //      }
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
                        $q = $this->getPDO()->prepare('SELECT rang FROM reservation inner join reservationExemplaire on reservationExemplaire.idR=reservation.idR WHERE idDoc = :idDoc  AND numeroExemplaire = :numeroExemplaire');
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
                        $q = $this->getPDO()->prepare('SELECT MAX(rang) FROM reservation inner join reservationExemplaire on reservationExemplaire.idR=reservation.idR WHERE idDoc = :idDoc AND numeroExemplaire = :numeroExemplaire');
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
                        $q = $this->getPDO()->prepare('UPDATE reservation inner join reservationExemplaire on reservationExemplaire.idR=reservation.idR set rang = rang - 1 where idDoc = :idDoc AND numeroExemplaire=:numeroExemplaire AND rang > :rang ');
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
                                $q = $this->getPDO()->prepare('UPDATE reservation inner join reservationExemplaire on reservationExemplaire.idR=reservation.idR set idStatut =  1 where idDoc=:idDoc AND numeroExemplaire=:numeroExemplaire AND rang = :rang');
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
                        $q = $this->getPDO()->prepare('INSERT INTO reservation (idAbonne, rang, idStatut, dateReservation) VALUES (:idAbonne, :rang, :idStatut, CURRENT_TIMESTAMP()); INSERT INTO reservationExemplaire (idR, idDoc, numeroExemplaire) VALUES (LAST_INSERT_ID(), :idDoc, :numeroExemplaire)');
                        $q->bindParam(':idAbonne', $idAbonne, PDO::PARAM_INT);
                        $q->bindParam(':rang', $rang, PDO::PARAM_INT);
                        $q->bindParam(':idStatut', $idStatut, PDO::PARAM_INT);
                        $q->bindParam(':idDoc', $idDoc, PDO::PARAM_STR);
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
                        $q = $this->getPDO()->prepare('DELETE FROM reservationExemplaire WHERE idR = :idR');
                        $q1 = $this->getPDO()->prepare('DELETE FROM reservation WHERE idR = :idR');
                        $q->bindParam(':idR', $idR, PDO::PARAM_STR);
                        $q1->bindParam(':idR', $idR, PDO::PARAM_STR);
                        $success = $q->execute();
                        $success2 = $q1->execute();
                        if ($success && $success2) {
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
         * Afficher le bouton seulement si l'abonné n'a pas reservé l'exemplaire du document
         */
        function AfficherBouton($idAbonne, $idDoc, $numeroExemplaire)
        {
                try {
                        $q = $this->getPDO()->prepare('SELECT numeroExemplaire from reservation inner join reservationExemplaire on reservationExemplaire.idR=reservation.idR where idAbonne= :idAbonne AND idDoc = :idDoc');
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