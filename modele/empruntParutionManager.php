<?php

class EmpruntParutionManager extends Manager
{
    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets Etat
     *
     * @return array
     */
    public function getList() : array
    {   
        $parutionManager = new ParutionManager();
        $lesParutions = $parutionManager->getList();
        
        /*$documentManager = new DocumentManager();
        $lesDocuments = $documentManager->getList();
        
        $lesExemplaires = array();
        foreach($lesDocuments as $unDocument)
        {
            $lesExemplairesDuDocument = $unDocument->getLesExemplaires();
            foreach($lesExemplairesDuDocument as $unExemplaire)
            {
                $lesExemplaires[$unExemplaire->getNumero()] = $unExemplaire;
            }
        }*/
        /*
        $DVDManager = new DvdManager();
        $lesDvds = $DVDManager->getList();

        $lesDocuments = array_merge($lesLivres,$lesDvds);*/

        /*$exemplaireManager = new ExemplaireManager();
        $lesExemplaires = $exemplaireManager->getList();*/
        
        $q = $this->getPDO()->prepare('SELECT id, idAbonne, idParution, dateDebut, dateFin, prolongable FROM emprunt_parution ');
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