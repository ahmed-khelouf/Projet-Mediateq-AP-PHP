<?php

class RevueManager extends Manager
{
    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets Revue
     *
     * @return array
     */
    public function getList(): array
    {
        try {
            // recupération des états
            $etatManager = new EtatManager(); // Création d'un objet manager d'état
            $lesEtats = $etatManager->getList(); // chargement du dictionnaire des états

            // recupération des descripteurs
            $descripteurManager = new DescripteurManager(); // Création d'un objet manager de descripteur
            $lesDescripteurs = $descripteurManager->getList();

            $q = $this->getPDO()->prepare('SELECT * FROM revue ORDER BY titre');
            $q->execute();
            $r1 = $q->fetchAll(PDO::FETCH_ASSOC);

            $lesRevues = array();
            foreach ($r1 as $revue) {
                $descripteur = $lesDescripteurs[$revue['idDescripteur']];
                $lesRevues[$revue['id']] = new Revue($revue['id'], $revue['titre'], $revue['empruntable'], $descripteur , $revue['logo'] , $revue['periodicite']);
                // on récupère la collection de parutions de cette revue
                $q2 = $this->getPDO()->prepare('SELECT * FROM parution WHERE idRevue = :id AND idEtat!="00004"ORDER BY numero');
                $q2->bindParam(':id',  $revue['id'], PDO::PARAM_INT);
                $q2->execute();
                $r2 = $q2->fetchAll(PDO::FETCH_ASSOC);
                $lesNumeros = array();
                foreach ($r2 as $parution) {
                    if ($parution['photo'] == null) {
                        $parution['photo'] = "";
                    }
                    $lesNumeros[$parution['numero']] = new Parution($parution['numero'], $lesRevues[$revue['id']], $parution['dateParution'], $parution['photo'], $lesEtats[$parution['idEtat']]);
                }
                // on instancie la collection d'exemplaires dans l'objet livre
                $lesRevues[$revue['id']]->setlesNumeros($lesNumeros);
            }
            return $lesRevues;
        } catch (PDOException $e) {
            echo ("une erreur s'est produite lors de la récupération des revues : " . $e->getMessage());
        }
    }

    
    /**
     * Renvoie l'objet Revue dont l'id correspond à la valeur du parametre $id
     *
     * @param integer $id
     * @return void
     */
    public function getRevueById(int $id): Revue
    {
        $catalogueRevue = $this->getList();
        return $catalogueRevue[$id];
    }

    

    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets Revue dont les identifiants appartiennent au tableau d'entier $listeId
     *
     * @param array $listeId
     * @return void
     */
    public function getRevuesByListId(array $listeId): array
    {
        $lesRevues = array();
        $catalogueRevue = $this->getList();
        foreach ($listeId as $id) {
            $lesRevues[$id] = $catalogueRevue[$id];
        }
        return $lesRevues;
    }

    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets Revue dont le titre contient la chaine $texte
     *
     * @param string $texte
     * @return void
     */
    public function getRevueCritereSimple(string $texte): array
    {
        $q = $this->getPDO()->prepare('SELECT DISTINCT id FROM revue WHERE revue.titre LIKE :texte');
        $q->bindValue(':texte',  "%" . $texte . "%", PDO::PARAM_STR);
        $q->execute();
        $r = $q->fetchAll(PDO::FETCH_ASSOC);
        $lesId = array();
        foreach ($r as $revue) {
            array_push($lesId, $revue['id']);
        }
        return $this->getRevuesByListId($lesId);
    }

    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets Revue dont la date d'achat date de moins de $nbJours jours
     *
     * @param integer $nbjours
     * @return array
     */
    public function getNouveautes(int $nbjours): array
    {
        // aller chercher les numéros des dernières parutions
        $q = $this->getPDO()->prepare('SELECT DISTINCT idRevue FROM parution WHERE dateParution > date_sub(now(), INTERVAL :nbjours DAY)');
        $q->bindParam(':nbjours',  $nbjours, PDO::PARAM_INT);
        $q->execute();
        $r = $q->fetchAll(PDO::FETCH_ASSOC);
        $lesId = array();
        foreach ($r as $revue) {
            array_push($lesId, $revue['idRevue']);
        }
        return $this->getRevuesByListId($lesId);
    }

 

    /**
     * Effectue une recherche avancée des revues en fonction des critères spécifiés
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
    public function getRevueCritereAvancee(string $texte, string $critere, string $option2, string $texte2, string $critere2, string $option3, string $texte3, string $critere3): array
    {
        $sql = 'SELECT DISTINCT * FROM revue INNER JOIN parution ON parution.idRevue = revue.id inner join descripteur on descripteur.id = revue.idDescripteur WHERE ';

        $conditions = []; // Tableau pour stocker les conditions de recherche

        // Ajoute la première condition de recherche en fonction du critère choisi
        switch ($critere) {
            case 'titre':
                $conditions[] = 'revue.titre LIKE :texte'; // Recherche par titre
                break;
            case 'descripteur':
                $conditions[] = 'descripteur.libelle LIKE :texte'; // Recherche par collection
                break;
            case 'periodicite':
                $conditions[] = 'revue.periodicite LIKE :texte'; // Recherche par ISBN
                break;
            default:
                return []; // Critère invalide, retourne un tableau vide
        }

     

        // Vérifie l'option choisie et ajoute la deuxième condition de recherche si nécessaire
        if ($option2 === 'et' && $texte2 !== null) {
            switch ($critere2) {
                case 'titre':
                    $conditions[] = 'AND revue.titre LIKE :texte2'; // Recherche par titre
                    break;
                case 'descripteur':
                    $conditions[] = 'AND descripteur.libelle LIKE :texte2'; // Recherche par auteur
                    break;
                case 'periodicite':
                    $conditions[] = 'AND revue.periodicite LIKE :texte2'; // Recherche par collection
                    break;
                default:
                    return []; // Critère invalide, retourne un tableau vide
            }
        } elseif ($option2 === 'ou' && $texte2 !== null) {
            switch ($critere2) {
                case 'titre':
                    $conditions[] = 'OR revue.titre LIKE :texte2'; // Recherche par titre
                    break;
                case 'descripteur':
                    $conditions[] = 'OR descripteur.libelle LIKE :texte2'; // Recherche par auteur
                    break;
                case 'periodicite':
                    $conditions[] = 'OR revue.periodicite LIKE :texte2'; // Recherche par collection
                    break;
                default:
                    return []; // Critère invalide, retourne un tableau vide
            }
        } elseif ($option2 === 'sauf' && $texte2 !== null) {
            switch ($critere2) {
                case 'titre':
                    $conditions[] = 'AND revue.titre NOT LIKE :texte2'; // Exclusion par titre
                    break;
                case 'descripteur':
                    $conditions[] = 'AND descripteur.libelle NOT LIKE :texte2'; // Exclusion par auteur
                    break;
                case 'periodicite':
                    $conditions[] = 'AND revue.periodicite NOT LIKE :texte2'; // Exclusion par collection
                    break;
                default:
                    return []; // Critère invalide, retourne un tableau vide
            }
        }

        // Vérifie l'option choisie et ajoute la troisième condition de recherche si nécessaire
        if ($option3 === 'et' && $texte3 !== null) {
            switch ($critere3) {
                case 'titre':
                    $conditions[] = 'AND revue.titre LIKE :texte3'; // Recherche par titre
                    break;
                case 'descripteur':
                    $conditions[] = 'AND descripteur.libelle LIKE :texte3'; // Recherche par auteur
                    break;
                case 'periodicite':
                    $conditions[] = 'AND revue.periodicite LIKE :texte3'; // Recherche par collection
                    break;
                default:
                    return []; // Critère invalide, retourne un tableau vide
            }
        } elseif ($option3 === 'ou' && $texte3 !== null) {
            switch ($critere3) {
                case 'titre':
                    $conditions[] = 'OR revue.titre LIKE :texte3'; // Recherche par titre
                    break;
                case 'descripteur':
                    $conditions[] = 'OR descripteur.libelle LIKE :texte3'; // Recherche par auteur
                    break;
                case 'periodicite':
                    $conditions[] = 'OR revue.periodicite LIKE :texte3'; // Recherche par collection
                    break;
                default:
                    return []; // Critère invalide, retourne un tableau vide
            }
        } elseif ($option3 === 'sauf' && $texte3 !== null) {
            switch ($critere3) {
                case 'titre':
                    $conditions[] = 'AND revue.titre NOT LIKE :texte3'; // Exclusion par titre
                    break;
                case 'descripteur':
                    $conditions[] = 'AND descripteur.libelle NOT LIKE :texte3'; // Exclusion par auteur
                    break;
                case 'periodicite':
                    $conditions[] = 'AND revue.periodicite NOT LIKE :texte3'; // Exclusion par collection
                    break;
                default:
                    return []; // Critère invalide, retourne un tableau vide
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
        foreach ($r as $revue) {
            array_push($lesId, $revue['idRevue']);
        }
        return $this->getRevuesByListId($lesId);
    }
}
