<?php

class DateConnexion
{

    private $id;
    private $id_utilisateur;
    private $date_connexion;

    /**
     * Constructeur de la classe DateConnexion
     *
     * @param integer $id
     * @param integer $id_utilisateur
     * @param dateTime $date_connexion
     */
    public function __construct(int $id, int $id_utilisateur, dateTime $date_connexion)
    {
        $this->id = $id;
        $this->id_utilisateur = $id_utilisateur;
        $this->date_connexion = $date_connexion;
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
     * Accesseur de la propriété id_utilisateur
     *
     * @return integer
     */
    public function getIdUtilisateur(): int
    {
        return $this->id_utilisateur;
    }

    /**
     * Accesseur de la propriété date_connexion
     *
     * @return dateTime
     */
    public function getDateConnexion(): dateTime
    {
        return $this->date_connexion;
    }

     /**
     * Mutateur de la propriété id
     *
     * @param int $id
     * @return void
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * Mutateur de la propriété id_utilisateur
     *
     * @param int $id_utilisateur
     * @return void
     */
    public function setIdUtilisateur(int $id_utilisateur): void {
        $this->id_utilisateur = $id_utilisateur;
    }

    /**
     * Mutateur de la propriété date_connexion
     *
     * @param dateTime $date_connexion
     * @return void
     */
    public function setDateConnexion(dateTime $date_connexion): void {
        $this->date_connexion = $date_connexion;}        
}

?>
