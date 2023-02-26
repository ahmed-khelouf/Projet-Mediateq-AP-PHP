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

                $q = $this->getPDO()->prepare('SELECT reservation.idR ,  idRevue ,  idAbonne , reservation.rang FROM reservation inner join abonné on abonné.id=reservation.idAbonne inner join revue on reservation.idRevue=revue.id ');
                $q->execute();
                $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
                $lesReservations = array();
                foreach ($r1 as $uneReservation) {
                        $revue = $revues[$uneReservation['idRevue']];
                        $abonne = $abonnes[$uneReservation['idAbonne']];
                        $lesReservations[$uneReservation['idR']] = new Reservation($uneReservation['idR'], $revue, $abonne, $uneReservation['rang']);
                }
                return $lesReservations;
        }

        /**
         * Retourne le rang d'une reservation dans la base de données si elle existe
         */
        function getRang($idRevue)
        {
                $q = $this->getPDO()->prepare('SELECT rang FROM reservation WHERE idRevue = :idRevue ');
                $q->bindParam(':idRevue', $idRevue, PDO::PARAM_STR);
                $q->execute();
                return $q->fetchColumn();
        }

        /**
         * recuperation du rang le plus élevé pour une revue 
         */
        function recupMaxRang($idRevue)
        {
                $q = $this->getPDO()->prepare('SELECT MAX(rang) FROM reservation WHERE idRevue = :idRevue');
                $q->bindParam(':idRevue', $idRevue, PDO::PARAM_INT);
                $q->execute();
                return $q->fetchColumn();
        }

        /**
         * modifie le rang pour les reservations superieures au rang supprimé dans une revue
         */
        function UpdateRang($idRevue, $rang)
        {
                $q = $this->getPDO()->prepare('UPDATE reservation set rang = rang - 1 where idRevue=:idRevue AND rang > :rang ');
                $q->bindParam(':idRevue', $idRevue, PDO::PARAM_STR);
                $q->bindParam(':rang', $rang, PDO::PARAM_INT);
                $q->execute();
        }

        /**
         * insert une reservation dans la base de données
         */
        function addReservation($idRevue, $idAbonne, $rang)
        {
                $q = $this->getPDO()->prepare('INSERT INTO reservation (idRevue , dateReservation , idAbonne , rang ) VALUES (:idRevue , Current_Date , :idAbonne , :rang)');
                $q->bindParam(':idRevue', $idRevue, PDO::PARAM_STR);
                $q->bindParam(':idAbonne', $idAbonne, PDO::PARAM_INT);
                $q->bindParam(':rang', $rang, PDO::PARAM_INT);
                $q->execute();
        }


        /**
         * supprime une reservation dans la base de données
         */
        function supReservation($idR, $idRevue, $rang)
        {
                $q = $this->getPDO()->prepare('DELETE FROM reservation WHERE idR = :idR');
                $q->bindParam(':idR', $idR, PDO::PARAM_STR);
                $maxRangReservation=$this->recupMaxRang($idRevue);
                if ( $maxRangReservation> $rang) {
                         $this->UpdateRang($idRevue, $rang);
                }
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
