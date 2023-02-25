<?php

class Revue {
    private $id;
    private $titre; 
    private $empruntable;
    private $lesNumeros ;
    private $reservationRang;
    
    /**
     * Constructeur de la classe Revue
     *
     * @param integer $id
     * @param string $titre
     * @param string $empruntable
     * @param integer $reservationRang
     */
    public function __construct(int $id, string $titre, string $empruntable , int $reservationRang)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->empruntable = $empruntable;
        $this->reservationRang =$reservationRang;
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
     * Accesseur de la propriété reservationRang
     *
     * @return integer
     */
    public function getReservationRang() : int {
        return $this->reservationRang;
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
     * Mutateur de la propriété reservationRang
     *
     * @param integer $reservationRang
     * @return void
     */
    public function setReservationRang(int $reservationRang): void {
        $this->reservationRang = $reservationRang;
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