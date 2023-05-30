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
     * Renvoie un tableau associatif contenant l'ensemble des objets EmpruntExemplaire non archivés et en retard
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

    

    /**
     * Met à jour les frais de retard sur la base de donnée selon le schéma suivant:
     * Si une semaine de retard : 2€
     * Si deux semaines de retard : 5€
     * 
     * @return void
     */
    public function updateFraisDeRetard(): void 
    {
        $q = $this->getPDO()->prepare('UPDATE emprunt SET frais_retard = CASE WHEN DATEDIFF(NOW(), dateFin) >= 14 THEN 5.0 WHEN DATEDIFF(NOW(), dateFin) >= 7 THEN 2.0 ELSE 0.0 END WHERE archive = 0;');
        $q->execute();
    }

    /**
     * Met à jour la valeur 'prolongeable' des emprunts, si leur date de fin d'emprunt est dépassé
     * @return void
     */
    public function updateProlongeable(): void 
    {
        $q = $this->getPDO()->prepare('UPDATE emprunt SET prolongable = CASE WHEN DATEDIFF(NOW(), dateFin) >= 0 THEN 0 ELSE prolongable END WHERE archive = 0;');
        $q->execute();
    }

    /**
     * Prolonge l'emprunt passé en paramêtre, d'une semaine.
     * @return void
     */
    public function prolongerEmprunt($idEmprunt): void
    {
        $q = $this->getPDO()->prepare('UPDATE emprunt SET dateFin = DATE_ADD(dateFin, INTERVAL 7 DAY), prolongable = 0 WHERE id = :id_emprunt;');
        $q->bindParam(':id_emprunt', $idEmprunt, PDO::PARAM_INT);
        $q->execute();
    }

    /**
     * Prolonge tout les emprunts prolongeables de l'abonné passé en paramêtre, d'une semaine.
     *
     * @param Abonne $abonne
     * @return void
     */
    public function prolongerToutEmprunt(Abonne $abonne): void
    {
        $q = $this->getPDO()->prepare('UPDATE emprunt SET dateFin = DATE_ADD(dateFin, INTERVAL 7 DAY), prolongable = 0 WHERE prolongable = 1 AND archive = 0 AND numero NOT IN (SELECT numeroExemplaire FROM reservationexemplaire) AND idAbonne = :id_abonne ;');
        $q->bindParam(':id_abonne', $abonne->getId(), PDO::PARAM_INT);
        $q->execute();
    }
    
}

?>