<?php

class ParutionManager extends Manager
{
    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets Parution
     *
     * @return array
     */
    public function getList(): array
    {
        $revueManager = new RevueManager();
        $revues = $revueManager->getList();

        $etatManager = new EtatManager();
        $etats = $etatManager->getList();

        $q = $this->getPDO()->prepare('SELECT * FROM parution');
        $q->execute();
        //fetchAll(PDO::FETCH_ASSOC) est une méthode de l'objet PDOStatement qui permet de récupérer le résultat d'une requête SQL sous forme de tableau associatif.Chaque ligne du résultat est représentée par un tableau associatif dont les clés correspondent aux noms des colonnes de la table et les valeurs correspondent aux valeurs des champs de chaque ligne.
        $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
        $lesParutions = array();
        foreach ($r1 as $uneParution) {
            $revue = $revues[$uneParution['idRevue']];
            $etat = $etats[$uneParution['idEtat']];
            $lesParutions[$uneParution['numero']] = new Parution(
                $uneParution['numero'],
                $revue,
                $uneParution['dateParution'],
                $uneParution['photo'],
                $etat
            );
        }
        return $lesParutions;
    }
}
