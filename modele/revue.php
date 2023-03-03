<?php

class Revue {
    private $id;
    private $titre; 
    private $empruntable;
    private $lesNumeros ;
    private $descripteur ;
    
    /**
     * Constructeur de la classe Revue
     *
     * @param integer $id
     * @param string $titre
     * @param string $empruntable
     * @param Descripteur $descripteur
     */
    public function __construct(int $id, string $titre, string $empruntable , Descripteur $descripteur)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->empruntable = $empruntable;
        $this->descripteur = $descripteur;
    }


    /**
     * Accesseur de la propriété id
     *
     * @return integer
     */
    public function getId() : int {
        return $this->id;
    }

    /**
     * Accesseur de la propriété descripteur
     *
     * @return Descipteur
     */
    public function getDescripteur() : Descripteur {
        return $this->descripteur;
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
     * Accesseur modifié de la propriété empruntable (renvoie vrai si il est à "O" et faux sinon)
     *
     * @return boolean
     */
    public function getEmpruntable() : bool {
        if ($this->empruntable == "O"){
            $value = true;
        } else {
            $value = false;
        }
        return $value;
    }

    /**
     * Accesseur de la propriété lesNumeros
     *
     * @return array
     */
    public function getLesNumeros() : array {
        return $this->lesNumeros;
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
     * Mutateur de la propriété lesNumeros
     *
     * @param array $lesNumeros
     * @return void
     */
    public function setlesNumeros(array $lesNumeros): void {
        $this->lesNumeros = $lesNumeros;
    }

    // a completer

}
?>