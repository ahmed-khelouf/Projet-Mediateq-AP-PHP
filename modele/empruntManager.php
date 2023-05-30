<?php

class empruntManager extends Manager {
    function nombreEmprunt($idAbonne)
        {
                try {
                        $q = $this->getPDO()->prepare('SELECT COUNT(*) FROM (
                        SELECT id FROM emprunt WHERE idAbonne=:idAbonne
                        UNION ALL
                        SELECT id FROM emprunt_parution WHERE idAbonne=:idAbonne ) AS total');
                        $q->bindParam(':idAbonne', $idAbonne, PDO::PARAM_INT);
                        $q->execute();
                        return $q->fetchColumn();
                } catch (PDOException $e) {
                        echo ("Une erreur s'est produite : " . $e->getMessage());
                }
        }
}