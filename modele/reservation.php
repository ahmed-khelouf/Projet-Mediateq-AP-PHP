<?php

class Reservation
{
    private $idR;
    private $idRevue;
    private $idAbonne;
    private $rang;

    /**
     * construteur de la classe Reservation
     *
     * @param integer $id
     * @param Revue $idRevue
     * @param Abonne $idAbonnee
     */
    public function __construct(int $idR, Revue $idRevue, Abonne $idAbonne , int $rang)
    {
        $this->idR = $idR;
        $this->idRevue = $idRevue;
        $this->idAbonne = $idAbonne;
        $this->rang = $rang;
    }


    /**
     * Accesseur de la propriété Reservation
     *
     * @return integer
     */
    public function getId(): int
    {
        return $this->idR;
    }

    /**
     * Accesseur de la propriété Reservation
     *
     * @return integer
     */
    public function getRang(): int
    {
        return $this->rang;
    }


    /**
     * Accesseur de la propriété Reservation
     *
     * @return Revue
     */
    public function getRevue(): Revue
    {
        return $this->idRevue;
    }

    /**
     * Accesseur de la propriété Reservation
     * @return Abonne
     */
    public function getIdAbonne(): Abonne
    {
        return $this->idAbonne;
    }
}
