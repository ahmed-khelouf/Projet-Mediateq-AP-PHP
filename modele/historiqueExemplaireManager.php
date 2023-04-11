<?php

class HistoriqueExemplaireManager extends Manager
{
    /**
     * insertion historique d'une reservation dans la base de données
     */
    function addHistorique($idAbonne , $idDoc , $numeroExemplaire )
    {
        try {
            $id = uniqid(); // Générer un ID unique
            $q = $this->getPDO()->prepare('INSERT INTO historiqueExemplaire (id ,idAbonne,  dateReservation , idDoc , numeroExemplaire) VALUES (:id ,:idAbonne,  CURRENT_TIMESTAMP() , :idDoc , :numeroExemplaire)');
            $q->bindParam(':id', $id, PDO::PARAM_STR);
            $q->bindParam(':idAbonne', $idAbonne, PDO::PARAM_INT);
            $q->bindParam(':idDoc', $idDoc, PDO::PARAM_STR);
            $q->bindParam(':numeroExemplaire', $numeroExemplaire, PDO::PARAM_INT);
            $q->execute();
        } catch (PDOException $e) {
            echo ("Une erreur s'est produite lors de l'ajout de l'historique : " . $e->getMessage());
        }
    }
}
