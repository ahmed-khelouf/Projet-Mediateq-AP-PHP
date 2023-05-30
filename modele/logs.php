<?php

class Logs
{

    private $id;
    private $id_abonne;
    private $page_consultee;
    private $date_consultation;

    /**
     * Constructeur de la classe DateConnexion
     *
     * @param integer $id
     * @param integer $id_abonne
     * @param string $page_consultee
     * @param dateTime $date_connexion
     */
    public function __construct(int $id, int $id_abonne, string $page_consultee, dateTime $date_consultation)
    {
        $this->id = $id;
        $this->id_abonne = $id_abonne;
        $this->page_consultee = $page_consultee;
        $this->date_consultation = $date_consultation;
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
     * Accesseur de la propriété id_abonne
     *
     * @return integer
     */
    public function getIdAbonne(): int
    {
        return $this->id_abonne;
    }

    /**
     * Accesseur de la propriété page_consultee
     *
     * @return integer
     */
    public function getPageConsultee(): int
    {
        return $this->page_consultee;
    }
    

    /**
     * Accesseur de la propriété date_consultation
     *
     * @return dateTime
     */
    public function getDateConsultation(): dateTime
    {
        return $this->date_consultation;
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
     * Mutateur de la propriété page_consultee
     *
     * @param int $page_consultee
     * @return void
     */
    public function setPageConsultee(int $page_consulte): void {
        $this->page_consulte = $page_consulte;
    }


    /**
     * Mutateur de la propriété date_consultation
     *
     * @param dateTime $date_consultation
     * @return void
     */
    public function setDateConsultation(dateTime $date_consultation): void {
        $this->date_consultation = $date_consultation;}        
}

?>
