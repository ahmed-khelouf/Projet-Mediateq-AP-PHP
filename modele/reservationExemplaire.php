<?php

class ReservationExemplaire extends Reservation
{
    private $document;
    private $exemplaire;

    /**
     * construteur de la classe Reservation
     *
     * @param integer $id
     * @param Document $document
     * @param Abonne $abonne
     * @param Statut $statut
     * @param integer $rang
     * @param string $dateReservation
     * @param Exemplaire $exemplaire
     */
    public function __construct(int $idR, Document $document, Abonne $abonne, int $rang, Statut $statut, string $dateReservation, Exemplaire $exemplaire)
    {
        parent::__construct($idR, $abonne, $rang, $statut, $dateReservation);
        $this->document = $document;
        $this->exemplaire = $exemplaire;
    }

    /**
     * Accesseur de la propriété document
     *
     * @return Document
     */
    public function getDocument(): Document
    {
        return $this->document;
    }

    /**
     * Accesseur de la propriété exemplaire
     *
     * @return Exemplaire
     */
    public function getExemplaire(): Exemplaire
    {
        return $this->exemplaire;
    }
}
