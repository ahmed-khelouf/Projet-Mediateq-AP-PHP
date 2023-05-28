<?php

class RechercheAvancee
{
    private $id;
    private $nbResultats;
    private $date;
    private $abonne;
    private $type;
    private $texte;
    private $connecteur;
    private $type2;
    private $texte2;
    private $connecteur2;
    private $type3;
    private $texte3;


    /**
     * construteur de la classe RechercheAvancee
     * @param integer $id
     * @param integer $nbResultats
     * @param string $date
     * @param Abonne $abonne
     * @param string $type
     * @param string $texte
     * @param string $connecteur
     * @param string $type2
     * @param string $texte2
     * @param string $connecteur2
     * @param string $type3
     * @param string $texte3
     */
    public function __construct(int $id , int $nbResultats , string $date , Abonne $abonne , string $type , string $texte , string $connecteur , string $type2 , string $texte2 , string $connecteur2 , string $type3 , string $texte3 )
    {
        $this->id = $id;
        $this->nbResultats = $nbResultats;
        $this->date = $date;
        $this->abonne = $abonne;
        $this->type = $type;
        $this->texte = $texte;
        $this->connecteur = $connecteur;
        $this->type2 = $type2;
        $this->texte2 = $texte2;
        $this->connecteur2 = $connecteur2;
        $this->type3 = $type3;
        $this->texte3 = $texte3;
    }


    /**
     * Accesseur de la propriété id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Accesseur de la propriété nbResultats
     *
     * @return int
     */
    public function getNbResultat(): int
    {
        return $this->nbResultats;
    }


    /**
     * Accesseur de la propriété date
     *
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * Accesseur de la propriété idAbonne
     * 
     * @return Abonne
     */
    public function getAbonne(): Abonne
    {
        return $this->abonne;
    }

    /**
     * Accesseur de la propriété type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Accesseur de la propriété texte
     *
     * @return string
     */
    public function getTexte(): string
    {
        return $this->texte;
    }

    /**
     * Accesseur de la propriété connecteur
     *
     * @return string
     */
    public function getConnecteur(): string
    {
        return $this->connecteur;
    }

    /**
     * Accesseur de la propriété type2
     *
     * @return string
     */
    public function getType2(): string
    {
        return $this->type2;
    }

    /**
     * Accesseur de la propriété texte2
     *
     * @return string
     */
    public function getTexte2(): string
    {
        return $this->texte2;
    }

    /**
     * Accesseur de la propriété connecteur2
     *
     * @return string
     */
    public function getConnecteur2(): string
    {
        return $this->connecteur2;
    }

    /**
     * Accesseur de la propriété type3
     *
     * @return string
     */
    public function getType3(): string
    {
        return $this->type3;
    }

    /**
     * Accesseur de la propriété texte3
     *
     * @return string
     */
    public function getTexte3(): string
    {
        return $this->texte3;
    }



}
