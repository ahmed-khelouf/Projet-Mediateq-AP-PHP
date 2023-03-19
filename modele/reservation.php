<?php

class Reservation
{
    private $idR;
    private $idRevue;
    private $idAbonne;
    private $rang;
    private $idStatut;
    private $dateReservation;
    private $numeroParution;

    /**
     * construteur de la classe Reservation
     *
     * @param integer $id
     * @param Revue $idRevue
     * @param Abonne $idAbonnee
     * @param Statut $idStatut
     * @param integer $rang
     * @param string $dateReservation
     * @param string $numeroParution
     */
    public function __construct(int $idR, Revue $idRevue, Abonne $idAbonne , int $rang , Statut $idStatut, string $dateReservation , string $numeroParution)
    {
        $this->idR = $idR;
        $this->idRevue = $idRevue;
        $this->idAbonne = $idAbonne;
        $this->rang = $rang;
        $this->idStatut = $idStatut;
        $this->dateReservation = $dateReservation;
        $this->numeroParution = $numeroParution;
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
     * Accesseur de la propriété date
     *
     * @return string
     */
    public function getDate(): string
    {
        return $this->dateReservation;
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

    /**
     * Accesseur de la propriété numeroParution
     *
     * @return string
     */
    public function getNumeroParution(): string
    {
        return $this->numeroParution;
    }
 
}

?>
