<?php

class Historique
{
    private $id;
    private $abonne;
    private $dateReservation;


    /**
     * construteur de la classe Reservation
     *
     * @param string $id
     * @param Abonne $abonne
     * @param string $dateReservation
     */
    public function __construct(string $id , Abonne $abonne , string $dateReservation )
    {
        $this->id= $id;
        $this->abonne = $abonne;
        $this->dateReservation = $dateReservation;
    }

    /**
     * Accesseur de la propriété id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
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
     * Accesseur de la propriété abonne
     * @return Abonne
     */
    public function getAbonne(): Abonne
    {
        return $this->abonne;
    }
 
}
