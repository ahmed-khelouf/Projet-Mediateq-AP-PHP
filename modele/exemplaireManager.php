<?php

class ExemplaireManager extends Manager
{
    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets Exemplaire
     *
     * @return array
     */
    public function getList(): array
    {
        $documentManager  = new DocumentManager();
        $documents = $documentManager->getList();

        $etatManager = new EtatManager();
        $etats = $etatManager->getList();

        $rayonManger = new RayonManager();
        $rayons = $rayonManger->getList();

        $q = $this->getPDO()->prepare('SELECT * FROM exemplaire');
        $q->execute();
        //fetchAll(PDO::FETCH_ASSOC) est une méthode de l'objet PDOStatement qui permet de récupérer le résultat d'une requête SQL sous forme de tableau associatif.Chaque ligne du résultat est représentée par un tableau associatif dont les clés correspondent aux noms des colonnes de la table et les valeurs correspondent aux valeurs des champs de chaque ligne.
        $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
        $lesExemplaires = array();
        foreach ($r1 as $unExemplaire) {
            $document = $documents[$unExemplaire['idDocument']];
            $etat = $etats[$unExemplaire['idEtat']];
            $rayon = $rayons[$unExemplaire['idRayon']];
            $lesExemplaires[$unExemplaire['numero']] = new Exemplaire(
                $unExemplaire['numero'],
                $document,
                $unExemplaire['dateAchat'],
                $rayon,
                $etat
            );
        }
        return $lesExemplaires;
    }
}
