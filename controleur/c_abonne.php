    <?php
    include 'config.php';

    $titre = "Mon dossier - Mediateq";

    $logsManager = new LogsManager();

    // Inclusion du modèle et initialisation de l'objet manager
    $abonneManager = new AbonneManager();

    $typeAboManager = new TypeAbonnementManager();

    // Si l'utilisateur est connecté, récupérez ses informations à partir de la session
    if (isset($_SESSION['mailU'])) {
        $unAbonne = $abonneManager->getUtilisateurByMailU($_SESSION['mailU']);
    }

    if (isset($_POST['id']) && isset($_POST['mdpActuel']) && isset($_POST['nouveauMdp']) && isset($_POST['confirmationMdp'])) {
        if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
            $id = $_POST['id'];
            $mdpActuel = $_POST['mdpActuel'];
            $nouveauMdp = $_POST['nouveauMdp'];
            $confirmationMdp = $_POST['confirmationMdp'];

            // Mettre à jour le mot de passe de l'utilisateur
            $resultat = $abonneManager->updateMdp($id, $mdpActuel, $nouveauMdp, $confirmationMdp);

            // Affichage du message de résultat
            echo "<h2>$resultat</h2>";

            if ($resultat === "Le mot de passe a été mis à jour avec succès.") {
                // Redirection de l'utilisateur vers la page de connexion après 3 secondes
                header("Refresh: 3; URL=./?action=connexion");
                exit();
            }
        } else {
            // Si le jeton CSRF est invalide, afficher une erreur
            echo "<h2>Erreur ! Le jeton CSRF est invalide.</h2>";
        }
    }

            // Vérification de la soumission du formulaire
    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['dateNaissance']) && isset($_POST['adresse']) && isset($_POST['numTel']) && isset($_POST['mailU'])) {
        if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

            // Récupération des données du formulaire
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $dateNaiss = $_POST['dateNaissance'];
            $adresse = $_POST['adresse'];
            $numTel = $_POST['numTel'];
            $mailU = $_POST['mailU'];

            // Obtention des données existantes de l'abonné
            $id = $unAbonne->getId();
            $typeAboObj = $unAbonne->getTypeAbonnement();
            $finAbo = $unAbonne->getFinAbonnement();
            $mdpU = $unAbonne->getMdpU();
            $frais = $unAbonne->getFrais();

            // Création de l'objet TypeAbonnement
            $typeAbo = new TypeAbonnement($typeAboObj->getId(), $typeAboObj->getLibelle());

            // Création de l'objet Abonne avec les nouvelles informations
            $abonne = new Abonne($id, $nom, $prenom, $dateNaiss, $adresse, $numTel, $finAbo, $mdpU, $mailU, $typeAbo, $frais);

            // Mettre à jour les informations personnelles de l'abonné
            $resultat = $abonneManager->updateAbonne($abonne);

            // Affichage du message de résultat
            echo "<h2>$resultat</h2>";
        } else {
            // Si le jeton CSRF est invalide, afficher une erreur
            echo "<h2>Erreur ! Le jeton CSRF est invalide.</h2>";
        }
    }


    if (defined('LOGS_ENABLED') && LOGS_ENABLED && isset($_SESSION['mailU'])) {
        $idAbonne = $unAbonne->getId();
        $pageConsultee = $titre; // Utilisez la variable $titre actuelle pour obtenir le nom de la page consultée
        $dateConsultation = date('Y-m-d H:i:s');
        $logsManager->logPageConsultee($idAbonne, $pageConsultee, $dateConsultation);
    }

    // Reste du code pour afficher la vue, etc.

    // Vérifier si le jeton CSRF existe déjà dans la session
    if (!isset($_SESSION['csrf_token'])) {
        // Générer un jeton CSRF unique s'il n'existe pas
        $csrf_token = bin2hex(random_bytes(32));

        // Stocker le jeton CSRF en session
        $_SESSION['csrf_token'] = $csrf_token;
    } else {
        // Utiliser le jeton CSRF existant s'il existe déjà
        $csrf_token = $_SESSION['csrf_token'];
    }

    // Inclusion de la vue
    include "$racine/vue/header.php";
    include "$racine/vue/v_monDossier.php";
    include "$racine/vue/footer.php";
    ?>
