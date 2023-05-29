<?php

class EmpruntExemplaire extends Emprunt {
    private $exemplaire; 
    
    /**
     * Constructeur de la classe EmrpruntExemplaire
     * 
     * @param int $id
     * @param int $abonne
     * @param Exemplaire $exemplaire
     * @param string $dateDebut
     * @param string $dateFin
     * @param bool $prolongable
     * @param int $fraisRetard
     */
    public function __construct(int $id, int $abonne, Exemplaire $exemplaire, string $dateDebut, string $dateFin, int $prolongable, int $fraisRetard)
    {
        parent::__construct($id, $abonne, $dateDebut, $dateFin, $prolongable, $fraisRetard);
        $this->exemplaire = $exemplaire;

    }

    /**
     * Accesseur de la propriété Exemplaire
     *
     * @return Exemplaire
     */
    public function getExemplaire() : Exemplaire {
        return $this->exemplaire;
    }
}
?>