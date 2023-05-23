<?php

class TypeAbonnement {
    private $id;
    private $libelle; 
    
    /**
     * Constructeur de la classe Parution
     *
     * @param integer $id
     * @param string $libelle
     */
    public function __construct(int $id, string $libelle)
    {
        $this->id = $id;
        $this->libelle = $libelle;
    }

    /**
     * Accesseur de la propriété numero
     *
     * @return integer
     */
    public function getId() : int {
        return $this->id;
    }

    /**
     * Accesseur de la propriété categorie
     *
     * @return string
     */
    public function getLibelle() : string {
        return $this->libelle;
    }

}
?>