<?php

class ReservationManager extends Manager
{
        /**
         * retourne le nombre de réservation  en cours pour chaque abonne
         */
        function nombreReservation($idAbonne)
        {
                try {
                        $q = $this->getPDO()->prepare('SELECT COUNT(*) FROM (
                        SELECT idR FROM reservationExemplaire WHERE idAbonne=:idAbonne
                        UNION ALL
                        SELECT idR FROM reservationParution WHERE idAbonne=:idAbonne ) AS total');
                        $q->bindParam(':idAbonne', $idAbonne, PDO::PARAM_INT);
                        $q->execute();
                        return $q->fetchColumn();
                } catch (PDOException $e) {
                        echo ("Une erreur s'est produite : " . $e->getMessage());
                }
        }

        function nombreReservationAutorise($idAbonne)
      {
              try {
                      $q = $this->getPDO()->prepare('SELECT COUNT() AS total
                      FROM (
                          SELECT idR
                          FROM reservationExemplaire
                          WHERE idAbonne = :idAbonne AND dateReservation > DATE_SUB(NOW(), INTERVAL 3 WEEK)
                          UNION ALL
                          SELECT idR
                          FROM reservationParution
                          WHERE idAbonne = :idAbonne AND dateReservation > DATE_SUB(NOW(), INTERVAL 3 WEEK)) AS subquery'); // subquery pour avoir le count de la table union$q->bindParam(':idAbonne', $idAbonne, PDO::PARAM_INT);$q->execute();
                      return $q->fetchColumn();} catch (PDOException $e) {
                      echo ("Une erreur s'est produite : " . $e->getMessage());
                }
                }

}
