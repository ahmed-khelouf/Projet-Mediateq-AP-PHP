        <?php

        class abonneManager extends Manager
        {


            /**
             * Renvoie un tableau associatif contenant l'ensemble des objets Abonne
            *
            * @return abonne
            */
            public function getUtilisateurByMailU($mailU) : ?Abonne
            {

                $typeAbonnementManager = new typeAbonnementManager();
                $types = $typeAbonnementManager->getList();

                $q = $this->getPDO()->prepare('SELECT * FROM abonné where mailU=:mailU');
                $q->bindParam(':mailU',  $mailU, PDO::PARAM_STR);
                $q->execute();
                if($q->rowCount()==1){
                    $user = $q->fetch(PDO::FETCH_ASSOC);
                    $type = $types[$user['typeAbonnement']];
                $unAbonnee = new Abonne((int)$user['id'], $user['nom'] , $user['prenom'] , $user['dateNaissance'] , $user['adresse'] , $user['numTel'] , $user['finAbonnement'] , $user['mdpU'] , $user['mailU'], $type, $user['frais']); 
                
                return $unAbonnee;
                }
                else{
                    return null;
                }
            }
            
            public function getList() : array 
            {

                $typeAbonnementManager = new typeAbonnementManager();
                $types = $typeAbonnementManager->getList();
                
                $q = $this->getPDO()->prepare('SELECT * FROM abonné');
                $q->execute();
                $r1 = $q->fetchAll(PDO::FETCH_ASSOC);
                
                $lesAbonnees = array();
                foreach($r1 as $user)
                {
                    $type = $types[$user['typeAbonnement']];
                    $lesAbonnees[$user['id']] = new Abonne((int)$user['id'], $user['nom'] , $user['prenom'] , $user['dateNaissance'] , $user['adresse'] , $user['numTel'] , $user['finAbonnement'] , $user['mdpU'] , $user['mailU'], $type, $user['frais']); 
                }
                return $lesAbonnees;
                
            }

            function updateMdp($id, $mdpActuel, $nouveauMdp, $confirmationMdp) {
                try {
                    // Vérifier les conditions du mot de passe : 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial, 12 caractères minimum.
                    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$/', $nouveauMdp)) {
                        return "Le nouveau mot de passe ne respecte pas les critères requis.";
                    }
            
                    // Vérifier si le mot de passe actuel correspond à celui de l'utilisateur
                    $req = $this->getPDO()->prepare('SELECT mdpU FROM abonné WHERE id = :id');
                    $req->bindParam(':id', $id, PDO::PARAM_INT);
                    $req->execute();
                    $resultat = $req->fetch(PDO::FETCH_ASSOC);
                    $mdpActuelHash = $resultat['mdpU'];
            
                    if (!password_verify($mdpActuel, $mdpActuelHash)) {
                        return "Le mot de passe actuel est incorrect.";
                    }
            
                    // Vérifier si la confirmation du nouveau mot de passe correspond au nouveau mot de passe
                    if ($nouveauMdp !== $confirmationMdp) {
                        return "La confirmation du mot de passe ne correspond pas au nouveau mot de passe.";
                    }
            
                    $nouveauMdpCrypte = password_hash($nouveauMdp, PASSWORD_DEFAULT);
                    $req = $this->getPDO()->prepare('UPDATE abonné SET mdpU = :mdpU WHERE id = :id');
                    $req->bindParam(':id', $id, PDO::PARAM_INT);
                    $req->bindParam(':mdpU', $nouveauMdpCrypte, PDO::PARAM_STR);
                    $resultat = $req->execute();
            
                    if ($resultat) {
                        return "Le mot de passe a été mis à jour avec succès.";
                    } else {
                        return "Une erreur est survenue lors de la mise à jour du mot de passe.";
                    }
                } catch (PDOException $e) {
                    return "Erreur !: " . $e->getMessage();
                }
            }
            

            

                function insertAbo($nom, $prenom, $dateNaiss, $adresse, $numTel, $mailU) {
        try {
            // Vérifier si l'adresse e-mail existe déjà
            $existingEmail = $this->checkExistingEmail($mailU);

            if ($existingEmail) {
                // Adresse e-mail déjà utilisée, renvoyer une erreur
                throw new Exception("L'adresse e-mail est déjà utilisée pour un autre compte.");
            }

            // Calculer l'âge de l'utilisateur
            $dateNaissance = new DateTime($dateNaiss);
            $aujourdHui = new DateTime();
            $difference = $dateNaissance->diff($aujourdHui);
            $age = $difference->y;

            // Vérifier si l'utilisateur est éducateur
            if (isset($_POST['educateur']) && $_POST['educateur'] === 'on') {
                $typeAbonnement = '4'; // Mettre à jour le type d'abonnement à 4
            } else {
                // Déterminer le type d'abonnement en fonction de l'âge
                if ($age < 18) {
                    $typeAbonnement = '1';
                } elseif ($age >= 18 && $age <= 25) {
                    $typeAbonnement = '2';
                } else {
                    $typeAbonnement = '3';
                }
            }


            // Générer le mot de passe par défaut
            $mdpDefaut = date_format($dateNaissance, "dmY") . strtoupper(substr($nom, 0, 2));

            // Crypter le mot de passe par défaut
            $mdpCrypte = password_hash($mdpDefaut, PASSWORD_DEFAULT);

            $finAbo = date('Y-m-d', strtotime('+3 months'));

            // Insérer les données de l'abonné avec le mot de passe par défaut
            $sql = 'INSERT INTO abonné (nom, prenom, dateNaissance, adresse, numTel, typeAbonnement, finAbonnement, mdpU, mailU) 
                    VALUES (:nom, :prenom, :dateNaissance, :adresse, :numTel, :typeAbonnement, :finAbonnement, :mdpU, :mailU)';
            $req = $this->getPDO()->prepare($sql);
            $req->bindParam(':nom', $nom, PDO::PARAM_STR);
            $req->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $req->bindParam(':dateNaissance', $dateNaiss, PDO::PARAM_STR);
            $req->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $req->bindParam(':numTel', $numTel, PDO::PARAM_STR);
            $req->bindParam(':typeAbonnement', $typeAbonnement, PDO::PARAM_STR);
            $req->bindParam(':finAbonnement', $finAbo, PDO::PARAM_STR);
            $req->bindParam(':mdpU', $mdpCrypte, PDO::PARAM_STR);
            $req->bindParam(':mailU', $mailU, PDO::PARAM_STR);
            $resultat = $req->execute();
            
            return $resultat;
        } catch (PDOException $e) {
            // Gérer les erreurs de base de données d'une manière appropriée à votre application
            print "Erreur !: " . $e->getMessage();
            die();
        }
        }

        public function verifierFinAbonnement($abonne) {
            $finAbonnement = new DateTime($abonne->getFinAbonnement());
            $aujourdHui = new DateTime();
            $difference = $aujourdHui->diff($finAbonnement);
            $joursRestants = $difference->days;
        
            if ($joursRestants <= 7) {
                $message = 'Votre abonnement expire dans moins d\'une semaine ! Pensez à le renouveler.';
                // Retourne le message
                return $message;
            }
        
            // Retourne null si aucun message à afficher
            return null;
        }
        
                public function checkExistingEmail($mailU) {
                    $req = $this->getPDO()->prepare('SELECT COUNT(*) FROM abonné WHERE mailU = :mailU');
                    $req->bindParam(':mailU', $mailU, PDO::PARAM_STR);
                    $req->execute();
                    $count = $req->fetchColumn();
                    return ($count > 0);
                }
        
        
                public function updateAbonne($abonne)
                {
                    try {
                        // Mettre à jour les informations personnelles de l'abonné à l'exception de l'id, du type d'abonnement et de la date d'expiration
                        $sql = 'UPDATE abonné SET nom = :nom, prenom = :prenom, dateNaissance = :dateNaissance, adresse = :adresse, numTel = :numTel WHERE mailU = :mailU';
                        $q = $this->getPDO()->prepare($sql);
                        $q->bindValue(':nom', $abonne->getNom(), PDO::PARAM_STR);
                        $q->bindValue(':prenom', $abonne->getPrenom(), PDO::PARAM_STR);
                        $q->bindValue(':dateNaissance', $abonne->getDateNaissance(), PDO::PARAM_STR);
                        $q->bindValue(':adresse', $abonne->getAdresse(), PDO::PARAM_STR);
                        $q->bindValue(':numTel', $abonne->getNumTel(), PDO::PARAM_STR);
                        $q->bindValue(':mailU', $abonne->getMailU(), PDO::PARAM_STR);
                        $result = $q->execute();
                
                        if ($result) {
                            return "Les informations personnelles ont été mises à jour avec succès.";
                        } else {
                            return "Une erreur est survenue lors de la mise à jour des informations personnelles.";
                        }
                    } catch (PDOException $e) {
                        return "Erreur !: " . $e->getMessage();
                    }
                }
                


            function recupid() {

                $ret = false;
            
                if (isset($_SESSION["mailU"])) {
                    $abonneeManager = new abonneManager();
                    $util = $abonneeManager->getUtilisateurByMailU($_SESSION["mailU"]);
                    if ($util->getMailU() == $_SESSION["mailU"] && $util->getId() == $_SESSION["id"]
                    ) {
                        $ret = true;
                    }
                }
                return $ret;
            }

            function payerFrais($abonne){ 
                //Renitialise les frais de l'abonné passé en paramètre
                    $req = $this->getPDO()->prepare('UPDATE abonné SET frais = 0 WHERE id = :idAbonne');
                    $req->bindParam(':idAbonne', $abonne->getId(), PDO::PARAM_INT);
                    $req->execute();
            }

        }



