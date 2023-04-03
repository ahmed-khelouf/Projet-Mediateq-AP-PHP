<?php

class StatutManager extends Manager
{
    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets Statut
     *
     * @return array
     */
    public function getList() : array
    {
        $q = $this->getPDO()->prepare('SELECT * FROM statut');
        $q->execute();
        $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
        
        $lesStatuts = array();
        foreach($r1 as $unStatut)
        {
            $lesStatuts[$unStatut['id']] = new Statut($unStatut['id'], $unStatut['libelle']);

        }
        return $lesStatuts;
    }

}

?>
