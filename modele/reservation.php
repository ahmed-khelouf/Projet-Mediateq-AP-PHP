<?php

class Reservation
{
    private $idR;
    private $idRevue;
    private $idAbonne;
    private $rang;
    private $idStatut;

    /**
     * construteur de la classe Reservation
     *
     * @param integer $id
     * @param Revue $idRevue
     * @param Abonne $idAbonnee
     * @param Statut $idStatut
     */
    public function __construct(int $idR, Revue $idRevue, Abonne $idAbonne , int $rang , Statut $idStatut)
    {
        $this->idR = $idR;
        $this->idRevue = $idRevue;
        $this->idAbonne = $idAbonne;
        $this->rang = $rang;
        $this->idStatut = $idStatut;
    }


    /**
     * Accesseur de la propriété idR
     *
     * @return integer
     */
    public function getId(): int
    {
        return $this->idR;
    }

    /**
     * Accesseur de la propriété idStatut
     *
     * @return Statut
     */
    public function getStatut(): Statut
    {
        return $this->idStatut;
    }

    /**
     * Accesseur de la propriété rang
     *
     * @return integer
     */
    public function getRang(): int
    {
        return $this->rang;
    }


    /**
     * Accesseur de la propriété idRevue
     *
     * @return Revue
     */
    public function getRevue(): Revue
    {
        return $this->idRevue;
    }

    /**
     * Accesseur de la propriété idAbonne
     * @return Abonne
     */
    public function getIdAbonne(): Abonne
    {
        return $this->idAbonne;
    }
}
