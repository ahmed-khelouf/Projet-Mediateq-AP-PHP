<?php

class EmpruntParution extends Emprunt {
    private $parution; 
    
    /**
     * Constructeur de la classe EmpruntParution
     * 
     * @param int $id
     * @param int $abonne
     * @param Parution $parution
     * @param string $dateDebut
     * @param string $dateFin
     * @param bool $prolongable
     */
    public function __construct(int $id, int $abonne, Parution $parution, string $dateDebut, string $dateFin, int $prolongable)
    {
        parent::__construct($id, $abonne, $dateDebut, $dateFin, $prolongable);
        $this->parution = $parution;

    }

    /**
     * Accesseur de la propriété Parution
     *
     * @return string
     */
    public function getParution() : Parution {
        return $this->parution;
    }
}
?>