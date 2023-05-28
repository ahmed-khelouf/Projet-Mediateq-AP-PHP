<?php

class ReservationParution extends Reservation
{
    private $revue;
    private $parution;

    /**
     * construteur de la classe Reservation
     *
     * @param int $id
     * @param Revue $revue
     * @param Abonne $abonne
     * @param Statut $statut
     * @param integer $rang
     * @param string $dateReservation
     * @param Parution $parution
     */
    public function __construct(int $idR, Revue $revue, Abonne $abonne , int $rang , Statut $statut, string $dateReservation , Parution $parution )
    {
        parent::__construct($idR, $abonne, $rang, $statut, $dateReservation );
        $this->revue = $revue;
        $this->parution = $parution;
    }

    /**
     * Accesseur de la propriété revue
     *
     * @return Revue
     */
    public function getRevue(): Revue
    {
        return $this->revue;
    }

    /**
     * Accesseur de la propriété parution
     *
     * @return Parution
     */
    public function getParution(): Parution
    {
        return $this->parution;
    }
 
}
