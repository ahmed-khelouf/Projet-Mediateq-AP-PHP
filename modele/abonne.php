<?php

class Abonne  {

    private $id ; 
    private $nom;
    private $prenom;
    private $dateNaissance;
    private $adresse;
    private $numTel;
    private $finAbonnement;
    private $mdpU;
    private $mailU;
    private $typeAbonnement;
    private $frais;


    /**
     * Constructeur de la classe utilisateur
     *
     * @param integer $id
     * @param string $nom
     * @param string $prenom
     * @param string $dateNaissance
     * @param string $adresse
     * @param integer $numTel
     * @param string $finAbonnement
     * @param string $mdpU
     * @param string $mailU
     * @param string TypeAbonnement $typeAbonnement
     * @param integer frais;
     */


    public function __construct(int $id, string $nom, string $prenom , string $dateNaissance , string $adresse , string $numTel , string $finAbonnement , string $mdpU , string $mailU,TypeAbonnement $typeAbonnement, $frais)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance = $dateNaissance;
        $this->adresse = $adresse;
        $this->numTel = $numTel;
        $this->finAbonnement = $finAbonnement;
        $this->mdpU = $mdpU;
        $this->mailU = $mailU;
        $this->typeAbonnement = $typeAbonnement;
        $this->frais = $frais;

    }

    /**
     * Accesseur de la propriété id
     *
     * @return integer
     */
    public function getId() : int {
        return $this->id;
    }

    /**
     * Accesseur de la propriété nom
     *
     * @return string
     */
    public function getNom() : string{
        return $this->nom;
    }

    /**
     * Accesseur de la propriété prenom
     *
     * @return string
     */
    public function getPrenom() : string{
        return $this->prenom;
    }

    /**
     * Accesseur de la propriété dateNaissance
     *
     * @return string
     */
    public function getDateNaissance() : string{
        return $this->dateNaissance;
    }

    /**
     * Accesseur de la propriété adresse
     *
     * @return string
     */
    public function getAdresse() : string{
        return $this->adresse;
    }

    /**
     * Accesseur de la propriété numTel
     *
     * @return string
     */
    public function getNumTel() : string{
        return $this->numTel;
    }

     /**
     * Accesseur de la propriété typeabonnement
     *
     * @return TypeAbonnement
     */
    public function getTypeAbonnement() : TypeAbonnement {
        return $this->typeAbonnement;
    }

    /**
     * Accesseur de la propriété finAbonnement
     *
     * @return string
     */
    public function getFinAbonnement() : string{
        return $this->finAbonnement;
    }

    /**
     * Accesseur de la propriété mdpU
     *
     * @return string
     */
    public function getMdpU() : string{
        return $this->mdpU;
    }

     /**
     * Accesseur de la propriété mailU
     *
     * @return string
     */
    public function getMailU() : string{
        return $this->mailU;
    }

     /**
     * Accesseur de la propriété frais
     *
     * @return int $frais
     */
    public function getFrais() : int{
        return $this->frais;
    }

    /**
     * Mutateur de la propriété id
     *
     * @param integer $id
     * @return void
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * Mutateur de la propriété nom
     *
     * @param string $nom
     * @return void
     */
    public function setNom(string $nom): void {
        $this->nom = $nom;
    }

    /**
     * Mutateur de la propriété prenom
     *
     * @param string $prenom
     * @return void
     */
    public function setPrenom(string $prenom): void {
        $this->prenom = $prenom;
    }

    /**
     * Mutateur de la propriété dateNaissance
     *
     * @param string $dateNaissance
     * @return void
     */
    public function setDateNaissance(string $dateNaissance): void {
        $this->dateNaissance = $dateNaissance;
    }

    /**
     * Mutateur de la propriété adresse
     *
     * @param string $adresse
     * @return void
     */
    public function setAdresse(string $adresse): void {
        $this->adresse = $adresse;
    }

    /**
     * Mutateur de la propriété numTel
     *
     * @param integer $numTel
     * @return void
     */
    public function setNumTel(int $numTel): void {
        $this->numTel = $numTel;
    }

    /**
     * Mutateur de la propriété typeAbonnement
     *
     * @param string $typeAbonnement
     * @return void
     */
    public function setTypeAbonnement(TypeAbonnement $typeAbonnement): void {
        $this->$typeAbonnement = $typeAbonnement;
    }

    /**
     * Mutateur de la propriété finAbonnement
     *
     * @param string $finAbonnement
     * @return void
     */
    public function setFinAbonnement(string $finAbonnement): void {
        $this->finAbonnement = $finAbonnement;
    }

    /**
     * Mutateur de la propriété mdpU
     *
     * @param string $mdpU
     * @return void
     */
    public function setMdpU(string $mdpU): void {
        $this->mdpU = $mdpU;
    }

    /**
     * Mutateur de la propriété mailU
     *
     * @param string $mailU
     * @return void
     */
    public function setMailU(string $mailU): void {
        $this->mailU = $mailU;
    }

    /**
     * Mutateur de la propriété frais
     *
     * @param int $frais
     * @return void
     */
    public function setFrais(int $frais): void {
        $this->frais = $frais;
    }


}