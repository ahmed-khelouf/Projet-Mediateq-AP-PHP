<?php

class DocumentManager extends Manager
{
    /**
     * Renvoie un tableau associatif contenant l'ensemble des objets Documents
     *
     * @return array
     */
    public function getList() : array
    {
        $livreManager = new LivreManager();
        $lesLivres = $livreManager->getList();

        $DVDManager = new DvdManager();
        $lesDvds = $DVDManager->getList();

        $lesDocuments = array_merge($lesLivres,$lesDvds);

        return $lesDocuments;
    }

}
     

       

?>