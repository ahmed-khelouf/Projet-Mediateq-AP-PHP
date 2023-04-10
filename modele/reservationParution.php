<?php

class ReservationParution extends Reservation
{
    private $revue;
    private $parution;

    /**
     * construteur de la classe Reservation
     *
     * @param integer $id
     * @param Revue $revue
     * @param Abonne $abonne
     * @param Statut $statut
     * @param integer $rang
     * @param string $dateReservation
     * @param Parution $numeroParution
     */
    public function __construct(int $idR, Revue $revue, Abonne $abonne , int $rang , Statut $statut, string $dateReservation , Parution $parution)
    {
        parent::__construct($idR, $abonne, $rang, $statut, $dateReservation);
        $this->revue = $revue;
        $this->parution = $parution;
    }

    /**
     * Accesseur de la propriété idRevue
     *
     * @return Revue
     */
    public function getRevue(): Revue
    {
        return $this->revue;
    }

    /**
     * Accesseur de la propriété numeroParution
     *
     * @return Parution
     */
    public function getParution(): Parution
    {
        return $this->parution;
    }
 
}
?>