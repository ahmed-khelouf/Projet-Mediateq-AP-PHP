<?php

$titre = "Mon dossier - Mediateq";

    // Inclusion du modèle et initialisation de l'objet manager
    $abonneManager = new AbonneManager();

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
