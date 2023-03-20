<?php

class ExemplaireManager extends Manager
{
    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets Etat
     *
     * @return array
     */
    public function getList() : array
    {
        $documentManager = new DocumentManager;
        $lesDocuments = $documentManager->getList();

        foreach($r1 as $unExemplaire)
        {
            $lesExemplaires[$unExemplaire['numero']] = new Exemplaire($unExemplaire['numero'], $unExemplaire['numero'], $unExemplaire['dateAchat'], $lesRayons[$unExemplaire['idRayon']], $lesEtats[$unExemplaire['idEtat']]);
        }
        return $lesExemplaires;
    }
    
}

?>