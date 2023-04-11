<?php

class Reservation
{
    private $idR;
    private $abonne;
    private $rang;
    private $statut;
    private $dateReservation;


    /**
     * construteur de la classe Reservation
     *
     * @param integer $id
     * @param Abonne $abonne
     * @param Statut $statut
     * @param integer $rang
     * @param string $dateReservation
     */
    public function __construct(int $idR , Abonne $abonne , int $rang , Statut $statut, string $dateReservation )
    {
        $this->idR = $idR;
        $this->abonne = $abonne;
        $this->rang = $rang;
        $this->statut = $statut;
        $this->dateReservation = $dateReservation;
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
     * Accesseur de la propriété dateReservation
     *
     * @return string
     */
    public function getDate(): string
    {
        return $this->dateReservation;
    }

    /**
     * Accesseur de la propriété statut
     *
     * @return Statut
     */
    public function getStatut(): Statut
    {
        return $this->statut;
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
     * Accesseur de la propriété abonne
     * @return Abonne
     */
    public function getAbonne(): Abonne
    {
        return $this->abonne;
    }
 
}
