<?php

class ReservationManager extends Manager
{
     /**
         * retourne le nombre de réservation pour chaque abonne
         */
        function nombreReservation($idAbonne)
        {
                try {
                        $q = $this->getPDO()->prepare('SELECT count(reservation.idR) from reservation where idAbonne=:idAbonne');
                        $q->bindParam(':idAbonne', $idAbonne, PDO::PARAM_INT);
                        $q->execute();
                        // fetchColumn est utilisé pour récupérer la valeur d'une seule colonne de la première ligne d'un résultat
                        return $q->fetchColumn();
                } catch (PDOException $e) {
                        echo ("Une erreur s'est produite : " . $e->getMessage());
                }
        }
}

?>
