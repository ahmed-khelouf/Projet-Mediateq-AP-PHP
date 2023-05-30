<?php

class LogsMdpManager extends Manager 
{
    public function logChangementMdp($idAbonne, $dateChangementMdp) {
        try {
            $dateChangementMdpObj = DateTime::createFromFormat('Y-m-d H:i:s', $dateChangementMdp);
            $dateChangementMdpStr = $dateChangementMdpObj->format('Y-m-d H:i:s');
            
            $req = $this->getPDO()->prepare('INSERT INTO logs_mdp (abonne_id, date_logs_mdp) VALUES (:abonne_id, :date_logs_mdp)');
            $req->bindParam(':abonne_id', $idAbonne, PDO::PARAM_INT);
            $req->bindParam(':date_logs_mdp', $dateChangementMdpStr, PDO::PARAM_STR);
            
            $resultat = $req->execute();
            return $resultat;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }
}
