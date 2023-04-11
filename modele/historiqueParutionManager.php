<?php

class HistoriqueParutionManager extends Manager
{
    /**
     * insertion historique d'une reservation dans la base de données
     */
    function addHistorique($idAbonne , $idRevue , $numeroParution )
    {
        try {
            $id = uniqid(); // Générer un ID unique
            $q = $this->getPDO()->prepare('INSERT INTO historiqueParution (id , idAbonne,  dateReservation , idRevue , numeroParution) VALUES (:id ,:idAbonne, CURRENT_TIMESTAMP() , :idRevue , :numeroParution)');
            $q->bindParam(':id', $id, PDO::PARAM_STR);
            $q->bindParam(':idAbonne', $idAbonne, PDO::PARAM_INT);
            $q->bindParam(':idRevue', $idRevue, PDO::PARAM_STR);
            $q->bindParam(':numeroParution', $numeroParution, PDO::PARAM_INT);
            $q->execute();
        } catch (PDOException $e) {
            echo ("Une erreur s'est produite lors de l'ajout de l'historique : " . $e->getMessage());
        }
    }
}
