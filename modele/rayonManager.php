<?php

class RayonManager extends Manager
{
    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets Rayon
     *
     * @return array
     */
    public function getList(): array
    {
        try {
            $q = $this->getPDO()->prepare('SELECT * FROM rayon');
            $q->execute();
            $r1 = $q->fetchAll(PDO::FETCH_ASSOC);

            $lesRayons = array();
            foreach ($r1 as $unRayon) {
                $lesRayons[$unRayon['id']] = new Rayon($unRayon['id'], $unRayon['libelle']);
            }
            return $lesRayons;
        } catch (PDOException $e) {
            echo ("une erreur s'est produite lors de la récupération des rayons : " . $e->getMessage());
        }
    }
}
