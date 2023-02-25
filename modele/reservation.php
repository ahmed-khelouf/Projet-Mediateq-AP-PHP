<?php

class Reservation
{
    private $idR;
    private $idRevue;
    private $idAbonne;

    /**
     * construteur de la classe Reservation
     *
     * @param integer $id
     * @param Revue $idRevue
     * @param Abonne $idAbonnee
     */
    public function __construct(int $idR, Revue $idRevue, Abonne $idAbonne)
    {
        $this->idR = $idR;
        $this->idRevue = $idRevue;
        $this->idAbonne = $idAbonne;
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
