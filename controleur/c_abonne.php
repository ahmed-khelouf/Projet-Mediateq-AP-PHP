<?php

    // Inclusion du modèle et initialisation de l'objet manager
    $abonneManager = new AbonneManager();

    // Si l'utilisateur est connecté, récupérez ses informations à partir de la session
    if(isset($_SESSION['mailU'])) {
        $unAbonne = $abonneManager->getUtilisateurByMailU($_SESSION['mailU']);
    }

    // Si le formulaire de modification de mot de passe est soumis
    if(isset($_POST['id']) && isset($_POST['mdpU'])) {

        // Vérification du jeton CSRF
        if(isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

            $id = $_POST['id'];
            $mdpU = $_POST['mdpU'];

            // Mettre à jour le mot de passe de l'utilisateur
            $abonneManager->updateMdp($id, $mdpU);

            // Rediriger l'utilisateur vers la page de connexion
            // ...
            $connexionManager = new ConnexionManager();
            $connexionManager->logout();

            $message = "Votre mot de passe a été changé avec succès, vous serez deconecté.";

            // Affichage du message
            echo "<h2>$message</h2>";

            // Redirection de l'utilisateur vers la page de connexion
            header("Refresh: 3; URL=./?action=connexion");
            exit();

        } else {
            // Si le jeton CSRF est invalide, afficher une erreur ou rediriger l'utilisateur vers une page d'erreur
            // ...
            echo "<h2>Erreur ! Le jeton CSRF est invalide.</h2>";
            exit(); // Terminer le script pour éviter toute autre exécution
        }
    }

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
