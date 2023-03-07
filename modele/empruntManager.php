<?php

class EmpruntManager extends Manager
{
    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets Etat
     *
     * @return array
     */
    public function getEmprunts() : array
    {
        $livreManager = new LivreManager();
        $lesLivres = $livreManager->getList();

        $DVDManager = new DvdManager();
        $lesDvds = $DVDManager->getList();

        $lesDocuments = array_merge($lesLivres,$lesDvds); 
        
        $q = $this->getPDO()->prepare('SELECT idAbonne, idDocument, dateDebut, dateFin, prolongable FROM emprunt ');
        $q->execute();
        $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
        $lesEmprunts = array();
        foreach($r1 as $unEmprunt)
        {
            $lesEmprunts[$unEmprunt['idAbonne']][$unEmprunt['idDocument']] = new Emprunt($unEmprunt['idAbonne'], $lesDocuments[$unEmprunt['idDocument']], $unEmprunt['dateDebut'], $unEmprunt['dateFin'], $unEmprunt['prolongable']);
        }
        return $lesEmprunts;
    }

}

?>