<?php

class TypePublicManager extends Manager
{
    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets TypePublic
     *
     * @return array
     */
    public function getList(): array
    {
        try {
            $q = $this->getPDO()->prepare('SELECT * FROM public');
            $q->execute();
            $r1 = $q->fetchAll(PDO::FETCH_ASSOC);

            $lesPublics = array();
            foreach ($r1 as $unPublic) {
                $lesPublics[$unPublic['id']] = new TypePublic($unPublic['id'], $unPublic['libelle']);
            }
            return $lesPublics;
        } catch (PDOException $e) {
            echo ("une erreur s'est produite lors de la récupération des typesPublics : " . $e->getMessage());
        }
    }
}
