<?php

class Descripteur
{

    private $id;
    private $libelle;

    /**
     * Constructeur de la classe Descripteur
     *
     * @param integer $id
     * @param string $libelle
     */
    public function __construct(int $id, string $libelle)
    {
        $this->id = $id;
        $this->libelle = $libelle;
    }

    /**
     * Accesseur de la propriété id
     *
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Accesseur de la propriété libelle
     *
     * @return string
     */
    public function getLibelle(): string
    {
        return $this->libelle;
    }
}

?>
