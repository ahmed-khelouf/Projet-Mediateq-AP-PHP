<?php

class DvdManager extends Manager
{
    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets Dvd
     *
     * @return array
     */
    public function getList() : array
    {
        // recupération des types de public
        $typePublicManager = new TypePublicManager(); // Création d'un objet manager de type de public
        $lesPublics = $typePublicManager->getList(); // chargement du dictionnaire des types de public
        // recupération des états
        $etatManager = new EtatManager(); // Création d'un objet manager d'état
        $lesEtats = $etatManager->getList(); // chargement du dictionnaire des états
        $rayonManager = new RayonManager(); // Création d'un objet manager de rayon
        $lesRayons = $rayonManager->getList(); // chargement du dictionnaire des états
        
        $q = $this->getPDO()->prepare('SELECT * FROM document JOIN dvd ON document.id = dvd.idDocument ORDER BY titre');
        $q->execute();
        $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
        
        $lesDvd = array();
        foreach($r1 as $dvd)
        {
            if ($dvd['commandeEnCours'] == null){
                $dvd['commandeEnCours'] = false;
            }
            $lesDvd[$dvd['id']] = new Dvd($dvd['id'], $dvd['titre'], $dvd['image'], $dvd['commandeEnCours'], $lesPublics[$dvd['idPublic']], $dvd['synopsis'], $dvd['réalisateur'],$dvd['duree']);
            // on récupère la colection d'exemplaires de ce livre
            $q2 = $this->getPDO()->prepare('SELECT * FROM exemplaire WHERE idDocument = :id ORDER BY numero');
            $q2->bindParam(':id',  $dvd['id'], PDO::PARAM_INT);
            $q2->execute();
            $r2 = $q2->fetchAll(PDO::FETCH_ASSOC);
            $lesExemplaires = array();
            foreach($r2 as $exemplaire)
            {
                $lesExemplaires[$exemplaire['numero']] = new Exemplaire($exemplaire['numero'], $lesDvd[$dvd['id']] ,$exemplaire['dateAchat'],$lesRayons[$exemplaire['idRayon']],$lesEtats[$exemplaire['idEtat']]);
            }
            // on instancie la collection d'exemplaires dans l'objet livre
            $lesDvd[$dvd['id']]->setlesExemplaires($lesExemplaires);

        }
        return $lesDvd;
    }

    /**
     * Renvoie l'objet Dvd dont l'id correspond à la valeur du parametre $id
     *
     * @param string $id
     * @return void
     */
    public function getDvdById(string $id) : Dvd
    {
        $catalogue = $this->getList();
        return $catalogue[$id];
    }

    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets Dvd dont les identifiants appartienent au tableau d'entier $listeId
     *
     * @param array $listeId
     * @return void
     */
    public function getDvdByListId(array $listeId) : array 
    {
        $lesDvd = array();
        $catalogue = $this->getList();
        foreach($listeId as $id){
            $lesDvd[$id] = $catalogue[$id];
        }
        return $lesDvd;
    }

    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets Dvd dont le titre contient la chaine $texte
     *
     * @param string $texte
     * @return void
     */
    public function getDvdCritereSimple(string $texte) : array
    {
        $q = $this->getPDO()->prepare('SELECT DISTINCT document.id FROM document JOIN dvd ON document.id = dvd.idDocument WHERE document.titre LIKE :texte');
        $q->bindValue(':texte',  "%".$texte."%", PDO::PARAM_STR);
        $q->execute();
        //$q->debugDumpParams();
        $r = $q->fetchAll(PDO::FETCH_ASSOC);
        $lesId = array();
        foreach($r as $dvd){
            array_push($lesId, $dvd['id']);
        }
        return $this->getDvdByListId($lesId);
    }

    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets Dvd dont la date d'achat date de moins de $nbJours jours
     *
     * @param integer $nbjours
     * @return array
     */
    public function getNouveautes(int $nbjours) : array
    {
        $q = $this->getPDO()->prepare('SELECT DISTINCT exemplaire.idDocument FROM exemplaire JOIN dvd ON exemplaire.idDocument = dvd.idDocument WHERE dateAchat > date_sub(now(), INTERVAL :nbjours DAY)');
        $q->bindParam(':nbjours',  $nbjours, PDO::PARAM_INT);
        $q->execute();
        $r = $q->fetchAll(PDO::FETCH_ASSOC);
        $lesId = array();
        foreach($r as $dvd){
            array_push($lesId, $dvd['idDocument']);
        }
        return $this->getDvdByListId($lesId);

    }

    /**
     *  Effectue une recherche avancée des DVD en fonction des critères spécifiés
     *
     * @param string $texte
     * @param string $critere
     * @param string $option2
     * @param string $texte2
     * @param string $critere2
     * @param string $option3
     * @param string $texte3
     * @param string $critere3
     * @return array
     */
    public function getDVDCritereAvancee(string $texte, string $critere, string $option2, string $texte2, string $critere2, string $option3, string $texte3, string $critere3): array
    {
        $sql = 'SELECT DISTINCT * FROM dvd INNER JOIN document ON document.id = dvd.idDocument WHERE ';

        $conditions = []; // Tableau pour stocker les conditions de recherche

        // Ajoute la première condition de recherche en fonction du critère choisi
        switch ($critere) {
            case 'titre':
                $conditions[] = 'document.titre LIKE :texte'; // Recherche par titre
                break;
            case 'auteur':
                $conditions[] = 'dvd.réalisateur LIKE :texte'; // Recherche par auteur
                break;
            default:
                $conditions[] = 'null LIKE :texte'; // Critère invalide, retourne un tableau vide
        }

        // Vérifie l'option choisie et ajoute la deuxième condition de recherche si nécessaire
        if ($option2 === 'et' && $texte2 !== null) {
            switch ($critere2) {
                case 'titre':
                    $conditions[] = 'AND document.titre LIKE :texte2'; // Recherche par titre
                    break;
                case 'auteur':
                    $conditions[] = 'AND dvd.réalisateur LIKE :texte2'; // Recherche par auteur
                    break;
                default:
                    $conditions[] = 'AND null LIKE :texte2'; // Critère invalide, retourne un tableau vide
            }
        } elseif ($option2 === 'ou' && $texte2 !== null) {
            switch ($critere2) {
                case 'titre':
                    $conditions[] = 'OR document.titre LIKE :texte2'; // Recherche par titre
                    break;
                case 'auteur':
                    $conditions[] = 'OR dvd.réalisateur LIKE :texte2'; // Recherche par auteur
                    break;
                default:
                    $conditions[] = 'OR null LIKE :texte2'; // Critère invalide, retourne un tableau vide
            }
        } elseif ($option2 === 'sauf' && $texte2 !== null) {
            switch ($critere2) {
                case 'titre':
                    $conditions[] = 'AND document.titre NOT LIKE :texte2'; // Exclusion par titre
                    break;
                case 'auteur':
                    $conditions[] = 'AND dvd.réalisateur NOT LIKE :texte2'; // Exclusion par auteur
                    break;
                default:
                    $conditions[] = 'AND null NOT LIKE :texte2'; // Critère invalide, retourne un tableau vide
            }
        }

        // Vérifie l'option choisie et ajoute la troisième condition de recherche si nécessaire
        if ($option3 === 'et' && $texte3 !== null) {
            switch ($critere3) {
                case 'titre':
                    $conditions[] = 'AND document.titre LIKE :texte3'; // Recherche par titre
                    break;
                case 'auteur':
                    $conditions[] = 'AND dvd.réalisateur LIKE :texte3'; // Recherche par auteur
                    break;
                default:
                    $conditions[] = 'AND null LIKE :texte3'; // Critère invalide, retourne un tableau vide
            }
        } elseif ($option3 === 'ou' && $texte3 !== null) {
            switch ($critere3) {
                case 'titre':
                    $conditions[] = 'OR document.titre LIKE :texte3'; // Recherche par titre
                    break;
                case 'auteur':
                    $conditions[] = 'OR dvd.réalisateur LIKE :texte3'; // Recherche par auteur
                    break;
                default:
                    $conditions[] = 'OR null LIKE :texte3'; // Critère invalide, retourne un tableau vide
            }
        } elseif ($option3 === 'sauf' && $texte3 !== null) {
            switch ($critere3) {
                case 'titre':
                    $conditions[] = 'AND document.titre NOT LIKE :texte3'; // Exclusion par titre
                    break;
                case 'auteur':
                    $conditions[] = 'AND dvd.réalisateur NOT LIKE :texte3'; // Exclusion par auteur
                    break;
                default:
                    $conditions[] = 'AND null NOT LIKE :texte3'; // Critère invalide, retourne un tableau vide
            }
        }


        $sql .= implode(' ', $conditions); // Combinaison des conditions de recherche

        $q = $this->getPDO()->prepare($sql);
        $q->bindValue(':texte', '%' . trim($texte) . '%', PDO::PARAM_STR); //trim() supprime les espaces en début et fin de chaîne

        if ($option2 === 'et' || $option2 === 'ou' || $option2 === 'sauf') {
            $q->bindValue(':texte2', '%' . trim($texte2) . '%', PDO::PARAM_STR);
        }

        if ($option3 === 'et' || $option3 === 'ou' || $option3 === 'sauf') {
            $q->bindValue(':texte3', '%' . trim($texte3) . '%', PDO::PARAM_STR);
        }

        // Exécute la requête et récupère les résultats...

        $q->execute();
        $r = $q->fetchAll(PDO::FETCH_ASSOC);

        $lesId = array();
        foreach($r as $dvd){
            array_push($lesId, $dvd['idDocument']);
        }

        return $this->getDvdByListId($lesId);
    }

}

?>