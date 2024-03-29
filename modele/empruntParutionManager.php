<?php

class EmpruntParutionManager extends Manager
{
    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets EmpruntParution
     *
     * @return array
     */
    public function getList() : array
    {   
        $parutionManager = new ParutionManager();
        $lesParutions = $parutionManager->getList();
        
        $q = $this->getPDO()->prepare('SELECT id, idAbonne, idParution, dateDebut, dateFin, prolongable, frais_retard FROM emprunt_parution ORDER BY dateDebut DESC');
        $q->execute();
        $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
        $lesEmprunts = array();
        foreach($r1 as $unEmprunt)
        {
            $lesEmprunts[$unEmprunt['idAbonne']][$unEmprunt['id']] = new EmpruntParution($unEmprunt['id'],$unEmprunt['idAbonne'], $lesParutions[$unEmprunt['idParution']], $unEmprunt['dateDebut'], $unEmprunt['dateFin'], $unEmprunt['prolongable'], $unEmprunt['frais_retard']);
        }
        return $lesEmprunts;
    }

     /**
     * Renvoie un tableau associatif contenant l'ensemble des objets EmpruntParution non archivés
     *
     * @return array
     */
    public function getListActual() : array
    {   
        $parutionManager = new ParutionManager();
        $lesParutions = $parutionManager->getList();
        
        $q = $this->getPDO()->prepare('SELECT id, idAbonne, idParution, dateDebut, dateFin, prolongable, frais_retard FROM emprunt_parution WHERE archive = 0');
        $q->execute();
        $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
        $lesEmprunts = array();
        foreach($r1 as $unEmprunt)
        {
            $lesEmprunts[$unEmprunt['idAbonne']][$unEmprunt['id']] = new EmpruntParution($unEmprunt['id'],$unEmprunt['idAbonne'], $lesParutions[$unEmprunt['idParution']], $unEmprunt['dateDebut'], $unEmprunt['dateFin'], $unEmprunt['prolongable'], $unEmprunt['frais_retard']);
        }
        return $lesEmprunts;
    }

     /**
     * Renvoie un tableau associatif contenant l'ensemble des objets EmpruntParution en retard
     *
     * @return array
     */
    public function getListOverdue() : array
    {   
        $parutionManager = new ParutionManager();
        $lesParutions = $parutionManager->getList();
        
        $q = $this->getPDO()->prepare('SELECT id, idAbonne, idParution, dateDebut, dateFin, prolongable, frais_retard FROM emprunt_parution WHERE archive = 0 AND dateFin < CURRENT_DATE()');
        $q->execute();
        $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
        $lesEmprunts = array();
        foreach($r1 as $unEmprunt)
        {
            $lesEmprunts[$unEmprunt['idAbonne']][$unEmprunt['id']] = new EmpruntParution($unEmprunt['id'],$unEmprunt['idAbonne'], $lesParutions[$unEmprunt['idParution']], $unEmprunt['dateDebut'], $unEmprunt['dateFin'], $unEmprunt['prolongable'], $unEmprunt['frais_retard']);
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
    public function updateFraisDeRetard() 
    {
        $q = $this->getPDO()->prepare('UPDATE emprunt_parution SET frais_retard = CASE WHEN DATEDIFF(NOW(), dateFin) >= 14 THEN 5.0 WHEN DATEDIFF(NOW(), dateFin) >= 7 THEN 2.0 ELSE 0.0 END WHERE archive = 0;');
        $q->execute();
    }

    /**
     * Met à jour la valeur 'prolongeable' des emprunts, si leur date de fin d'emprunt est dépassé
     * @return void
     */
    public function updateProlongeable() 
    {
        $q = $this->getPDO()->prepare('UPDATE emprunt_parution SET prolongable = CASE WHEN DATEDIFF(NOW(), dateFin) >= 0 THEN 0 ELSE prolongable END WHERE archive = 0;');
        $q->execute();
    }

    /**
     * Prolonge l'emprunt passé en paramêtre, d'une semaine.
     * @return void
     */
    public function prolongerEmprunt($idEmprunt)
    {
        $q = $this->getPDO()->prepare('UPDATE emprunt_parution SET dateFin = DATE_ADD(dateFin, INTERVAL 7 DAY), prolongable = 0 WHERE id = :id_emprunt;');
        $q->bindParam(':id_emprunt', $idEmprunt, PDO::PARAM_INT);
        $q->execute();
    }

    /**
     * Prolonge tout les emprunts prolongeables de l'abonné passé en paramêtre, d'une semaine.
     *
     * @param Abonne $abonne
     * @return void
     */
    public function prolongerToutEmprunt(Abonne $abonne)
    {
        $q = $this->getPDO()->prepare('UPDATE emprunt_parution SET dateFin = DATE_ADD(dateFin, INTERVAL 7 DAY), prolongable = 0 WHERE prolongable = 1 AND archive = 0 AND idParution NOT IN (SELECT numeroParution FROM reservationparution) AND idAbonne = :id_abonne ;');
        $q->bindParam(':id_abonne', $abonne->getId(), PDO::PARAM_INT);
        $q->execute();
    }
}