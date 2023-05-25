    <?php
    // Inclusion du modèle et initialisation de l'objet manager
    $abonneManager = new AbonneManager();

    // Si l'utilisateur est connecté, récupérez ses informations à partir de la session
    if(isset($_SESSION['mailU'])) {
        $unAbonne = $abonneManager->getUtilisateurByMailU($_SESSION['mailU']);
    }

    if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['dateNaissance']) && isset($_POST['adresse']) && isset($_POST['numTel']) && isset($_POST['mailU'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $dateNaiss = $_POST['dateNaissance'];
        $adresse = $_POST['adresse'];
        $numTel = $_POST['numTel'];
        $mailU = $_POST['mailU'];

        // Vérification du jeton CSRF
        if(isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

            // Vérifier si l'adresse e-mail existe déjà
            $existingEmail = $abonneManager->checkExistingEmail($mailU);

            if ($existingEmail) {
                // Adresse e-mail déjà utilisée, afficher un message d'erreur
                $message = "L'adresse e-mail est déjà utilisée pour un autre compte.";
                echo "<h2>$message</h2>";
            } else {
                // Générer le mot de passe par défaut
                $mdpDefaut = date_format(date_create($dateNaiss), "dmY") . strtoupper(substr($nom, 0, 2));

                // Insérer l'abonné avec le mot de passe par défaut
                $abonneManager->insertAbo($nom, $prenom, $dateNaiss, $adresse, $numTel, $mailU);

                // Message de redirection
                $message = "Inscription réussie. Vous allez être redirigé vers la page de connexion dans quelques instants.";

                // Affichage du message
                echo "<h2>$message</h2>";

                // Redirection vers la page avec le message
                header("Refresh: 3; URL=./?action=connexion");
                exit();
            }
        } else {
            echo "<h2>Erreur ! Le jeton CSRF est invalide.</h2>";
        }
    }

    // Générer un jeton CSRF unique
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
    include "$racine/vue/v_inscription.php";
    include "$racine/vue/footer.php";
    ?>
