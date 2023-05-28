<?php

class EmpruntExemplaireManager extends Manager
{
    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets EmpruntExemplaire
     *
     * @return array
     */
    public function getList() : array
    {   
        $documentManager = new DocumentManager();
        $lesDocuments = $documentManager->getList();
        
        $lesExemplaires = array();
        foreach($lesDocuments as $unDocument)
        {
            $lesExemplairesDuDocument = $unDocument->getLesExemplaires();
            foreach($lesExemplairesDuDocument as $unExemplaire)
            {
                $lesExemplaires[$unExemplaire->getNumero()] = $unExemplaire;
            }
        }
        
        $q = $this->getPDO()->prepare('SELECT id, idAbonne, numero, dateDebut, dateFin, prolongable, frais_retard FROM emprunt ORDER BY dateDebut DESC');
        $q->execute();
        $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
        $lesEmprunts = array();
        foreach($r1 as $unEmprunt)
        {
            $lesEmprunts[$unEmprunt['idAbonne']][$unEmprunt['id']] = new EmpruntExemplaire($unEmprunt['id'],$unEmprunt['idAbonne'], $lesExemplaires[$unEmprunt['numero']], $unEmprunt['dateDebut'], $unEmprunt['dateFin'], $unEmprunt['prolongable'], $unEmprunt['frais_retard']);
        }
        return $lesEmprunts;
    }

        /**
     * Renvoie un tableau associatif contenant l'ensemble des objets EmpruntExemplaire non archivés
     *
     * @return array
     */
    public function getListActual() : array
    {   
        $documentManager = new DocumentManager();
        $lesDocuments = $documentManager->getList();
        
        $lesExemplaires = array();
        foreach($lesDocuments as $unDocument)
        {
            $lesExemplairesDuDocument = $unDocument->getLesExemplaires();
            foreach($lesExemplairesDuDocument as $unExemplaire)
            {
                $lesExemplaires[$unExemplaire->getNumero()] = $unExemplaire;
            }
        }
        
        $q = $this->getPDO()->prepare('SELECT id, idAbonne, numero, dateDebut, dateFin, prolongable, frais_retard FROM emprunt WHERE archive = 0');
        $q->execute();
        $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
        $lesEmprunts = array();
        foreach($r1 as $unEmprunt)
        {
            $lesEmprunts[$unEmprunt['idAbonne']][$unEmprunt['id']] = new EmpruntExemplaire($unEmprunt['id'],$unEmprunt['idAbonne'], $lesExemplaires[$unEmprunt['numero']], $unEmprunt['dateDebut'], $unEmprunt['dateFin'], $unEmprunt['prolongable'], $unEmprunt['frais_retard']);
        }
        return $lesEmprunts;
    }

            /**
     * Renvoie un tableau associatif contenant l'ensemble des objets EmpruntExemplaire non archivés
     *
     * @return array
     */
    public function getListOverdue() : array
    {   
        $documentManager = new DocumentManager();
        $lesDocuments = $documentManager->getList();
        
        $lesExemplaires = array();
        foreach($lesDocuments as $unDocument)
        {
            $lesExemplairesDuDocument = $unDocument->getLesExemplaires();
            foreach($lesExemplairesDuDocument as $unExemplaire)
            {
                $lesExemplaires[$unExemplaire->getNumero()] = $unExemplaire;
            }
        }
        
        $q = $this->getPDO()->prepare('SELECT id, idAbonne, numero, dateDebut, dateFin, prolongable, frais_retard FROM emprunt WHERE archive = 0 AND dateFin < CURRENT_DATE()');
        $q->execute();
        $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
        $lesEmprunts = array();
        foreach($r1 as $unEmprunt)
        {
            $lesEmprunts[$unEmprunt['idAbonne']][$unEmprunt['id']] = new EmpruntExemplaire($unEmprunt['id'],$unEmprunt['idAbonne'], $lesExemplaires[$unEmprunt['numero']], $unEmprunt['dateDebut'], $unEmprunt['dateFin'], $unEmprunt['prolongable'], $unEmprunt['frais_retard']);
        }
        return $lesEmprunts;
    }

    public function updateFraisDeRetard(): void 
    {
        $q = $this->getPDO()->prepare('UPDATE emprunt SET frais_retard = CASE WHEN DATEDIFF(NOW(), dateFin) >= 14 THEN 5.0 WHEN DATEDIFF(NOW(), dateFin) >= 7 THEN 2.0 ELSE 0.0 END WHERE archive = 0;');
        $q->execute();
    }

    public function updateProlongeable(): void 
    {
        $q = $this->getPDO()->prepare('UPDATE emprunt SET prolongable = CASE WHEN DATEDIFF(NOW(), dateFin) >= 0 THEN 0 ELSE prolongable END WHERE archive = 0;');
        $q->execute();
    }

    public function getFraisDeRetard($idUtilisateur): int
    {
        $q = $this->getPDO()->prepare('SELECT SUM(frais_retard) AS f_r FROM emprunt WHERE archive = 0 AND idAbonne = :id_utilisateur');
        $q->bindParam(':id_utilisateur', $idUtilisateur, PDO::PARAM_INT);
        $q->execute();
        $r1 = $q->fetchAll(PDO::FETCH_ASSOC);

        foreach($r1 as $fraisRetard){
            $nombre = $fraisRetard['f_r'];
        }

        $nombre = intval($nombre);

        return $nombre;
    }

    public function prolongerEmprunt($idEmprunt): void
    {
        $q = $this->getPDO()->prepare('UPDATE emprunt SET dateFin = DATE_ADD(dateFin, INTERVAL 7 DAY), prolongable = 0 WHERE id = :id_emprunt;');
        $q->bindParam(':id_emprunt', $idEmprunt, PDO::PARAM_INT);
        $q->execute();
    }

    public function prolongerToutEmprunt($abonne): void
    {
        $q = $this->getPDO()->prepare('UPDATE emprunt SET dateFin = DATE_ADD(dateFin, INTERVAL 7 DAY), prolongable = 0 WHERE prolongable = 1 AND archive = 0 AND numero NOT IN (SELECT numeroExemplaire FROM reservationexemplaire) AND idAbonne = :id_abonne ;');
        $q->bindParam(':id_abonne', $abonne->getId(), PDO::PARAM_INT);
        $q->execute();
    }
    
}

?>