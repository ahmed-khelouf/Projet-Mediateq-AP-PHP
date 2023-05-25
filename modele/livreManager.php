<?php

class LivreManager extends Manager
{
    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets Livre
     *
     * @return array
     */
    public function getList(): array
    {
        // recupération des types de public
        $typePublicManager = new TypePublicManager(); // Création d'un objet manager de type de public
        $lesPublics = $typePublicManager->getList(); // chargement du dictionnaire des types de public
        // recupération des états
        $etatManager = new EtatManager(); // Création d'un objet manager d'état
        $lesEtats = $etatManager->getList(); // chargement du dictionnaire des états
        $rayonManager = new RayonManager(); // Création d'un objet manager de rayon
        $lesRayons = $rayonManager->getList(); // chargement du dictionnaire des états

        $q = $this->getPDO()->prepare('SELECT * FROM document JOIN livre ON document.id = livre.idDocument ORDER BY titre');
        $q->execute();
        $r1 = $q->fetchAll(PDO::FETCH_ASSOC);

        $lesLivres = array();
        foreach ($r1 as $livre) {
            if ($livre['commandeEnCours'] == null) {
                $livre['commandeEnCours'] = false;
            }
            $lesLivres[$livre['id']] = new Livre($livre['id'], $livre['titre'], $livre['image'], $livre['commandeEnCours'], $lesPublics[$livre['idPublic']], $livre['synopsis'],  $livre['ISBN'], $livre['auteur'], $livre['collection']);
            // on récupère la colection d'exemplaires de ce livre
            $q2 = $this->getPDO()->prepare('SELECT * FROM exemplaire WHERE idDocument = :id ORDER BY numero');
            $q2->bindParam(':id',  $livre['id'], PDO::PARAM_INT);
            $q2->execute();
            $r2 = $q2->fetchAll(PDO::FETCH_ASSOC);
            $lesExemplaires = array();
            foreach ($r2 as $exemplaire) {
                $lesExemplaires[$exemplaire['numero']] = new Exemplaire($exemplaire['numero'], $lesLivres[$livre['id']], $exemplaire['dateAchat'], $lesRayons[$exemplaire['idRayon']], $lesEtats[$exemplaire['idEtat']]);
            }

            // on instancie la collection d'exemplaires dans l'objet livre
            $lesLivres[$livre['id']]->setlesExemplaires($lesExemplaires);
        }
        return $lesLivres;
    }

    /**
     * Renvoie l'objet Livre dont l'id correspond à la valeur du parametre $id
     *
     * @param string $id
     * @return void
     */
    public function getLivreById(string $id): Livre // récupère un objet Livre en fonction de son id
    {
        $catalogue = $this->getList();

        return $catalogue[$id];
    }



    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets Livre dont les identifiants appartiennent au tableau d'entier $listeId
     *
     * @param array $listeId
     * @return void
     */
    public function getLivresByListId(array $listeId): array
    {
        $lesLivres = array();
        $catalogue = $this->getList();
        foreach ($listeId as $id) {
            $lesLivres[$id] = $catalogue[$id];
        }
        return $lesLivres;
    }

    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets Livre dont le titre contient la chaine $texte
     *
     * @param string $texte
     * @return void
     */
    public function getLivreCritereSimple(string $texte): array
    {
        $q = $this->getPDO()->prepare('SELECT DISTINCT document.id FROM document JOIN livre ON document.id = livre.idDocument WHERE document.titre LIKE :texte');
        $q->bindValue(':texte',  "%" . $texte . "%", PDO::PARAM_STR);
        $q->execute();
        $r = $q->fetchAll(PDO::FETCH_ASSOC);
        $lesId = array();
        foreach ($r as $livre) {
            array_push($lesId, $livre['id']);
        }
        return $this->getLivresByListId($lesId);
    }



    /**
     * Effectue une recherche avancée des livres en fonction des critères spécifiés
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
    public function getLivreCritereAvancee(string $texte, string $critere, string $option2, string $texte2, string $critere2, string $option3, string $texte3, string $critere3): array
    {
        $sql = 'SELECT DISTINCT * FROM livre INNER JOIN document ON document.id = livre.idDocument WHERE ';

        $conditions = []; // Tableau pour stocker les conditions de recherche

        // Ajoute la première condition de recherche en fonction du critère choisi
        switch ($critere) {
            case 'titre':
                $conditions[] = 'document.titre LIKE :texte'; // Recherche par titre
                break;
            case 'auteur':
                $conditions[] = 'livre.auteur LIKE :texte'; // Recherche par auteur
                break;
            case 'collection':
                $conditions[] = 'livre.collection LIKE :texte'; // Recherche par collection
                break;
            case 'isbn':
                $conditions[] = 'livre.ISBN LIKE :texte'; // Recherche par ISBN
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
                    $conditions[] = 'AND livre.auteur LIKE :texte2'; // Recherche par auteur
                    break;
                case 'collection':
                    $conditions[] = 'AND livre.collection LIKE :texte2'; // Recherche par collection
                    break;
                case 'isbn':
                    $conditions[] = 'AND livre.ISBN LIKE :texte2'; // Recherche par ISBN
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
                    $conditions[] = 'OR livre.auteur LIKE :texte2'; // Recherche par auteur
                    break;
                case 'collection':
                    $conditions[] = 'OR livre.collection LIKE :texte2'; // Recherche par collection
                    break;
                case 'isbn':
                    $conditions[] = 'OR livre.ISBN LIKE :texte2'; // Recherche par ISBN
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
                    $conditions[] = 'AND livre.auteur NOT LIKE :texte2'; // Exclusion par auteur
                    break;
                case 'collection':
                    $conditions[] = 'AND livre.collection NOT LIKE :texte2'; // Exclusion par collection
                    break;
                case 'isbn':
                    $conditions[] = 'AND livre.ISBN NOT LIKE :texte2'; // Exclusion par ISBN
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
                    $conditions[] = 'AND livre.auteur LIKE :texte3'; // Recherche par auteur
                    break;
                case 'collection':
                    $conditions[] = 'AND livre.collection LIKE :texte3'; // Recherche par collection
                    break;
                case 'isbn':
                    $conditions[] = 'AND livre.ISBN LIKE :texte3'; // Recherche par ISBN
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
                    $conditions[] = 'OR livre.auteur LIKE :texte3'; // Recherche par auteur
                    break;
                case 'collection':
                    $conditions[] = 'OR livre.collection LIKE :texte3'; // Recherche par collection
                    break;
                case 'isbn':
                    $conditions[] = 'OR livre.ISBN LIKE :texte3'; // Recherche par ISBN
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
                    $conditions[] = 'AND livre.auteur NOT LIKE :texte3'; // Exclusion par auteur
                    break;
                case 'collection':
                    $conditions[] = 'AND livre.collection NOT LIKE :texte3'; // Exclusion par collection
                    break;
                case 'isbn':
                    $conditions[] = 'AND livre.ISBN NOT LIKE :texte3'; // Exclusion par ISBN
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

        $lesId = [];
        foreach ($r as $livre) {
            $lesId[] = $livre['id'];
        }

        return $this->getLivresByListId($lesId);
    }

    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets Livre dont la date d'achat date de moins de $nbJours jours
     *
     * @param integer $nbjours
     * @return array
     */
    public function getNouveautes(int $nbjours): array
    {
        $q = $this->getPDO()->prepare('SELECT DISTINCT exemplaire.idDocument FROM exemplaire JOIN livre ON exemplaire.idDocument = livre.idDocument WHERE dateAchat > date_sub(now(), INTERVAL :nbjours DAY)');
        $q->bindParam(':nbjours',  $nbjours, PDO::PARAM_INT);
        $q->execute();
        $r = $q->fetchAll(PDO::FETCH_ASSOC);
        $lesId = array();
        foreach ($r as $livre) {
            array_push($lesId, $livre['idDocument']);
        }
        return $this->getLivresByListId($lesId);
    }
}
