<?php

class EmpruntExemplaire extends Emprunt {
    private $exemplaire; 
    
    /**
     * Constructeur de la classe Exemplaire
     * 
     * @param int $id
     * @param int $abonne
     * @param Exemplaire $exemplaire
     * @param string $dateDebut
     * @param string $dateFin
     * @param bool $prolongable
     */
    public function __construct(int $id, int $abonne, Exemplaire $exemplaire, string $dateDebut, string $dateFin, int $prolongable)
    {
        parent::__construct($id, $abonne, $dateDebut, $dateFin, $prolongable);
        $this->exemplaire = $exemplaire;

    }

    /**
     * Accesseur de la propriété auteur
     *
     * @return string
     */
    public function getExemplaire() : Exemplaire {
        return $this->exemplaire;
    }
}
?>