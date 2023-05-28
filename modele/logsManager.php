<?php

class logsManager extends Manager 
{

    public function logPageConsultee($idAbonne, $pageConsultee, $dateConsultation) {
        try {
            $dateConnexionObj = DateTime::createFromFormat('Y-m-d H:i:s', $dateConsultation);
            $dateConsultationStr = $dateConnexionObj->format('Y-m-d H:i:s');
            
            $req = $this->getPDO()->prepare('INSERT INTO logs (id_abonne, page_consultee, date_consultation) VALUES (:id_abonne, :page_consultee, :date_consultation)');
            $req->bindParam(':id_abonne', $idAbonne, PDO::PARAM_INT);
            $req->bindParam(':page_consultee', $pageConsultee, PDO::PARAM_STR);
            $req->bindParam(':date_consultation', $dateConsultationStr, PDO::PARAM_STR);
            
            $resultat = $req->execute();
            return $resultat;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }
    
 }