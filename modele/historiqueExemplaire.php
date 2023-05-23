<?php

class HistoriqueExemplaire extends Historique
{
    private $document;
    private $exemplaire;

    /**
     * construteur de la classe Reservation
     *
     * @param int $id
     * @param Document $document
     * @param Abonne $abonne
     * @param string $dateReservation
     * @param Exemplaire $exemplaire
     */
    public function __construct(int $id, Document $document, Abonne $abonne,  string $dateReservation, Exemplaire $exemplaire)
    {
        parent::__construct($id, $abonne,  $dateReservation);
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
