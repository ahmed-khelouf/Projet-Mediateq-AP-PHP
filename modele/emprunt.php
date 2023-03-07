<?php

class Emprunt {
    private $abonne;
    private $document; 
    private $dateDebut;
    private $dateFin;
    private $prolongable;
    
    /**
     * Constructeur de la classe Exemplaire
     *
     * param Abonne $abonne
     * @param Document $document
     * @param string $dateDebut
     * @param string $dateFin
     * @param bool $prolongable
     */
    public function __construct(int $abonne, Document $document, string $dateDebut, string $dateFin, int $prolongable)
    {
        $this->abonne = $abonne;
        $this->document = $document;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->prolongable = $prolongable;
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
    public function getDocument() : Document {
        return $this->document;
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