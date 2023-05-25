<?php

class HistoriqueManager extends Manager
{
        /**
         * retourne le nombre de réservation pour chaque abonne (hisorique)
         */
        function nombreHistorique($idAbonne)
        {
                try {
                        $q = $this->getPDO()->prepare('SELECT COUNT(*) FROM (
                        SELECT id FROM historiqueParution WHERE idAbonne=:idAbonne
                        UNION ALL
                        SELECT id FROM historiqueExemplaire WHERE idAbonne=:idAbonne ) AS total');
                        $q->bindParam(':idAbonne', $idAbonne, PDO::PARAM_INT);
                        $q->execute();
                        return $q->fetchColumn();
                } catch (PDOException $e) {
                        echo ("Une erreur s'est produite : " . $e->getMessage());
                }
        }
}