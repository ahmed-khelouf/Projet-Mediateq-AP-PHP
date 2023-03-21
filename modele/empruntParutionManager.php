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
        
        $q = $this->getPDO()->prepare('SELECT id, idAbonne, idParution, dateDebut, dateFin, prolongable FROM emprunt_parution ORDER BY dateDebut DESC');
        $q->execute();
        $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
        $lesEmprunts = array();
        foreach($r1 as $unEmprunt)
        {
            $lesEmprunts[$unEmprunt['idAbonne']][$unEmprunt['id']] = new EmpruntParution($unEmprunt['id'],$unEmprunt['idAbonne'], $lesParutions[$unEmprunt['idParution']], $unEmprunt['dateDebut'], $unEmprunt['dateFin'], $unEmprunt['prolongable']);
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
        
        $q = $this->getPDO()->prepare('SELECT id, idAbonne, idParution, dateDebut, dateFin, prolongable FROM emprunt_parution WHERE archive = 0');
        $q->execute();
        $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
        $lesEmprunts = array();
        foreach($r1 as $unEmprunt)
        {
            $lesEmprunts[$unEmprunt['idAbonne']][$unEmprunt['id']] = new EmpruntParution($unEmprunt['id'],$unEmprunt['idAbonne'], $lesParutions[$unEmprunt['idParution']], $unEmprunt['dateDebut'], $unEmprunt['dateFin'], $unEmprunt['prolongable']);
        }
        return $lesEmprunts;
    }
    
}

?>