<?php

class HistoriqueParution extends Historique
{
    private $revue;
    private $parution;

    /**
     * construteur de la classe Reservation
     *
     * @param string $id
     * @param Revue $revue
     * @param Abonne $abonne
     * @param string $dateReservation
     * @param Parution $parution
     */
    public function __construct(string $id, Revue $revue, Abonne $abonne ,  string $dateReservation , Parution $parution)
    {
        parent::__construct($id, $abonne,$dateReservation);
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
