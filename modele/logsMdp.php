<?php

class Logs_Mdp
{

    private $id;
    private $id_abone;
    private $date_logs_mdp;

    /**
     * Constructeur de la classe DateConnexion
     *
     * @param integer $id
     * @param integer $id_utilisateur
     * @param dateTime $date_logs_mdp
     */
    public function __construct(int $id, int $id_utilisateur, dateTime $date_logs_mdp)
    {
        $this->id = $id;
        $this->id_utilisateur = $id_utilisateur;
        $this->date_logs_mdp = $date_logs_mdp;
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
    public function getIdAbonne(): int
    {
        return $this->id_abonne;
    }

    /**
     * Accesseur de la propriété date_logs_mdp
     *
     * @return dateTime
     */
    public function getDateLogsMdp(): dateTime
    {
        return $this->date_logs_mdp;
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
     * Mutateur de la propriété id_abonne
     *
     * @param int $id_abonne
     * @return void
     */
    public function setIdAbonne(int $id_abonne): void {
        $this->id_abonne = $id_abonne;
    }

    /**
     * Mutateur de la propriété date_logs_mdp
     *
     * @param dateTime $date_logs_mdp
     * @return void
     */
    public function setDateLogsMdp(dateTime $date_logs_mdp): void {
        $this->date_logs_mdp = $date_logs_mdp;}        
}

?>
