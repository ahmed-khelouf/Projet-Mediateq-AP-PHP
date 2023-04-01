<?php

class Emprunt {
    private $id;
    private $abonne;
    private $dateDebut;
    private $dateFin;
    private $prolongable;
    
    /**
     * Constructeur de la classe Emprunt
     * 
     * @param int $id
     * @param int $abonne
     * @param string $dateDebut
     * @param string $dateFin
     * @param bool $prolongable
     */
    public function __construct(int $id, int $abonne, string $dateDebut, string $dateFin, int $prolongable)
    {
        $this->id = $id;
        $this->abonne = $abonne;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->prolongable = $prolongable;
    }

    /**
     * Accesseur de la propriété Id
     *
     * @return string
     */
    public function getId() : int {
        return $this->id;
    }

    /**
     * Accesseur de la propriété Abonné
     *
     * @return string
     */
    public function getAbonne() : int {
        return $this->abonne;
    }

    /**
     * Accesseur de la propriété DateDébut
     *
     * @return string
     */
    public function getDateDebut() : string {
        return $this->dateDebut;
    }


        /**
     * Accesseur de la propriété DateFin
     *
     * @return string
     */
    public function getDateFin() : string {
        return $this->dateFin;
    }

            /**
     * Accesseur de la propriété estProlongable
     *
     * @return string
     */
    public function peutProlonger() : int {
        return $this->prolongable;
    }
}
?>