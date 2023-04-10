<?php

class Document {
    private $id;
    private $titre; 
    private $image;
    private $commandeEnCours; 
    private $typePublic;
    private $lesExemplaires ;
    private $synopsis;
    
    /**
     * construteur de la classe Document
     *
     * @param string $id
     * @param string $titre
     * @param string $image
     * @param boolean $commandeEnCours
     * @param TypePublic $public
     * @param string $synopsis
     */
    public function __construct(string $id, string $titre, string $image, bool $commandeEnCours, TypePublic $public , string $synopsis)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->image = $image;
        $this->commandeEnCours = $commandeEnCours;
        $this->typePublic = $public;
        $this->synopsis = $synopsis;

    }

    /**
     * Accesseur de la propriété id
     *
     * @return string
     */
    public function getId() : string {
        return $this->id;
    }

    /**
     * Accesseur de la propriété titre
     *
     * @return string
     */
    public function getTitre() : string {
        return $this->titre;
    }

    /**
     * Accesseur de la propriété image
     *
     * @return string
     */
    public function getImage() : string {
        return $this->image;
    }
    
    /**
     * Accesseur de la propriété commandeEnCours
     *
     * @return boolean
     */
    public function getcommandeEnCours() : bool {
        return $this->commandeEnCours;
    }
    
    /**
     * Accesseur de la propriété typePublic
     *
     * @return TypePublic
     */
    public function getTypePublic() : TypePublic {
        return $this->typePublic;
    }
    
    /**
     * Accesseur de la propriété synopsis
     *
     * @return string
     */
    public function getSynopsis() : string {
        return $this->synopsis;
    }

    /**
     * Accesseur de la propriété lesExemplaires
     *
     * @return array
     */
    public function getLesExemplaires() : array {
        return $this->lesExemplaires;
    }

    /**
     * Mutateur de la propriété id
     *
     * @param integer $id
     * @return void
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * Mutateur de la propriété lesExemplaires
     *
     * @param array $lesExemplaires
     * @return void
     */
    public function setlesExemplaires(array $lesExemplaires): void {
        $this->lesExemplaires = $lesExemplaires;
    }



}
?>