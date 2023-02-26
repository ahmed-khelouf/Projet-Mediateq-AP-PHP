<?php

class descripteurManager extends Manager
{
    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets Descripteur
     *
     * @return array
     */
    public function getList(): array
    {
        $q = $this->getPDO()->prepare('SELECT * FROM descripteur');
        $q->execute();
        $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
        $lesDescripteurs = array();
        foreach ($r1 as $uneDescription) {
            $lesDescripteurs[$uneDescription['id']] = new Descripteur($uneDescription['id'], $uneDescription['libelle']);
        }
        return $lesDescripteurs;
    }
}

?>