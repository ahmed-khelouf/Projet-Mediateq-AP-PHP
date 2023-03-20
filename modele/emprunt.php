<?php

class Emprunt {
    private $id;
    private $abonne;
    private $exemplaire; 
    private $dateDebut;
    private $dateFin;
    private $prolongable;
    
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
        $this->id = $id;
        $this->abonne = $abonne;
        $this->exemplaire = $exemplaire;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->prolongable = $prolongable;
    }

    /**
     * Accesseur de la propriété ISBN
     *
     * @return string
     */
    public function getId() : int {
        return $this->id;
    }

    /**
     * Accesseur de la propriété ISBN
     *
     * @return string
     */
    public function getAbonne() : int {
        return $this->abonne;
    }

    /**
     * Accesseur de la propriété auteur
     *
     * @return string
     */
    public function getExemplaire() : Exemplaire {
        return $this->exemplaire;
    }

    /**
     * Accesseur de la propriété collection
     *
     * @return string
     */
    public function getDateDebut() : string {
        return $this->dateDebut;
    }


        /**
     * Accesseur de la propriété collection
     *
     * @return string
     */
    public function getDateFin() : string {
        return $this->dateFin;
    }

            /**
     * Accesseur de la propriété collection
     *
     * @return string
     */
    public function peutProlonger() : int {
        return $this->prolongable;
    }

    
    // a completer getter/setter


}
?>