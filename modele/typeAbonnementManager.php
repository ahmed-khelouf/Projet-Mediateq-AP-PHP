<?php

class TypeAbonnementManager extends Manager
{

    public function getList() : array 
    {

        $q = $this->getPDO()->prepare('SELECT * FROM type_abonnement');
        $q->execute();
        $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
        
        $lesTypesAbonnement = array();
        foreach($r1 as $user)
        {
             $lesTypesAbonnement[$user['id']] = new TypeAbonnement($user['id'], $user['libelle']); 
        }
        return $lesTypesAbonnement;

    }
}