<?php

class typeAbonnementManager extends Manager
{

    public function getList() : array 
    {

        $q = $this->getPDO()->prepare('SELECT * FROM typeAbonnement');
        $q->execute();
        $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
        
        $lesTypesAbonnement = array();
        foreach($r1 as $user)
        {
            $lesTypesAbonnement[$user['id']] = new typeAbonnement((int)$user['id'], $user['libelle']); 
        }
        return $lesTypesAbonnement;
        
    }
}