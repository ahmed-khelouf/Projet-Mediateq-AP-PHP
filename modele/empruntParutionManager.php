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

    public function updateFraisDeRetard(): void 
    {
        $q = $this->getPDO()->prepare('UPDATE emprunt_parution SET frais_retard = CASE WHEN DATEDIFF(NOW(), dateFin) >= 14 THEN 5.0WHEN DATEDIFF(NOW(), dateFin) >= 7 THEN 2.0 ELSE 0.0 END WHERE archive = 0;');
        $q->execute();
    }

    public function getFraisDeRetard(): int
    {
        $q = $this->getPDO()->prepare('SELECT SUM(frais_retard) AS f_r FROM emprunt_parution WHERE archive = 0');
        $q->execute();
        $r1 = $q->fetchAll(PDO::FETCH_ASSOC);

        foreach($r1 as $fraisRetard){
            $nombre = $fraisRetard['f_r'];
        }

        $nombre = intval($nombre);

        return $nombre;
    }
    
}