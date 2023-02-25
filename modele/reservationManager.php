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

                $q = $this->getPDO()->prepare('SELECT reservation.idR ,  idRevue ,  idAbonne  FROM reservation inner join abonné on abonné.id=reservation.idAbonne inner join revue on reservation.idRevue=revue.id ');
                $q->execute();
                $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
                $lesReservations = array();
                foreach ($r1 as $uneReservation) {
                        $revue = $revues[$uneReservation['idRevue']];
                        $abonne = $abonnes[$uneReservation['idAbonne']];
                        $lesReservations[$uneReservation['idR']] = new Reservation($uneReservation['idR'], $revue, $abonne);
                }
                return $lesReservations;
        }

        /**
         * insert une reservation dans la base de données
         */
        function addReservation($idRevue, $idAbonne)
        {
                $q = $this->getPDO()->prepare('INSERT INTO reservation (idRevue , dateReservation , idAbonne ) VALUES (:idRevue , Current_Date , :idAbonne)');
                $q->bindParam(':idRevue', $idRevue, PDO::PARAM_STR);
                $q->bindParam(':idAbonne', $idAbonne, PDO::PARAM_INT);
                $q->execute();
        }

        /**
         * supprime une reservation dans la base de données
         */
        function supReservation($idR)
        {
                $q = $this->getPDO()->prepare('DELETE FROM reservation WHERE idR = :idR');
                $q->bindParam(':idR', $idR, PDO::PARAM_STR);
                $q->execute();
        }

        /**
         * retourne le nombre de réservation pour chaque abonne
         */
        function nombreReservation($idAbonne)
        {
                $q = $this->getPDO()->prepare('SELECT count(reservation.idR) from reservation where idAbonne=:idAbonne');
                $q->bindParam(':idAbonne', $idAbonne, PDO::PARAM_INT);
                $q->execute();
                return $q->fetchColumn();
        }
}
